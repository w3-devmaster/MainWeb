@extends('layouts.master')
@section('title', 'ซื้อ Cash')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <hr>
        <table class="table-sm table-striped table-dark table-borderless thai f-12 table">
            <tbody>
                <tr>
                    <td>Id</td>
                    <td>{{ $user->username }}</td>
                </tr>
                <tr>
                    <td>ID Status :</td>
                    <td>{!! $ac['billing']->Status == 2 ? '<span class="text-success" >Premium</span>' : 'Normal' !!}</td>
                </tr>
                @if ($ac['billing']->Status == 2)
                    <tr>
                        <td>Premium Expire :</td>
                        <td class="thai f-12 align-middle">
                            {{ thai_date_time(strtotime($ac['billing']->DTEndPrem)) }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="text-warning">Money :</td>
                    <td class="text-warning">{{ number_format($user->money, 2) }} THB</td>
                </tr>
                <tr>
                    <td class="text-warning">Bonus :</td>
                    <td class="text-warning">{{ number_format($user->bonus, 2) }} Point</td>
                </tr>
                <tr>
                    <td class="text-warning">Cash :</td>
                    <td class="text-warning">{{ number_format($ac['billing']->Cash) }} Cash</td>
                </tr>
            </tbody>
        </table>
        <hr>
        {!! Form::open(['route' => 'buycash_update']) !!}
        <div class="row thai">
            <div class="col-12">
                <p>ซื้อ Cash สำหรับเล่นในเกม</p>
            </div>
            <div class="col-12">
                <label for="prem-range" class="form-label">ระบุจำนวนวันที่ต้องการ</label>
                <input name="bath" type="range" class="form-range" min="1" max="{{ $user->money }}" step="0.01" id="prem-range" value="1" oninput="changeVal(this.value)">
                <hr>
                <p>จำนวนเงินที่ต้องการแลก : <span id="money">1</span> THB</p>
                <p class="text-warning">อัตราแลกเปลี่ยน : {{ getSetting()->exchange }} Cash / ต่อ 1 THB</p>
                <p class="text-success">จำนวน Cash ที่จะได้รับ : <span id="total">{{ getSetting()->exchange * 1 }}</span> THB</p>
            </div>
            <div class="col-12">
                <div class="d-grid gap-2">
                    {!! Form::submit('ซื้อ Cash', ['class' => 'btn btn-sm btn-success', 'disabled' => $user->money <= 0 ? true : false]) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <script>
        const changeVal = (val) => {
            let price = {{ getSetting()->exchange }}
            document.getElementById('money').innerHTML = val;
            document.getElementById('total').innerHTML = Math.floor(val * price);
        }
    </script>
@endsection
