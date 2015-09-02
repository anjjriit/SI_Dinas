@extends('layouts.master')

@section('page_title', 'Data Jenis Biaya Pengeluaran Standard')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
            <h1>Data Jenis Biaya Pengeluaran Standard</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($data_jenispengeluaranbiayastandard->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Jenis Biaya</th>
                                            <th>Biaya</th>
                                            <th class="col-md-2">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data_jenispengeluaranbiayastandard as $jenisbiayapengeluaranstandard)
                                        <tr>
                                            <td>
                                                {{ $jenisbiayapengeluaranstandard->nama_jenis }}
                                            </td>
                                            <td>
                                                {{ 'Rp ' . number_format($jenisbiayapengeluaranstandard->biaya, 2, ",", ".") }}
                                            </td>
                                            <td>
                                                <a href="/jenisbiayapengeluaranstandard/{{ $jenisbiayapengeluaranstandard->kode }}/edit" class="btn btn-sm btn-default"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                {!! Form::open(
                                                    [
                                                        'method' => 'DELETE',
                                                        'route' => ['jenisbiayapengeluaranstandard.destroy', $jenisbiayapengeluaranstandard->kode],
                                                        'style' => 'display: inline-block;',
                                                        'data-nama' => $jenisbiayapengeluaranstandard->nama_jenis,
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
                            Data jenis biaya pengeluaran standard belum tersedia. Klik tombol Tambah Jenis Biaya untuk menambah jenis biaya pengeluaran standard.
                        </div>
                    @endif

                    {!! $data_jenispengeluaranbiayastandard->render() !!}

                    <a href="/jenisbiayapengeluaranstandard/create" class="btn btn-success pull-right"><i class="fa fa-fw fa-plus"></i> Tambah Jenis Biaya </a>

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
                title: '<i class="fa fa-trash"></i> Hapus Kota',
                content: 'Apakah Anda yakin akan menghapus jenis biaya <strong>' + nama + '</strong>',
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
