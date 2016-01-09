@extends('layouts.master')

@section('page_title', 'Draf RPD')

@section('content')

        <section class="content-header">
            <p>Draf RPD</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                @if (Auth::user()->role == 'super_admin')
                    <a href="/dashboard">Halaman Utama</a>
                @else
                    <a href="/homepage">Halaman Utama</a>
                @endif
                <i class="fa fa-angle-right fa-fw"></i> Rencana Perjalanan Dinas
                <i class="fa fa-angle-right fa-fw"></i> Draf
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

                    @if ($draftRpds->count() != 0)
                        <div class="box box-widget">
                            <div class="box-body no-padding">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">No.</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Terakhir Diperbarui</th>
                                            <th class="col-md-1">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($draftRpds as $draftRpd)
                                            <tr>
                                                <!--td>{{ $draftRpd->id }}</td-->
                                                <td>{{ $i++ }}.</td>
                                                <td>{{ date_format( date_create($draftRpd->created_at), 'd/m/Y' ) }}</td>
                                                <td>{{ date_format( date_create($draftRpd->updated_at), 'd/m/Y H:i' ) }}</td>
                                                <td>
                                                    <a href="/rpd/{{ $draftRpd->id }}/edit" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-title="Ubah"><i class="fa fa-fw fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            Tidak ada draf RPD yang tersimpan. Dengan menyimpan draf, Anda dapat menyimpan RPD sebelum diajukan.
                        </div>
                    @endif
                </div>
            </div>
        </section>

@endsection
