<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'country_name'
    ];

    public function provinces(){
        return $this->hasMany(ProvinceModel::class, 'country_id');
    }
}
