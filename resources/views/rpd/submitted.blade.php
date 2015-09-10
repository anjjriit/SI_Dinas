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
        <label>Yang telah disubmit</label>
    </section>

    <section class="content">
    	<div class="row">
    		<!--Bagian box tabel-->
    		<div class="col-md-12">
    			@if ($submittedRpds->count() != 0)
	    			<div class="box box-widget">
	    				<div class="box-body no-padding">
	    					<table class="table">
	    						<thead>
	    							<tr>
	    								<th>Kode</th>
	    								<th>Kota Tujuan</th>
	    								<th>Tanggal Mulai</th>
	    								<th>Tanggal Selesai</th>
	    								<th>Action</th>
	    							</tr>
	    						</thead>
	    						<tbody>
	    							@foreach ($submittedRpds as $rpd)
			    						<tr>
			    							<td>
			    								{{ $rpd->id }}
			    							</td>
											<td>
												{{ $rpd->kotaTujuan->nama_kota }}
											</td>
											<td>
												{{ $rpd->tanggal_mulai }}
											</td>
											<td>
												{{ $rpd->tanggal_selesai }}
											</td>
											<td>
												<form><input type="hidden" value="{{ $rpd->pegawai->nama_lengkap }}"></form>
												<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#detailRPD-{{ $rpd->id }}">
													<i class="fa fa-fw fa-share"></i>Detail
												</button>
											</td>
			    						</tr>
			    					@endforeach
	    						</tbody>
	    					</table>
	    				</div>
	    			</div><!-- Akhir Bagian Box Table-->
    			@else
    				<div class="alert alert-warning">
                        Data RPD yang telah disubmit belum tersedia.
                    </div>
    			@endif


    		</div>
    	</div>
    </section>

    
    <!-- Bagian Modal Detail RPD-->
    @foreach ($submittedRpds as $rpd)
	<div class="modal fade" id="detailRPD-{{ $rpd->id }}" tabindex="-1" role="dialog" aria-labelledby="detailRPDLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h1 class="modal-title" id="myModalLabel">Rencana Perjalanan Dinas (RPD)</h1>
				</div>
				<div class="modal-body">
					<div>
						<!-- Info basic dari RPD -->
                        <table class="table table-modal table-responsive">
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
                                    <td>{{ $rpd->kategori }}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Jenis</th>
                                    <td>{{ $rpd->jenis_perjalanan }}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Tanggal Mulai</th>
                                    <td>{{ $rpd->tanggal_mulai }}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Tanggal Selesai</th>
                                    <td>{{ $rpd->tanggal_selesai }}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-4">Jumlah Hari Dinas</th>
                                    <td></td>
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
                                    <td>{{ $rpd->sarana_penginapan }}</td>
                                </tr>
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
								</tr>
							</thead>
							<tbody>
							{{ dd($rpd->peserta) }}
								
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
								<tr>
									<td>2015/09/09</td>
									<td>Reynaldi Sunaryo</td>
									<td>Submitted</td>
								</tr>
								<tr>
									<td>2015/09/10</td>
									<td>Ananda</td>
									<td>Approve</td>
								</tr>
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

	// <script type="text/javascript">
	// 	$('#detailRPD').on('show.bs.modal', function (event) {
	// 		var button = $(event.relatedTarget) // Button that triggered the modal
	// 		var rpd = button.data('whatever') // Extract info from data-* attributes

	// 		//var hari_dinas = (rpd['tanggal_selesai']-rpd['tanggal_mulai']);

	// 		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	// 		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

	// 		var modal = $(this)
	// 		modal.find('.id_rpd').text( rpd['id'] );
	// 		modal.find('.kategori_rpd').text( rpd['kategori'] );
	// 		modal.find('.jenis_rpd').text( rpd['jenis_perjalanan'] );
	// 		modal.find('.mulai_rpd').text( rpd['tanggal_mulai'] );
	// 		modal.find('.selesai_rpd').text( rpd['tanggal_selesai'] );
	// 		modal.find('.sarana_rpd').text( rpd['sarana_penginapan'] );
	// 		modal.find('.status_rpd').text( rpd['status'] );
	// 		modal.find('.komentar_rpd').text( rpd['keterangan'] );
	// 		//modal.find('.tujuan_kota').text( rpd['kotaTujuan']['nama_kota'] );
	// 		modal.find('.pj_rpd').text( rpd['pegawai']['nama_lengkap'] );
	// 		//modal.find('.hari_dinas').text( hari_dinas );
	// 	})
	// </script>

@endsection
