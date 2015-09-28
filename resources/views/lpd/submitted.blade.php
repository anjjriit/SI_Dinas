@extends('layouts.master')

@section('page_title', 'LPD Submitted')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
            <p>LPD Yang Di Submit</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                @if (Auth::user()->role == 'super_admin')
                    <a href="/dashboard">Dashboard</a>
                @else
                    <a href="/homepage">Homepage</a>
                @endif
                <i class="fa fa-angle-right fa-fw"></i> Laporan Perjalanan Dinas
                <i class="fa fa-angle-right fa-fw"></i> Submitted
            </span>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($submittedLpds->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No. RPD</th>
                                            <th>No. Laporan</th>
                                            <th>Tanggal Laporan</th>
                                            <th>Total Pengeluaran</th>
                                            <th class="col-md-1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($submittedLpds as $lpd)
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
                                                    Rp {{ number_format($lpd->pengeluaran->sum('biaya'), 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#detailLPD-{{ $lpd->id }}" data-toggle-alt="tooltip" data-placement="top" data-title="Detail">
                                                        <i class="fa fa-fw fa-share"></i>
                                                    </button>
                                                    @if ($lpd->nik == auth()->user()->nik)
                                                        {!! Form::open(
                                                            [
                                                                'method' => 'POST',
                                                                'url' => '/lpd/recall/' . $lpd->id,
                                                                'style' => 'display: inline-block;',
                                                                'data-nama' => $lpd->kode,
                                                            ]
                                                        ) !!}

                                                            {!! Form::button('<i class="fa fa-fw fa-refresh"></i>', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger delete-button', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'data-title' => 'Recall']
                                                            ) !!}
                                                        {!! Form::close() !!}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            Data LPD yang telah disubmit belum tersedia.
                        </div>
                    @endif

                    {!! $submittedLpds->render() !!}
                </div>
            </div>
        </section>

        @foreach ($submittedLpds as $lpd)
            @include('lpd._modal_detail')
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
                title: '<i class="fa fa-refresh"></i> Recall LPD',
                content: 'Apakah Anda yakin akan merecall LPD dengan kode <strong>' + nama + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-default',
                cancelButton: 'Tidak',
                confirmButton: 'Ya, Recall',
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
