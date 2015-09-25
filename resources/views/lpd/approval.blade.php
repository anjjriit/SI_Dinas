@extends('layouts.master')

@section('page_title', 'Approval LPD')

@section('content')

        <section class="content-header">
            <h1>Laporan Perjalanan Dinas</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Approval LPD</h4>
                        </div>
                        {!! Form::open(['method' => 'POST', 'url' => '/lpd/' . $lpd->id . '/approval']) !!}
                            <div class="box-body">
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
                                        <td colspan="6" align="center">Total</td>
                                        <td>Rp 30.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
@endsection
