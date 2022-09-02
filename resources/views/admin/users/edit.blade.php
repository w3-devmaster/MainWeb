@extends('layouts.master')
@section('title', 'จัดการไอดี')
@section('content')
    <div class="bg-alpha border-secondary rounded border p-2">
        <h2>users management</h2>
        <a href="{{ route('users.index') }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <hr>
        {!! Form::open(['action' => ['App\Http\Controllers\UserManageController@update', $user->id], 'method' => 'put']) !!}
        <table class="table-striped table-bordered table-dark table">
            <tr>
                <td class="align-middle">Username : </td>
                <td class="align-middle">{{ $user->username }}</td>
            </tr>
            <tr>
                <td class="align-middle">Money : </td>
                <td class="align-middle">
                    {!! Form::number('money', $user->money, ['class' => 'form-control', 'step' => '0.01']) !!}
                </td>
            </tr>
            <tr>
                <td class="align-middle">บันทึกข้อมูล</td>
                <td class="align-middle">
                    <div class="d-grid gap-2">
                        {!! Form::submit('บันทึกข้อมูล', ['class' => 'btn btn-success btn-sm']) !!}
                    </div>
                </td>
            </tr>
        </table>
        {!! Form::close() !!}
    </div>
@endsection
