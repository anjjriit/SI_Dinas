@extends('layouts.master')

@section('page_title', 'Catatan LPD')

@section('content')



        <section class="content-header">
        <p>Catatan LPD</p>
        <span class="bcumb">
            <i class="fa fa-fw fa-bookmark"></i>
            @if (Auth::user()->role == 'super_admin')
                <a href="/dashboard">Halaman Utama</a>
            @else
                <a href="/homepage">Halaman Utama</a>
            @endif
            <i class="fa fa-angle-right fa-fw"></i> Laporan Perjalanan Dinas
            <i class="fa fa-angle-right fa-fw"></i> Catatan
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
                    @if ($lpdLogs->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">No. LPD</th>
                                            <th>Terakhir Diperbarui</th>
                                            <th>Status</th>
                                            <th class="col-md-1">Aksi</th>
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
                                                    <button type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#detailLPD-{{ $lpdLog->id }}" data-toggle-alt="tooltip" data-placement="top" data-title="Detail">
                                                        <i class="fa fa-fw fa-share"></i>
                                                    </button>
                                                    @if ($lpdLog->status == 'BACK TO INITIATOR')
                                                        <a href="/lpd/{{ $lpdLog->id }}/edit" class="btn btn-default"><i class="fa fa-fw fa-edit"></i> Ubah</a>
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
                            Catatan LPD belum tersedia.
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

@section('script')
    @parent
    <script>
        $('[data-toggle-alt="tooltip"]').tooltip();
    </script>
@endsection
