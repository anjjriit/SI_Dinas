@extends('layouts.master')

@section('page_title', 'Akomodasi Per Bulan')

@section('content')

        <section class="content-header">
            <p>Akomodasi Per Bulan</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                <a href="/dashboard">Dashboard</a>
                <i class="fa fa-angle-right fa-fw"></i> Report
                <i class="fa fa-angle-right fa-fw"></i> Akomodasi Per Bulan
            </span>
        </section>

        <section class="content-filter">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::model($request, [
                        'method' => 'GET',
                        'url' => '/report/bulanan',
                        'class' => 'form-inline pull-left'
                    ])!!}
                        <div class="form-group">
                            @if ($request->has('query'))
                                {!! Form::hidden('searchBy') !!}
                                {!! Form::hidden('query') !!}
                            @endif

                            {!! Form::select(
                                'month',
                                [
                                    1 => 'Januari',
                                    2 => 'Februari',
                                    3 => 'Maret',
                                    4 => 'April',
                                    5 => 'Mei',
                                    6 => 'Juni',
                                    7 => 'Juli',
                                    8 => 'Agustus',
                                    9 => 'September',
                                    10 => 'Oktober',
                                    11 => 'November',
                                    12 => 'Desember'
                                ],
                                $request->input('month', date('m')),
                                ['class' => 'form-control', 'placeholder' => 'Bulan', 'required']
                            ) !!}

                            {!! Form::selectRange(
                                'year',
                                date('Y'),
                                2009,
                                $request->input('year', date('Y')),
                                ['class' => 'form-control', 'placeholder' => 'Tahun', 'required']
                            ) !!}

                            {!! Form::button(
                                '<i class="fa fa-fw fa-file-text-o"></i> View Report',
                                [
                                    'type' => 'submit', 'class' => 'btn btn-success'
                                ]
                            ) !!}
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="small-box">
                        <div class="inner text-center">
                            <div class="small-box-title">Project</div>
                            <div class="small-box-number">{{ count($biayaProject) }}</div class="small-box-number">
                            <p>
                                Total akomodasi: <strong>Rp {{ number_format(array_sum($biayaProject), 0, ',', '.') }}</strong>
                            </p>
                        </div>

                        <a href="/report/project{{ ($request->has('month')) ? '?month=' . $request->input('month') . '&amp;year=' . $request->input('year') : '' }}" class="small-box-footer">More info <i class="fa fa-fw fa-angle-right"></i></a>
                    </div>
                </div>

                <div class="col-md-4 col-xs-12">
                    <div class="small-box">
                        <div class="inner text-center">
                            <div class="small-box-title">Prospek</div>
                            <div class="small-box-number">{{ count($biayaProspek) }}</div class="small-box-number">
                            <p>
                                Total akomodasi: <strong>Rp {{ number_format(array_sum($biayaProspek), 0, ',', '.') }}</strong>
                            </p>
                        </div>

                        <a href="/report/prospek{{ ($request->has('month')) ? '?month=' . $request->input('month') . '&amp;year=' . $request->input('year') : '' }}" class="small-box-footer">More info <i class="fa fa-fw fa-angle-right"></i></a>
                    </div>
                </div>

                <div class="col-md-4 col-xs-12">
                    <div class="small-box">
                        <div class="inner text-center">
                            <div class="small-box-title">Pelatihan</div>
                            <div class="small-box-number">{{ count($biayaPelatihan) }}</div class="small-box-number">
                            <p>
                                Total akomodasi: <strong>Rp {{ number_format(array_sum($biayaPelatihan), 0, ',', '.') }}</strong>
                            </p>
                        </div>

                        <a href="/report/pelatihan{{ ($request->has('month')) ? '?month=' . $request->input('month') . '&amp;year=' . $request->input('year') : '' }}" class="small-box-footer">More info <i class="fa fa-fw fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </section>

@endsection
