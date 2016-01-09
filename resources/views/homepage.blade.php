@extends('layouts.master')

@section('page_title','Halaman Utama')

@endsection

@section('stylesheet')
	@parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

	<section class="content-header">
		<p>Halaman Utama</p>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><b>Rencana Perjalanan Dinas</b></p>
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
    								<th>Aksi</th>
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
											<button type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#detailRPD-{{ $rpd->id }}" data-toggle-alt="tooltip" data-placement="top" data-title="Detail">
                                                <i class="fa fa-fw fa-share"></i>
											</button>
                                            @if($rpd->status != 'SUBMIT' || auth()->user()->role == 'administration')
                                            <a href="/rpd/{{ $rpd->id }}/edit" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-title="Ubah"><i class="fa fa-fw fa-edit"></i></a>
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
                        Data RPD dengan status back to initiator tidak tersedia.
                    </div>
    			@endif

    			{!! $rpds->render() !!}
			</div> <!-- col 12-->
		</div> <!-- row -->
		<!-- awal data LPD-->
		<div class="row">
			<div class="col-md-12">
				<p><b>Laporan Perjalanan Dinas</b></p>
				@if($lpds->count() != 0)
				<div class="box box-widget">
					<div class="box-body no-padding">
						<table class="table">
							<thead>
    							<tr>
    								<th>No. RPD</th>
                                    <th>No. LPD</th>
                                    <th>Tanggal Laporan</th>
                                    <th>Total Pengeluaran</th>
                                    <th class="col-md-1">Aksi</th>
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
                                                        'url' => 'lpd/recall/' . $lpd->id,
                                                        'style' => 'display: inline-block;',
                                                        'data-nama' => $lpd->kode,
                                                    ]
                                                ) !!}

                                                    {!! Form::button('<i class="fa fa-fw fa-refresh"></i>', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger delete-button', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'data-title' => 'Tarik Kembali']
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

    			{!! $lpds->render() !!}
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
						<div class="page-header"><strong>Peserta &amp; Tujuan Kegiatan</strong></div>
                        <table class="table table-bordered table-condensed" width="100%">
                            <thead>
                                <tr class="active">
                                    <th width="25%">Nama</th>
                                    <th width="30%">Judul Proyek/Prospek/Pelatihan</th>
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

						<!--Bagian Action History-->
						<div class="page-header"><strong>Histori</strong></div>
                        <table class="table table-bordered table-condensed" width="100%">
                            <thead>
                                <tr class="active">
                                    <th width="25%">Tanggal & Waktu</th>
                                    <th width="30%">Nama</th>
                                    <th width="20%">Keterangan</th>
                                    <th width="25%">Komentar</th>
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
	                                <a href="/rpd/{{ $rpd->id }}/edit" class="btn btn-default"><i class="fa fa-fw fa-edit"></i> Ubah</a>
	                                <a href="/rpd/{{ $rpd->id }}/approval" class="btn btn-success"><i class="fa fa-fw fa-check-square-o"></i> Setujui</a>
	                            </div>
	                        </div>
	                    @endif
    				</div>
    				<div class="modal-footer">
    					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Tutup</button>
    				</div>
    			</div>
    		</div>
    	</div> <!-- Akhir Bagian Modal detail RPD-->
	@endforeach

	<!-- Detail LPD-->
    @foreach( $lpds as $lpd )
        <div class="modal fade" id="detailLPD-{{ $lpd->id }}" tabindex="-1" role="dialog" aria-labelledby="detailLPDLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Laporan Perjalanan Dinas (LPD)</h4>
                    </div>
                    <div class="modal-body">
                        <div class="content">
                            <div class="row">
                                <div class="col-md-8 table-responsive">
                                    <table class="table table-bordered table-condensed">
                                        <thead>
                                            <tr class="active">
                                                <th class="col-md-6">Penanggung Jawab Akomodasi</th>
                                                <th class="col-md-6">Tanggal Laporan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $lpd->pegawai->nama_lengkap }}</td>
                                                <td>
                                                    {{ date_format(date_create($lpd->tanggal_laporan), 'd/m/Y') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 table-responsive">
                                    <table class="table table-bordered table-condensed">
                                        <thead>
                                            <tr class="active">
                                                <th class="col-md-6">Personil</th>
                                                <th class="col-md-6">Proyek / Keperluan Lainnya</th>
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
                                <div class="col-md-8 table-responsive">
                                    <table class="table table-bordered table-condensed">
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
                                                <td class="active"><strong>Pengembalian (Reimburse)</strong></td>
                                                <td class="text-right">Rp {{ number_format($lpd->rpd->akomodasi_awal - $lpd->pengeluaran->sum('biaya'), 0, ',', '.') }}</td>
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
                                        <th>Personil</th>
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
                                                @foreach ($pengeluaran->personel as $personel)
                                                    {{ $personel->nama_lengkap }}@if ($personel != $pengeluaran->personel[$pengeluaran->personel->count() - 1]), @endif
                                                @endforeach
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

                            <div class="page-header">Histori</div>
                            <table class="table table-bordered table-condensed" width="100%">
                                <thead>
                                    <tr class="active">
                                        <th width="25%">Tanggal & Waktu</th>
                                        <th width="30%">Nama</th>
                                        <th width="20%">Keterangan</th>
                                        <th width="25%">Komentar</th>
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
                                        <a href="/lpd/{{ $lpd->id }}/approval" class="btn btn-success"><i class="fa fa-fw fa-check-square-o"></i> Setujui</a>
                                    </div>
                                </div>
                            @endif
                        @elseif (auth()->user()->role == 'administration')
                            @if ($lpd->status == 'PROCESS PAYMENT' || $lpd->status == 'TAKE PAYMENT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="/lpd/{{ $lpd->id }}/approval" class="btn btn-success"><i class="fa fa-fw fa-check-square-o"></i> Setujui</a>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div>
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
                title: '<i class="fa fa-refresh"></i> Tarik Kembali LPD',
                content: 'Apakah Anda yakin akan menarik kembali LPD dengan kode <strong>' + nama + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-default',
                cancelButton: 'Tidak',
                confirmButton: 'Ya',
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

        $('[data-toggle-alt="tooltip"]').tooltip();
    </script>

@endsection
