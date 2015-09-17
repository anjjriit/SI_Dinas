@extends('layouts.master')

@section('page_title', 'Edit Pengajuan RPD')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="/vendor/select2/css/select2.min.css" />
@endsection

@section('content')
    <section class="content-header">
        <h1>Rencana Perjalanan Dinas</h1>
    </section>

    <section class="content">
        <div class="box box-widget">
            <div class="box-header">
                <h4>Form Pengajuan RPD</h4>
            </div>

            {!! Form::model($rpd, ['method' => 'PATCH', 'url' => ['/administrasi/rpd/' . $rpd->id]]) !!}
_
                @include('rpd.partials.forms.edit')

            {!! Form::close() !!}
        </div>

        @include('rpd.partials.modals.add_prospect')

        @include('rpd..partials.modals.add_training')

    </section>
@endsection

@section('script')
    @parent

    <script src="/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/vendor/select2/js/select2.min.js"></script>
    <script src="/js/form-rpd.js"></script>
@endsection
