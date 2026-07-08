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
    public function weight()
    {
        return view('auth.register_step2');
    }

    public function storeWeight(RegisterWeightRequest $request)
    {
        $userId = Auth::id();

        WeightLog::create([
            'user_id' => $userId,
            'date'    => now(), 
            'weight'  => $request->weight,
        ]);

        WeightTarget::create([
            'user_id'       => $userId,
            'target_weight' => $request->target_weight,
        ]);

        return redirect('/weight_logs');
    }

    public function admin()
    {
        $userId = Auth::id();

        $startDate = '';
        $endDate   = '';

        $weightLogs = WeightLog::where('user_id', $userId)->paginate(8);
        $latestWeightLog = WeightLog::where('user_id', $userId)->latest()->first();
        $weightTarget = WeightTarget::where('user_id', $userId)->latest()->first();

        return view('admin', compact('weightLogs', 'weightTarget', 'latestWeightLog', 'startDate', 'endDate'));
    }

    public function goalSetting()
    {
        $userId = Auth::id();
        $weightTarget = WeightTarget::where('user_id', $userId)->first();

        return view('goal_setting', compact('weightTarget'));
    }

    public function goalUpdate(WeightTargetRequest $request)
    {
        $target = WeightTarget::findOrFail($request->id);
        $target->update($request->only('target_weight'));

        return redirect('/weight_logs');
    }

    public function store(WeightLogRequest $request)
    {
        WeightLog::create([
            'user_id' => Auth::id(),
            ...$request->validated(),
        ]);

        return redirect('/weight_logs');
    }

    public function search(Request $request)
    {
        $userId = Auth::id();
        $startDate = $request->start_date;
        $endDate   = $request->end_date;

        $weightLogs = WeightLog::where('user_id', $userId)
            ->dateSearch($startDate, $endDate)
            ->paginate(8)
            ->appends([
                'start_date' => $startDate,
                'end_date'   => $endDate,
            ]);

        $latestWeightLog = WeightLog::where('user_id', $userId)->latest()->first();
        $weightTarget = WeightTarget::where('user_id', $userId)->latest()->first();

        return view('admin', compact('weightLogs', 'weightTarget', 'latestWeightLog', 'startDate', 'endDate'));
    }

    public function detail($weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);
        return view('detail', compact('weightLog'));
    }

    public function update(WeightLogRequest $request, $weightLogId)
    {
        $log = WeightLog::findOrFail($weightLogId);
        $log->update($request->validated());

        return redirect('/weight_logs');
    }

    public function destroy($weightLogId)
    {
        WeightLog::findOrFail($weightLogId)->delete();
        return redirect('/weight_logs');
    }
}