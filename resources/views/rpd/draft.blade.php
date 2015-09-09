@extends('layouts.master')

@section('page_title', 'RPD Drafts')

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

                    @if ($draftRpds->count() != 0)
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
                                        @foreach ($draftRpds as $draftRpd)
                                            <tr>
                                                <td>{{ $draftRpd->id }}</td>
                                                <td>{{ $draftRpd->kotaTujuan->nama_kota }}</td>
                                                <td>{{ $draftRpd->tanggal_mulai }}</td>
                                                <td>{{ $draftRpd->tanggal_selesai }}</td>
                                                <td>
                                                    <a href="/rpd/draft/{{ $draftRpd->id }}/edit" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="fa fa-fw fa-edit"></i></a>
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
