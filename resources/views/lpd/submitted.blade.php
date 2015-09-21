@extends('layouts.master')

@section('page_title', 'LPD Submitted')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')
    
        <section class="content-header">
            <h1>Laporan Perjalanan Dinas</h1>
            <label>Yang telah disubmit</label>
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
                                            <th>Kode</th>
                                            <th>Tanggal Laporan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($submittedLpds as $lpd)
                                            <tr>
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
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#detailLPD-{{ $lpd->id }}">
                                                        <i class="fa fa-fw fa-share"></i> Detail
                                                    </button>
                                                    @if ($lpd->nik == auth()->user()->nik)
                                                        {!! Form::open(
                                                            [
                                                                'method' => 'POST',
                                                                'url' => '/lpd/recall/' . $lpd->id,
                                                                'style' => 'display: inline-block;',
                                                                'data-nama' => $lpd->kode,
                                                            ]
                                                        ) !!}

                                                            {!! Form::button('<i class="fa fa-fw fa-refresh"></i>Recall', ['type' => 'submit', 'class' => 'btn btn-sm btn-default delete-button']
                                                            ) !!}
                                                        {!! Form::close() !!}
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
                            Data LPD yang telah disubmit belum tersedia.
                        </div>
                    @endif

                    {!! $submittedLpds->render() !!}
                </div>
            </div>
        </section>

        @foreach ($submittedLpds as $lpd)
            <div class="modal fade" id="detailLPD-{{ $lpd->id }}" tabindex="-1" role="dialog" aria-labelledby="detailLPDLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Laporan Perjalanan Dinas (LPD)</h4>
                        </div>
                        <div class="modal-body">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-8">
                                        <table class="table table-modal table-bordered">
                                            <thead>
                                                <tr class="active">
                                                    <th class="col-md-6">Penanggung Jawab Akomodasi</th>
                                                    <th class="col-md-6">Tanggal Laporan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $lpd->pegawai->nama_lengkap }}</td>
                                                    <td>
                                                        {{ $tglLaporan }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <table class="table table-modal table-bordered">
                                            <thead>
                                                <tr class="active">
                                                    <th class="col-md-6">Personel</th>
                                                    <th class="col-md-6">Proyek / Keperluan Lainnya</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($lpd->rpd->peserta as $peserta)
                                                    @foreach($lpd->rpd->kegiatan()->where('nik_peserta', $peserta->nik)->get() as $kegiatan)
                                                        <tr>
                                                            @if ($lpd->rpd->kegiatan()->where('nik_peserta', $peserta->nik)->first() == $kegiatan)
                                                                <td rowspan="{{ $lpd->rpd->kegiatan()->where('nik_peserta', $peserta->nik)->count() }}" style="vertical-align: top;">
                                                                    {{ $peserta->nama_lengkap }}
                                                                </td>
                                                            @endif
                                                            <td>
                                                                @if ($kegiatan->jenis_kegiatan == 'project')
                                                                    {{ $kegiatan->project->nama_project }}
                                                                @elseif ($kegiatan->jenis_kegiatan == 'prospek')
                                                                    {{ $kegiatan->prospek->nama_prospek }}
                                                                @elseif ($kegiatan->jenis_kegiatan == 'pelatihan')
                                                                    {{ $kegiatan->pelatihan->nama_pelatihan }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <table class="table table-modal table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="col-md-6 active"><strong>Akomodasi Awal</strong></td>
                                                    <td class="text-right">{{ 'Rp ' . number_format($lpd->rpd->akomodasi_awal, 0, ',', '.') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="active"><strong>Total Pengeluaran</strong></td>
                                                    <td class="text-right">{{ 'Rp ' . number_format($lpd->total_pengeluaran, 0, ',', '.') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="active"><strong>Pengembalian (Reimburse)</strong></td>
                                                    <td class="text-right">{{ 'Rp ' . number_format(2000000, 0, ',', '.') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <table class="table table-modal table-bordered">
                                    <thead>
                                        <tr class="active">
                                            <th>Hari</th>
                                            <th>Tanggal</th>
                                            <th>Tipe</th>
                                            <th>Keterangan</th>
                                            <th>Struk</th>
                                            <th>Personel</th>
                                            <th>Biaya</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Jumat</td>
                                            <td>25/09/2015</td>
                                            <td>Makanan</td>
                                            <td>Makan Pagi</td>
                                            <td>Warung Nasi</td>
                                            <td>Personel</td>
                                            <td>Rp 10.000</td>
                                        </tr>
                                        <tr>
                                            <td>Jumat</td>
                                            <td>25/09/2015</td>
                                            <td>Makanan</td>
                                            <td>Makan Pagi</td>
                                            <td>Warung Nasi</td>
                                            <td>Personel</td>
                                            <td>Rp 10.000</td>
                                        </tr>
                                        <tr>
                                            <td>Jumat</td>
                                            <td>25/09/2015</td>
                                            <td>Makanan</td>
                                            <td>Makan Pagi</td>
                                            <td>Warung Nasi</td>
                                            <td>Personel</td>
                                            <td>Rp 10.000</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="text-center">Total</td>
                                            <td>Rp 30.000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @if (auth()->user()->role == 'finance')
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="/lpd/{{ $lpd->id }}/approval" class="btn btn-success"><i class="fa fa-fw fa-check-square-o"></i> Approval</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

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
                title: '<i class="fa fa-refresh"></i> Recall LPD',
                content: 'Apakah Anda yakin akan merecall LPD dengan kode <strong>' + nama + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-default',
                cancelButton: 'Tidak',
                confirmButton: 'Ya, Recall',
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