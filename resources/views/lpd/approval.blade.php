@extends('layouts.master')

@section('page_title', 'Approval LPD')

@section('content')

        <section class="content-header">
            <p>Laporan Perjalanan Dinas</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                @if (Auth::user()->role == 'super_admin')
                    <a href="/dashboard">Dashboard</a>
                @else
                    <a href="/homepage">Homepage</a>
                @endif
                <i class="fa fa-angle-right fa-fw"></i> <a href="/lpd/processed">Processed LPD</a>
                <i class="fa fa-angle-right fa-fw"></i> {{ $lpd->kode }}
                <i class="fa fa-angle-right fa-fw"></i> Approval
            </span>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Approval LPD</h4>
                        </div>

                        <hr style="margin-top: 10px;">

                        {!! Form::open(['method' => 'POST', 'url' => '/lpd/' . $lpd->id . '/approval']) !!}
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
                                        <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#detailLPD">
                                            <i class="fa fa-fw fa-share"></i> Detail LPD
                                        </button>
                                    </div>

                                </div>
                                <br>
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
                                @if ($lpd->reimburse)
                                    {!! Form::button('<i class="fa fa-fw fa-check"></i> Paid', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                                @else
                                    {!! Form::button('<i class="fa fa-fw fa-check"></i> Take Payment', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                                @endif
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="detailLPD" tabindex="-1" role="dialog" aria-labelledby="detailLPDLabel">
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
                                                <td class="col-md-6 active"><strong>Akomodasi Awal</strong></td>
                                                <td class="text-right">Rp {{number_format($lpd->rpd->akomodasi_awal, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="active"><strong>Total Pengeluaran</strong></td>
                                                <td class="text-right">Rp {{ number_format($lpd->pengeluaran->sum('biaya'), 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                @if ($lpd->reimburse)
                                                    <td class="active"><strong>Reimburse</strong></td>
                                                    <td align="right">Rp {{ number_format($lpd->pengeluaran->sum('biaya') - $lpd->rpd->akomodasi_awal, 0, ",", ".") }}</td>
                                                @else
                                                    <td class="active"><strong>Pengembalian</strong></td>
                                                    <td align="right">Rp {{ number_format($lpd->rpd->akomodasi_awal - $lpd->pengeluaran->sum('biaya'), 0, ",", ".") }}</td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="page-header">Pengeluaran</div>
                            <table class="table table-condensed table-bordered">
                                <thead>
                                    <tr class="active">
                                        <th>Tanggal</th>
                                        <th>Tipe</th>
                                        <th>Keterangan</th>
                                        <th>Struk</th>
                                        <th>Personel</th>
                                        <th>Biaya</th>
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
                                            <td style="vertical-align: top;">Rp {{ number_format($pengeluaran->biaya, 0, '.', ',' ) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="text-center">Total</td>
                                        <td>Rp {{ number_format($lpd->pengeluaran->sum('biaya'), 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="page-header">Action History</div>
                            <table class="table table-bordered table-condensed" width="100%">
                                <thead>
                                    <tr class="active">
                                        <th width="25%">Date Time</th>
                                        <th width="30%">Nama</th>
                                        <th width="20%">Action Taken</th>
                                        <th width="25%">Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lpd->actionHistory as $action)
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
                        @if (auth()->user()->role == 'finance')
                            @if ($lpd->status == 'SUBMIT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="/lpd/{{ $lpd->id }}/approval" class="btn btn-success"><i class="fa fa-fw fa-check-square-o"></i> Approval</a>
                                    </div>
                                </div>
                            @endif
                        @elseif (auth()->user()->role == 'administration')
                            @if ($lpd->status == 'PROCESS PAYMENT' || $lpd->status == 'TAKE PAYMENT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="/lpd/{{ $lpd->id }}/approval" class="btn btn-success"><i class="fa fa-fw fa-check-square-o"></i> Approval</a>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
@endsection
