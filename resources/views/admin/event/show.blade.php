@extends('layouts.master')
@section('title', $event->title)
@section('content')
    <div class="bg-alpha border-secondary tahoma rounded border p-2">
        <h2 class="en">event view</h2>
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <div class="float-end">
            {!! Form::open(['action' => ['App\Http\Controllers\EventController@destroy', $event->id], 'method' => 'delete', 'id' => 'formdel_' . $event->id]) !!}
            <a class="btn btn-warning btn-sm" href="{{ route('event.edit', $event->id) }}"><i class="fa-solid fa-edit"></i></a>
            <button type="submit" class="btn btn-danger btn-sm" onclick="confDel('{{ $event->id }}');return false;"><i class="fa fa-trash-alt"></i></button>
            {!! Form::close() !!}
        </div>
        <hr>
        <h3 class="thai">{{ $event->title }}</h3>
        <img class="img-fluid d-block mx-auto" src="{{ Storage::url($event->img) }}" alt="">
        <div class="event-content mt-3">
            {!! $event->content !!}
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
