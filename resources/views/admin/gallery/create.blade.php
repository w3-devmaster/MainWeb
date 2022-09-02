@extends('layouts.gallery-master')
@section('title', 'เพิ่มรูปภาพใหม่')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <hr>
        {!! Form::open(['action' => 'App\Http\Controllers\GalleryController@store', 'method' => 'post', 'files' => true]) !!}
        <p>สามารถเลือกไฟล์ภาพได้สูงสุดครั้งละ 20 ไฟล์</p>
        <div class="input-group input-group-sm mb-3">
            <label class="input-group-text" for="inputGroupFile01">ไฟล์ภาพเท่านั้น</label>
            <input name="img[]" type="file" class="form-control" id="inputGroupFile01" multiple>
        </div>
        <div class="d-grid gap-2">
            {!! Form::submit('upload', ['class' => 'btn btn-success btn-sm']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
