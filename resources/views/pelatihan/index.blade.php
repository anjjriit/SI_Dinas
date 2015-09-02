@extends('layouts.master')

@section('page_title', 'Data Pelatihan')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
            <h1>Data Pelatihan</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($data_pelatihan->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Pelatihan</th>
                                            <th>Nama Lembaga</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Alamat</th>
                                            <th class="col-md-2">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data_pelatihan as $pelatihan)

                                        <tr>
                                            <td>
                                                {{ $pelatihan->nama_pelatihan }}
                                            </td>
                                            <td>
                                                {{ $pelatihan->nama_lembaga }}
                                            </td>
                                            <td>
                                                {{ $pelatihan->tanggal_mulai }}
                                            </td>
                                            <td>
                                                {{ $pelatihan->tanggal_selesai }}
                                            </td>
                                            <td>
                                                {{ $pelatihan->alamat }}
                                            </td>
                                            <td>
                                                <a href="/pelatihan/{{ $pelatihan->kode }}/edit" class="btn btn-sm btn-default"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                {!! Form::open(
                                                    [
                                                        'method' => 'DELETE',
                                                        'route' => ['pelatihan.destroy', $pelatihan->kode],
                                                        'style' => 'display: inline;',
                                                        'data-nama' => $pelatihan->nama_pelatihan,
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
                    @else
                        <div class="alert alert-warning">
                            Data pelatihan belum tersedia. Klik tombol Tambah Pelatihan untuk menambah pelatihan.
                        </div>
                    @endif

                    {!! $data_pelatihan->render() !!}

                    <a href="/pelatihan/create" class="btn btn-success pull-right"><i class="fa fa-fw fa-plus"></i> Tambah Pelatihan</a>
                </div>
            </div>
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
                title: '<i class="fa fa-trash"></i> Hapus Pelatihan',
                content: 'Apakah Anda yakin akan menghapus pelatihan dengan nama <strong>' + nama + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-success',
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
