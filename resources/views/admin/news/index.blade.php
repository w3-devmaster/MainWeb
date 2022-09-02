@extends('layouts.master')
@section('title', 'ข่าวสาร')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <h2>news management</h2>
        <hr>
        <a class="btn btn-sm btn-success" href="{{ route('news.create') }}"><i class="fa-solid fa-plus-circle me-2"></i> add news</a>
        <hr>
        <table class="table-sm table-striped table-dark table-borderless thai f-12 table">
            <thead>
                <tr>
                    <td class="text-center align-middle">#</td>
                    <td class="align-middle">หัวข้อข่าว</td>
                    <td class="text-center align-middle">ผู้เขียน</td>
                    <td class="text-center align-middle">วันที่ลงข่าว</td>
                    <td class="text-center align-middle">จัดการ</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $item)
                    <tr>
                        <td class="text-center align-middle">{{ $item->id }}</td>
                        <td class="align-middle">{{ Str::limit($item->title, 100, '...') }}</td>
                        <td class="text-center align-middle">{{ getUser($item->user)->username }}</td>
                        <td class="text-center align-middle">{{ thai_date_time_short(strtotime($item->created_at)) }}</td>
                        <td class="text-center align-middle">
                            {!! Form::open(['action' => ['App\Http\Controllers\NewsController@destroy', $item->id], 'method' => 'delete', 'id' => 'formdel_' . $item->id]) !!}
                            <a class="btn btn-info btn-sm f-12 py-0 px-1" href="{{ route('news.show', $item->id) }}"><i class="fa-solid fa-eye"></i></a>
                            <a class="btn btn-warning btn-sm f-12 py-0 px-1" href="{{ route('news.edit', $item->id) }}"><i class="fa-solid fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger btn-sm f-12 py-0 px-1" onclick="confDel('{{ $item->id }}');return false;"><i class="fa fa-trash-alt"></i></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-12 d-flex justify-content-center">
            {!! $news->links() !!}
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
    </div>
@endsection
