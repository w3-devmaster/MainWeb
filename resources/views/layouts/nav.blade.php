<div class="main-nav position-fixed w-100">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark p-0">
        <div class="container-lg">
            <a class="navbar-brand p-0" href="{{ route('index') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='en f-20' >rf online official</span>"><img style="width: 300px;" src="{{ Storage::url('images/logo.png') }}" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto ms-5 mb-lg-0 position-relative mb-2">
                    <li class="nav-item link-hover">
                        <a class="nav-link f-20 en @if (request()->is('/')) active @endif text-center" aria-current="page" href="{{ route('index') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="bottom" title="<span class='thai' >หน้าแรก</span>">home</a>
                    </li>
                    <li class="nav-item link-hover">
                        <a class="nav-link f-20 en @if (request()->is('register')) active @endif text-center" href="{{ route('register') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="bottom" title="<span class='thai' >สมัครไอดี</span>">register</a>
                    </li>
                    <li class="nav-item link-hover">
                        <a class="nav-link f-20 en @if (request()->is('download')) active @endif text-center" href="{{ route('download') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="bottom" title="<span class='thai' >ดาวน์โหลด</span>">download</a>
                    </li>
                    <li class="nav-item link-hover">
                        <a class="nav-link f-20 en @if (request()->is('information')) active @endif text-center" href="{{ route('information') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="bottom" title="<span class='thai' >ข้อมูลเซิร์ฟเวอร์</span>">information</a>
                    </li>
                    <li class="nav-item link-hover dropdown">
                        <a class="nav-link f-20 en dropdown-toggle text-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ranking</a>
                        <ul class="dropdown-menu en" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item f-16" href="#" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >อันดับเลเวล</span>">level
                                    ranking</a></li>
                            <li><a class="dropdown-item f-16" href="#" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >อันดับฆ่า</span>">kill
                                    ranking</a></li>
                            <li><a class="dropdown-item f-16" href="#" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >อันดับความรวย</span>">rich
                                    ranking</a></li>
                            <li><a class="dropdown-item f-16" href="#" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >อันดับแต้ม CP</span>">Certain
                                    Point ranking</a></li>
                            <li><a class="dropdown-item f-16" href="#" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >อันดับแต้ม Temp</span>">Temporary Point ranking</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item f-16" href="#" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >อันดับกิลด์</span>">Guild
                                    ranking</a></li>
                        </ul>
                    </li>
                    <li class="nav-item link-hover dropdown">
                        <a class="nav-link f-20 en dropdown-toggle text-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            game cp</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item f-16" href="{{ route('topup') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >เติมเงิน</span>">refill</a>
                            </li>
                            {{-- <li>
                                <hr class="dropdown-divider">
                            </li> --}}
                            <li><a class="dropdown-item f-16" href="{{ route('shop') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >ร้านค้าไอเท็ม</span>">item
                                    shop</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
