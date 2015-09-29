@extends('layouts.master')

@section('page_title', 'LPD Yang Telah Di Proses')

@section('content')

    <section class="content-header">
        <p>LPD Yang Telah Di Proses</p>
        <span class="bcumb">
            <i class="fa fa-fw fa-bookmark"></i>
            @if (Auth::user()->role == 'super_admin')
                <a href="/dashboard">Dashboard</a>
            @else
                <a href="/homepage">Homepage</a>
            @endif
            <i class="fa fa-angle-right fa-fw"></i> Laporan Perjalanan Dinas
            <i class="fa fa-angle-right fa-fw"></i> Processed
        </span>
    </section>

    <section class="content-filter">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::model($request, [
                        'method' => 'GET',
                        'url' => '/lpd/processed',
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
                                    'tanggal_laporan' => 'Tanggal Laporan'
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
                            'url' => '/lpd/processed',
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
                                    'tanggal_laporan' => 'Tanggal Laporan'
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
                                'url' => '/lpd/processed',
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

                @if ($processedLpds->count() != 0)
                    <div class="box box-widget">
                        <div class="box-body no-padding">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="col-md-1"></th>
                                        <th>No. LPD</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Tanggal Laporan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($processedLpds as $lpd)
                                        <tr>
                                            <td class="text-right">
                                                @if($lpd->reimburse)
                                                    <span class="label label-warning">Reimburse</span>
                                                @else
                                                    <span class="label label-default">Pengembalian</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $lpd->kode }}
                                            </td>
                                            <td>
                                                {{ $lpd->pegawai->nama_lengkap }}
                                            </td>
                                            <td>
                                                <?php
                                                    $hari = date_format(date_create($lpd->tanggal_laporan), 'N');
                                                    $tanggalLaporan = date_format(date_create($lpd->tanggal_laporan), 'd/m/Y');
                                                ?>

                                                @if ($hari == 1)
                                                    {{ $tglLaporan = 'Senin, ' . $tanggalLaporan }}
                                                @elseif($hari == 2)
                                                    {{ $tglLaporan = 'Selasa, ' . $tanggalLaporan }}
                                                @elseif($hari == 3)
                                                    {{ $tglLaporan = 'Rabu, ' . $tanggalLaporan }}
                                                @elseif($hari == 4)
                                                    {{ $tglLaporan = 'Kamis, ' . $tanggalLaporan }}
                                                @elseif($hari == 5)
                                                    {{ $tglLaporan = 'Jum\'at, ' . $tanggalLaporan }}
                                                @elseif($hari == 6)
                                                    {{ $tglLaporan = 'Sabtu, ' . $tanggalLaporan }}
                                                @else
                                                    {{ $tglLaporan = 'Minggu, ' . $tanggalLaporan }}
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#detailLPD-{{ $lpd->id }}" data-toggle-alt="tooltip" data-placement="top" data-title="Detail">
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
                            Data LPD yang telah diproses belum tersedia.
                        </div>
                    @endif
                @endif

                {!! $processedLpds->render() !!}
            </div>
        </div>
    </section>

    @foreach ($processedLpds as $lpd)
        @include('lpd._modal_detail')
    @endforeach

@endsection

