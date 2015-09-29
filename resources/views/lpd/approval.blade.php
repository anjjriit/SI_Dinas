@extends('layouts.master')

@section('page_title', 'Approval LPD')

@section('content')

        <section class="content-header">
            <p>Laporan Perjalanan Dinas</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                @if (Auth::user()->role == 'super_admin')
                    <a href="/dashboard">Dashboard</a>
                @else
                    <a href="/homepage">Homepage</a>
                @endif
                <i class="fa fa-angle-right fa-fw"></i> <a href="/lpd/processed">Processed LPD</a>
                <i class="fa fa-angle-right fa-fw"></i> {{ $lpd->kode }}
                <i class="fa fa-angle-right fa-fw"></i> Approval
            </span>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Approval LPD</h4>
                        </div>

                        <hr style="margin-top: 10px;">

                        {!! Form::open(['method' => 'POST', 'url' => '/lpd/' . $lpd->id . '/approval']) !!}
                            <div class="box-body">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                                            <br>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#detailLPD">
                                            <i class="fa fa-fw fa-share"></i> Detail LPD
                                        </button>
                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('comment', 'Komentar') !!}
                                            {!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                @if ($lpd->reimburse)
                                    {!! Form::button('<i class="fa fa-fw fa-check"></i> Paid', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                                @else
                                    {!! Form::button('<i class="fa fa-fw fa-check"></i> Take Payment', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                                @endif
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>

        @include('lpd._modal_detail')
@endsection
