@extends('layouts.master')

@section('page_title', 'Data Biaya ' . $transportasi->nama_transportasi)

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
            <p>Data Biaya {{ $transportasi->nama_transportasi }}</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                <a href="/dashboard">Halaman Utama</a>
                <i class="fa fa-angle-right fa-fw"></i> <a href="/transportasi">Data Transportasi</a>
                <i class="fa fa-angle-right fa-fw"></i> Data Biaya {{ $transportasi->nama_transportasi }}
            </span>
        </section>

        <section class="content-filter">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::model($request, [
                        'method' => 'GET',
                        'url' => '/transportasi/' . $transportasi->id,
                        'class' => 'form-inline pull-right'
                    ])!!}
                        <div class="form-group">
                            @if ($request->has('query'))
                                {!! Form::hidden('searchBy') !!}
                                {!! Form::hidden('query') !!}
                            @endif

                            {!! Form::select(
                                'orderBy',
                                [
                                    'harga' => 'Biaya',
                                ],
                                null,
                                ['class' => 'form-control', 'placeholder' => 'Kategori', 'required']
                            ) !!}

                            {!! Form::select(
                                'order',
                                [
                                    'asc' => 'Menaik',
                                    'desc' => 'Menurun'
                                ],
                                null,
                                ['class' => 'form-control', 'required']
                            ) !!}

                            {!! Form::button(
                                '<i class="fa fa-fw fa-sort-amount-asc"></i> Urutkan',
                                [
                                    'type' => 'submit', 'class' => 'btn btn-success'
                                ]
                            ) !!}
                        </div>
                    {!! Form::close() !!}

                    {!! Form::model($request,
                        [
                            'method' => 'GET',
                            'url' => '/transportasi/' . $transportasi->id,
                            'class' => 'form-inline pull-left'
                        ]
                    )!!}
                        <div class="form-group">
                            @if ($request->has('orderBy'))
                                {!! Form::hidden('orderBy') !!}
                                {!! Form::hidden('order') !!}
                            @endif

                            {!! Form::select(
                                'searchBy',
                                [
                                    'id_kota_asal' => 'Kota Asal',
                                    'id_kota_tujuan' => 'Kota Tujuan',
                                ],
                                null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => 'Kategori',
                                    'required'
                                ]
                            ) !!}
                            {!! Form::select('query', $list_kota, null, ['class' => 'form-control']) !!}
                            {!! Form::button(
                                '<i class="fa fa-fw fa-search"></i> Cari',
                                ['type' => 'submit', 'class' => 'btn btn-success', 'style' => 'margin-left: 3px;']
                            ) !!}
                        </div>
                    {!! Form::close() !!}

                    @if ($request->has('query'))
                        {!! Form::model($request,
                            [
                                'method' => 'GET',
                                'url' => '/transportasi/' . $transportasi->id,
                                'class' => 'form-inline pull-left',
                                'style' => 'margin-left: 5px;'
                            ]
                        )!!}
                            <div class="form-group">
                                @if ($request->has('orderBy'))
                                    {!! Form::hidden('orderBy') !!}
                                    {!! Form::hidden('order') !!}
                                @endif

                                {!! Form::button(
                                    '<i class="fa fa-fw fa-times"></i> Kosongkan Pencarian',
                                    [
                                        'type' => 'submit',
                                        'class' => 'btn btn-info',
                                        'style' => 'margin-top: 1px;'
                                    ]
                                ) !!}
                            </div>
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($data_biayaTransportasi->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Kota Asal</th>
                                            <th>Kota Tujuan</th>
                                            <th>Biaya</th>
                                            <th class="col-md-1">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data_biayaTransportasi as $biaya)
                                        <tr>
                                            <td>
                                                {{ $biaya->kotaAsal->nama_kota }}
                                            </td>
                                            <td>
                                                {{ $biaya->kotaTujuan->nama_kota }}
                                            </td>
                                            <td>
                                                Rp{{ number_format($biaya->harga, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                <a href="/transportasi/{{ $transportasi->id }}/biaya/{{ $biaya->id }}/edit" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-title="Ubah"><i class="fa fa-fw fa-edit"></i></a>
                                                {!! Form::open(
                                                    [
                                                        'method' => 'DELETE',
                                                        'url' => ['/transportasi/' . $transportasi->id . '/biaya/' . $biaya->id],
                                                        'style' => 'display: inline-block;',
                                                        'data-nama' => $transportasi->nama_transportasi . ' dari ' . $biaya->kotaAsal->nama_kota . ' ke ' . $biaya->kotaTujuan->nama_kota,
                                                    ]
                                                ) !!}

                                                    {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger delete-button', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'data-title' => 'Hapus']
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
                        @if ($request->has('query'))
                            <div class="alert alert-warning">
                                Hasil tidak ditemukan untuk kata kunci "<strong>{{ $request->input('query') }}</strong>".
                            </div>
                        @else
                            <div class="alert alert-warning">
                                Data biaya transportasi belum tersedia. Klik tombol Tambah Biaya Transportasi untuk menambah data biaya.
                            </div>
                        @endif
                    @endif

                    {!! $data_biayaTransportasi->render() !!}

                    <a href="/transportasi/{{ $transportasi->id }}/biaya/create" class="btn btn-success pull-right"><i class="fa fa-fw fa-plus"></i> Tambah Biaya </a>

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
                title: '<i class="fa fa-trash"></i> Hapus Biaya Transportasi',
                content: 'Apakah Anda yakin akan menghapus biaya transportasi <strong>' + nama + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-default',
                cancelButton: 'Tidak',
                confirmButton: 'Ya',
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
