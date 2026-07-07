@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/goal_setting.css')}}">
@endsection

@section('content')
<div class="background">
    <div class="goal-content">
        <h2 class="goal-title">目標体重設定</h2>
        <form method="post" action="/weight_logs/goal_setting" class="goal-setting">
            @csrf
            @method('patch')
            <div class="goal-setting__form">
                <input type="text" class="goal-setting__input" name="target_weight" value="{{old('target_weight', $weightTarget->target_weight)}}">
                <input type="hidden" name="id" value="{{$weightTarget->id}}">
                <span class="goal-setting__unit">kg</span>
            </div>
            <div class="goal-setting__form-error">
                @error('target_weight')
                {{$message}}
                @enderror
            </div>
            <div class="goal-setting__button">
                <a href="/weight_logs" class="goal-setting__button-back">戻る</a>
                <button class="goal-setting__button-update" type="submit">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection