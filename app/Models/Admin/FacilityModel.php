<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class FacilityModel extends Model
{
    protected $table = 'facility';

    public function rooms()
    {
        return $this->hasMany(RoomFacilityModel::class, 'room_facility_id');
    }
}
