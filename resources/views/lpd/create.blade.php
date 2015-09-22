@extends('layouts.master')

@section('page_title', 'Buat LPD')
@endsection

@section('stylesheet')
    @parent
    <link rel="stylesheet" type="text/css" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
@endsection

@section('content')

        <section class="content-header">
            <h1>Laporan Perjalanan Dinas</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget">
                        {!! Form::open(['method' => 'POST', 'url' => 'lpd/store']) !!}

                            <div class="box-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                                            <br>
                                        @endforeach
                                    </div>
                                @endif

                                <fieldset>
                                	<legend>Data LPD</legend>
                                    <table>
                                        <tr>
                                            <td>
                                                <label>Kode RPD </label>
                                            </td>
                                            <td> : </td>
                                            <td>{{ $rpd->kode }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Penanggung Jawab </label>
                                            </td>
                                            <td> : </td>
                                            <td>{{ $rpd->pegawai->nama_lengkap }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Akomodasi Awal </label>
                                            </td>
                                            <td> : </td>
                                            <td>{{ $rpd->akomodasi_awal }}</td>
                                        </tr>
                                    </table>
                                </fieldset>

                                @include('lpd._form_pengeluaran')


                                {!! Form::button('<i class="fa fa-fw fa-floppy-o"></i> Tambah LPD', ['type' => 'submit', 'class' => 'btn btn-lg btn-success']) !!}
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </section>

@endsection

@section('script')
    @parent

    <script src="/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <script>
        $('.datepicker').datepicker({
            autoclose: true,
            beforeShowMonth: function (date){
                    switch (date.getMonth()){
                      case 8:
                        return false;
                    }
                },
            format: 'yyyy-mm-dd',
        })
    </script>
@endsection
