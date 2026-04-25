<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'vehicle_id',
        'message'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}