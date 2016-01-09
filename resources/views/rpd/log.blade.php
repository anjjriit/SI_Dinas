@extends('layouts.master')

@section('page_title', 'Catatan RPD')

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
            <p>Catatan RPD</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                @if (Auth::user()->role == 'super_admin')
                    <a href="/dashboard">Halaman Utama</a>
                @else
                    <a href="/homepage">Halaman Utama</a>
                @endif
                <i class="fa fa-angle-right fa-fw"></i> Rencana Perjalanan Dinas
                <i class="fa fa-angle-right fa-fw"></i> Catatan
            </span>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if ($rpdLogs->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">No. RPD</th>
                                            <th>Kota Asal</th>
                                            <th>Kota Tujuan</th>
                                            <th>Terakhir Diperbarui</th>
                                            <th>Status</th>
                                            <th class="col-md-1">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rpdLogs as $rpdLog)
                                            <tr>
                                                <td>
                                                    {{ $rpdLog->kode }}
                                                </td>
                                                <td>
                                                    {{ $rpdLog->kotaAsal->nama_kota }}
                                                </td>
                                                <td>
                                                    {{ $rpdLog->kotaTujuan->nama_kota }}
                                                </td>
                                                <td>
                                                    {{ date_format( date_create($rpdLog->updated_at), 'd/m/Y H:i' ) }}
                                                </td>
                                                <td>
                                                    {{ ucwords(strtolower($rpdLog->status)) }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#detailRPD-{{ $rpdLog->id }}" data-toggle-alt="tooltip" data-placement="top" data-title="Detail">
                                                        <i class="fa fa-share"></i>
                                                    </button>
                                                    @if ($rpdLog->status == 'BACK TO INITIATOR')
                                                        <a href="/rpd/{{ $rpdLog->id }}/edit" class="btn btn-xs btn-default" data-toggle-alt="tooltip" data-placement="top" data-title="Ubah"><i class="fa fa-fw fa-edit"></i></a>
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
                            Catatan RPD belum tersedia.
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Bagian Modal Detail RPD-->
        @foreach ($rpdLogs as $rpd)
        <div class="modal fade" id="detailRPD-{{ $rpd->id }}" tabindex="-1" role="dialog" aria-labelledby="detailRPDLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><strong>Rencana Perjalanan Dinas (RPD)</strong></h4>
                    </div>
                    <div class="modal-body">
                        <!-- Info basic dari RPD -->
                        <div class="page-header"><strong>Detail</strong></div>
                        <table class="table table-plain table-responsive">
                            <tbody>
                                <tr>
                                    <td class="col-md-3">Nomor RPD</td>
                                    <td>{{ $rpd->kode }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Penanggung Jawab</td>
                                    <td>{{ $rpd->pegawai->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Kategori</td>
                                    <td>{{ $dataKategori = ucwords(str_replace('_', ' ', $rpd->kategori)) }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Jenis</td>
                                    <td>{{ ucwords(str_replace('_', ' ', $rpd->jenis_perjalanan)) }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Tanggal Mulai</td>
                                    <td>{{ date_format( date_create($rpd->tanggal_mulai), 'd/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Tanggal Selesai</td>
                                    <td>
                                        {{ date_format( date_create($rpd->tanggal_selesai), 'd/m/Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Jumlah Hari Dinas</td>
                                    <td>
                                        {{ $rpd->lama_hari }} hari
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Asal Kota</td>
                                    <td>{{ $rpd->kotaAsal->nama_kota }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Tujuan Kota</td>
                                    <td>{{ $rpd->kotaTujuan->nama_kota }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3" style="vertical-align: top;">Sarana Transportasi</td>
                                    <td>
                                        @foreach($rpd->saranaTransportasi as $saranaTransportasi)
                                            {{ $saranaTransportasi->nama_transportasi }}@if ($saranaTransportasi != $rpd->saranaTransportasi[$rpd->saranaTransportasi->count() - 1]), @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Sarana Penginapan</td>
                                    <td>{{ $rpd->saranaPenginapan->nama_penginapan }}</td>
                                </tr>
                                @if ($rpd->status == 'APPROVED' || auth()->user()->role == 'administration')
                                <tr>
                                    <td class="col-md-3">Akomodasi Awal</td>
                                    <td>Rp {{ number_format($rpd->akomodasi_awal, 2, ',', '.') }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="col-md-3">Status</td>
                                    <td>{{ $rpd->status }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Daftar Peserta RPD-->
                        <div class="page-header"><strong>Peserta &amp; Tujuan Kegiatan</strong></div>
                        <table class="table table-bordered table-condensed" width="100%">
                            <thead>
                                <tr class="active">
                                    <th width="25%">Nama</th>
                                    <th width="30%">Judul Proyek/Prospek/Pelatihan</th>
                                    <th width="20%">Kegiatan</th>
                                    <th width="25%">Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rpd->peserta as $peserta)
                                    @foreach($rpd->kegiatan()->where('nik_peserta', $peserta->nik)->get() as $kegiatan)
                                        <tr>
                                            @if ($rpd->kegiatan()->where('nik_peserta', $peserta->nik)->first() == $kegiatan)
                                                <td rowspan="{{ $rpd->kegiatan()->where('nik_peserta', $peserta->nik)->count() }}" style="vertical-align: top;">
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
                                            <td>
                                                @if ($kegiatan->kegiatan == 'UAT')
                                                    UAT
                                                @else
                                                    {{ ucwords(strtolower(str_replace('_', ' ', $kegiatan->kegiatan))) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($kegiatan->deskripsi == '')
                                                    -
                                                @else
                                                    {{ $kegiatan->deskripsi }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>

                       <!--Bagian Action History-->
                        <div class="page-header"><strong>Histori</strong></div>
                        <table class="table table-bordered table-condensed" width="100%">
                            <thead>
                                <tr class="active">
                                    <th width="25%">Tanggal & Waktu</th>
                                    <th width="30%">Nama</th>
                                    <th width="20%">Keterangan</th>
                                    <th width="25%">Komentar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rpd->actionHistory as $action)
                                    @if ($action->action != 'DRAFT')
                                        <tr>
                                            <td>{{ date_format( date_create($action->created_at), 'd/m/Y H:i') }}</td>
                                            <td>{{ $action->pegawai->nama_lengkap }}</td>
                                            <td>{{ ucwords(strtolower($action->action)) }}</td>
                                            <td>{{ $action->comment }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div> <!-- Akhir Bagian Modal detail RPD-->
        @endforeach
@endsection

@section('script')
    @parent

    <script>
    $('[data-toggle-alt="tooltip"]').tooltip();
    </script>
@endsection
