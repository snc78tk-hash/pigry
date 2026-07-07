<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterWeightRequest;
use App\Http\Requests\WeightLogRequest;
use App\Http\Requests\WeightTargetRequest;

class WeightController extends Controller
{
    public function weight(){
        return view('auth.register_step2');
    }

    public function storeWeight(RegisterWeightRequest $request){
        $createdAt=now();
        $formattedDate=$createdAt->format('Y/m/d');
        $userId=Auth::id();
        WeightLog::create([
            'user_id'=>$userId,
            'date'=>$formattedDate,
            'weight'=>$request->weight
        ]);
        WeightTarget::create([
            'user_id'=>$userId,
            'target_weight'=>$request->target_weight
        ]);
        return redirect('/weight_logs');
    }

    public function admin(){
        $userId=Auth::id();
        $startDate='';
        $endDate='';
        $weightLogs=WeightLog::with('user')->where('user_id', $userId)->Paginate(8);
        $latestWeightLog=WeightLog::with('user')->where('user_id', $userId)->orderBy('created_at', 'desc')->first();
        $weightTarget=WeightTarget::with('user')->where('user_id', $userId)->orderBy('created_at', 'desc')->first();
        return view('admin', compact('weightLogs', 'weightTarget', 'latestWeightLog', 'startDate', 'endDate'));
    }

    public function goalSetting(){
        $userId=Auth::id();
        $weightTarget=WeightTarget::with('user')->where('user_id', $userId)->first();
        return view('goal_setting', compact('weightTarget'));
    }

    public function goalUpdate(WeightTargetRequest $request){
        $weightTarget=$request->only(['target_weight']);
        WeightTarget::find($request->id)->update($weightTarget);
        return redirect('/weight_logs');
    }

    public function store(WeightLogRequest $request){
        $userId=Auth::id();
        $weightLogs=$request->only(['date', 'weight', 'calories', 'exercise_time', 'exercise_content']);
        $weightLogs['user_id']=$userId;
        WeightLog::create($weightLogs);
        return redirect('/weight_logs');
    }

    public function search(Request $request){
        $userId=Auth::id();
        $startDate=$request->start_date;
        $endDate=$request->end_date;
        $weightLogs=WeightLog::with('user')->where('user_id', $userId)->DateSearch($startDate, $endDate)->Paginate(8)->appends([
            'start_date'=>$startDate,
            'end_date'=>$endDate
        ]);
        $latestWeightLog=WeightLog::with('user')->where('user_id', $userId)->orderBy('created_at', 'desc')->first();
        $weightTarget=WeightTarget::with('user')->where('user_id', $userId)->orderBy('created_at', 'desc')->first();
        return view('admin', compact('weightLogs', 'weightTarget', 'latestWeightLog', 'startDate', 'endDate'));
    }

    public function detail($weightLogId){
        $weightLog=WeightLog::find($weightLogId);
        return view('detail', compact('weightLog'));
    }

    public function update(WeightLogRequest $request, $weightLogId){
        $weightLog=$request->only(['date', 'weight', 'calories', 'exercise_time', 'exercise_content']);
        WeightLog::find($weightLogId)->update($weightLog);
        return redirect('/weight_logs');
    }

    public function destroy($weightLogId){
        WeightLog::find($weightLogId)->delete();
        return redirect('/weight_logs');
    }
}