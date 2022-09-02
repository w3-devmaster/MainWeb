@extends('layouts.master')
@section('title', 'ตั้งค่าระบบ')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <h2>system setting</h2>
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        {!! Form::open(['action' => ['App\Http\Controllers\SettingController@update', $setting->id], 'method' => 'put']) !!}
        <table class="table-striped table-dark table-sm table-bordered table">
            <tr>
                <td class="align-middle">login system</td>
                <td class="align-middle">
                    <input type="radio" value="1" class="btn-check" name="login" id="login-open" autocomplete="off" @if ($setting->login == true) checked @endif>
                    <label class="btn btn-sm thai btn-outline-success" for="login-open">เปิด</label>

                    <input type="radio" value="0" class="btn-check" name="login" id="login-close" autocomplete="off" @if ($setting->login == false) checked @endif>
                    <label class="btn btn-sm thai btn-outline-danger" for="login-close">ปิด</label>
                </td>
            </tr>
            <tr>
                <td class="align-middle">refill system</td>
                <td class="align-middle">
                    <input type="radio" value="1" class="btn-check" name="refill" id="refill-open" autocomplete="off" @if ($setting->refill == true) checked @endif>
                    <label class="btn btn-sm thai btn-outline-success" for="refill-open">เปิด</label>

                    <input type="radio" value="0" class="btn-check" name="refill" id="refill-close" autocomplete="off" @if ($setting->refill == false) checked @endif>
                    <label class="btn btn-sm thai btn-outline-danger" for="refill-close">ปิด</label>
                </td>
            </tr>
            <tr>
                <td class="align-middle">itemshop system</td>
                <td class="align-middle">
                    <input type="radio" value="1" class="btn-check" name="itemshop" id="itemshop-open" autocomplete="off" @if ($setting->itemshop == true) checked @endif>
                    <label class="btn btn-sm thai btn-outline-success" for="itemshop-open">เปิด</label>

                    <input type="radio" value="0" class="btn-check" name="itemshop" id="itemshop-close" autocomplete="off" @if ($setting->itemshop == false) checked @endif>
                    <label class="btn btn-sm thai btn-outline-danger" for="itemshop-close">ปิด</label>
                </td>
            </tr>
            <tr>
                <td class="align-middle">exchange rate | 1 thb : ? cash</td>
                <td class="align-middle">
                    {!! Form::number('exchange', $setting->exchange, ['class' => 'form-control form-control-sm', 'step' => '1']) !!}
                </td>
            </tr>
            <tr>
                <td class="align-middle">premium rate | 1 day : ? thb</td>
                <td class="align-middle">
                    {!! Form::number('premium', $setting->premium, ['class' => 'form-control form-control-sm', 'step' => '0.01']) !!}
                </td>
            </tr>
            <tr>
                <td class="align-middle">save data</td>
                <td class="align-middle">
                    <div class="d-grid gap-2">{!! Form::submit('บันทึกข้อมูล', ['class' => 'btn btn-sm btn-success thai']) !!}</div>
                </td>
            </tr>
        </table>
        {!! Form::close() !!}
    </div>
@endsection
