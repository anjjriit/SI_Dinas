@extends('layouts.master')

@section('page_title', 'Buat Laporan')

@section('stylesheet')
	@parent

@endsection

@section('content')



	<section class="content-header">
        <p>Buat Laporan</p>
        <span class="bcumb">
            <i class="fa fa-fw fa-bookmark"></i>
            @if (Auth::user()->role == 'super_admin')
                <a href="/dashboard">Dashboard</a>
            @else
                <a href="/homepage">Homepage</a>
            @endif
            <i class="fa fa-angle-right fa-fw"></i> Laporan Perjalanan Dinas
            <i class="fa fa-angle-right fa-fw"></i> Create
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
                @if ($approvedRpds->count() != 0)
        			<div class="box box-widget">
        				<div class="box-body no-padding">
        					<table class="table">
        						<thead>
        							<tr>
        								<th class="col-md-1">No. RPD</th>
        								<th>Kategori</th>
        								<th>Kota Tujuan</th>
        								<th>Tanggal Mulai</th>
        								<th>Tanggal Selesai</th>
        								<th class="col-md-1">Action</th>
        							</tr>
        						</thead>
        						<tbody>
        							@foreach($approvedRpds as $rpd)
                                        @if (!is_null($rpd->lpd))
                                            @if ($rpd->lpd->status == 'SUBMIT')
                                                <?php continue; ?>
                                            @endif
                                        @endif
        		    						<tr>
        		    							<td>{{ $rpd->kode }}</td>
        		    							<td>{{ $dataKategori = ucwords(str_replace('_', ' ', $rpd->kategori)) }}</td>
        										<td>{{ $rpd->kotaTujuan->nama_kota }}</td>
        										<td>{{ date_format( date_create($rpd->tanggal_mulai), 'd/m/Y') }}</td>
        										<td>
        											@if($dataKategori == "Trip")
        												{{ date_format( date_create($rpd->tanggal_selesai), 'd/m/Y') }}
        											@else
        												{{ date_format( date_create($rpd->tanggal_mulai), 'd/m/Y') }}
        											@endif
        										</td>
        										<td>
        											<button type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#detailRPD-{{ $rpd->id }}" data-toggle-alt="tooltip" data-placement="top" data-title="Detail">
        												<i class="fa fa-fw fa-share"></i>
        											</button>

                                                    @if (is_null($rpd->lpd))
        											    <a href="/lpd/create/{{ $rpd->id }}" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" data-title="Buat LPD"><i class="fa fa-fw fa-copy"></i></a>
                                                    @else
                                                        <a href="/lpd/{{ $rpd->lpd->id }}/edit" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-title="Edit LPD"><i class="fa fa-fw fa-edit"></i></a>
                                                    @endif
        										</td>
        		    						</tr>
    	    						@endforeach
        						</tbody>
        					</table>
        				</div>
                    @else
                        <div class="alert alert-warning">
                            Tidak ada laporan yang harus dibuat.
                        </div>
                    @endif
    			</div>
    		</div><!-- Akhir Bagian Box Table-->
    	</div>
    </section>

    <!-- Bagian Modal Detail RPD-->
    @foreach ($approvedRpds as $rpd)
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
                                    <th width="30%">Judul Project/Prospek/Pelatihan</th>
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
                        <div class="page-header"><strong>Action History</strong></div>
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Close</button>
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
