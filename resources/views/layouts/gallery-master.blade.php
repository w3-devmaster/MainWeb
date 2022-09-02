<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="RF,RF Online,Rising Force Online,RF OFFICIAL,เซิฟ RF เถื่อน,RF OFFICIAL เถื่อน,RF Online,อาเอฟ เถื่อน,RF Thailand, RF TH,RF Online 2.2.3.2 เซิฟเวอร์ RF เถื่อนเปิดใหม่ล่าสุด 2017,เปิดให้บริการด้วยทีมงานมืออาชิพ เปิดยาวมั่นคง ไม่มีวันตาย" />
    <meta name="description" content="เซิฟ RF เถื่อน,RF OFFICIAL เถื่อน,RF Online,อาเอฟ เถื่อน,RF Thailand, RF TH,RF Online 2.2.3.2 เซิฟเวอร์ RF เถื่อนเปิดใหม่ล่าสุด 2017,เปิดให้บริการด้วยทีมงานมืออาชิพ เปิดยาวมั่นคง ไม่มีวันตาย" />
    <meta name="author" content="SuckshotDev">
    <title>@yield('title') | {{ config('app.name') }}</title>
    @include('layouts.header')
</head>

<body class="en text-light bg-dark">
    @include('layouts.alert')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-2">
                @yield('content')
            </div>
        </div>
    </div>
    @include('layouts.script')
</body>

</html>
