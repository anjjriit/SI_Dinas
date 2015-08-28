@extends('layouts.master')

@section('page_title', 'Add User')

@section('content')

        <section class="content-header">
            <h1>Manage Users</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-widget">
                        <div class="box-header">
                            <h4>Form Add User</h4>
                        </div>
                        <div class="box-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                                        <br>
                                    @endforeach
                                </div>
                            @endif

                            {!! Form::open(['method' => 'POST', 'route' => 'user.store']) !!}
                                @include('pegawai._form')

                                {!! Form::button('<i class="fa fa-fw fa-plus"></i> Add User', ['type' => 'submit', 'class' => 'btn btn-lg btn-success']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection
