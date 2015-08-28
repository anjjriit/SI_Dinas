@extends('layouts.master')

@section('page_title', 'Manage Users')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
            <h1>Data User</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-body no-padding">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>E-mail</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($data_pegawai as $pegawai)

                                    <tr>
                                        <td>
                                            {{ $pegawai->nik }}
                                        </td>
                                        <td>
                                            {{ $pegawai->nama_lengkap }}
                                        </td>
                                        <td>
                                            {{ $pegawai->email }}
                                        </td>
                                        <td>
                                            @if ($pegawai->role == 'super_admin')
                                                Super Admin
                                            @elseif ($pegawai->role == 'administration')
                                                Administration
                                            @elseif ($pegawai->role == 'finance')
                                                Finance
                                            @else
                                                Employee
                                            @endif
                                        </td>
                                        <td>
                                            @if ($pegawai->active == 1)
                                                Active
                                            @else
                                                Non-active
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/user/{{ $pegawai->nik }}/edit" class="btn btn-sm btn-default"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                            {!! Form::open(
                                                [
                                                    'method' => 'DELETE',
                                                    'route' => ['user.destroy', $pegawai->nik],
                                                    'style' => 'display: inline-block;',
                                                    'data-nama' => $pegawai->nama_lengkap,
                                                ]
                                            ) !!}

                                                {!! Form::button('<i class="fa fa-fw fa-trash"></i> Hapus', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger delete-button',]
                                                ) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            {!! $data_pegawai->render() !!}
            <div class="clearfix"></div>

            <a href="/user/create" class="btn btn-success pull-right"><i class="fa fa-fw fa-plus"></i> Tambah User</a>

        </section>

@endsection

@section('script')
    @parent
    <script src="/vendor/jquery-confirm/js/jquery-confirm.min.js"></script>

    <script>
        $('.delete-button').on('click', function(event) {
            event.preventDefault();

            var element = $(this).parent()

            var nama = element.attr('data-nama')

            $.confirm({
                title: '<i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus User',
                content: 'Apakah Anda yakin akan menghapus user dengan nama <strong>' + nama + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-default',
                cancelButton: 'Tidak',
                confirmButton: 'Ya, Hapus',
                animation: 'top',
                animationSpeed: 300,
                animationBounce: 1,

                confirm: function(){
                    return element.submit()
                },
                cancel: function(event){
                    return;
                }
            });
        })

    </script>
@endsection
