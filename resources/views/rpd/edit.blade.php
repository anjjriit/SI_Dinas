@extends('layouts.master')

@section('page_title', 'Edit Pengajuan RPD')

@section('stylesheet')
    @parent
    <link rel="stylesheet" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="/vendor/select2/css/select2.min.css" />
@endsection

@section('content')
    <section class="content-header">
        <p>Edit Pengajuan RPD</p>
        <span class="bcumb">
            <i class="fa fa-fw fa-bookmark"></i>
            @if (Auth::user()->role == 'super_admin')
                <a href="/dashboard">Dashboard</a>
            @else
                <a href="/homepage">Homepage</a>
            @endif
            <i class="fa fa-angle-right fa-fw"></i> <a href="/rpd/submitted/all">Rencana Perjalanan Dinas</a>
            @if ($rpd->status == 'SUBMIT')
                <i class="fa fa-angle-right fa-fw"></i> {{ $rpd->kode}}
            @endif
            <i class="fa fa-angle-right fa-fw"></i> Edit
        </span>
    </section>

    <section class="content">
        <div class="box box-widget">
            <div class="box-header">
                <h4>Form Pengajuan RPD</h4>
            </div>

            {!! Form::model($rpd, ['method' => 'PATCH', 'route' => ['rpd.update', $rpd->id]]) !!}

                @include('rpd.partials.forms.edit')

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
