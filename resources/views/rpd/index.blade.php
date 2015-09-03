@extends('layouts.master')

@section('page_title', 'Home')

@section('stylesheet')
	@parent

@endsection

@section('content')
	
	<section class="content-header">
        <h1>Data Rencana Perjalanan Dinas</h1>
    </section>

    <section class="content">
    	<div class="row">
    		<div class="col-md-12">
    			<div class="box box-widget">
    				<div class="box-body no-padding">
    					<table class="table">
    						<thead>
    							<tr>
    								<td>Kode</td>
    								<td>Kota Tujuan</td>
    								<td>Tanggal Mulai</td>
    								<td>Tanggal Selesai</td>
    								<td>Status</td>
    								<td>Action</td>
    							</tr>
    						</thead>
    						<tbody>
    							<td>Kode</td>
								<td>Kota Tujuan</td>
								<td>Tanggal Mulai</td>
								<td>Tanggal Selesai</td>
								<td>Status</td>
								<td>
									<!--Disini if-->
									<!--{!! Form::button('<i class="fa fa-fw fa-share"></i> Detail',['class','btn btn-sm btn-info', 'data-toggle','modal', 'data-target','#detailRPD']) !!}
									<a href="" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-share"></i>Detail</a>-->
									<button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailRPD">Detail</button>
									<!--else if-->
									<a href="" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-share"></i>Detail</a>
									<!--end if-->
								</td>
    						</tbody>
    					</table>
    				</div>    				
    			</div>
    		</div>
    	</div>

    	<!-- Bagian Modal -->
    	<div class="modal fade" id="detailRPD" tabindex="-1" role="dialog" aria-labelledby="detailRPDLabel">
    		<div class="modal-dialog" role="document">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    					<h4 class="modal-title" id="myModalLabel">Rencana Perjalanan Dinas (RPD)</h4>
    				</div>
    				<div class="modal-body">
    					
    				</div>
    				<div class="modal-footer">
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>

@endsection

@section('script')

@endsection