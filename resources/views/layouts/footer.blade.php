<div class="main-footer position-fixed w-100 bg-dark border-top border-secondary py-3">
    <p class="m-0 text-center">&copy; {{ date('Y') }} rf online official &trade; allright reserved. GameArt Comunicate Corporation.</p>
</div>
@php
$img = Storage::allFiles('public/images/sd/');
$imgname = $img[rand(0, count($img) - 1)]; //str_replace('public/','',$img[rand(0,count($img)-1)]);
$str = ['สวัสดีจ้า!! ยินดีต้อนรับนะ', 'คุณพร้อมแล้วหรือยังล่ะ ?', 'ไหนๆก็แวะมาแล้ว มาลองเล่นดูสิ', '??..... อ๊ะ', 'จะรีบไปไหน มาเล่นด้วยกันก่อนสิ..', 'พรุ่งนี้วันอะไรกันนะ', 'วันนี้วันพระ โปรดอย่าฆ่าสัตว์เลยนะ!', 'เก่งนักเหรอ เดี๋ยวได้เจอกัน !!'];
$str_show = $str[rand(0, count($str) - 1)];
@endphp
<img id="rand-img" class="position-fixed w-25 hvr-buzz-out" src="{{ Storage::url($imgname) }}" alt="" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" title="<span class='thai f-14 text-info' >{{ $str_show }}</span>">
