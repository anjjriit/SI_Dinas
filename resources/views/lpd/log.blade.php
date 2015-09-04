@extends('layouts.master')

@section('page_title', 'Logs LPD')

@section('content')

        <section class="content-header">
            <h1>Logs Laporan Perjalanan Dinas</h1>
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
                        <div class="alert alert-error">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="box box-widget">
                        <div class="box-body no-padding">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Kota Tujuan</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>11117263</td>
                                        <td>Jakarta</td>
                                        <td>2015-09-01</td>
                                        <td>2015-09-04</td>
                                        <td>Approved</td>
                                        <td>
                                            <a href="/detail" class="btn btn-sm btn-success"><i class="fa fa-fw fa-info"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>11126374</td>
                                        <td>Jakarta</td>
                                        <td>2015-09-01</td>
                                        <td>2015-09-04</td>
                                        <td>Recall</td>
                                        <td>
                                            <a href="/detail" class="btn btn-sm btn-success"><i class="fa fa-fw fa-info"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>11137482</td>
                                        <td>Jakarta</td>
                                        <td>2015-09-01</td>
                                        <td>2015-09-04</td>
                                        <td>Decline</td>
                                        <td>
                                            <a href="/detail" class="btn btn-sm btn-success"><i class="fa fa-fw fa-info"></i> Detail</a>
                                        </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>


@endsection