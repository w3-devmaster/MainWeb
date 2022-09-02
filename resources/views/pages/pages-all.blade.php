@extends('layouts.master')
@section('title', 'บทความทั้งหมด')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <div class="row">
            <div class="col-12">
                <h3 class="thai">บทความทั้งหมด</h3>
                <hr>
            </div>
            @foreach ($pages as $item)
                <div class="col-12">
                    <a class="text-light news-hover hvr-icon-forward" href="{{ route('view-page', $item->url) }}">
                        <i class="fa-solid fa-circle-chevron-right me-3 hvr-icon"></i>{{ Str::limit($item->title, 100, '...') }}
                    </a>
                </div>
            @endforeach
            <div class="col-12 d-flex justify-content-center">
                {!! $pages->links() !!}
            </div>
        </div>
    </div>
@endsection
