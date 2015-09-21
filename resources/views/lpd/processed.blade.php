@extends('layouts.master')

@section('page_title', 'LPD Processed')

@section('content')

        @if (session('success'))
            <div class="content">
                <div class="row">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="content">
                <div class="row">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        <section class="content-header">
            <h1>Laporan Perjalanan Dinas</h1>
            <label>Yang telah diapproved Finance</label>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if ($processedLpds->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Penanggung Jawab</th>
                                            <th>Tanggal Laporan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($processedLpds as $processedLpd)
                                            <tr>
                                                <td>{{ $processedLpd->kode }}</td>
                                                <td>{{ $processedLpd->pegawai->nama_lengkap }}</td>
                                                <td>{{ date_format (date_create($processedLpd->updated_at), 'd/m/Y') }}</td>
                                                <td>{{ ucwords(str_replace('_', ' ', $processedLpd->status)) }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target= "#detailLPD-{{ $processedLpd->id }}">
                                                        <i class="fa fa-fw fa-share"></i>Detail
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
                        List LPD yang diapproved oleh Finance belum tersedia.
                    </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Detail Modal LPD -->
        @foreach ($processedLpds as $lpd)
        <div class="modal fade" id="detailLPD-{{ $lpd->id }}" tabindex="-1" role="dialog" aria-labelledby="detailLPDLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Laporan Perjalanan Dinas (LPD)</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Info Detail LPD -->
                        <div class="content">
                            <div class="row">
                                <div class="col-md-8">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Penanggung Jawab Akomodasi</th>
                                                <th>Tanggal Laporan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $lpd->pegawai->nama_lengkap }}</td>
                                                <td>{{ date_format(date_create($lpd->updated_at), 'd/m/Y') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Personel</th>
                                                <th>Proyek / Keperluan Lainnya</th>
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
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <th class="col-md-5">Akomodasi Awal</th>
                                                <td>{{ 'Rp ' . number_format($lpd->rpd->akomodasi_awal, 2, ",", ".") }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Pengeluaran</th>
                                                <td>{{ 'Rp '. number_format($lpd->total_pengeluaran, 2, ",", ".") }}</td>
                                            </tr>
                                            <tr>
                                                @if ($lpd->reimburse)
                                                    <th>Reimburse</th>
                                                    <td>{{ 'Rp '. number_format($lpd->total_pengeluaran - $lpd->rpd->akomodasi_awal, 2, ",", ".") }}</td>
                                                @else
                                                    <th>Pengembalian</th>
                                                    <td>{{ 'Rp '. number_format($lpd->rpd->akomodasi_awal - $lpd->total_pengeluaran, 2, ",", ".") }}</td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>Hari</th>
                                        <th>Tanggal</th>
                                        <th>Tipe</th>
                                        <th>Keterangan</th>
                                        <th>Struk</th>
                                        <th>Personel</th>
                                        <th>Biaya</th>
                                    </tr>
                                    <tr>
                                        <td>Hari</td>
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
                                        <td colspan="6" align="center">Total</td>
                                        <td>{{ 'Rp '. number_format($lpd->total_pengeluaran, 2, ",", ".") }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @if (auth()->user()->role == 'administration')
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="/lpd/{{ $lpd->id }}/approval" class="btn btn-success"><i class="fa fa-fw fa-check-square-o"></i> Approval</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div> <!-- Akhir Bagian Modal Detail LPD-->
        @endforeach

@endsection