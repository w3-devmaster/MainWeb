@extends('layouts.master')
@section('title', 'Rising Force')
@section('content')
    @include('layouts.slide')
    <div class="bg-alpha border-secondary mb-2 rounded border p-2">
        <h3 class="text-warning m-0">news <a href="{{ route('news-all') }}" class="text-light news-hover f-12 float-end"><i class="fa-solid fa-plus-circle me-1"></i> view all</a> </h3>
        <div class="border-bottom border-secondary border-top border-secondary py-3">
            <ul class="list-unstyled f-12 tahoma">
                @foreach ($news as $item)
                    <li class="border-bottom border-secondary mb-1">
                        <a class="text-light news-hover hvr-icon-forward d-block" href="{{ route('view-news', $item->id) }}"><i class="fa-solid fa-rss me-2 hvr-icon"></i>{{ Str::limit($item->title, 100, '...') }} <span
                                class="float-end">{{ thai_date_short(strtotime($item->created_at)) }}</span></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="bg-alpha border-secondary mb-2 rounded border p-2">
        <h3 class="text-warning m-0">event <a href="{{ route('event-all') }}" class="text-light news-hover f-12 float-end"><i class="fa-solid fa-plus-circle me-1"></i> view all</a> </h3>
        <div class="border-bottom border-secondary border-top border-secondary py-3">
            <div class="row">
                @foreach ($event as $item)
                    <div class="col-md-4 col-6 hvr-forward news-hover mb-2">
                        <div class="card border-secondary border bg-transparent" style="cursor: pointer;" onclick="window.location.href='{{ route('view-event', $item->id) }}'">
                            <img src="{{ Storage::url($item->img) }}" class="card-img-top card-img-to rounded" alt="..." style="height: 120px;">
                            <div class="card-body px-0 py-2">
                                <p class="card-text f-12 text-center">{{ Str::limit($item->title, 50, '...') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="bg-alpha border-secondary mb-2 rounded border p-2">
        <h3 class="text-warning m-0">note & guide <a href="{{ route('pages-all') }}" class="text-light news-hover f-12 float-end"><i class="fa-solid fa-plus-circle me-1"></i> view all</a> </h3>
        <div class="border-bottom border-secondary border-top border-secondary tahoma f-12 py-3">
            <div class="row">
                @foreach ($page as $item)
                    <div class="col-md-6 col-12">
                        <a class="text-light news-hover hvr-icon-forward" href="{{ route('view-page', $item->url) }}">
                            <i class="fa-solid fa-circle-chevron-right me-3 hvr-icon"></i>{{ Str::limit($item->title, 60, '...') }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
