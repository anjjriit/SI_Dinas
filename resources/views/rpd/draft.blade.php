@extends('layouts.master')

@section('page_title', 'Draft RPD')

@section('content')

        <section class="content-header">
            <p>Draft RPD</p>
            <span class="bcumb">
                <i class="fa fa-fw fa-bookmark"></i>
                @if (Auth::user()->role == 'super_admin')
                    <a href="/dashboard">Dashboard</a>
                @else
                    <a href="/homepage">Homepage</a>
                @endif
                <i class="fa fa-angle-right fa-fw"></i> Rencana Perjalanan Dinas
                <i class="fa fa-angle-right fa-fw"></i> Draft
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
                                            <!--th>Kode</th-->
                                            <th class="col-md-1">No.</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Terakhir Diperbarui</th>
                                            <th class="col-md-1">Action</th>
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
                                                    <a href="/rpd/{{ $draftRpd->id }}/edit" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            Tidak ada draft RPD yang tersimpan. Dengan menyimpan draft, Anda dapat menyimpan RPD sebelum disubmit.
                        </div>
                    @endif
                </div>
            </div>
        </section>

@endsection
