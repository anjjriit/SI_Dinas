@extends('layouts.master')

@section('page_title', 'LPD Submitted')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

    <section class="content-header">
        <h1>Data Laporan Perjalanan Dinas</h1>
        <label>Yang telah disubmit</label>
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
                                        <th>Kode LPD</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Tanggal Laporan</th>
                                        <th class="col-md-1"></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($submittedLpds as $lpd)
                                        <tr>
                                            <td>
                                                {{ $lpd->kode }}
                                            </td>
                                            <td>
                                                {{ $lpd->pegawai->nama_lengkap }}
                                            </td>
                                            <td>
                                                {{ $lpd->tanggal_laporan }}
                                            </td>
                                            <td>
                                                @if($lpd->reimburse)
                                                    <span class="label label-warning">Reimburse</span>
                                                @else
                                                    <span class="label label-success">Pengembalian</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#detailLPD-{{ $lpd->id }}">
                                                    <i class="fa fa-fw fa-share"></i> Detail
                                                </button>
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
                title: '<i class="fa fa-refresh"></i> Recall RPD',
                content: 'Apakah Anda yakin akan merecall RPD dengan kode <strong>' + nama + '</strong>',
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

    </script>

@endsection
