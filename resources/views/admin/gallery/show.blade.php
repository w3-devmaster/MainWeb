@extends('layouts.gallery-master')
@section('title', '')
@section('content')
    <script>
        const copyToClipboard = () => {
            var textBox = document.getElementById("url");
            textBox.select();
            document.execCommand("copy");
            alertify.success('คัดลอก URL แล้ว');
        }
    </script>
    <div class="bg-alpha border-secondary rounded border p-2">
        <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-alt-circle-left me-2"></i>back</a>
        <hr>
        <h3 class="text-center">{{ $gallery->name }}</h3>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm" onclick="copyToClipboard()">image url <span class="text-danger ms-2">(คลิก เพื่อคัดลอก)</span></span>
            <input id="url" type="text" class="form-control" value="{{ URL::to(Storage::url($gallery->url)) }}" onclick="copyToClipboard()">
        </div>
        <img class="img-fluid d-block mx-auto" src="{{ Storage::url($gallery->url) }}" alt="">
        <hr>
        <table class="table-striped table-bordered table-sm table-dark tahoma table">
            <tr>
                <td>name : </td>
                <td>{{ $gallery->name }}</td>
            </tr>
            <tr>
                <td>descriptions : </td>
                <td>{{ $gallery->descriptions }}</td>
            </tr>
            <tr>
                <td>hash : </td>
                <td>{{ $gallery->checksum }}</td>
            </tr>
            <tr>
                <td>size : </td>
                <td>{{ $gallery->size }} kb</td>
            </tr>
            <tr>
                <td>extension : </td>
                <td>{{ $gallery->ext }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    {!! Form::open(['action' => ['App\Http\Controllers\GalleryController@destroy', $gallery->id], 'method' => 'delete', 'id' => 'formdel_' . $gallery->id]) !!}
                    <button type="submit" class="btn btn-danger btn-sm" onclick="confDel('{{ $gallery->id }}');return false;"><i class="fa fa-trash-alt me-2"></i> ลบภาพ</button>
                    {!! Form::close() !!}
                </td>
            </tr>
        </table>
    </div>
    <script>
        const confDel = (id) => {
            alertify.confirm('ลบข้อมูล', 'ต้องการลบข้อมูลนี้หรือไม่?', function() {
                document.getElementById('formdel_' + id).submit();
            }, function() {
                alertify.error('การลบถูกยกเลิก !')
            });
        }
    </script>
@endsection
