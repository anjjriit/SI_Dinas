@extends('layouts.master')

@section('page_title', 'Data User')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
            <h1>Data User</h1>
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
                                    'role' => 'Role',
                                    'active' => 'Status',
                                    'last_login' => 'Last Login'
                                ],
                                null,
                                ['class' => 'form-control', 'placeholder' => 'Order by', 'required']
                            ) !!}

                            {!! Form::select(
                                'order',
                                [
                                    'asc' => 'Ascending',
                                    'desc' => 'Descending'
                                ],
                                null,
                                ['class' => 'form-control', 'required']
                            ) !!}

                            {!! Form::button(
                                '<i class="fa fa-fw fa-sort-amount-asc"></i> Sort',
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
                                    'role' => 'Role',
                                ],
                                null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => 'Search By',
                                    'required'
                                ]
                            ) !!}
                            {!! Form::text('query', null, ['class' => 'form-control', 'placeholder' => 'Query...']) !!}
                            {!! Form::button(
                                '<i class="fa fa-fw fa-search"></i> Search',
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
                                    '<i class="fa fa-fw fa-times"></i> Clear Search',
                                    [
                                        'type' => 'submit',
                                        'class' => 'btn btn-info'
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
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Last Login</th>
                                            <th class="col-md-2">Action</th>
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
                                                <button class="btn btn-sm" disabled data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="fa fa-fw fa-edit"></i></button>
                                            @else
                                                <a href="/user/{{ $pegawai->nik }}/edit" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="fa fa-fw fa-edit"></i></a>
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
                                                    {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger delete-button', 'disabled', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'data-title' => 'Hapus']
                                                    ) !!}
                                                @else
                                                    {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger delete-button', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'data-title' => 'Hapus']
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
                                Data user belum tersedia. Klik tombol Tambah User untuk menambah user.
                            </div>
                        @endif
                    @endif

                    {!! $data_pegawai->render() !!}

                    <a href="/user/create" class="btn btn-success pull-right"><i class="fa fa-fw fa-plus"></i> Tambah User</a>
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
