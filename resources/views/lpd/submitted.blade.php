@extends('layouts.master')

@section('page_title', 'LPD yang Diajukan')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
            <p>LPD yang Diajukan</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                @if (Auth::user()->role == 'super_admin')
                    <a href="/dashboard">Halaman Utama</a>
                @else
                    <a href="/homepage">Halaman Utama</a>
                @endif
                <i class="fa fa-angle-right fa-fw"></i> Laporan Perjalanan Dinas
                <i class="fa fa-angle-right fa-fw"></i> Ajukan
            </span>
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

                    @if ($submittedLpds->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No. RPD</th>
                                            <th>No. LPD</th>
                                            <th>Tanggal Laporan</th>
                                            <th>Total Pengeluaran</th>
                                            <th class="col-md-1">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($submittedLpds as $lpd)
                                            <tr>
                                                <td>
                                                    {{ $lpd->rpd->kode }}
                                                </td>
                                                <td>
                                                    {{ $lpd->kode }}
                                                </td>
                                                <td>
                                                   <?php
                                                        $hari = date_format(date_create($lpd->tanggal_laporan), 'N');
                                                        $tanggalLaporan = date_format(date_create($lpd->tanggal_laporan), 'd/m/Y');
                                                    ?>

                                                    @if ($hari == 1)
                                                        {{ $tglLaporan = 'Senin, ' . $tanggalLaporan }}
                                                    @elseif ($hari == 2)
                                                        {{ $tglLaporan = 'Selasa, ' . $tanggalLaporan }}
                                                    @elseif ($hari == 3)
                                                        {{ $tglLaporan = 'Rabu, ' . $tanggalLaporan }}
                                                    @elseif ($hari == 4)
                                                        {{ $tglLaporan = 'Kamis, ' . $tanggalLaporan }}
                                                    @elseif ($hari == 5)
                                                        {{ $tglLaporan = 'Jum\'at, ' . $tanggalLaporan }}
                                                    @elseif ($hari == 6)
                                                        {{ $tglLaporan = 'Sabtu, ' . $tanggalLaporan }}
                                                    @else
                                                        {{ $tglLaporan = 'Minggu, ' . $tanggalLaporan }}
                                                    @endif
                                                </td>
                                                <td>
                                                    Rp {{ number_format($lpd->pengeluaran->sum('biaya'), 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#detailLPD-{{ $lpd->id }}" data-toggle-alt="tooltip" data-placement="top" data-title="Detail">
                                                        <i class="fa fa-fw fa-share"></i>
                                                    </button>
                                                    @if ($lpd->nik == auth()->user()->nik)
                                                        {!! Form::button('<i class="fa fa-fw fa-refresh"></i>', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger delete-button', 'data-toggle-alt' => 'tooltip', 'data-placement' => 'top', 'data-title' => 'Tarik Kembali', 'data-toggle' => 'modal', 'data-target' => '#modal-recall-' . $lpd->id]
                                                        ) !!}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            Data LPD yang telah diajukan belum tersedia.
                        </div>
                    @endif

                    {!! $submittedLpds->render() !!}
                </div>
            </div>
        </section>

        @foreach ($submittedLpds as $lpd)
            @include('lpd._modal_detail')

            <div class="modal fade" id="modal-recall-{{ $lpd->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Tarik Kembali {{ $lpd->kode }}</h4>
                        </div>

                        {!! Form::open(
                            [
                                'method' => 'POST',
                                'url' => '/lpd/recall/' . $lpd->id,
                                'data-nama' => $lpd->kode,
                            ]
                        ) !!}
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('comment', 'Alasan') !!}
                                            {!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Tarik Kembali</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach

@endsection

@section('script')
    @parent
    <script src="/vendor/jquery-confirm/js/jquery-confirm.min.js"></script>

    <script>
        $('[data-toggle-alt="tooltip"]').tooltip();
    </script>

@endsection
