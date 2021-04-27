<script>
    const child_url = "{!! Request::url() !!}";



    function setForm(saved, method, title) {
        save_method = saved;
        $('input[name=_method]').val(method);
        $('#modalForm form')[0].reset();
        $(':input[name=id]').val('');
        $('#modalFormTitle').text(title);
        $('#modalForm').modal('show');
    }

    function editData(id) {
        $.ajax({
            url: child_url + "/" + id + "/edit",
            type: "GET",
            dataType: "json",
            success: function(result) {

                setData(result);
            },
            error: function(result) {
                console.log(result);
            }
        })
    }

    function setUrl() {
        var id = $('#id').val();
        if (save_method == "create") url = child_url;
        else url = child_url + '/' + id;

        return url;
    }

    /** ambil data error**/
    function getError(errors) {
        $.each(errors, function(index, value) {
            value.filter(function(obj) {
                return error = obj;
            });
            toastr.error(error, 'Error', {
                closeButton: true,
                progressBar: true,
            });
        });
    }

    /** save data onsubmit**/
    $(function() {
        $('#modalForm form').on('submit', function(e) {
            if (!e.isDefaultPrevented()) {
                saveAjax(setUrl());
                return false;
            }

        });
    });

    function saveAjax(url) {
        Swal.fire({
            type: 'warning',
            text: 'Please wait.',
            showCancelButton: false,
            confirmButtonText: "ok",
            allowOutsideClick: false,
            allowEscapeKey: false
        })
        Swal.showLoading()

        $.ajax({
            url: url,
            type: "post",
            cache: false,
            dataType: 'json',
            data: new FormData($('#modalForm form')[0]),
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('#modalForm').modal('hide');
                reloadDatatable();

                Toast.fire({
                    icon: 'success',
                    title: 'successfully'
                })

                // toastr.success('Berhasil Disimpan', 'Success');
            },
            error: function(result) {
                $('#modalForm').modal('hide');

                if (result.responseJSON) {
                    getError(result.responseJSON.errors);
                } else {
                    console.log(result);
                }
            },
        })
    }

    /** konfirmasi hapus data **/
    function deleteConfirm(id) {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true,
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Kamu Akan Menghapus Data Ini!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Hapus!',
            cancelButtonText: 'No, Keluar!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                deleteData(id);
                swalWithBootstrapButtons.fire(
                    'Dihapus!',
                    'Data Telah Dihapus',
                    'success'
                )

            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Batal',
                    'Proses Telah dibatalkan',
                    'error'
                )
            }
        })
    }

    /** hapus data dari database **/
    function deleteData(id) {
        var url = child_url + '/' + id;
        Swal.fire({
            type: 'warning',
            text: 'Please wait.',
            showCancelButton: false,
            confirmButtonText: "ok",
            allowOutsideClick: false,
            allowEscapeKey: false
        })
        Swal.showLoading()
        $.ajax({
            url: url,
            type: "DELETE",

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "_token": "{{ csrf_token() }}",

            },

            success: function(result) {
                reloadDatatable();
                Toast.fire({
                    icon: 'success',
                    title: 'Delete successfully'
                })

                // toastr.success('Berhasil Dihapus', 'Success');
            },
            error: function(errors) {
                getError(errors.responseJSON.errors);
            }
        });
    }

</script>
