@extends('layouts.master')
@section('title', 'เติมเงิน')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <h2>topup system</h2>
        {!! Form::open(['action' => 'App\Http\Controllers\TopupController@store', 'method' => 'post', 'files' => true]) !!}
        <div class="row tahoma">
            <div class="col-12">
                กรุณาแสกนชำระเงินด้วย QR Code หรือโอนเงิน ตามที่เห็นอยู่ด้านล่าง ตามจำนวนเงินที่ท่านต้องการ
            </div>
            <div class="col-lg-6 col-md-8 col-12 mx-auto">
                <img class="img-fluid" src="{{ Storage::url('images/bank.jpg') }}" />
            </div>
            <div class="col-12">
                <p class="text-center">ธนาคารกสิกรไทย</p>
                {{-- <p class="text-center">เลขบัญชี : 1-331-53984-4</p> --}}
                <p class="text-center">ชื่อบัญชี : นางสาว นันท์นภัา บุตดา</p>
                <hr>
            </div>
            <div class="col-12">
                <div class="alert alert-danger f-12">
                    *การแจ้งโอนเงินเท็จ อาจมีผลให้ถูกระงับบัญชี
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">จำนวนเงิน</label>
                    <input name="amount" type="number" class="form-control form-control-sm" id="exampleFormControlInput1" placeholder="จำนวนเงินพร้อมจุดทศนิยม" min="0.01" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="formFileSm" class="form-label">อัปโหลดหลักฐานการชำระเงิน</label>
                    <input name="image" class="form-control form-control-sm" id="formFileSm" type="file" required>
                </div>
                <div class="d-grid gap-2">
                    {!! Form::submit('แจ้งชำระเงิน', ['class' => 'btn btn-success btn-sm']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        <div class="row">
            <div class="col-12">
                <hr>
                <table class="table-striped table-dark table-bordered table-sm f-12 tahoma table text-center">
                    <thead>
                        <tr>
                            <th colspan="4">ประวัติการเติมเงิน</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>มูลค่า</th>
                            <th>สถานะ</th>
                            <th>แจ้งโอนเมื่อ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($his as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ number_format($item->amount, 2) }} THB</td>
                                <td>{!! getTopupStatus($item->status) !!}</td>
                                <td>{{ thai_date_time_short(strtotime($item->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
