@extends('layouts.master')

@section('page_title', 'Approved LPD')

@section('content')

         <section class="content-header">
            <p>LPD Yang Telah Di Approve</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                @if (Auth::user()->role == 'super_admin')
                    <a href="/dashboard">Dashboard</a>
                @else
                    <a href="/homepage">Homepage</a>
                @endif
                <i class="fa fa-angle-right fa-fw"></i> Laporan Perjalanan Dinas
                <i class="fa fa-angle-right fa-fw"></i> Approved
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

                    @if ($approvedLpds->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>No. LPD</th>
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
                                                    <button type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#detailLPD-{{ $approvedLpd->id }}" data-toggle-alt="tooltip" data-placement="top" data-title="Detail">
                                                        <i class="fa fa-fw fa-share"></i>
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

@section('script')
    @parent
    <script>
        $('[data-toggle-alt="tooltip"]').tooltip();
    </script>
@endsection
