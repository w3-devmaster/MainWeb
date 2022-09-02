@extends('layouts.master')
@section('title', 'การเติมเงิน')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <h2>topup list</h2>
        <hr>

        <hr>
        <table class="table-sm table-striped table-dark table-borderless thai f-12 mb-3 table">
            <thead>
                <tr>
                    <td colspan="5" class="text-center">รายการรออนุมัต</td>
                </tr>
                <tr>
                    <td class="text-center align-middle">#</td>
                    <td class="text-center align-middle">ไอดี</td>
                    <td class="text-center align-middle">จำนวนเงิน</td>
                    <td class="text-center align-middle">วันที่เติมเงิน</td>
                    <td class="text-center align-middle">จัดการ</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($wait as $item)
                    <tr>
                        <td class="text-center align-middle">
                            <button class="btn btn-sm btn-success f-12 py-0" onclick="popup('{{ Storage::url($item->img) }}','',500,600)">Slip</button>
                        </td>
                        <td class="text-center align-middle">{{ $item->username }}</td>
                        <td class="text-center align-middle">{{ number_format($item->amount, 2) }}</td>
                        <td class="text-center align-middle">{{ thai_date_time_short(strtotime($item->created_at)) }}</td>
                        <td class="text-center align-middle">
                            <a class="btn btn-warning btn-sm f-12 py-0 px-1" href="{{ route('refill.edit', $item->id) }}"><i class="fa-solid fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table class="table-sm table-striped table-dark table-borderless thai f-12 table">
            <thead>
                <tr>
                    <td colspan="5" class="text-center">รายการอนุมัตแล้ว</td>
                </tr>
                <tr>
                    <td colspan="3" class="f-18 text-success text-center">จำนวนเงินที่เติมผ่านในรอบนี้</td>
                    <td colspan="2" class="f-18 text-success text-center">{{ number_format($total_a, 2) }} บาท
                        {!! Form::open(['action' => 'App\Http\Controllers\RefillController@store', 'method' => 'post', 'id' => 'take', 'class' => 'd-inline']) !!}
                        <button type="submit" class="btn btn-success btn-sm ms-3 px-3 py-0" onclick="confTake({{ $total_a }});return false;">ตัดยอด</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="f-18 text-success text-center">วันที่เคลียร์ยอดล่าสุด</td>
                    <td colspan="2" class="f-18 text-success text-center">{{ thai_date_time(strtotime(getSetting()->take_money)) }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="f-18 text-success text-center">ผู้ดำเนินการเคลียร์ยอด</td>
                    <td colspan="2" class="f-18 text-success text-center">{{ getSetting()->taker ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="f-18 text-warning text-center">จำนวนเงินที่เติมผ่านทั้งหมด</td>
                    <td colspan="2" class="f-18 text-warning text-center">{{ number_format($total, 2) }} บาท</td>
                </tr>
                <tr>
                    <td class="text-center align-middle">#</td>
                    <td class="text-center align-middle">ไอดี</td>
                    <td class="text-center align-middle">จำนวนเงิน</td>
                    <td class="text-center align-middle">สถานะ</td>
                    <td class="text-center align-middle">วันที่เติมเงิน</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($succ as $item)
                    <tr>
                        <td class="text-center align-middle">
                            <button class="btn btn-sm btn-success f-12 py-0" onclick="popup('{{ Storage::url($item->img) }}','',500,600)">Slip</button>
                        </td>
                        <td class="text-center align-middle">{{ $item->username }}</td>
                        <td class="text-center align-middle">{{ number_format($item->amount, 2) }}</td>
                        <td class="text-center align-middle">{!! getTopupStatus($item->status) !!}</td>
                        <td class="text-center align-middle">{{ thai_date_time_short(strtotime($item->created_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $succ->links() !!}
        </div>
    </div>
    <script>
        const confTake = (val) => {
            alertify.confirm('ตัดยอดการเติมเงิน', `ต้องการตัดยอดเติมเงิน จำนวน ${val} บาท ในรอบนี้หรือไม่?`, function() {
                document.getElementById('take').submit();
            }, function() {
                alertify.error('การตัดยอดเติมเงินถูกยกเลิก !')
            });
        }
    </script>
@endsection
