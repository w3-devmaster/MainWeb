@extends('layouts.master')
@section('title', 'ข้อมูลไอดี')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <h2>users account</h2>
        <a href="{{ route('users.index') }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <hr>
        <table class="table-sm table-striped table-dark table-borderless thai f-12 table">
            <tbody>
                <tr>
                    <td>Account Serial</td>
                    <td>
                        @if (array_key_exists('account', $ac))
                            {{ $ac['account']->serial }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Id</td>
                    <td>{{ $user->username }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>ID Status :</td>
                    <td>{!! $ac['billing']->Status == 2 ? '<span class="text-success" >Premium</span>' : 'Normal' !!}</td>
                </tr>
                @if ($ac['billing']->Status == 2)
                    <tr>
                        <td>Premium Expire :</td>
                        <td class="thai f-12 align-middle">
                            {{ thai_date_time(strtotime($ac['billing']->DTEndPrem)) }}</td>
                    </tr>
                @endif
                @if (array_key_exists('account', $ac))
                    <tr>
                        <td>Online Status :</td>
                        <td>{!! $ac['account']->Online == 1 ? '<span class="text-success" >Online</span>' : '<span class="text-secondary" >Offline</span>' !!}</td>
                    </tr>
                @endif
                <tr>
                    <td class="text-warning">Money :</td>
                    <td class="text-warning">{{ number_format($user->money, 2) }} THB <a class="btn btn-warning btn-sm f-12 float-end py-0 px-1" href="{{ route('users.edit', $user->id) }}"><i class="fa-solid fa-edit"></i></a></td>
                </tr>
                <tr>
                    <td class="text-warning">Bonus :</td>
                    <td class="text-warning">{{ number_format($user->bonus, 2) }} Point</td>
                </tr>
                <tr>
                    <td class="text-warning">Cash :</td>
                    <td class="text-warning">{{ number_format($ac['billing']->Cash) }} Cash</td>
                </tr>
                @if (array_key_exists('account', $ac))
                    <tr>
                        <td>Last IP :</td>
                        <td>{{ $ac['account']->lastconnectip }}</td>
                    </tr>
                    <tr>
                        <td>Last Login :</td>
                        <td>{{ thai_date_time(strtotime($ac['account']->lastlogintime)) }}</td>
                    </tr>
                    <tr>
                        <td>Last Logout :</td>
                        <td>{{ thai_date_time(strtotime($ac['account']->lastlogofftime)) }}</td>
                    </tr>
                @endif
                <tr>
                    <td colspan="2" class="text-center">Character Information</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row m-0 p-0">
                            @foreach ($game as $item)
                                <div class="col-12 border-secondary mb-2 rounded border">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="en mt-2 text-center">Name : {{ $item['base']->Name }}</h3>
                                        </div>
                                        <div class="col-lg-4 col-12 py-2">
                                            <table class="table-sm table-striped table-dark table-bordered thai f-12 table">
                                                <tr>
                                                    <td>Slot :</td>
                                                    <td>{{ $item['base']->Slot + 1 }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Level :</td>
                                                    <td>{{ $item['base']->Lv }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-danger">HP :</td>
                                                    <td class="text-danger">{{ number_format($item['general']->HP) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-primary">FP :</td>
                                                    <td class="text-primary">{{ number_format($item['general']->FP) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-warning">SP :</td>
                                                    <td class="text-warning">{{ number_format($item['general']->SP) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Exp :</td>
                                                    <td>{{ $item['general']->Exp }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Gender :</td>
                                                    <td>{{ getGender($item['base']->Race) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Class Name :</td>
                                                    <td>{{ getClass($item['base']->Class) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Race :</td>
                                                    <td>{{ getRace($item['base']->Race, true) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Dalant :</td>
                                                    <td>{{ number_format($item['base']->Dalant) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Gold :</td>
                                                    <td>{{ number_format($item['base']->Gold) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Status :</td>
                                                    <td>
                                                        @php
                                                            $on = strtotime(date('Y-m-d H:i:s')) - strtotime($item['general']->OnlineStatus);
                                                        @endphp
                                                        @if ($on < 300)
                                                            <span class="text-success">Online</span>
                                                        @else
                                                            <span class="text-danger">Offline</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-lg-8 col-12 py-2">
                                            <table class="table-sm table-striped table-dark table-bordered thai f-12 table">
                                                <tr>
                                                    <td>Map :</td>
                                                    <td>{{ getMap($item['general']->Map) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Pos X :</td>
                                                    <td>{{ $item['general']->X }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Pos Y :</td>
                                                    <td>{{ $item['general']->Y }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Pos Z :</td>
                                                    <td>{{ $item['general']->Z }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Bag :</td>
                                                    <td>{{ $item['general']->BagNum }} Slot</td>
                                                </tr>
                                                <tr>
                                                    <td>Created At :</td>
                                                    <td>{{ thai_date_time(strtotime($item['base']->CreateTime)) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>CP :</td>
                                                    <td>{{ number_format($item['pvp']->PvpPoint) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Temp Pt. :</td>
                                                    <td>{{ number_format($item['pvp']->PvpCash) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Kill :</td>
                                                    <td>{{ $item['pvp']->Kill }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Death :</td>
                                                    <td>{{ $item['pvp']->Death }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total Play :</td>
                                                    <td class="text-success">{{ number_format($item['general']->TotalPlayMin) }} Minute</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
