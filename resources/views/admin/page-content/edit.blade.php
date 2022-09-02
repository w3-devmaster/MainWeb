@extends('layouts.master')
@section('title', 'แก้ไขข่าวสาร')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <h2>pages edit</h2>
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <hr>
        {!! Form::open(['action' => ['App\Http\Controllers\PageContentController@update', $pageContent->id], 'method' => 'put']) !!}
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">pages title</span>
            {!! Form::text('title', $pageContent->title, ['class' => 'form-control', 'placeholder' => 'ห้วข้อข่าว', 'required']) !!}
        </div>
        <p>pages content</p>
        <textarea name="content" id="content">{{ $pageContent->content }}</textarea>
        <hr>
        <div class="d-grid gap-2">
            {!! Form::submit('update pages', ['class' => 'btn btn-success btn-sm']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    <script>
        CKEDITOR.replace('content', {
            height: 600,
        });
    </script>
@endsection
