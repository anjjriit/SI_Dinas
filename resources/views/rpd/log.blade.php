@extends('layouts.master')

@section('page_title', 'Logs RPD')

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

        <div class="content-header">
            <h1>Logs Rencana Perjalanan Dinas</h1>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if ($rpdLogs->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Terakhir Diperbarui</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rpdLogs as $rpdLog)
                                            <tr>
                                                <td>
                                                    {{ $rpdLog->kode }}
                                                </td>
                                                <td>
                                                    {{ date_format( date_create($rpdLog->updated_at), 'd/m/Y H:i:s' ) }}
                                                </td>
                                                <td>
                                                    {{ $rpdLog->status }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            Logs RPD belum tersedia.
                        </div>
                    @endif
                </div>
            </div>
        </section>

@endsection