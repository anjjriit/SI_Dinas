@extends('layouts.master')

@section('page_title', 'LPD yang Disetujui')

@section('content')

        <section class="content-header">
        <p>LPD yang Disetujui</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                @if (Auth::user()->role == 'super_admin')
                    <a href="/dashboard">Halaman Utama</a>
                @else
                    <a href="/homepage">Halaman Utama</a>
                @endif
                <i class="fa fa-angle-right fa-fw"></i> Laporan Perjalanan Dinas
                <i class="fa fa-angle-right fa-fw"></i> Setujui
            </span>
        </section>

        <section class="content-filter">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::model($request, [
                        'method' => 'GET',
                        'url' => '/lpd/approved',
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
                                    'kode' => 'No. LPD',
                                    'updated_at' => 'Terakhir Diperbarui'
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
                            'url' => '/lpd/approved',
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
                                    'kode' => 'No. LPD',
                                    'updated_at' => 'Terakhir Diperbarui'
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
                                'url' => '/lpd/approved',
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

                    @if ($approvedLpds->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>No. LPD</th>
                                            <th>Pengaju</th>
                                            <th>Status</th>
                                            <th>Terakhir Diperbarui</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($approvedLpds as $approvedLpd)
                                            <tr>
                                                <td>
                                                    {{ $approvedLpd->kode }}
                                                </td>
                                                <td>
                                                    {{ $approvedLpd->pegawai->nama_lengkap }}
                                                </td>
                                                <td>
                                                    {{ $approvedLpd->status }}
                                                </td>
                                                <td>
                                                    {{ date_format( date_create($approvedLpd->updated_at), 'd/m/Y H:i:s' ) }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#detailLPD-{{ $approvedLpd->id }}" data-toggle-alt="tooltip" data-placement="top" data-title="Detail">
                                                        <i class="fa fa-fw fa-share"></i>
                                                    </button>
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
                                Data LPD yang telah disetujui belum tersedia.
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </section>

        @foreach ($approvedLpds as $lpd)
            @include('lpd._modal_detail')
        @endforeach


@endsection

@section('script')
    @parent
    <script>
        $('[data-toggle-alt="tooltip"]').tooltip();
    </script>
@endsection
