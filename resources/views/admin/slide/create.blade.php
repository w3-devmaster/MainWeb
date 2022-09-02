@extends('layouts.master')
@section('title', 'สร้างข่าวสารใหม่')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <h2>image create</h2>
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <hr>
        {!! Form::open(['action' => 'App\Http\Controllers\SlideController@store', 'method' => 'post', 'files' => true]) !!}
        <div class="input-group input-group-sm mb-3">
            <label class="input-group-text" for="inputGroupFile01">image</label>
            <input name="image" type="file" class="form-control" id="inputGroupFile01" required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">image title</span>
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'ชื่อภาพ', 'required']) !!}
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">image descriptions</span>
            {!! Form::text('descriptions', null, ['class' => 'form-control', 'placeholder' => 'คำบรรยายภาพ', 'required']) !!}
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">url</span>
            {!! Form::text('url', '#', ['class' => 'form-control', 'placeholder' => 'url', 'required']) !!}
        </div>
        <hr>
        <div class="d-grid gap-2">
            {!! Form::submit('add image', ['class' => 'btn btn-success btn-sm']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
