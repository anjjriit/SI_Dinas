@extends('layouts.master')

@section('page_title', 'Pengajuan RPD')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="/vendor/select2/css/select2.min.css" />
@endsection

@section('content')
    <section class="content-header">
        <p>Pengajuan RPD</p>
        <span class="bcumb">
            <i class="fa fa-fw fa-bookmark"></i>
            @if (Auth::user()->role == 'super_admin')
                <a href="/dashboard">Halaman Utama</a>
            @else
                <a href="/homepage">Halaman Utama</a>
            @endif
            <i class="fa fa-angle-right fa-fw"></i> Rencana Perjalanan Dinas
            <i class="fa fa-angle-right fa-fw"></i> Buat
        </span>
    </section>

    <section class="content">
        <div class="box box-widget">
            <div class="box-header">
                <h4>Formulir Pengajuan RPD</h4>
            </div>

            <hr style="margin-top: 10px;">

            {!! Form::open(['method' => 'POST', 'route' => 'rpd.action']) !!}

                @include('rpd.partials.forms.create')

            {!! Form::close() !!}
        </div>

        @include('rpd.partials.modals.add_prospect')

        @include('rpd.partials.modals.add_training')

    </section>
@endsection

@section('script')
    @parent

    <script src="/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/vendor/select2/js/select2.full.min.js"></script>
    <script src="/js/form-rpd.js"></script>
@endsection
