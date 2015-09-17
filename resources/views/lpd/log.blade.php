@extends('layouts.master')

@section('page_title', 'Logs LPD')

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
            <h1>Logs Laporan Perjalanan Dinas</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if ($lpdLogs->count() != 0)
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
                                        @foreach ($lpdLogs as $lpdLog)
                                            <tr>
                                                <td>
                                                    {{ $lpdLog->kode }}
                                                </td>
                                                <td>
                                                    {{ date_format( date_create($lpdLog->updated_at), 'd/m/Y H:i:s' ) }}
                                                </td>
                                                <td>
                                                    {{ $lpdLog->status }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#detailLPD-{{ $lpdLog->id }}">
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
                            Logs LPD belum tersedia.
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Bagian Modal Detail LPD -->
        @foreach($lpdLogs as $lpd)
            <div class="modal fade" id="detailLPD-{{ $lpdLog->id }}" tabindex="-1" role="dialog" aria-labelledby="detailLPDLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Laporan Perjalanan Dinas (LPD)</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Info Detail LPD -->
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th class="col-md-4">Penanggung Jawab Akomodasi</th>
                                        <th>Tanggal Laporan</th>
                                    </tr>
                                    <tr>
                                        <td>Nama Penanggung Jawab</td>
                                        <td>Jumat, 25/09/2015</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th class="col-md-4">Personel</th>
                                        <th>Proyek / Keperluan Lainnya</th>
                                    </tr>
                                    <tr>
                                        <td>Nama Personel</td>
                                        <td>Pelatihan Blog untuk Anak</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th class="col-md-4">Akomodasi Awal</th>
                                        <td>Rp 1.000.000</td>
                                    </tr>
                                    <tr>
                                        <th>Total Pengeluaran</th>
                                        <td>Rp 800.000</td>
                                    </tr>
                                    <tr>
                                        <th>Pengembalian (Reimburse)</th>
                                        <td>Rp 200.000</td>
                                    </tr>
                                </tbody>
                            </table>
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
                                        <td colspan="6" align="center">Total</td>
                                        <td>Rp 10.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

@endsection