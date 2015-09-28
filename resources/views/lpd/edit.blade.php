@extends('layouts.master')

@section('page_title', 'Laporan ' . $lpd->rpd->kode)

@section('stylesheet')
    @parent
    <link rel="stylesheet" type="text/css" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
            <p>Edit LPD</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                @if (Auth::user()->role == 'super_admin')
                    <a href="/dashboard">Dashboard</a>
                @else
                    <a href="/homepage">Homepage</a>
                @endif
                <i class="fa fa-angle-right fa-fw"></i> <a href="/lpd">Laporan Perjalanan Dinas</a>
                <i class="fa fa-angle-right fa-fw"></i> Laporan <strong>{{ $lpd->rpd->kode }}</strong>
                <i class="fa fa-angle-right fa-fw"></i> Edit
            </span>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Edit LPD</h4>
                        </div>

                        <hr style="margin-top: 10px;">

                        <div class="box-body">
                            {!! Form::open(
                                [
                                    'method' => 'POST',
                                    'url' => '/lpd/' . $lpd->id . '/pengeluaran/add'
                                ]
                            ) !!}
                                <div class="page-header alt"><strong>Pengeluaran</strong></div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                                            <br>
                                        @endforeach
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @include('lpd._form_pengeluaran')

                                {!! Form::button('<i class="fa fa-fw fa-plus"></i> Tambah Pengeluaran', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                            {!! Form::close() !!}

                            <br>
                            <br>
                            <div class="page-header alt"><strong>List Pengeluaran</strong></div>
                            @if ($lpd->pengeluaran->count() > 0)
                                <table class="table table-condensed table-bordered">
                                    <thead>
                                        <tr class="active">
                                            <th>Tanggal</th>
                                            <th>Tipe</th>
                                            <th>Keterangan</th>
                                            <th>Struk</th>
                                            <th>Personel</th>
                                            <th>Biaya</th>
                                            <th class="col-md-1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lpd->pengeluaran as $pengeluaran)
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <?php
                                                        $hari = date_format(date_create($pengeluaran->tanggal), 'N');
                                                    ?>

                                                    @if ($hari == 1)
                                                        {{ 'Senin, ' }}
                                                    @elseif($hari == 2)
                                                        {{ 'Selasa, ' }}
                                                    @elseif($hari == 3)
                                                        {{ 'Rabu, ' }}
                                                    @elseif($hari == 4)
                                                        {{ 'Kamis, ' }}
                                                    @elseif($hari == 5)
                                                        {{ 'Jum\'at, ' }}
                                                    @elseif($hari == 6)
                                                        {{ 'Sabtu, ' }}
                                                    @else
                                                        {{ 'Minggu, ' }}
                                                    @endif

                                                    {{ date_format(date_create($pengeluaran->tanggal), 'd/m/Y') }}
                                                </td>
                                                <td style="vertical-align: top;">{{ $pengeluaran->tipe->nama_kategori }}</td>
                                                <td style="vertical-align: top;">{{ $pengeluaran->keterangan }}</td>
                                                <td style="vertical-align: top;">{{ $pengeluaran->struk }}</td>
                                                <td style="vertical-align: top;">
                                                    <ul class="list-unstyled">
                                                        @foreach ($pengeluaran->personel as $personel)
                                                            <li>{{ $personel->nama_lengkap }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td style="vertical-align: top;">Rp {{ number_format($pengeluaran->biaya, 0, ',', '.' ) }}</td>
                                                <td>
                                                    <a href="/lpd/{{ $lpd->id }}/pengeluaran/{{ $pengeluaran->id }}/edit" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                                    {!! Form::open(
                                                        [
                                                            'method' => 'DELETE',
                                                            'url' => '/lpd/pengeluaran/' . $pengeluaran->id,
                                                            'style' => 'display: inline-block;',
                                                            'data-nama' => $pengeluaran->keterangan,
                                                        ]
                                                    ) !!}

                                                        {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger delete-button', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'data-title' => 'Hapus']
                                                        ) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="5" class="text-center active">Total</td>
                                            <td>Rp {{ number_format($lpd->pengeluaran->sum('biaya'), 0, ',', '.') }}</td>
                                            <td class="active"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-warning">
                                    Belum ada pengeluaran yang tercatat untuk laporan ini.
                                </div>
                            @endif
                        </div>
                        <div class="box-footer text-right">
                            {!! Form::open(
                                [
                                    'method' => 'POST',
                                    'url' => '/lpd/' . $lpd->id
                                ]
                            ) !!}
                                {!! Form::button('<i class="fa fa-fw fa-floppy-o"></i> Save as Draft', ['type' => 'submit', 'class' => 'btn btn-default', 'value' => 'draft', 'name' => 'action']) !!}
                                {!! Form::button('<i class="fa fa-fw fa-check"></i> Submit', ['type' => 'submit', 'class' => 'btn btn-success', 'value' => 'submit', 'name' => 'action']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection

@section('script')
    @parent
    <script src="/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/vendor/jquery-confirm/js/jquery-confirm.min.js"></script>

    <script>
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd',
        });

        $('.delete-button').on('click', function(event) {
            event.preventDefault();

            var element = $(this).parent()

            var nama = element.attr('data-nama')

            $.confirm({
                title: '<i class="fa fa-trash"></i> Hapus Pengeluaran',
                content: 'Apakah Anda yakin akan menghapus <strong>' + nama + '</strong>',
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
