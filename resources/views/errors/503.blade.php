@extends('layouts.template')

@section('title', 'Error 503')

@section('content-main')
    <div class="error-page">

        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Anda Tidak Mempunyai Hak Akses</h3>

            <p>
                {{--click ini Untuk Kembali<a href="{{ redirect()->back() }}">Click</a>--}}
            </p>
        </div>
    </div>
@endsection