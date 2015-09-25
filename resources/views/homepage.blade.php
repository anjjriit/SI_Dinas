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
				<h4>Data RPD</h4>
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
		    								{{ $data = ucwords(str_replace('_', ' ', $rpd->kategori)) }}
		    							</td>
		    							@if(auth()->user()->role == 'administration')
                                            <td>
                                                {{ $rpd->pegawai->nama_lengkap }}
                                            </td>
                                        @endif
										<td>
											{{ $rpd->kotaTujuan->nama_kota }}
										</td>
										<td>
											{{ date_format( date_create($rpd->tanggal_mulai), 'd/m/Y') }}
										</td>
										<td>
											@if($data == "Trip")
												{{ date_format( date_create($rpd->tanggal_selesai), 'd/m/Y') }}
											@else
												-
											@endif
										</td>
										<td>
											<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#detailRPD-{{ $rpd->id }}">
												<i class="fa fa-fw fa-share"></i>Detail
											</button>
										</td>
		    						</tr>
		    					@endforeach
    						</tbody>
						</table>
					</div>					
				</div><!-- akhir box -->
			</div>
		</div>
		<!--<div class="row">
			<div class="col-md-12">
				<h2>Data LPD</h2>
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
		    								{{ $data = ucwords(str_replace('_', ' ', $rpd->kategori)) }}
		    							</td>
		    							@if(auth()->user()->role == 'administration')
                                            <td>
                                                {{ $rpd->pegawai->nama_lengkap }}
                                            </td>
                                        @endif
										<td>
											{{ $rpd->kotaTujuan->nama_kota }}
										</td>
										<td>
											{{ date_format( date_create($rpd->tanggal_mulai), 'd/m/Y') }}
										</td>
										<td>
											@if($data == "Trip")
												{{ date_format( date_create($rpd->tanggal_selesai), 'd/m/Y') }}
											@else
												-
											@endif
										</td>
										<td>
											<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#detailRPD-{{ $rpd->id }}">
												<i class="fa fa-fw fa-share"></i>Detail
											</button>
										</td>
		    						</tr>
		    					@endforeach
    						</tbody>
						</table>
					</div>					
				</div><!- akhir box -->
			</div>
		</div>
		
	</section>
@endsection

@section('script')
	@parent

@endsection