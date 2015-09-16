@extends('layouts.master')

@section('page_title', 'Logs RPD')

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

        <div class="content-header">
            <h1>Logs Rencana Perjalanan Dinas</h1>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if ($rpdLogs->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Terakhir Diperbarui</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rpdLogs as $rpdLog)
                                            <tr>
                                                <td>
                                                    {{ $rpdLog->kode }}
                                                </td>
                                                <td>
                                                    {{ date_format( date_create($rpdLog->updated_at), 'd/m/Y H:i:s' ) }}
                                                </td>
                                                <td>
                                                    {{ $rpdLog->status }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#detailRPD-{{ $rpdLog->id }}">
                                                        <i class="fa fa-fw fa-share"></i>Detail
                                                    </button>
                                                    @if ($rpdLog->status == 'BACK TO INITIATOR')
                                                        <a href="/rpd/{{ $rpdLog->id }}/edit" class="btn btn-default"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                            Logs RPD belum tersedia.
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
                    <h4 class="modal-title" id="myModalLabel">Rencana Perjalanan Dinas (RPD)</h4>
                </div>
                <div class="modal-body">
                    <!-- Info basic dari RPD -->
                    <table class="table table-modal table-responsive table-condensed">
                        <tbody>
                            <tr>
                                <td class="col-md-4"><strong>Kode RPD</strong></td>
                                <td>{{ $rpd->kode }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4"><strong>Penanggung Jawab</strong></td>
                                <td>{{ $rpd->pegawai->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4"><strong>Kategori</strong></td>
                                <td>{{ ucwords(str_replace('_', ' ', $rpd->kategori)) }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4"><strong>Jenis</strong></td>
                                <td>{{ ucwords(str_replace('_', ' ', $rpd->jenis_perjalanan)) }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4"><strong>Tanggal Mulai</strong></td>
                                <td>{{ date_format( date_create($rpd->tanggal_mulai), 'd/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4"><strong>Tanggal Selesai</strong></td>
                                <td>{{ date_format( date_create($rpd->tanggal_selesai), 'd/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4"><strong>Jumlah Hari Dinas</strong></td>
                                <td>
                                    {{ $rpd->lama_hari }} hari
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-4"><strong>Asal Kota</strong></td>
                                <td>{{ $rpd->kotaAsal->nama_kota }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4"><strong>Tujuan Kota</strong></td>
                                <td>{{ $rpd->kotaTujuan->nama_kota }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4"><strong>Sarana Transportasi</strong></td>
                                <td>
                                    <ul style="margin-top: 10px;">
                                        @foreach($rpd->saranaTransportasi as $saranaTransportasi)
                                            <li>{{ $saranaTransportasi->nama_transportasi }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-4"><strong>Sarana Penginapan</strong></td>
                                <td>{{ $rpd->saranaPenginapan->nama_penginapan }}</td>
                            </tr>
                            @if ($rpd->status == 'APPROVED' || auth()->user()->role == 'administration')
                                <tr>
                                    <td class="col-md-4"><strong>Akomodasi Awal</strong></td>
                                    <td>Rp {{ number_format($rpd->akomodasi_awal, 2, ',', '.') }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="col-md-4"><strong>Status</strong></td>
                                <td style="text-transform : uppercase;">{{ $rpd->status }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <!-- Daftar Peserta RPD-->
                    <h4>Peserta dan Tujuan Kegiatan</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Judul Project/Prospek/Pelatihan</th>
                                <th>Kegiatan</th>
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
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <!--Bagian Komentar atau Keterangan-->
                    <h4>Komentar</h4>
                    <p>
                        {{ $rpd->keterangan }}
                    </p>
                    <br>
                    <!--Bagian Action History-->
                    <h4>Action History</h4>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date Time</th>
                                <th>Nama</th>
                                <th>Action Taken</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rpd->actionHistory as $action)
                                <tr>
                                    <td>{{ date_format( date_create($action->created_at), 'd/m/Y H:i') }}</td>
                                    <td>{{ $action->pegawai->nama_lengkap }}</td>
                                    <td>{{ $action->action }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (auth()->user()->role == 'administration')
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="/administrasi/rpd/{{ $rpd->id }}/edit" class="btn btn-default"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                <a href="/administrasi/rpd/{{ $rpd->id }}/approval" class="btn btn-success"><i class="fa fa-fw fa-check-square-o"></i> Approval</a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Close</button>
                </div>
            </div>
        </div>
    </div> <!-- Akhir Bagian Modal detail RPD-->
    @endforeach


@endsection
