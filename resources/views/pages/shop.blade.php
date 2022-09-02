@extends('layouts.master')
@section('title', 'ร้านค้า')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <hr>
        <h3 class="text-center">ขออภัยระบบร้านค้าจะเปิดให้บริการภายหลังการพัฒนาเสร็จสิ้น !!</h3>
    </div>
@endsection
