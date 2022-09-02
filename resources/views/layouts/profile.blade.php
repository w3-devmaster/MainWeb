<div class="bg-alpha border-secondary mb-3 rounded border p-2">
    <img class="w-75 d-block mx-auto" src="{{ Storage::url('images/logo.png') }}" alt="">
    @guest
        <div class="row">
            <div class="col-md-3">
                <h5 class="text-md-end">login</h5>
            </div>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row">
                <label for="username-login" class="col-md-3 col-form-label text-md-end">{{ __('Username') }}</label>

                <div class="col-md-9">
                    <input id="username-login" type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <label for="password-login" class="col-md-3 col-form-label text-md-end">{{ __('Password') }}</label>

                <div class="col-md-9">
                    <input id="password-login" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 offset-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-0">
                <div class="col-md-8 offset-md-3">
                    <button type="submit" class="btn btn-outline-dark btn-sm text-light me-1 px-4">
                        {{ __('Login') }}
                    </button>
                    @if (Route::has('password.request'))
                        <a class="text-light f-12" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    @else
        <div class="row">
            <div class="col-12">
                <h5 class="text-md-start">user infomation</h5>
                @php
                    $data = getUserData(Auth::user()->username);
                @endphp
                <table class="table-striped table-borderless table-dark table-sm table">
                    <tr>
                        <td>ID : </td>
                        <td>{{ Auth::user()->username }}</td>
                    </tr>
                    <tr>
                        <td>Money :</td>
                        <td>{{ number_format(Auth::user()->money, 2) }} THB</td>
                    </tr>
                    <tr>
                        <td>bonus :</td>
                        <td>{{ number_format(Auth::user()->bonus, 2) }} Point</td>
                    </tr>
                    <tr>
                        <td>Cash :</td>
                        <td>{{ number_format($data['billing']->Cash) }} Cash</td>
                    </tr>
                    <tr>
                        <td>ID Status :</td>
                        <td>{!! $data['billing']->Status == 2 ? '<span class="text-success" >Premium</span>' : 'normal' !!}</td>
                    </tr>
                    @if ($data['billing']->Status == 2)
                        <tr>
                            <td>Premium Expire :</td>
                            <td class="thai f-12 align-middle">
                                {{ thai_date_time_short(strtotime($data['billing']->DTEndPrem)) }}</td>
                        </tr>
                    @endif
                    @if (array_key_exists('account', $data))
                        <tr>
                            <td>Online Status :</td>
                            <td>{!! $data['account']->Online == 1 ? '<span class="text-success" >online</span>' : '<span class="text-secondary" >offline</span>' !!}</td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="2">
                            <div class="d-grid gap-2">
                                <a class="btn btn-link btn-sm thai link-hover" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-sign-out-alt me-2"></i> {{ __('ออกจากระบบ') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </td>
                    </tr>
                </table>
                <hr>
                <h6 class="text-warning">user menu</h6>
                <nav class="nav flex-column">
                    <a class="nav-link text-light news-hover hvr-underline-from-left py-1" href="{{ route('news-all') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >ข่าวสาร</span>"><i class="fa-solid fa-square-rss me-2"></i> news</a>
                    <a class="nav-link text-light news-hover hvr-underline-from-left py-1" href="{{ route('event-all') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >กิจกรรม</span>"><i class="fa-solid fa-calendar-days me-2"></i> event</a>
                    <a class="nav-link text-light news-hover hvr-underline-from-left py-1" href="{{ route('topup') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >เติมเงิน</span>"><i class="fa-solid fa-circle-dollar-to-slot me-2"></i>
                        refill</a>
                    <a class="nav-link text-light news-hover hvr-underline-from-left py-1" href="{{ route('shop') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >ร้านค้า</span>"><i class="fa-solid fa-cart-plus me-2"></i> itemshop</a>
                    {{-- <div class="clearfix"></div> --}}
                    <a class="nav-link text-light news-hover hvr-underline-from-left dropdown-toggle py-1" data-bs-toggle="collapse" href="#collapseAccount" role="button" aria-expanded="false" aria-controls="collapseAccount"><i class="fa-solid fa-file-invoice me-2"></i> account</a>
                    <div class="collapse ms-2" id="collapseAccount">
                        <nav class="nav flex-column">
                            <a class="nav-link news-hover hvr-underline-from-left text-light py-1" href="{{ route('account') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >ข้อมูลไอดี</span>"><i class="fa-solid fa-user me-2"></i> account
                                info</a>
                            <a class="nav-link news-hover hvr-underline-from-left text-light py-1" href="{{ route('premium') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >ไอดีพรีเมี่ยม</span>"><i class="fa-solid fa-check-double me-2"></i>
                                premium
                                account</a>
                            <a class="nav-link news-hover hvr-underline-from-left text-light py-1" href="{{ route('buycash') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >ซื้อ Cash</span>"><i
                                    class="fa-solid fa-money-bill-transfer me-2"></i> buy cash</a>
                            {{-- <a class="nav-link news-hover hvr-underline-from-left text-light py-1" href="#" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >ปลดแบน</span>"><i class="fa-solid fa-calendar-check me-2"></i> unbanned</a>
                            <a class="nav-link news-hover hvr-underline-from-left text-light py-1" href="#" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >ซื้อ-ขายไอเท็ม</span>"><i class="fa-solid fa-arrow-right-arrow-left me-2"></i> market
                                place</a> --}}
                        </nav>
                    </div>
                </nav>
                @if (Auth::user()->type >= 100)
                    <hr>
                    <h6 class="text-danger">admin menu</h6>
                    <a class="nav-link text-danger hvr-underline-from-left f-14 d-block dropdown-toggle py-1" data-bs-toggle="collapse" href="#collapseWeb" role="button" aria-expanded="false" aria-controls="collapseWeb">
                        <i class="fa-solid fa-file-word me-1"></i>web menu
                    </a>
                    <div class="collapse ms-2" id="collapseWeb">
                        <nav class="nav flex-column">
                            <a class="nav-link hvr-underline-from-left text-warning py-1" href="{{ route('refill.index') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >การเติมเงิน</span>"><i
                                    class="fa-solid fa-file-invoice-dollar me-2"></i>
                                topup</a>
                            <a class="nav-link hvr-underline-from-left text-danger py-1" href="{{ route('setting.index') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >ตั้งค่าระบบ</span>"><i class="fa-solid fa-gear me-2"></i> setting</a>
                            <a class="nav-link hvr-underline-from-left text-danger py-1" href="{{ route('slide.index') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >ภาพสไลด์</span>"><i class="fa-solid fa-images me-2"></i> slide images</a>
                            <a class="nav-link hvr-underline-from-left text-danger py-1" href="{{ route('news.index') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >ข่าวสาร</span>"><i class="fa-solid fa-newspaper me-2"></i> news</a>
                            <a class="nav-link hvr-underline-from-left text-danger py-1" href="{{ route('event.index') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >กิจกรรม</span>"><i class="fa-solid fa-calendar-days me-2"></i> event</a>
                            <a class="nav-link hvr-underline-from-left text-danger py-1" href="{{ route('page-content.index') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >หน้าเพจ</span>"><i class="fa-solid fa-file me-2"></i> pages</a>
                            <a class="nav-link hvr-underline-from-left text-danger py-1" href="javascript:void(0)" onclick="popup('{{ route('gallery.index') }}','Images Gallery',1024,768)" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right"
                                title="<span class='thai' >อัลบัมภาพ</span>"><i class="fa-solid fa-images me-2"></i> gallery</a>
                        </nav>
                    </div>
                    <div class="clearfix"></div>
                    <a class="nav-link text-warning hvr-underline-from-left f-14 d-block dropdown-toggle py-1" data-bs-toggle="collapse" href="#collapseGame" role="button" aria-expanded="false" aria-controls="collapseGame">
                        <i class="fa-solid fa-gamepad me-1"></i>game menu
                    </a>
                    <div class="collapse ms-2" id="collapseGame">
                        <nav class="nav flex-column">
                            <a class="nav-link hvr-underline-from-left text-warning py-1" href="{{ route('gm.index') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >ไอดีจีเอ็ม</span>"><i class="fa-solid fa-fingerprint me-2"></i> id gm</a>
                            <a class="nav-link hvr-underline-from-left text-warning py-1" href="{{ route('users.index') }}" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >จัดการเงิน</span>"><i class="fa-solid fa-hand-holding-dollar me-2"></i>
                                user money</a>
                            <a class="nav-link hvr-underline-from-left text-warning py-1" href="#" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >ส่งไอเท็ม</span>"><i class="fa-solid fa-file-circle-plus me-2"></i> add item</a>
                            <a class="nav-link hvr-underline-from-left text-warning py-1" href="#" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<span class='thai' >รายชื่อแบน</span>"><i class="fa-solid fa-person-circle-minus me-2"></i> user banned</a>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    @endguest
</div>

<div class="bg-alpha border-secondary d-none d-md-block rounded border p-2">
    @include('layouts.left-content')
</div>
