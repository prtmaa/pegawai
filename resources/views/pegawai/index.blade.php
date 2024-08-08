@extends('layouts.master')

@section('tittle')
    Data Pegawai
@endsection

@section('badge')
    @parent
    <li class="breadcrumb-item active">Data Pegawai</li>
@endsection

@section('content')
<div class="container-fluid">
 
    <div class="row">
      
      <section class="col-lg-12 connectedSortable">
        
        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">

                    <div class="btn-group">
                        <button onclick="addForm('{{ route('pegawai.store') }}')" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Tambah Data</button>
                    </div>

                </div>
                 
                <div class="card-body table-responsive">
                    <form action="" class="form-produk" method="post">
                        @csrf
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Tanggal Lahir</th>
                                <th>Umur</th>
                                <th>Alamat</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
    
                            </tbody>
                        </table>
                    </form>
                </div>
                
              </div>
        
            </div>

          </div>

      </section>
    </div>

@include('pegawai.form')
@endsection

@push('js')
    <script>
        let table;

       $(function(){
           table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            // language: {
            //      url: '//cdn.datatables.net/plug-ins/2.1.3/i18n/id.json',
            // },
            ajax: {
                url: '{{ route('pegawai.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'nip'},
                {data: 'nama'},
                {data: 'jabatan'},
                {data: 'tgl_lahir'},
                {data: 'umur'},
                {data: 'alamat'},
                {data: 'foto'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
            });

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

       function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Data');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nama]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama]').val(response.nama);
                $('#modal-form [name=jabatan]').val(response.jabatan);
                $('#modal-form [name=tgl_lahir]').val(response.tgl_lahir);
                $('#modal-form [name=umur]').val(response.umur);
                $('#modal-form [name=alamat]').val(response.alamat);
                $('#modal-form [name=foto]').val(response.foto);
            })
            .fail((errors) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data gagal ditampilkan',
                }) 
            });
         }

         function deleteData(url) {
            Swal.fire({
                title: 'Yakin?',
                text: "Data akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        table.ajax.reload();
                        $('.alertdelete').fadeIn();

                        setTimeout(() => {
                            $('.alertdelete').fadeOut();
                        }, 3000);
                    })
                    .fail((errors) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Data gagal dihapus',
                        }) 
                    });
                }
            })
    }



        $(document).ready(function() {
            $('#jabatan').select2({
                $('.modal select').css('width', '100%');
                dropdownParent: $('#modal-form'),
            });
        });

        $('#tgl_lahir').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });

        // Dropzone.options.dropzone ={
        //     paramName: 'foto'
        // }
    </script>

@endpush

