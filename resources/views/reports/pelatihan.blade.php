@extends('layouts.master')

@section('page_title', 'Akomodasi Per Pelatihan')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
            <p>Akomodasi Per Pelatihan</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                <a href="/dashboard">Dashboard</a>
                <i class="fa fa-angle-right fa-fw"></i> Report
                <i class="fa fa-angle-right fa-fw"></i> Akomodasi Per Pelatihan
            </span>
        </section>

        <section class="content-filter">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::model($request, [
                        'method' => 'GET',
                        'url' => '/report/pelatihan',
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
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($activities->count() > 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Nama Pelatihan</th>
                                            <th>Nama Lembaga/Institusi</th>
                                            <th>Akomodasi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($activities as $activity)

                                        <tr>
                                            <td>
                                                {{ $activity->pelatihan->nama_pelatihan }}
                                            </td>
                                            <td>
                                                {{ $activity->pelatihan->nama_lembaga }}
                                            </td>
                                            <td>
                                                @if (isset($biayaPelatihan[$activity->kode_kegiatan]))
                                                    Rp {{ number_format($biayaPelatihan[$activity->kode_kegiatan], 0, ',', '.') }}
                                                @else
                                                    Rp 0
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach

                                        <tr style="background-color: #fafafa;">
                                            <td colspan="2" class="text-center"><strong>Total</strong></td>
                                            <td>Rp {{ number_format(array_sum($biayaPelatihan), 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        @if ($request->has('query'))
                            <div class="alert alert-warning">
                                Tidak ada data yang tersedia.
                            </div>
                        @else
                            <div class="alert alert-warning">
                                Tidak ada data yang tersedia.
                            </div>
                        @endif
                    @endif

                </div>
            </div>
        </section>

@endsection
