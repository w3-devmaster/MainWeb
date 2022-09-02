@extends('layouts.master')
@section('title', $news->title)
@section('content')
    <div class="bg-alpha border-secondary tahoma rounded border p-2">
        <h2 class="en">news view</h2>
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <div class="float-end">
            {!! Form::open(['action' => ['App\Http\Controllers\NewsController@destroy', $news->id], 'method' => 'delete', 'id' => 'formdel_' . $news->id]) !!}
            <a class="btn btn-warning btn-sm" href="{{ route('news.edit', $news->id) }}"><i class="fa-solid fa-edit"></i></a>
            <button type="submit" class="btn btn-danger btn-sm" onclick="confDel('{{ $news->id }}');return false;"><i class="fa fa-trash-alt"></i></button>
            {!! Form::close() !!}
        </div>
        <hr>
        <h3 class="thai">{{ $news->title }}</h3>
        <img class="img-fluid d-block mx-auto" src="{{ Storage::url($news->img) }}" alt="">
        <div class="news-content mt-3">
            {!! $news->content !!}
        </div>
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
