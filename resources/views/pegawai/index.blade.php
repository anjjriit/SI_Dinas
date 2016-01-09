@extends('layouts.master')

@section('page_title', 'Data Pegawai')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
            <p>Data Pegawai</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                <a href="/dashboard">Halaman Utama</a>
                <i class="fa fa-angle-right fa-fw"></i> Pegawai
            </span>
        </section>

        <section class="content-filter">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::model($request, [
                        'method' => 'GET',
                        'route' => 'user.index',
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
                                    'nik' => 'NIK',
                                    'nama_lengkap' => 'Nama Lengkap',
                                    'email' => 'E-mail',
                                    'role' => 'Peran',
                                    'active' => 'Status',
                                    'last_login' => 'Terakhir Masuk'
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
                            'route' => 'user.index',
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
                                    'nik' => 'NIK',
                                    'nama_lengkap' => 'Nama Lengkap',
                                    'email' => 'E-mail',
                                    'role' => 'Peran',
                                ],
                                null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => 'Kategori',
                                    'required'
                                ]
                            ) !!}
                            {!! Form::text('query', null, ['class' => 'form-control', 'placeholder' => 'Kata Kunci...']) !!}
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
                                'route' => 'user.index',
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

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($data_pegawai->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>NIK</th>
                                            <th>Nama Lengkap</th>
                                            <th>E-mail</th>
                                            <th>Peran</th>
                                            <th>Status</th>
                                            <th>Terakhir Masuk</th>
                                            <th class="col-md-1">Aksi</th>
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
                                            @if (is_null($pegawai->last_login))
                                                -
                                            @else
                                                {{ $pegawai->last_login}}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($pegawai->otherAdmin())
                                                <button class="btn btn-xs" disabled data-toggle="tooltip" data-placement="top" data-title="Ubah"><i class="fa fa-fw fa-edit"></i></button>
                                            @else
                                                <a href="/user/{{ $pegawai->nik }}/edit" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-title="Ubah"><i class="fa fa-fw fa-edit"></i></a>
                                            @endif

                                            {!! Form::open(
                                                [
                                                    'method' => 'DELETE',
                                                    'route' => ['user.destroy', $pegawai->nik],
                                                    'style' => 'display: inline-block;',
                                                    'data-nama' => $pegawai->nama_lengkap,
                                                ]
                                            ) !!}
                                                @if ($pegawai->otherAdmin())
                                                    {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger delete-button', 'disabled', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'data-title' => 'Hapus']
                                                    ) !!}
                                                @else
                                                    {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger delete-button', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'data-title' => 'Hapus']
                                                    ) !!}
                                                @endif
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
                                Data pegawai belum tersedia. Klik tombol Tambah Pegawai untuk menambah pegawai.
                            </div>
                        @endif
                    @endif

                    {!! $data_pegawai->render() !!}

                    <a href="/user/create" class="btn btn-success pull-right"><i class="fa fa-fw fa-plus"></i> Tambah Pegawai</a>
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
                title: '<i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus Pegawai',
                content: 'Apakah Anda yakin akan menghapus pegawai dengan nama <strong>' + nama + '</strong>',
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
