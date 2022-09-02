@extends('layouts.master')
@section('title', $pageContent->title)
@section('content')
    <div class="bg-alpha border-secondary tahoma rounded border p-2">
        <h2 class="en">pages view</h2>
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <div class="float-end">
            {!! Form::open(['action' => ['App\Http\Controllers\PageContentController@destroy', $pageContent->id], 'method' => 'delete', 'id' => 'formdel_' . $pageContent->id]) !!}
            <a class="btn btn-warning btn-sm" href="{{ route('page-content.edit', $pageContent->id) }}"><i class="fa-solid fa-edit"></i></a>
            <button type="submit" class="btn btn-danger btn-sm" onclick="confDel('{{ $pageContent->id }}');return false;"><i class="fa fa-trash-alt"></i></button>
            {!! Form::close() !!}
        </div>
        <hr>
        <h3 class="thai">{{ $pageContent->title }}</h3>
        <div class="pages-content mt-3">
            {!! $pageContent->content !!}
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
