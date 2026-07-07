<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WeightLog extends Model
{
    use HasFactory;

    protected $fillable=['user_id', 'date', 'weight', 'calories', 'exercise_time', 'exercise_content'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getDateAttribute($value){
        if(!$value){
            return null;
        }
        return Carbon::createFromFormat('Y-m-d', $value)->format('Y/m/d');
    }

    public function getExerciseTimeAttribute($value){
        if(!$value){
            return null;
        }
        return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function scopeDateSearch($query, $startDate, $endDate){
        if(!empty($startDate) && !empty($endDate)){
            $query->whereBetween('date', [$startDate, $endDate]);
        }elseif(!empty($startDate)){
            $query->where('date', '>=', $startDate);
        }elseif(!empty($endDate)){
            $query->where('date', '<=', $endDate);
        }
    }

    protected $casts=[
        'date'=>'date',
    ];
}