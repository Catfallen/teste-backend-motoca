<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lead;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'brand',
        'model',
        'year',
        'price',
        'color',
        'mileage'
    ];

    protected $casts = [
        'year' => 'integer',
        'price' => 'float',
        'mileage' => 'integer',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}