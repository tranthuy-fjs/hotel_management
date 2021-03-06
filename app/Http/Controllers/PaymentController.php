<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        session(['cost_id' => Auth::id()]);
        session(['url' => route('booking.list')]);
        $vnp_TmnCode = "I6FSGNZG";
        $vnp_HashSecret = "OBOMXCJARZELJLOKHYGVBVAHAXXVHAWN";
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8080/hotel_management/public/return-vnpay";
        $vnp_TxnRef = date("YmdHis");
        $vnp_OrderInfo = "Thanh toán hóa đơn";
        $vnp_OrderType = 'billpayment';
        // $vnp_Amount = 10000 * 100;
        $vnp_Amount = $request->total_price * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }

    public function returnUrl(Request $request)
    {
        if (Auth::check()) {
            $url = session('url', '/');
            if ($request->vnp_ResponseCode == "00") {
                return redirect($url);
            }
            session()->forget('url');
            return redirect()->route('booking')->with('errors', 'Lỗi trong quá trình thanh toán phí dịch vụ');
        } else {
            if ($request->vnp_ResponseCode == "00") {
                return redirect()->route('payment')->with('success', "Đặt phòng thành công!");
            }
            session()->forget('url');
            return redirect()->route('booking')->with('errors', 'Lỗi trong quá trình thanh toán phí dịch vụ');
        }
    }

    public function payment()
    {
        return view('frontend.contents.booking.payment');
    }
}
