<div>
    <button class="weight-logs__create--button" wire:click="openModal()" type="button">
        データ追加
    </button>

    @if($showModal || $errors->any())
        <div class="modal__background">
            <div class="modal">
                <h2 class="modal-title">Weight Logを追加</h2>
                <form action="/weight_logs/create" class="modal-form" method="post">
                    @csrf
                    <div class="modal-form__group">
                        <div class="modal-form__heading">
                            <span class="modal-form__heading-name">日付</span>
                            <span class="modal-form__heading-required">必須</span>
                        </div>
                        <div class="modal-form__content-date">
                            <input type="date" class="modal-form__input-date" name="date" value="{{old('date', now()->format('Y-m-d'))}}">
                        </div>
                        <div class="modal-error">
                            @error('date')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="modal-form__group">
                        <div class="modal-form__heading">
                            <span class="modal-form__heading-name">体重</span>
                            <span class="modal-form__heading-required">必須</span>
                        </div>
                        <div class="modal-form__content-unit">
                            <input type="text" class="modal-form__input-weight" name="weight" placeholder="50.0" value="{{old('weight')}}">
                            <span class="modal-form__input-unit">kg</span>
                        </div>
                        <div class="modal-error">
                            @error('weight')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="modal-form__group">
                        <div class="modal-form__heading">
                            <span class="modal-form__heading-name">摂取カロリー</span>
                            <span class="modal-form__heading-required">必須</span>
                        </div>
                        <div class="modal-form__content-unit">
                            <input type="text" class="modal-form__input-calories" name="calories" placeholder="1200" value="{{old('calories')}}">
                            <span class="modal-form__input-unit">cal</span>
                        </div>
                        <div class="modal-error">
                            @error('calories')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="modal-form__group">
                        <div class="modal-form__heading">
                            <span class="modal-form__heading-name">運動時間</span>
                            <span class="modal-form__heading-required">必須</span>
                        </div>
                        <div class="modal-form__content-time">
                            <input type="time" class="modal-form__input-time" name="exercise_time" value="{{old('exercise_time')}}">
                        </div>
                        <div class="modal-error">
                            @error('exercise_time')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="modal-form__group">
                        <div class="modal-form__heading">
                            <span class="modal-form__heading-name">運動内容</span>
                        </div>
                        <div class="modal-form__content">
                            <textarea name="exercise_content" class="modal-form__textarea" placeholder="運動内容を追加">{{old('exercise_content')}}</textarea>
                        </div>
                        <div class="modal-error">
                            @error('exercise_content')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="modal-form__button">
                        <div class="modal-form__button-back">
                            <button class="modal-form__button-back--submit" wire:click="closeModal()" type="button">戻る</button>
                        </div>
                        <div class="modal-form__button-create">
                            <button class="modal-form__button-create--submit" type="submit">登録</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>