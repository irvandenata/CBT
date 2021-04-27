@extends('layouts.backend')

@section('title', 'Menejemen Pengguna')

    @push('css')
        {{-- <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')  }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css')  }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css')  }}" rel="stylesheet" type="text/css" />
<!-- Multi Item Selection examples -->
<link href="{{ asset('assets/plugins/datatables/select.bootstrap4.min.css')  }}" rel="stylesheet" type="text/css" />

<!-- App css -->
<link href="{{ asset('assets/css/bootstrap.min.css')  }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/icons.css')  }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.css')  }}" rel="stylesheet" type="text/css" />


<script src="{{ asset('assets/js/modernizr.min.js')  }}"></script> --}}
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @endpush

    @push('style')
        <style>
            .mtop-100 {
                margin-top: 150px !important;
            }

        </style>
    @endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">


                    <a class="btn btn-success btn-sm mt-2" onclick="createItem()">Tambah</a>

                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Skor Tertinggi</th>
                                    <th width="30%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.user._form')
    </div>
@endsection

@push('js')

    {{-- <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')  }}"></script>
<!-- Buttons examples -->
<script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js')  }}"></script> --}}
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert2.min.js') }}"></script>

    {{-- sweat allert --}}
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>



    <!-- Responsive examples -->
    {{-- <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js')  }}"></script>

<!-- Selection table -->
<script src="{{ asset('assets/plugins/datatables/dataTables.select.min.js')  }}"></script> --}}

@endpush

@push('script')

    @include('crud.js')
    <script>
        // init(){
        //     console.log('masuk')
        // }
        // init()
        // console.log('masuk')

        let dataTable = $('#datatable').DataTable({
            dom: 'lBfrtip',
            buttons: [{
                className: 'btn btn-success btn-sm mr-2',
                text: 'Create',
                action: function(e, dt, node, config) {
                    createItem();
                }
            }, {
                className: 'btn btn-warning btn-sm mr-2',
                text: 'Reload',
                action: function(e, dt, node, config) {
                    reloadDatatable();
                    Toast.fire({
                        icon: 'success',
                        title: 'Reload'
                    })
                }
            }],
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            pageLength: 5,
            lengthMenu: [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
            ajax: {
                url: child_url,
                type: 'GET',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false
                },
                {
                    data: 'name',
                    orderable: true
                },
                {
                    data: 'email',
                    orderable: true
                },
                {
                    data: 'score',
                    orderable: true
                },
                {
                    data: 'action',
                    name: '#',
                    orderable: false
                },
            ]
        });

    </script>

    <script>
        function createItem() {
            setForm('create', 'POST', 'Create Tag', true)

        }

        function editItem(id) {
            setForm('update', 'PUT', 'Edit Tag', true)
            editData(id)
            // Toast.fire({
            //          icon: 'success',
            //          title: 'Create successfully'
            // })
        }

        function deleteItem(id) {
            deleteConfirm(id)

        }

    </script>

    <script>
        /** set data untuk edit**/
        function setData(result) {

            $('input[name=id]').val(result.id);
            $('input[name=name]').val(result.name);
            $('input[name=email]').val(result.email);
            // $('input[name=email]').val(result.email);
            // $('input[name=stock]').val(result.stock);
            // $('input[name=cost]').val(result.cost);

            // $("#typeID option").filter(function () {
            //    return $.trim($(this).val()) == result.type_id
            // }).prop('selected', true);
            // $('#typeID').selectpicker('refresh');

        }

        /** reload dataTable Setelah mengubah data**/
        function reloadDatatable() {
            dataTable.ajax.reload();
        }

    </script>

@endpush
