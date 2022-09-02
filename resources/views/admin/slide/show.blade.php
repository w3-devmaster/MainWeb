@extends('layouts.master')
@section('title', $slide->title)
@section('content')
    <div class="bg-alpha border-secondary tahoma rounded border p-2">
        <h2 class="en">slide view</h2>
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <div class="float-end">
            {!! Form::open(['action' => ['App\Http\Controllers\SlideController@destroy', $slide->id], 'method' => 'delete', 'id' => 'formdel_' . $slide->id]) !!}
            <a class="btn btn-warning btn-sm" href="{{ route('slide.edit', $slide->id) }}"><i class="fa-solid fa-edit"></i></a>
            <button type="submit" class="btn btn-danger btn-sm" onclick="confDel('{{ $slide->id }}');return false;"><i class="fa fa-trash-alt"></i></button>
            {!! Form::close() !!}
        </div>
        <hr>
        <img class="img-fluid d-block mx-auto" src="{{ Storage::url($slide->img) }}" alt="">
        <hr>
        <h3 class="thai">Title : {{ $slide->title }}</h3>
        <div class="news-content mt-3">
            Details : {!! $slide->descriptions !!}
        </div>
        url : <a class="btn btn-success" target="_new" href="{{ $slide->url }}">URL</a>
    </div>
    <script>
        const confDel = (id) => {
            alertify.confirm('ลบข้อมูล', 'ต้องการลบข้อมูลนี้หรือไม่?', function() {
                document.getElementById('formdel_' + id).submit();
            }, function() {
                alertify.error('การลบถูกยกเลิก !')
            });
        }
    </script>
@endsection
