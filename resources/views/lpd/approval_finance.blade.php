@extends('layouts.master')

@section('page_title', 'Approval LPD')

@section('content')

        <section class="content-header">
            <h1>Laporan Perjalanan Dinas</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Approval LPD</h4>
                        </div>
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
                                        <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#detailRPD">
                                            <i class="fa fa-fw fa-share"></i> Detail LPD
                                        </button>
                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('status', 'Status') !!}

                                            @if ($lpd->reimburse)
                                                {!! Form::select(
                                                    'status',
                                                    [
                                                        'PROCESS PAYMENT' => 'Approve',
                                                        'DECLINE' => 'Decline',
                                                        'BACK TO INITIATOR' => 'Back To Initiator'
                                                    ],
                                                    null,
                                                    ['class' => 'form-control', 'autofocus']
                                                ) !!}
                                            @else
                                                {!! Form::select(
                                                'status',
                                                [
                                                    'TAKE PAYMENT' => 'Approve',
                                                    'DECLINE' => 'Decline',
                                                    'BACK TO INITIATOR' => 'Back To Initiator'
                                                ],
                                                null,
                                                ['class' => 'form-control', 'autofocus']
                                            ) !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
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
                                {!! Form::button('<i class="fa fa-fw fa-check"></i> Submit', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>

@endsection
