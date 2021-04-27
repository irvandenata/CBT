@extends('layouts.app')

@push('css')

@endpush

@push('styles')
    <style>


    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mx-auto">
                <div class="card ">

                    <div class="card-body " style="padding: 50px 0px !important">


                        <h1 class="text-center">Selamat Datang Di Aplikasi <br> CAT Tes Online</h1>
                        <div class="text-center mt-4">
                            <a class="btn btn-info btn-xl" href="{{ route('login') }}">Masuk</a>
                            {{-- <a class="btn btn-success btn-xl" href="{{ route("register") }}">Daftar</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
