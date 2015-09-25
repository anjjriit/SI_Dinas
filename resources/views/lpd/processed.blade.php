@extends('layouts.master')

@section('page_title', 'Processed LPD')

@section('content')

    <section class="content-header">
        <h1>Data Laporan Perjalanan Dinas</h1>
        <label>Yang telah diproses</label>
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
                                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#detailLPD-{{ $lpd->id }}">
                                                    <i class="fa fa-fw fa-share"></i> Detail
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning">
                        Data LPD yang telah diproses belum tersedia.
                    </div>
                @endif

                {!! $processedLpds->render() !!}
            </div>
        </div>
    </section>

    @foreach ($processedLpds as $lpd)
        @include('lpd._modal_detail')
    @endforeach

@endsection

