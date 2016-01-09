@extends('layouts.master')

@section('page_title', 'Akomodasi Per Tahun')

@section('content')

        <section class="content-header">
            <p>Akomodasi Per Tahun</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                <a href="/dashboard">Halaman Utama</a>
                <i class="fa fa-angle-right fa-fw"></i> Laporan
                <i class="fa fa-angle-right fa-fw"></i> Akomodasi Per Tahun
            </span>
        </section>

        <section class="content-filter">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::model($request, [
                        'method' => 'GET',
                        'url' => '/report/tahunan',
                        'class' => 'form-inline pull-left'
                    ])!!}
                        <div class="form-group">
                            @if ($request->has('query'))
                                {!! Form::hidden('searchBy') !!}
                                {!! Form::hidden('query') !!}
                            @endif

                            {!! Form::selectRange(
                                'year',
                                date('Y'),
                                2009,
                                $request->input('year', date('Y')),
                                ['class' => 'form-control', 'placeholder' => 'Tahun', 'required']
                            ) !!}

                            {!! Form::button(
                                '<i class="fa fa-fw fa-file-text-o"></i> Lihat Laporan',
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
                            <div class="small-box-title">Proyek</div>
                            <div class="small-box-number">{{ count($biayaProject) }}</div class="small-box-number">
                            <p>
                                Total akomodasi: <strong>Rp {{ number_format(array_sum($biayaProject), 0, ',', '.') }}</strong>
                            </p>
                        </div>
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
                    </div>
                </div>
            </div>
        </section>

@endsection
