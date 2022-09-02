@extends('layouts.master')
@section('title', 'เพิ่มไอดี GM')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <h2>add gm</h2>
        <hr>
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <hr>
        {!! Form::open(['action' => 'App\Http\Controllers\GMController@store', 'method' => 'post']) !!}
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">username</span>
            {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'ไอดี', 'required', 'pattern' => '[!]+[A-Za-z0-9]*']) !!}
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">password</span>
            {!! Form::text('password', null, ['class' => 'form-control', 'placeholder' => 'รหัสผ่าน', 'required']) !!}
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">email</span>
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'อีเมล', 'required']) !!}
        </div>
        {{-- <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">grade</span>
            {!! Form::selectRange('grade', 1, 10, null, ['class' => 'form-select', 'placeholder' => 'เกรดจีเอ็ม', 'required']) !!}
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">subgrade</span>
            {!! Form::selectRange('subgrade', 1, 10, null, ['class' => 'form-select', 'placeholder' => 'ซับเกรดจีเอ็ม', 'required']) !!}
        </div> --}}
        <hr>
        <div class="d-grid gap-2">
            {!! Form::submit('add gm', ['class' => 'btn btn-success btn-sm']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
