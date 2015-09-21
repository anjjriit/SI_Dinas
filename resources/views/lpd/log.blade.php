@extends('layouts.master')

@section('page_title', 'Logs LPD')

@section('content')

        @if (session('success'))
            <div class="content">
                <div class="row">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="content">
                <div class="row">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        <section class="content-header">
            <h1>Logs Laporan Perjalanan Dinas</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if ($lpdLogs->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Terakhir Diperbarui</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lpdLogs as $lpdLog)
                                            <tr>
                                                <td>
                                                    {{ $lpdLog->kode }}
                                                </td>
                                                <td>
                                                    {{ date_format( date_create($lpdLog->updated_at), 'd/m/Y H:i:s' ) }}
                                                </td>
                                                <td>
                                                    {{ $lpdLog->status }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#detailLPD-{{ $lpdLog->id }}">
                                                        <i class="fa fa-fw fa-share"></i>Detail
                                                    </button>
                                                    @if ($lpdLog->status == 'BACK TO INITIATOR')
                                                        <a href="/lpd/{{ $lpdLog->id }}/edit" class="btn btn-default"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                            Logs LPD belum tersedia.
                        </div>
                    @endif

                    {!! $lpdLogs->render() !!}
                </div>
            </div>
        </section>

        @foreach ($lpdLogs as $lpd)
            @include('lpd._modal_detail')
        @endforeach

@endsection
