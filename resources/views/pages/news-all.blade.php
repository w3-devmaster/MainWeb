@extends('layouts.master')
@section('title', 'ข่าวสารทั้งหมด')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <div class="row">
            <div class="col-12">
                <h3 class="thai">ข่าวสารทั้งหมด</h3>
                <hr>
            </div>
            @foreach ($news as $item)
                <div class="col-md-4 col-6 hvr-forward news-hover mb-2">
                    <div class="card border-secondary border bg-transparent" style="cursor: pointer;" onclick="window.location.href='{{ route('view-event', $item->id) }}'">
                        <img src="{{ Storage::url($item->img) }}" class="card-img-top card-img-to rounded" alt="..." style="height: 120px;">
                        <div class="card-body px-0 py-2">
                            <p class="card-text f-12 text-center">{{ Str::limit($item->title, 50, '...') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-12 d-flex justify-content-center">
                {!! $news->links() !!}
            </div>
        </div>
    </div>
@endsection
