@extends('layouts.master')

@section('page_title', 'RPD Submitted')

@section('stylesheet')
	@parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

	<section class="content-header">
        <h1>Data Rencana Perjalanan Dinas</h1>
        <label>Yang telah disubmit</label>
    </section>

    <section class="content">
    	<div class="row">
    		<!--Bagian box tabel-->
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

                @if ($submittedRpds->count() != 0)
	    			<div class="box box-widget">
	    				<div class="box-body no-padding">
	    					<table class="table">
	    						<thead>
	    							<tr>
	    								<th>Kode</th>
                                        <th>Pengaju</th>
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
			    								{{ $rpd->kode }}
			    							</td>
                                            <td>
                                                {{ $rpd->pegawai->nama_lengkap }}
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
												<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#detailRPD-{{ $rpd->id }}">
													<i class="fa fa-fw fa-share"></i>Detail
												</button>
                                                @if ($rpd->nik == auth()->user()->nik)
                                                    {!! Form::open(
                                                        [
                                                            'method' => 'POST',
                                                            'url' => '/rpd/recall/' . $rpd->id,
                                                            'style' => 'display: inline-block;',
                                                            'data-nama' => $rpd->kode,
                                                        ]
                                                    ) !!}

                                                        {!! Form::button('<i class="fa fa-fw fa-refresh"></i>Recall', ['type' => 'submit', 'class' => 'btn btn-sm btn-default delete-button']
                                                        ) !!}
                                                    {!! Form::close() !!}
                                                @endif
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

                {!! $submittedRpds->render() !!}
    		</div>
    	</div>
    </section>


    <!-- Bagian Modal Detail RPD-->
    @foreach ($submittedRpds as $rpd)
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
                                <td class="col-md-4"><strong>Kode RPD</strong></td>
                                <td>{{ $rpd->kode }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4"><strong>Penanggung Jawab</strong></td>
                                <td>{{ $rpd->pegawai->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4"><strong>Kategori</strong></td>
                                <td>{{ ucwords(str_replace('_', ' ', $rpd->kategori)) }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4"><strong>Jenis</strong></td>
                                <td>{{ ucwords(str_replace('_', ' ', $rpd->jenis_perjalanan)) }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4"><strong>Tanggal Mulai</strong></td>
                                <td>{{ date_format( date_create($rpd->tanggal_mulai), 'd/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4"><strong>Tanggal Selesai</strong></td>
                                <td>{{ date_format( date_create($rpd->tanggal_selesai), 'd/m/Y') }}</td>
                            </tr>
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
                    @if (auth()->user()->role == 'administration')
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="/administrasi/rpd/{{ $rpd->id }}/edit" class="btn btn-default"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                <a href="/administrasi/rpd/{{ $rpd->id }}/approval" class="btn btn-success"><i class="fa fa-fw fa-check-square-o"></i> Approval</a>
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
    <script src="/vendor/jquery-confirm/js/jquery-confirm.min.js"></script>

    <script>
        $('.delete-button').on('click', function(event) {
            event.preventDefault();

            var element = $(this).parent()

            var nama = element.attr('data-nama')

            $.confirm({
                title: '<i class="fa fa-refresh"></i> Recall RPD',
                content: 'Apakah Anda yakin akan merecall RPD dengan kode <strong>' + nama + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-default',
                cancelButton: 'Tidak',
                confirmButton: 'Ya, Recall',
                animation: 'top',
                animationSpeed: 300,
                animationBounce: 1,

                confirm: function(){
                    return element.submit()
                },
                cancel: function(event){
                    return;
                }
            });
        })

    </script>

@endsection
