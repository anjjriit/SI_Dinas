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

        <section class="content-header">
            <h1>Logs Rencana Perjalanan Dinas</h1>
        </section>

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
                        <table class="table table-plain table-responsive">
                            <tbody>
                                <tr>
                                    <td class="col-md-3">Kode RPD</td>
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
                                    @if($dataKategori == "Trip")
                                        <td class="col-md-3">Tanggal Mulai</td>
                                    @else
                                        <td class="col-md-3">Tanggal </td>
                                    @endif
                                    <td>{{ date_format( date_create($rpd->tanggal_mulai), 'd/m/Y') }}</td>
                                </tr>
                                @if($dataKategori == "Trip")
                                    <tr>
                                        <td class="col-md-3">Tanggal Selesai</td>
                                        <td>
                                            {{ date_format( date_create($rpd->tanggal_selesai), 'd/m/Y') }}
                                        </td>
                                    </tr>
                                @endif
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
                                    <td class="col-md-3">Sarana Transportasi</td>
                                    <td>
                                        <ul class="list-unstyled">
                                            @foreach($rpd->saranaTransportasi as $saranaTransportasi)
                                                <li>{{ $saranaTransportasi->nama_transportasi }}</li>
                                            @endforeach
                                        </ul>
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
                                    <td style="text-transform : uppercase;">{{ $rpd->status }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Daftar Peserta RPD-->
                        <br>
                        <h4>Peserta dan Tujuan Kegiatan</h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Judul Project/Prospek/Pelatihan</th>
                                    <th>Kegiatan</th>
                                    <th>Deskripsi</th>
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
                                                    'UAT'
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

                        <!--Bagian Komentar atau Keterangan-->
                        <br>
                        <h4>Komentar</h4>
                        <p>
                            {{ $rpd->keterangan }}
                        </p>

                        <!--Bagian Action History-->
                        <br>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div> <!-- Akhir Bagian Modal detail RPD-->
        @endforeach


@endsection
