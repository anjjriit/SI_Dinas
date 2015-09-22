@extends('layouts.master')

@section('page_title', 'LPD Approved')

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
            <h1>Data Laporan Perjalanan Dinas</h1>
            <label>Yang telah diapproved</label>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if ($approvedLpds->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Pengaju</th>
                                            <th>Status</th>
                                            <th>Terakhir Diperbarui</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($approvedLpds as $approvedLpd)
                                            <tr>
                                                <td>
                                                    {{ $approvedLpd->kode }}
                                                </td>
                                                <td>
                                                    {{ $approvedLpd->pegawai->nama_lengkap }}
                                                </td>
                                                <td>
                                                    {{ $approvedLpd->status }}
                                                </td>
                                                <td>
                                                    {{ date_format( date_create($approvedLpd->updated_at), 'd/m/Y H:i:s' ) }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#detailLPD-{{ $approvedLpd->id }}">
                                                        <i class="fa fa-fw fa-share"></i>Detail
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
                            List LPD yang telah diapproved belum tersedia.
                        </div>
                    @endif
                </div>
            </div>
        </section>

        @foreach ($approvedLpds as $lpd)
            @include('lpd._modal_detail')
        @endforeach


@endsection
