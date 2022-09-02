@extends('layouts.master')
@section('title', 'สร้างข่าวสารใหม่')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <h2>pages create</h2>
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <hr>
        {!! Form::open(['action' => 'App\Http\Controllers\PageContentController@store', 'method' => 'post']) !!}
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">pages title</span>
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'ชื่อหน้า', 'required']) !!}
        </div>
        <p>pages content</p>
        <textarea name="content" id="content"></textarea>
        <hr>
        <div class="d-grid gap-2">
            {!! Form::submit('add pages', ['class' => 'btn btn-success btn-sm']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    <script>
        CKEDITOR.replace('content', {
            height: 600,
        });
    </script>
@endsection
