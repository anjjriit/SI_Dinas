@extends('layouts.master')

@section('page_title', 'LPD yang Diajukan')

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
                                        <th class="col-md-1"></th>
                                        <th>No. LPD</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Tanggal Laporan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($submittedLpds as $lpd)
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
    @endforeach


@endsection

@section('script')
    @parent
    <script>
        $('[data-toggle-alt="tooltip"]').tooltip();
    </script>
@endsection
