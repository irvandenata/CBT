@extends('layouts.app')

@section('title', 'Keuangan')

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


                        <h1 class="text-center">Hallo {{ Auth::user()->name }}</h1>
                        <p class="text-center">Apkakah Anda Ingin Memulai Mengerjakan Tes ?</p>
                        <div class="text-center mt-4">
                            <a class="btn btn-info btn-xl" href="{{ route('user.test') }}">Mulai</a>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-md-8 mx-auto mt-4">
                <div class="card ">

                    <div class="card-body " style="padding: 50px 0px !important">


                        <h4 class="text-center">SCORE TERTINGGI ANDA</h4>
                        {{-- <p class="text-center">Apkakah Anda Ingin Memulai Mengerjakan Tes ?</p>
                        <div class="text-center mt-4">
                            <a class="btn btn-info btn-xl" href="{{ route('user.test') }}">Mulai</a>
                        </div> --}}
                        <div class="text-center">

                            @foreach ($score as $key => $item)
                                <div class="mb-2">
                                    <span>{{ $key + 1 }}. </span>
                                    <div class="btn btn-primary">{{ $item->score }}</div><br>
                                </div>

                            @endforeach
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')


@endpush

@push('script')
    <script>

    </script>
@endpush
