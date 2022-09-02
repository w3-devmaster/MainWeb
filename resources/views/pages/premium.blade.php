@extends('layouts.master')
@section('title', 'ไอดีพรีเมี่ยม')
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
        {!! Form::open(['route' => 'premium_update']) !!}
        <div class="row thai">
            <div class="col-12">
                <p>ซื้อ Premium ID เพื่อรับสิทธิพิเศษที่มากกว่า</p>
            </div>
            <div class="col-12">
                <label for="prem-range" class="form-label">ระบุจำนวนวันที่ต้องการ</label>
                <input name="day" type="range" class="form-range" min="1" max="{{ $user->money / getSetting()->premium > 90 ? 90 : $user->money / getSetting()->premium }}" step="1" id="prem-range" value="1" oninput="changeVal(this.value)">
                <hr>
                <p>จำนวนวัน : <span id="date">1</span> วัน</p>
                <p class="text-warning">ราคา : {{ getSetting()->premium }} THB / ต่อวัน</p>
                <p class="text-success">จำนวนที่ต้องจ่าย : <span id="total">{{ getSetting()->premium * 1 }}</span> THB</p>
            </div>
            <div class="col-12">
                <div class="d-grid gap-2">
                    {!! Form::submit('ซื้อ Premium', ['class' => 'btn btn-sm btn-success', 'disabled' => $user->money / getSetting()->premium <= 0 ? true : false]) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <script>
        const changeVal = (val) => {
            let price = {{ getSetting()->premium }}
            document.getElementById('date').innerHTML = val;
            document.getElementById('total').innerHTML = (val * price).toFixed(2);
        }
    </script>
@endsection
