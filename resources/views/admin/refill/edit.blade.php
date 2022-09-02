@extends('layouts.master')
@section('title', 'แก้ไขข่าวสาร')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <h2>news edit</h2>
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <hr>
        {!! Form::model($refill, ['route' => ['refill.update', $refill->id], 'method' => 'put']) !!}
        <img class="img-fluid w-25" src="{{ Storage::url($refill->img) }}" alt="">
        <hr>
        <p>จำนวนเงินที่แจ้งโอน : {{ number_format($refill->amount, 2) }} THB</p>
        <hr>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="1" required>
            <label class="form-check-label ms-3" for="flexRadioDefault1">
                {!! getTopupStatus(1) !!}
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="2" required>
            <label class="form-check-label ms-3" for="flexRadioDefault2">
                {!! getTopupStatus(2) !!}
            </label>
        </div>
        <hr>
        <div class="d-grid gap-2">
            {!! Form::submit('ดำเนินการ', ['class' => 'btn btn-success btn-sm']) !!}
        </div>
        {!! Form::close() !!}
        {{-- {!! Form::open(['action' => ['App\Http\Controllers\NewsController@update', $news->id], 'method' => 'put', 'files' => true]) !!}
        <div class="input-group input-group-sm mb-3">
            <label class="input-group-text" for="inputGroupFile01">title image</label>
            <input name="img" type="file" class="form-control" id="inputGroupFile01">
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">news title</span>
            {!! Form::text('title', $news->title, ['class' => 'form-control', 'placeholder' => 'ห้วข้อข่าว', 'required']) !!}
        </div>
        <p>news content</p>
        <textarea name="content" id="content">{{ $news->content }}</textarea>
        <hr>
        <div class="d-grid gap-2">
            {!! Form::submit('update news', ['class' => 'btn btn-success btn-sm']) !!}
        </div>
        {!! Form::close() !!} --}}
    </div>
@endsection
