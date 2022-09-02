@php
$find = [' ', '&nbsp;', '\r\n', '<br>', '&ldquo;'];
$replace = ['', '', '', '', ''];
@endphp
@extends('layouts.master')
@section('title', $page->title)
@section('descriptions'){!! trim(iconv_substr(str_replace($find, '', strip_tags($page->content)), 0, 400, 'UTF-8')) . '...' !!}@endsection
@section('image', Storage::url('images/logo.png'))
@section('content')
    <div class="bg-alpha border-secondary text-light mb-2 rounded border p-2">
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <hr>
        <h3>{{ $page->title }}</h3>
        <hr>
        {!! $page->content !!}
        <hr>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <!-- AddToAny BEGIN -->
                <div class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="{{ urldecode(url()->current()) }}" data-a2a-title="{{ config('app.name') }} : @yield('title')">
                    <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                    <a class="a2a_button_facebook"></a>
                    <a class="a2a_button_twitter"></a>
                    <a class="a2a_button_line"></a>
                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script>
                <!-- AddToAny END -->
            </div>
        </div>
    </div>
    <div class="bg-alpha border-secondary text-light rounded border p-2">
        <h3 class="thai text-warning">บทความอื่นๆ</h3>
        <ul class="list-unstyled f-12 tahoma">
            @foreach ($pages as $item)
                <li class="border-bottom border-secondary mb-1">
                    <a class="text-light news-hover hvr-icon-forward d-block" href="{{ route('view-page', $item->url) }}">
                        <i class="fa-solid fa-circle-chevron-right me-3 hvr-icon"></i>{{ Str::limit($item->title, 100, '...') }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

@endsection
