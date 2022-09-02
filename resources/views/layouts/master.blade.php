<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="RF,RF Online,Rising Force Online,RF OFFICIAL,เซิฟ RF เถื่อน,RF OFFICIAL เถื่อน,RF Online,อาเอฟ เถื่อน,RF Thailand, RF TH,RF Online 2.2.3.2 เซิฟเวอร์ RF เถื่อนเปิดใหม่ล่าสุด 2017,เปิดให้บริการด้วยทีมงานมืออาชิพ เปิดยาวมั่นคง ไม่มีวันตาย" />
    <meta name="description" content="เซิฟ RF ,RF OFFICIAL ,RF Online,อาเอฟ ,RF Thailand, RF TH,RF Online 2.2.3.2 เซิฟเวอร์ RF เปิดใหม่ล่าสุด 2017,เปิดให้บริการด้วยทีมงานมืออาชิพ เปิดยาวมั่นคง ไม่มีวันตาย" />
    <meta name="author" content="SuckshotDev">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{!! urldecode(url()->current()) !!}" />
    <meta property="og:description" content="@yield('descriptions')" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:image:secure_url" content="@yield('image')" />
    <meta itemprop="image" content="@yield('image')">
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="@yield('descriptions')" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:image" content="@yield('image')" />

    @include('layouts.header')
</head>

<body class="en text-light" style="background-image: url( {{ Storage::url('images/bg.webp') }} ">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v14.0" nonce="uhWZ2D59"></script>
    @include('layouts.nav')
    @include('layouts.alert')
    <div class="main-div p-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-12 mb-5">
                    <div class="menu-div float-md-start mb-3" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                        @include('layouts.profile')
                    </div>
                    <div class="content-div float-md-start mb-3" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine">
                        @yield('content')
                    </div>

                    <div class="bg-alpha border-secondary d-md-none rounded border p-2" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                        @include('layouts.left-content')
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-5">
                    <img class="d-block ms-auto" style="width:150px;" src="{{ Storage::url('images/ccr.webp') }}" alt="">
                </div>
                <div class="col-6 mb-5">
                    <img class="d-block me-auto" style="width:150px;" src="{{ Storage::url('images/ga.webp') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
    @include('layouts.script')
</body>

</html>
