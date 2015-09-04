@extends('layouts.master')

@section('page_title', 'RPD Drafts')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

        <section class="content-header">
            <h1>Draft Rencana Perjalanan Dinas</h1>
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

                    
                    <div class="box box-widget">
                        <div class="box-body no-padding">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Kota Tujuan</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>11117263</td>
                                        <td>Jakarta</td>
                                        <td>2015-09-01</td>
                                        <td>2015-09-04</td>
                                        <td>
                                            <a href="/edit" class="btn btn-sm btn-default"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>11126374</td>
                                        <td>Jakarta</td>
                                        <td>2015-09-01</td>
                                        <td>2015-09-04</td>
                                        <td>
                                            <a href="/edit" class="btn btn-sm btn-default"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>11137482</td>
                                        <td>Jakarta</td>
                                        <td>2015-09-01</td>
                                        <td>2015-09-04</td>
                                        <td>
                                            <a href="/edit" class="btn btn-sm btn-default"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!--div class="alert alert-warning">
                        Tidak ada draft RPD yang tersimpan. Dengan menyimpan draft, Anda dapat menyimpan RPD sebelum disubmit.
                    </div-->
                    
@endsection