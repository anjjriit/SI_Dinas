@extends('layouts.master')

@section('page_title', 'Data Kota')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
            <h1>Data Kota</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($data_kota->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Kota</th>
                                            <th class="col-md-2">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data_kota as $kota)
                                        <tr>
                                            <td>
                                                {{ $kota->nama_kota }}
                                            </td>
                                            <td>
                                                <a href="/kota/{{ $kota->kode }}/edit" class="btn btn-sm btn-default"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                {!! Form::open(
                                                    [
                                                        'method' => 'DELETE',
                                                        'route' => ['kota.destroy', $kota->kode],
                                                        'style' => 'display: inline-block;',
                                                        'data-nama' => $kota->nama_kota,
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
                            Data kota belum tersedia. Klik tombol Tambah Kota untuk menambah kota.
                        </div>
                    @endif

                    {!! $data_kota->render() !!}

                    <a href="/kota/create" class="btn btn-success pull-right"><i class="fa fa-fw fa-plus"></i> Tambah Kota</a>

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
                content: 'Apakah Anda yakin akan menghapus kota <strong>' + nama + '</strong>',
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
