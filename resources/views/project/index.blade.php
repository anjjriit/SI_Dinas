@extends('layouts.master')

@section('page_title', 'Data Proyek')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
            <p>Data Proyek</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                <a href="/dashboard">Halaman Utama</a>
                <i class="fa fa-angle-right fa-fw"></i> Proyek
            </span>
        </section>

        <section class="content-filter">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::model($request, [
                        'method' => 'GET',
                        'route' => 'project.index',
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
                                    'nama_project' => 'Nama Proyek',
                                    'nama_lembaga' => 'Nama Lembaga/Institusi',
                                    'tanggal_mulai' => 'Tanggal Mulai',
                                    'tanggal_selesai' => 'Tanggal Selesai',
                                    'alamat' => 'Alamat',
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
                            'route' => 'project.index',
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
                                    'nama_project' => 'Nama Proyek',
                                    'nama_lembaga' => 'Nama Lembaga/Institusi',
                                    'tanggal_mulai' => 'Tanggal Mulai',
                                    'tanggal_selesai' => 'Tanggal Selesai',
                                    'alamat' => 'Alamat',
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
                                'route' => 'project.index',
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

                    @if ($data_project->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="22%">Nama Proyek</th>
                                            <th width="18%">Nama Lembaga/Institusi</th>
                                            <th width="15%">Tanggal Mulai</th>
                                            <th width="15%">Tanggal Selesai</th>
                                            <th>Alamat</th>
                                            <th class="col-md-1">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data_project as $project)

                                        <tr>
                                            <td>
                                                {{ $project->nama_project }}
                                            </td>
                                            <td>
                                                {{ $project->nama_lembaga }}
                                            </td>
                                            <td>
                                                {{ date_format(date_create($project->tanggal_mulai), 'd/m/Y') }}
                                            </td>
                                            <td>
                                                {{ date_format(date_create($project->tanggal_selesai), 'd/m/Y') }}
                                            </td>
                                            <td>
                                                {{ $project->alamat }}
                                            </td>
                                            <td>
                                                <a href="/project/{{ $project->kode }}/edit" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-title="Ubah"><i class="fa fa-fw fa-edit"></i></a>
                                                {!! Form::open(
                                                    [
                                                        'method' => 'DELETE',
                                                        'route' => ['project.destroy', $project->kode],
                                                        'style' => 'display: inline-block;',
                                                        'data-nama' => $project->nama_project,
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
                                Data proyek belum tersedia. Klik tombol Tambah Proyek untuk menambah data proyek.
                            </div>
                        @endif
                    @endif

                    {!! $data_project->render() !!}

                    <a href="/project/create" class="btn btn-success pull-right"><i class="fa fa-fw fa-plus"></i> Tambah Proyek</a>
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
                title: '<i class="fa fa-trash"></i> Hapus Proyek',
                content: 'Apakah Anda yakin akan menghapus proyek dengan nama <strong>' + nama + '</strong>',
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
