@extends('layouts.master')

@section('page_title', 'Data Prospek')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
            <h1>Data Prospek</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if ($data_prospek->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Prospek</th>
                                            <th>Nama Lembaga</th>
                                            <th>Alamat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data_prospek as $prospek)

                                        <tr>
                                            <td>
                                                {{ $prospek->nama_prospek }}
                                            </td>
                                            <td>
                                                {{ $prospek->nama_lembaga }}
                                            </td>
                                            <td>
                                                {{ $prospek->alamat }}
                                            </td>
                                            <td>
                                                <a href="/prospek/{{ $prospek->kode }}/edit" class="btn btn-sm btn-default"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                {!! Form::open(
                                                    [
                                                        'method' => 'DELETE',
                                                        'route' => ['prospek.destroy', $prospek->kode],
                                                        'style' => 'display: inline-block;',
                                                        'data-nama' => $prospek->nama_prospek,
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
                            Data prospek belum tersedia. Klik tombol Tambah Prospek untuk menambah prospek.
                        </div>
                    @endif

                    {!! $data_prospek->render() !!}
                    <div class="clearfix"></div>

                    <a href="/prospek/create" class="btn btn-success pull-right"><i class="fa fa-fw fa-plus"></i> Tambah Prospek</a>
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
                title: '<i class="fa fa-trash"></i> Hapus Prospek',
                content: 'Apakah Anda yakin akan menghapus prospek dengan nama <strong>' + nama + '</strong>',
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
