@extends('layouts.master')

@section('page_title', 'Home')

@section('stylesheet')
	@parent

@endsection

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
        <h1>Data Rencana Perjalanan Dinas</h1>
        <label>Yang telah diapprove</label>
    </section>

    <section class="content">
    	<div class="row">
    		<!--Bagian box tabel-->
    		<div class="col-md-12">
                @if ($approvedRpds->count() != 0)
        			<div class="box box-widget">
        				<div class="box-body no-padding">
        					<table class="table">
        						<thead>
        							<tr>
        								<th>Kode</th>
        								<th>Kategori</th>
        								<th>Kota Tujuan</th>
        								<th>Tanggal Mulai</th>
        								<th>Tanggal Selesai</th>
        								<th colspan="2">Action</th>
        							</tr>
        						</thead>
        						<tbody>
        							@foreach($approvedRpds as $rpd)
    		    						<tr>
    		    							<td>{{ $rpd->kode }}</td>
    		    							<td>{{ $dataKategori = ucwords(str_replace('_', ' ', $rpd->kategori)) }}</td>
    										<td>{{ $rpd->kotaTujuan->nama_kota }}</td>
    										<td>{{ $rpd->tanggal_mulai }}</td>
    										<td>
    											@if($dataKategori == "Trip")
    												{{ $rpd->tanggal_selesai }}
    											@else
    												-
    											@endif
    										</td>
    										<td>
    											<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#detailRPD-{{ $rpd->id }}">
    												<i class="fa fa-fw fa-share"></i>Detail
    											</button>
    											<a href="/lpd/create?rpdId={{ $rpd->id }}" class="btn btn-sm btn-primary"> Create LPD</a>
    										</td>
    		    						</tr>
    	    						@endforeach
        						</tbody>
        					</table>
        				</div>
                    @else
                        <div class="alert alert-warning">
                            Anda belum memiliki list RPD yang telah diapproved.
                        </div>
                    @endif    				
    			</div>
    		</div><!-- Akhir Bagian Box Table-->
    	</div>
    </section>

    <!-- Bagian Modal Detail RPD-->
    @foreach ($approvedRpds as $rpd)
	<div class="modal fade" id="detailRPD-{{ $rpd->id }}" tabindex="-1" role="dialog" aria-labelledby="detailRPDLabel">
		<div class="modal-dialog modal-lg"  role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Rencana Perjalanan Dinas (RPD)</h4>
				</div>
				<div class="modal-body">
					<div>
						<!-- Info basic dari RPD -->
                        <table class="table table-modal table-responsive table-condensed">
                            <tbody>
                                <tr>
                                    <th class="col-md-4">ID</th>
                                    <td>{{ $rpd->id }}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Penanggung Jawab</th>
                                    <td>{{ $rpd->pegawai->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Kategori</th>
                                    <td>{{ $dataKategori = str_replace('_', ' ', $rpd->kategori) }}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Jenis</th>
                                    <td>{{ $dataJenis = str_replace('_', ' ', $rpd->jenis_perjalanan) }}</td>
                                </tr>
                                <tr>
                                	@if($dataKategori == "Trip")
	                                    <th class="col-md-4">Tanggal Mulai</th>
                                    @else
	                                    <th class="col-md-4">Tanggal </th>
                                    @endif
                                    <td>{{ $rpd->tanggal_mulai }}</td>
                                </tr>
	                            @if($dataKategori == "Trip")
	                                <tr>
	                                    <th class="col-md-4">Tanggal Selesai</th>
	                                    <td>
											{{ $rpd->tanggal_selesai }}
	                                    </td>
	                                </tr>
	                            @endif
	                            <tr>
                                    <th class="col-md-4">Jumlah Hari Dinas</th>
                                    <td>
                                    	{{ 
                                    		$rpd->lama_hari
										}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Asal Kota</th>
                                    <td>{{ $rpd->kotaAsal->nama_kota }}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Tujuan Kota</th>
                                    <td>{{ $rpd->kotaTujuan->nama_kota }}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Sarana Transportasi</th>
                                    <td>
                                    	<ul>
                                    		@foreach($rpd->saranaTransportasi as $saranaTransportasi)
	                                    		<li>{{ $saranaTransportasi->nama_transportasi }}</li> 
	                                    	@endforeach
	                                    </ul>
                                    </td>                                    	
                                </tr>
                                <tr>
                                    <th class="col-md-4">Sarana Penginapan</th>
                                    <td>{{ $rpd->saranaPenginapan->nama_penginapan }}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Status</th>
                                    <td style="text-transform : uppercase;">{{ $rpd->status }}</td>
                                </tr>
                            </tbody>
                        </table>

						<!-- Daftar Peserta RPD-->
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
						<h4>Komentar</h4>
						<p>
							{{ $rpd->keterangan }}
						</p>

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
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div> <!-- Akhir Bagian Modal detail RPD-->
	@endforeach

@endsection

@section('script')
	@parent

@endsection