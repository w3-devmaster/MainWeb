@extends('layouts.master')
@section('title', 'สร้างข่าวสารใหม่')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <h2>news create</h2>
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <hr>
        {!! Form::open(['action' => 'App\Http\Controllers\NewsController@store', 'method' => 'post', 'files' => true]) !!}
        <div class="input-group input-group-sm mb-3">
            <label class="input-group-text" for="inputGroupFile01">title image</label>
            <input name="image" type="file" class="form-control" id="inputGroupFile01" required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">news title</span>
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'ห้วข้อข่าว', 'required']) !!}
        </div>
        <p>news content</p>
        <textarea name="content" id="content"></textarea>
        <hr>
        <div class="d-grid gap-2">
            {!! Form::submit('add news', ['class' => 'btn btn-success btn-sm']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    <script>
        CKEDITOR.replace('content', {
            height: 600,
        });
    </script>
@endsection
