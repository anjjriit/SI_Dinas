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
						<input type="text" class="knob" value="{{ $prospeks->count() }}" data-skin="tron"  data-thickness="0.2" data-width="120" data-height="120" data-fgColor="#3c8dbc" data-readonly="true" />
	                    <div class="knob-label"> prospek </div>
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
						<input type="text" class="knob" value="80" data-skin="tron"  data-thickness="0.2" data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true" />
	                    <div class="knob-label">proyek</div>
	                    <input type="text" class="knob" value="80" data-skin="tron"  data-thickness="0.2" data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true" />
	                    <div class="knob-label">pelatihan</div>
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
						<input type="text" class="knob" value="80" data-skin="tron"  data-thickness="0.2" data-width="120" data-height="120" data-fgColor="#3c8dbc" data-readonly="true" />
	                    <div class="knob-label">user</div>                    
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

@endsection

@section('script')
	@parent

	<script type="text/javascript" src="/vendor/jquery/jquery.knob.js"></script>

	<script type="text/javascript">
		$(function () {
	        /* jQueryKnob */

	        $(".knob").knob({
	          /*change : function (value) {
	           //console.log("change : " + value);
	           },
	           release : function (value) {
	           console.log("release : " + value);
	           },
	           cancel : function () {
	           console.log("cancel : " + this.value);
	           },*/
	          draw: function () {

	            // "tron" case
	            if (this.$.data('skin') == 'tron') {

	              var a = this.angle(this.cv)  // Angle
	                      , sa = this.startAngle          // Previous start angle
	                      , sat = this.startAngle         // Start angle
	                      , ea                            // Previous end angle
	                      , eat = sat + a                 // End angle
	                      , r = true;

	              this.g.lineWidth = this.lineWidth;

	              this.o.cursor
	                      && (sat = eat - 0.3)
	                      && (eat = eat + 0.3);

	              if (this.o.displayPrevious) {
	                ea = this.startAngle + this.angle(this.value);
	                this.o.cursor
	                        && (sa = ea - 0.3)
	                        && (ea = ea + 0.3);
	                this.g.beginPath();
	                this.g.strokeStyle = this.previousColor;
	                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
	                this.g.stroke();
	              }

	              this.g.beginPath();
	              this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
	              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
	              this.g.stroke();

	              this.g.lineWidth = 2;
	              this.g.beginPath();
	              this.g.strokeStyle = this.o.fgColor;
	              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
	              this.g.stroke();

	              return false;
	            }
	          }
	        });
	        /* END JQUERY KNOB */

        });
	</script>

@endsection
