@extends('layouts.master')

@section('page_title', 'Approval RPD')

@section('content')

        <section class="content-header">
            <h1>Rencana Perjalanan Dinas</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Approval RPD</h4>
                        </div>
                        {!! Form::open(['method' => 'POST', 'url' => '/administrasi/rpd/' . $rpd->id . '/approval']) !!}
                            <div class="box-body">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                                            <br>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-modal">
                                            <tbody>
                                                <tr>
                                                    <td class="col-md-4"><strong>Kode RPD</strong></td>
                                                    <td>{{ $rpd->kode }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4"><strong>Penanggung Jawab</strong></td>
                                                    <td>{{ $rpd->pegawai->nama_lengkap }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('status', 'Status') !!}
                                            {!! Form::select(
                                                'status',
                                                [
                                                    'APPROVED' => 'Approve',
                                                    'DECLINE' => 'Decline',
                                                    'BACK TO INITIATOR' => 'Back To Initiator'
                                                ],
                                                null,
                                                ['class' => 'form-control', 'autofocus']
                                            ) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('comment', 'Komentar') !!}
                                            {!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                {!! Form::button('<i class="fa fa-fw fa-check"></i> Submit', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>

@endsection
