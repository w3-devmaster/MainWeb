@extends('layouts.master')
@section('title','สมัครไอดีใหม่')
@section('content')
<div class="bg-alpha rounded border border-secondary p-2" >
    <div class="row">
        <div class="col-12 mx-auto">
            <h2>register</h2>
            <div class="rounded border border-secondary mb-3 p-3 thai">
                <p><u>กฎระเบียบและข้อตกลงการใช้งาน</u></p>
                <ul class="f-12" >
                    <li>ห้ามเปิดเผย ไอดี หรือ รหัสผ่านให้ผู้อื่นทราบ เพื่อความปลอดภัยของข้อมูลไอดีของท่านเอง</li>
                    <li>ห้ามผู้เล่นทำการใช้บัค เพื่อหาผลประโยชน์ใดๆในเกม หากฝ่าฝึนจะทำการแบนไอดีถาวร</li>
                    <li>หากมีการซื้อขายไอดีโดยไม่มีการรับรองจากทีมงาน กรณีนี้จะไม่รับผิดชอบในทุกกรณี</li>
                    <li>ผู้เล่นสามารถซื่อขายเงิน และไอเท็มในเกมเป็นเงินจริงได้อย่างอิสระ</li>
                    <li>ห้ามใช้โปรแกรมโกง หากฝ่าฝืนจะทำการแบนไอดีถาวร โดยไม่ละเว้นโทษใดๆ</li>
                </ul>
                {{-- <img id="register-logo" class="w-25 d-block mx-auto" src="{{ Storage::url('images/cora.png') }}" alt=""> --}}
            </div>
        {!! Form::open(['action' => 'App\Http\Controllers\SignupController@store','method' => 'post']) !!}
            <div class="row mb-3">
                <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                <div class="col-md-5">
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                <div class="col-md-5">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                <div class="col-md-5">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                <div class="col-md-5">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-5 offset-md-4 d-grid gap-2">
                    <button type="submit" class="btn btn-outline-secondary btn-sm text-success">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
