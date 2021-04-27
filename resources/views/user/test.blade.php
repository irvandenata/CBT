@extends('layouts.App')

@section('title', 'Test')

    @push('css')

    @endpush

    @push('styles')
        <style>

        </style>
    @endpush

@section('content')

    <div class="container">
        <div class="row justify-content-center mb-4">
            <div  class="btn btn-danger col-md-2">
                <div id="tampilkan"></div>
            </div>
        </div>

        @foreach ($questions as $key => $item)

            <div class="question ">
                <div id="question-{{ $key + 1 }}" class="row justify-content-center @if ($key
                    !=0) {
                            d-none
                        } @endif">
                    <div class="col-md-12 ">
                        <div class="card pr-4 pl-4">
                            <div class="card-body " style="padding: 50px 0px !important">
                                <h4 class="text-center"> <b>Soal {{ $key + 1 }}</b> </h4>
                                <h5 class="text-center">{{ $item->question }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mt-4">
                            <div class="row justify-content-center">
                                @for ($i = 1; $i < 6; $i++)

                                    <div id="answer-{{ $item->id }}-{{ $i }}" data-an="{{ $i }}"
                                        class=" col-md-2 btn btn-info mr-2 ml-2">
                                        {{ $item['option' . $i] }}
                                    </div>
                                @endfor




                                {{-- <div class="card">
                                        <div class="card-body">
                                            <p class="text-center">{{ $item['option' . $i] }}</p>
                                        </div>
                                    </div> --}}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row justify-content-center mt-4">
            <div  class="  card col-md-2">
                <div id="tampilkan"></div>
            </div>
        </div>
        <div class="row justify-content-center" style="margin-top: 30px !important;">
            <div class="col-md-12 text-center">
                @foreach ($questions as $key => $item)
                    <a id="number-{{ $key + 1 }}" class="btn btn-info">{{ $key + 1 }}</a>
                @endforeach
            </div>
        </div>
        <div class="text-center mt-4">
            <div class="btn btn-success btn-xl" id="submit">Kumpulkan</div>
        </div>


        
        </div>
@endsection

@push('js')


@endpush

@push('script')


    <script>
       


        












        var answer = new Object();
        var keyQu = new Object();

        panjang = {{ $questions->count() }}
        @foreach ($questions as $item)
            keyQu[{{ $item->id }}]= {{ $item->answer }};
        @endforeach
        correct = 0
        @foreach ($questions as $key => $item)
            answer[{{ $item->id }}] = 0
            @for ($i = 1; $i < 6; $i++)
                $("#answer-{{ $item->id }}-{{ $i }}").on('click', function() {
                answer[{{ $item->id }}] = $("#answer-{{ $item->id }}-{{ $i }}").data('an');
                for (i = 1; i < 6; i++) { 
                    $('#answer-{{ $item->id }}-'+i).removeClass('btn-warning').addClass('btn-info ');
                                    }
                                       $(this).removeClass(' btn-info ').addClass(' btn-warning ');

                                        if(answer[{{ $item->id }}]!=0) {
                                    $("#number-{{ $key + 1 }}").removeClass(' btn-info ').addClass(' btn-warning'); 
                                }
                                 })
                    @endfor
            @endforeach
        // console.log(answer)
        @foreach ($questions as $key => $item)
            $("#number-{{ $key + 1 }}").on('click',function(){

            for (let index = 0; index < {{ $questions->count() }} ; index++) { 
                $('#question-'+(index+1)).addClass('d-none');
                
                if(answer[{{ $item->id }}]!=0) {
                $("#number-{{ $key + 1 }}").removeClass(' btn-info ').addClass(' btn-warning'); 
            } 
        }
                $('#question-{{ $key + 1 }}').removeClass('d-none');
             })
              @endforeach

    </script>
    <script>
        ansKeys = Object.keys(answer);
        resKeys = Object.keys(keyQu);
        temp = 0;
        temp2 = 0;
        result = 0;
        notAnswer = 0;

        function sumbitTest() {
            for (let index = 0; index < panjang; index++) {
                if (keyQu[resKeys[index]] == answer[ansKeys[index]]) {
                    temp += 1
                }
                if (answer[ansKeys[index]] != 0) {
                    temp2 += 1
                }



            }
            result = temp;
            notAnswer = temp2;
            temp = 0;
            temp2 = 0;

            // console.log(result)
        }

        $("#submit").on('click', function() {
            sumbitTest()

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: 'Yakin Ingin Mengumpulkan?',
                text: "Kamu Menyelesaikan " + notAnswer + " dari " + panjang + " Soal",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Kumpulkan!',
                cancelButtonText: 'Tidak, Batalkan!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    let timerInterval
                    Swal.fire({
                        title: 'Berhasil!',
                        icon: 'success',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            timerInterval = setInterval(() => {
                                const content = Swal.getContent()
                                if (content) {
                                    const b = content.querySelector('b')
                                    if (b) {
                                        b.textContent = Swal.getTimerLeft()
                                    }
                                }
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer')
                        }
                    })

                    // swalWithBootstrapButtons.fire(
                    //     'Berhasil!',
                    //     'Tugas Berhasil Dikumpulkan',
                    //     'success'
                    // )
                    postData()



                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        '',
                        'error'
                    )
                }
            })
        })





        function postData() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/user/score",
                type: "POST",
                data: {
                    score: result,
                    _token: _token
                },
                success: function(response) {
                    // console.log(response);

                    if (response) {
                        // $('.success').text(response.success);
                        // $("#ajaxform")[0].reset();
                        window.location.replace('/user')
                    }
                },
            });
        }
        

        function waktu(soal) {
            var detik = 0;
            var menit =5*soal;
            function hitung() {
                setTimeout(hitung,1000);
                $('#tampilkan').html( "<h6 class='mt-2  ml-1'>"+ menit + ' menit ' + detik + ' detik </h6>');
                detik --;
                if(detik < 0) {
                detik = 59;
                menit --;
                if(menit < 0) {
                menit = 0;
                detik = 0;
                }
             }
             if(menit==0 && detik == 0){
                
                postData()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops... Waktu Habis',
                    text: 'Something went wrong!',
                    timer: 1500,
                    footer: '<a href>Why do I have this issue?</a>'
                    }).then((result) => {
                        window.location.replace('/user')
                       
                    })
            }
            }
           
            hitung();
           
            }
           
        function initTest() {
            Swal.fire({
                title: '<strong>Perhatian</strong>',
                icon: 'info',
                html: 'Kejakan sebelum waktu habis! , jika waktu habis maka akan otomatis dikumpulkan' ,
                showCloseButton: false,
                showCancelButton: false,
                focusConfirm: false,
                // confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
                confirmButtonAriaLabel: 'Mulai !',
                
               
            }).then((result) => {
                if (result.isConfirmed) {
                    waktu(panjang)

                    
                }
                })
           
        }
        initTest()
    </script>

@endpush
