@extends('layouts.master')
@section('title', 'แก้ไขข่าวสาร')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <h2>event edit</h2>
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <hr>
        {!! Form::open(['action' => ['App\Http\Controllers\EventController@update', $event->id], 'method' => 'put', 'files' => true]) !!}
        <div class="input-group input-group-sm mb-3">
            <label class="input-group-text" for="inputGroupFile01">title image</label>
            <input name="img" type="file" class="form-control" id="inputGroupFile01">
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">event title</span>
            {!! Form::text('title', $event->title, ['class' => 'form-control', 'placeholder' => 'ห้วข้อข่าว', 'required']) !!}
        </div>
        <p>event content</p>
        <textarea name="content" id="content">{{ $event->content }}</textarea>
        <hr>
        <div class="d-grid gap-2">
            {!! Form::submit('update event', ['class' => 'btn btn-success btn-sm']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    <script>
        CKEDITOR.replace('content', {
            height: 600,
        });
    </script>
@endsection
