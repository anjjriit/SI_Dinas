@extends('layouts.master')

@section('page_title', 'Dashboard')

@endsection

@section('stylesheet')
	@parent

@endsection

@section('content')

	<section class="content-header">
		<h1>Dashboard</h1>		
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-4">
				<div class="box box-info">
					<div class="box-header with-border text-center">
						<h3 class="box-title">Prospek</h3>
					</div>
					<div class="box-body">
						
	                    <h1><font style="font-size: 100px;">{{ $prospeks->count() }}</font> prospek</h1>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box box-info">
					<div class="box-header with-border text-center">
						<h3 class="box-title">Proyek dan Pelatihan</h3>
					</div>
					<div class="box-body">
						<h1><font style="font-size: 100px;">{{ $projects->count() }}</font> project</h1>
	                    <h1>pelatihan <font style="font-size: 100px;">{{ $pelatihans->count() }}</font></h1>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box box-info">
					<div class="box-header with-border text-center">
						<h3 class="box-title">User</h3>
					</div>
					<div class="box-body">
						<h1><font style="font-size: 100px;">{{ $users->count() }}</font> user</h1>                  
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div role="tabpanel" class="nav-tabs-custom" style="cursor: move">
					<ul class="nav nav-tabs ui-sortable-handle" role="tablist">
						<li class="active" role="presentation">
							<a href="#data_rpd" data-toggle="tab" aria-controls="data-rpd" role="tab">RPD</a>
						</li>
						<li role="presentation">
							<a href="#data_lpd" data-toggle="tab" aria-controls="data-lpd" role="tab">LPD</a>
						</li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" id="data_rpd" class="tab-pane active" style="position : relative">
							<h3 class="text-center">Data Rencana Perjalanan Dinas</h3>
							<table class="table table-bordered">
	    						<thead>
	    							<tr>
	    								<th>Kode</th>
	    								<th>Kota Tujuan</th>
	    								<th>Tanggal Selesai</th>
	    								<th>Penanggung Jawab</th>
	    								<th>Action</th>
	    							</tr>
	    						</thead>
	    						<tbody>
	    							@foreach($rpds as $rpd)
	    							<tr>
	    								<td>{{ $rpd->kode }}</td>
	    								<td>{{ $rpd->kotaTujuan->nama_kota }}</td>
	    								<td>{{ date_format( date_create($rpd->tanggal_mulai), 'd/m/Y') }}</td>
	    								<td>{{ $rpd->pegawai->nama_lengkap }}</td>
	    								<td>
	    									<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#detailRPD-{{ $rpd->id }}">
												<i class="fa fa-fw fa-share"></i>Detail
											</button>
	    							</tr>
	    							@endforeach
	    						</tbody>
	    					</table>
						</div>
						<div role="tabpanel" id="data_lpd" class="tab-pane" style="position : relative">
							<h3 class="text-center">Data Laporan Perjalanan Dinas</h3>
							<table class="table table-bordered">
	    						<thead>
	    							<tr>
	    								<th>Kode</th>
	    								<th>Kota Tujuan</th>
	    								<th>Tanggal Selesai</th>
	    								<th>Penanggung Jawab</th>
	    								<th>Action</th>
	    							</tr>
	    						</thead>
	    						<tbody>
	    							<tr>
	    								<td>1</td>
	    								<td>Semarang</td>
	    								<td>2015-08-09</td>
	    								<td>Super Admin</td>
	    								<td>
	    									<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#detailRPD" >
												<i class="fa fa-fw fa-share"></i>Detail
											</button>
	    								</td>
	    							</tr>
	    						</tbody>
	    					</table>
						</div>
					</div>
				</div>
			</div>			
		</div>

	</section>

	<!-- Bagian Modal Detail RPD-->
    @foreach ($rpds as $rpd)
    	<div class="modal fade" id="detailRPD-{{ $rpd->id }}" tabindex="-1" role="dialog" aria-labelledby="detailRPDLabel">
    		<div class="modal-dialog modal-lg" role="document">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    					<h1 class="modal-title" id="myModalLabel">Rencana Perjalanan Dinas (RPD)</h1>
    				</div>
    				<div class="modal-body">
    						<!-- Info basic dari RPD -->
                            <table class="table table-modal table-responsive table-condensed">
                                <tbody>
                                    <tr>
                                        <th class="col-md-4">Kode RPD</th>
                                        <td>{{ $rpd->kode }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-4">Penanggung Jawab</th>
                                        <td>{{ $rpd->pegawai->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-4">Kategori</th>
                                        <td>{{ $dataKategori = ucwords(str_replace('_', ' ', $rpd->kategori)) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-4">Jenis</th>
                                        <td>{{ ucwords(str_replace('_', ' ', $rpd->jenis_perjalanan)) }}</td>
                                    </tr>
                                    <tr>
                                        @if($dataKategori == "Trip")
    	                                    <th class="col-md-4">Tanggal Mulai</th>
                                        @else
    	                                    <th class="col-md-4">Tanggal </th>
                                        @endif
                                        <td>{{ date_format( date_create($rpd->tanggal_mulai), 'd/m/Y') }}</td>
                                    </tr>
                                    @if($dataKategori == "Trip")
    	                                <tr>
    	                                    <th class="col-md-4">Tanggal Selesai</th>
    	                                    <td>
    											{{ date_format( date_create($rpd->tanggal_selesai), 'd/m/Y') }}
    	                                    </td>
    	                                </tr>
    	                            @endif
                                    <tr>
                                        <th class="col-md-4">Jumlah Hari Dinas</th>
                                        <td>
                                        	{{ $rpd->lama_hari }} hari
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-4">Asal Kota</th>
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
                                        <th class="col-md-4">Status</th>
                                        <td style="text-transform : uppercase;">{{ $rpd->status }}</td>
                                    </tr>
                                </tbody>
                            </table>

    						<!-- Daftar Peserta RPD-->
    						<h3>Peserta dan Tujuan Kegiatan</h3>
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
    						<h3>Action History</h3>
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
    	                                <a href="/rpd/{{ $rpd->id }}/edit" class="btn btn-default"><i class="fa fa-fw fa-edit"></i> Edit</a>
    	                                <a href="/rpd/{{ $rpd->id }}/approval" class="btn btn-success"><i class="fa fa-fw fa-check-square-o"></i> Approval</a>
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

@section('script')
	@parent

@endsection
