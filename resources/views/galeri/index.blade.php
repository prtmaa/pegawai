@extends('layouts.master')

@section('tittle')
    Galeri
@endsection

@section('badge')
    @parent
    <li class="breadcrumb-item active">Galeri</li>
@endsection

@section('content')
<div class="container-fluid">
 
    <div class="row">
      
      <section class="col-lg-12 connectedSortable">
        
        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">



                </div>
                 
                <div class="card-body table-responsive">
                    <form action="/store" enctype="multipart/form-data" class="dropzone" method="post" id="dropzone">
                        @csrf

                    </form>
                </div>
                
              </div>
        
            </div>

          </div>

      </section>
    </div>

@endsection

@push('js')
    <script>
        Dropzone.options.dropzone ={
            paramName: 'judul',
            params: {
                _token: document.querySelector('meta[name="csrf-token"]').content
            }
        }

       $(function()
            ajax: {


            $('#modal-form').validator().on('submit', function (e) {
                if (! e.preventDefault()){
                    $.ajax({
                        enctype: 'multipart/form-data',
                        url: $('#modal-form form').attr('action'),
                        type: $('#modal-form form').attr('method'),
                        data: new FormData($('#modal-form form')[0]),
                        async: false,
                        processData: false,
                        contentType: false
                    })
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();

                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil disimpan',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    })
                    .fail((errors) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Data gagal disimpan',
                        }) 
                    });
                }
            })

       }); 

       function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Data');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=nama]').focus();
       }



        $(document).ready(function() {
            $('#jabatan').select2({
                dropdownParent: $('#modal-form'),
                width: 'resolve'
            });
        });
    

    </script>

@endpush

