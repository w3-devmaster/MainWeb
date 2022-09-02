@extends('layouts.master')
@section('title', 'แก้ไขภาพ')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <h2>slide edit</h2>
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <hr>
        {!! Form::open(['action' => ['App\Http\Controllers\SlideController@update', $slide->id], 'method' => 'put', 'files' => true]) !!}
        <img class="img-fluid mb-2" src="{{ Storage::url($slide->img) }}" alt="">
        <div class="input-group input-group-sm mb-3">
            <label class="input-group-text" for="inputGroupFile01">image</label>
            <input name="image" type="file" class="form-control" id="inputGroupFile01">
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">image title</span>
            {!! Form::text('title', $slide->title, ['class' => 'form-control', 'placeholder' => 'ชื่อภาพ', 'required']) !!}
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">image descriptions</span>
            {!! Form::text('descriptions', $slide->descriptions, ['class' => 'form-control', 'placeholder' => 'คำบรรยายภาพ', 'required']) !!}
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">url</span>
            {!! Form::text('url', $slide->url, ['class' => 'form-control', 'placeholder' => 'url', 'required']) !!}
        </div>
        <hr>
        <div class="d-grid gap-2">
            {!! Form::submit('update slide', ['class' => 'btn btn-success btn-sm']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    <script>
        CKEDITOR.replace('content', {
            height: 600,
        });
    </script>
@endsection
