@extends('layouts.gallery-master')
@section('title', 'อัลบัมภาพ')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <a class="btn btn-success btn-sm mt-2" href="{{ route('gallery.create') }}"><i class="fa-solid fa-plus-circle me-1"></i> add image</a>
        <hr>
        <div class="row">
            @foreach ($images as $item)
                <div class="col-lg-3 col-md-4 col-6 mb-3 text-center" style="height: 100px;cursor: pointer;">
                    <img src="{{ Storage::url($item->url) }}" class="img-thumbnail h-100 hvr-grow" alt="..." ondblclick="window.location.href='{{ route('gallery.show', $item->id) }}'" data-bs-toggle="tooltip" data-bs-html="false" data-bs-placement="top" title="ดับเบิ้ลคลิ๊ก เพื่อดูรายละเอียดรูปภาพ">
                </div>
            @endforeach
            <div class="col-12 d-flex justify-content-center">
                {!! $images->links() !!}
            </div>
        </div>
    </div>
@endsection
