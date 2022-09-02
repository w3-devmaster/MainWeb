@extends('layouts.master')
@section('title', 'ไอดี GM')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <h2>gm management</h2>
        <hr>
        <a class="btn btn-sm btn-success" href="{{ route('gm.create') }}"><i class="fa-solid fa-plus-circle me-2"></i> add gm</a>
        <hr>
        <table class="table-sm table-striped table-dark table-borderless thai f-12 table">
            <thead>
                <tr>
                    <td class="text-center align-middle">#</td>
                    <td class="text-center align-middle">ไอดีเว็บ</td>
                    <td class="text-center align-middle">ไอดีเกม</td>
                    <td class="text-center align-middle">เกรด</td>
                    <td class="text-center align-middle">วันหมดอายุ</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($gm as $item)
                    <tr>
                        <td class="text-center align-middle">{{ $item->id }}</td>
                        <td class="text-center align-middle">{{ $item->username }}</td>
                        <td class="text-center align-middle">{{ getGmData($item->username)->ID }}</td>
                        <td class="text-center align-middle">{{ getGmData($item->username)->Grade . ' : ' . getGmData($item->username)->SubGrade }}</td>
                        <td class="text-center align-middle">{{ thai_date_time_short(strtotime(getGmData($item->username)->ExpireDT)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-12 d-flex justify-content-center">
            {!! $gm->links() !!}
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
