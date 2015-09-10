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

        <section class="content-filter">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::model($request, [
                        'method' => 'GET',
                        'route' => 'prospek.index',
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
                                    'nama_prospek' => 'Nama Prospek',
                                    'nama_lembaga' => 'Nama Lembaga',
                                    'alamat' => 'Alamat',
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
                            'route' => 'prospek.index',
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
                                    'nama_prospek' => 'Nama Prospek',
                                    'nama_lembaga' => 'Nama Lembaga',
                                    'alamat' => 'Alamat',
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
                                'route' => 'prospek.index',
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

                    @if ($data_prospek->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Prospek</th>
                                            <th>Nama Lembaga</th>
                                            <th>Alamat</th>
                                            <th class="col-md-2">Action</th>
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
                                                <a href="/prospek/{{ $prospek->kode }}/edit" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                                {!! Form::open(
                                                    [
                                                        'method' => 'DELETE',
                                                        'route' => ['prospek.destroy', $prospek->kode],
                                                        'style' => 'display: inline-block;',
                                                        'data-nama' => $prospek->nama_prospek,
                                                    ]
                                                ) !!}

                                                    {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger delete-button', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'data-title' => 'Hapus']
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
                                Data prospek belum tersedia. Klik tombol Tambah Prospek untuk menambah prospek.
                            </div>
                        @endif
                    @endif

                    {!! $data_prospek->render() !!}

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
            event.preventDefault()

            var element = $(this).parent()

            var nama = element.attr('data-nama')

            $.confirm({
                title: '<i class="fa fa-trash"></i> Hapus Prospek',
                content: 'Apakah Anda yakin akan menghapus prospek dengan nama <strong>' + nama + '</strong>',
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
            })
        })

    </script>
@endsection
