@extends('layouts.master')
@section('title', 'จัดการไอดี')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <h2>users management</h2>
        <hr>
        {!! Form::open(['action' => 'App\Http\Controllers\UserController@search_user', 'method' => 'post']) !!}
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">ค้นหาไอดี</span>
            <input name="username" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            <input class="btn btn-info" type="submit" value="ค้นหาไอดี">
        </div>
        {!! Form::close() !!}
        <hr>
        <table class="table-sm table-striped table-dark table-borderless thai f-12 table">
            <thead>
                <tr>
                    <td class="text-center align-middle">#</td>
                    <td class="text-center align-middle">ไอดี</td>
                    <td class="text-center align-middle">เงิน</td>
                    <td class="text-center align-middle">โบนัส</td>
                    <td class="text-center align-middle">cash</td>
                    <td class="text-center align-middle">จัดการ</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                    <tr>
                        <td class="text-center align-middle">{{ $item->id }}</td>
                        <td class="text-center align-middle">{{ $item->username }}</td>
                        <td class="text-center align-middle">{{ number_format($item->money, 2) }}</td>
                        <td class="text-center align-middle">{{ number_format($item->bonus, 2) }}</td>
                        <td class="text-center align-middle">{{ number_format(getUserData($item->username)['billing']->Cash) }}</td>
                        <td class="text-center align-middle">
                            <a class="btn btn-info btn-sm f-12 py-0 px-1" href="{{ route('users.show', $item->id) }}"><i class="fa-solid fa-eye"></i></a>
                            <a class="btn btn-warning btn-sm f-12 py-0 px-1" href="{{ route('users.edit', $item->id) }}"><i class="fa-solid fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-12 d-flex justify-content-center">
            {!! $users->links() !!}
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
