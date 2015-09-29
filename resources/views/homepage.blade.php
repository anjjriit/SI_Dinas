@extends('layouts.master')

@section('page_title','Homepage')

@endsection

@section('stylesheet')
	@parent

@endsection

@section('content')

	<section class="content-header">
		<h1>Homepage</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<h2>Data RPD</h2>
				<h4>Dengan Status Back To Initiator</h4>
				@if($rpds->count() != 0)
				<div class="box box-widget">
					<div class="box-body no-padding">
						<table class="table">
							<thead>
    							<tr>
    								<th>Kode</th>
    								<th>Kota Tujuan</th>
    								<th>Tanggal Mulai</th>
    								<th>Tanggal Selesai</th>
    								<th>Status</th>
    								<th>Action</th>
    							</tr>
    						</thead>
    						<tbody>
    							@foreach ($rpds as $rpd)
		    						<tr>
		    							<td>
		    								{{ $rpd->kode }}
		    							</td>
										<td>
											{{ $rpd->kotaTujuan->nama_kota }}
										</td>
										<td>
											{{ date_format( date_create($rpd->tanggal_mulai), 'd/m/Y') }}
										</td>
										<td>
											{{ date_format( date_create($rpd->tanggal_selesai), 'd/m/Y') }}
										</td>
										<td>
											{{ $rpd->status }}
										</td>
										<td>
											<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#detailRPD-{{ $rpd->id }}">
												<i class="fa fa-fw fa-share"></i>
											</button>
                                            <a href="/rpd/{{ $rpd->id }}/edit" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="fa fa-fw fa-edit"></i></a>
										</td>
		    						</tr>
		    					@endforeach
    						</tbody>
						</table>
					</div>					
				</div><!-- akhir box -->
				@else
    				<div class="alert alert-warning">
                        Data RPD dengan status back to initiator belum tersedia.
                    </div>
    			@endif
			</div> <!-- col 12-->
		</div> <!-- row -->
		<!-- awal data LPD-->
		<div class="row">
			<div class="col-md-12">
				<h2>Data LPD</h2>
				<h4>Yang di Proses</h4>
				@if($lpds->count() != 0)
				<div class="box box-widget">
					<div class="box-body no-padding">
						<table class="table">
							<thead>
    							<tr>
    								<th>No. RPD</th>
                                    <th>No. Laporan</th>
                                    <th>Tanggal Laporan</th>
                                    <th>Total Pengeluaran</th>
                                    <th class="col-md-1">Action</th>
    							</tr>
    						</thead>
    						<tbody>
    							@foreach ($lpds as $lpd)
                                    <tr>
                                        <td>
                                            {{ $lpd->rpd->kode }}
                                        </td>
                                        <td>
                                            {{ $lpd->kode }}
                                        </td>
                                        <td>
                                           <?php
                                                $hari = date_format(date_create($lpd->tanggal_laporan), 'N');
                                                $tanggalLaporan = date_format(date_create($lpd->tanggal_laporan), 'd/m/Y');
                                            ?>

                                            @if ($hari == 1)
                                                {{ $tglLaporan = 'Senin, ' . $tanggalLaporan }}
                                            @elseif ($hari == 2)
                                                {{ $tglLaporan = 'Selasa, ' . $tanggalLaporan }}
                                            @elseif ($hari == 3)
                                                {{ $tglLaporan = 'Rabu, ' . $tanggalLaporan }}
                                            @elseif ($hari == 4)
                                                {{ $tglLaporan = 'Kamis, ' . $tanggalLaporan }}
                                            @elseif ($hari == 5)
                                                {{ $tglLaporan = 'Jum\'at, ' . $tanggalLaporan }}
                                            @elseif ($hari == 6)
                                                {{ $tglLaporan = 'Sabtu, ' . $tanggalLaporan }}
                                            @else
                                                {{ $tglLaporan = 'Minggu, ' . $tanggalLaporan }}
                                            @endif
                                        </td>
                                        <td>
                                            Rp {{ number_format($lpd->total_pengeluaran, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#detailLPD-{{ $lpd->id }}" data-toggle-alt="tooltip" data-placement="top" data-title="Detail">
                                                <i class="fa fa-fw fa-share"></i>
                                            </button>
                                            @if ($lpd->nik == auth()->user()->nik)
                                                {!! Form::open(
                                                    [
                                                        'method' => 'POST',
                                                        'url' => '/lpd/recall/' . $lpd->id,
                                                        'style' => 'display: inline-block;',
                                                        'data-nama' => $lpd->kode,
                                                    ]
                                                ) !!}

                                                    {!! Form::button('<i class="fa fa-fw fa-refresh"></i>', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger delete-button', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'data-title' => 'Recall']
                                                    ) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
    						</tbody>
						</table>
					</div>					
				</div><!-- akhir box -->
				@else
    				<div class="alert alert-warning">
                        Data LPD yang telah diproses belum tersedia.
                    </div>
    			@endif
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
    					<h4 class="modal-title" id="myModalLabel">Rencana Perjalanan Dinas (RPD)</h4>
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
    									<th>Keterangan</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($rpd->actionHistory as $action)
    									<tr>
    										<td>{{ date_format( date_create($action->created_at), 'd/m/Y H:i') }}</td>
    										<td>{{ $action->pegawai->nama_lengkap }}</td>
    										<td>{{ $action->action }}</td>
    										<td>{{ $action->comment }}</td>
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