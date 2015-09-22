@extends('layouts.master')

@section('page_title', 'Approval RPD')

@section('content')

        <section class="content-header">
            <h1>Rencana Perjalanan Dinas</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Approval RPD</h4>
                        </div>
                        {!! Form::open(['method' => 'POST', 'url' => '/rpd/' . $rpd->id . '/approval']) !!}
                            <div class="box-body">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                                            <br>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#detailRPD">
                                            <i class="fa fa-fw fa-share"></i> Detail RPD
                                        </button>
                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('status', 'Status') !!}
                                            {!! Form::select(
                                                'status',
                                                [
                                                    'APPROVED' => 'Approve',
                                                    'DECLINE' => 'Decline',
                                                    'BACK TO INITIATOR' => 'Back To Initiator'
                                                ],
                                                null,
                                                ['class' => 'form-control', 'autofocus']
                                            ) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('comment', 'Komentar') !!}
                                            {!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                {!! Form::button('<i class="fa fa-fw fa-check"></i> Submit', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="detailRPD" tabindex="-1" role="dialog" aria-labelledby="detailRPDLabel">
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
                                    <td class="col-md-4">Kategori</td>
                                    <td>{{ $dataKategori = ucwords(str_replace('_', ' ', $rpd->kategori)) }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-4">Jenis</td>
                                    <td>{{ ucwords(str_replace('_', ' ', $rpd->jenis_perjalanan)) }}</td>
                                </tr>
                                <tr>
                                    @if($dataKategori == "Trip")
                                        <td class="col-md-4">Tanggal Mulai</td>
                                    @else
                                        <td class="col-md-4">Tanggal </td>
                                    @endif
                                    <td>{{ date_format( date_create($rpd->tanggal_mulai), 'd/m/Y') }}</td>
                                </tr>
                                @if($dataKategori == "Trip")
                                    <tr>
                                        <td class="col-md-4">Tanggal Selesai</td>
                                        <td>
                                            {{ date_format( date_create($rpd->tanggal_selesai), 'd/m/Y') }}
                                        </td>
                                    </tr>
                                @endif
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
                                        <ul class="list-unstyled">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>

@endsection
