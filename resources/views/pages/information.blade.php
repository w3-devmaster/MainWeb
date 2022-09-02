@extends('layouts.master')
@section('title', 'รายละเอียดเซิร์ฟเวอร์')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <img class="img-fluid d-block mx-auto mb-2" src="{{ Storage::url('images/info.webp') }}" alt="">
        <hr>
        <h2 class="text-center">server information</h2>
        <div class="row">
            <div class="col-6">
                <h5 class="text-center">server rate</h5>
                <hr>
                <ul class="list-unstyled text-center">
                    <li>level max : 50</li>
                    <li>exp : x30</li>
                    <li>drop : x10</li>
                    <li>skill : gm</li>
                    <li>pt : gm</li>
                    <li>animus : x100</li>
                    <li>quest unlock : disabled</li>
                </ul>
            </div>
            <div class="col-6">
                <h5 class="text-center">drop list</h5>
                <hr>
                <ul class="list-unstyled text-center">
                    <li>-</li>
                    <li>-</li>
                    <li>-</li>
                    <li>-</li>
                    <li>-</li>
                    <li>-</li>
                    <li>-</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
