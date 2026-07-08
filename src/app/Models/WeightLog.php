<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WeightLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'date', 'weight', 'calories',
        'exercise_time', 'exercise_content'
    ];

    protected $casts = [
        'date' => 'date:Y/m/d',
        'exercise_time' => 'datetime:H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeDateSearch($query, $startDate, $endDate)
    {
        if ($startDate && $endDate) {
            return $query->whereBetween('date', [$startDate, $endDate]);
        }

        if ($startDate) {
            return $query->where('date', '>=', $startDate);
        }

        if ($endDate) {
            return $query->where('date', '<=', $endDate);
        }

        return $query;
    }
}
