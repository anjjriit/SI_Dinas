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
						dddd
					</div>
					<div class="box-footer">
						sss
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box box-info">
					<div class="box-header with-border text-center">
						<h3 class="box-title">Proyek dan Pelatihan</h3>
					</div>
					<div class="box-body no-padding">
						
					</div>
					<div class="box-footer">
						sss
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box box-info">
					<div class="box-header with-border text-center">
						<h3 class="box-title">User</h3>
					</div>
					<div class="box-body">
						
					</div>
					<div class="box-footer">
						sss
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
							<table class="table">
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
						<div role="tabpanel" id="data_lpd" class="tab-pane" style="position : relative">
							aa
						</div>
					</div>
				</div>
			</div>			
		</div>
	</section>

@endsection

@section('script')
	@parent

@endsection
