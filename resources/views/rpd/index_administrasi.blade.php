@extends('layouts.master')

@section('page_title', 'Approval RPD')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/jquery-confirm/css/jquery-confirm.min.css">
@endsection

@section('content')

    <section class="content-header">
        <h1>Daftar Pengajuan Rencana Perjalanan Dinas</h1>
    </section>

    <section class="content">
        <div class="row">
            <!--Bagian box tabel-->
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

                @if ($approvalRpds->count() != 0)
                    <div class="box box-widget">
                        <div class="box-body no-padding">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($approvalRpds as $rpd)
                                        <tr>
                                            <td> {{ $rpd->kode }} </td>
                                            <td> {{ $rpd->pegawai->nama_lengkap }} </td>
                                            <td> {{ $rpd->status }} </td>
                                            <td>
                                                <a href="/rpd/approval/{{ $rpd->id }}/detail" class="btn btn-sm btn-success"><i class="fa fa-fw fa-share"></i>Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning">
                        Pengajuan RPD belum tersedia.
                    </div>
                @endif

                {!! $approvalRpds->render() !!}
            </div>
        </div>
    </section>

@endsection