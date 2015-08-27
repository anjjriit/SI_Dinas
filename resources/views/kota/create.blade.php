@extends('layouts.app')

@section('page_title', 'Add Kota')

@section('content')

        <div class="row">
            <div class="col-md-12">
                <div class="page-header text-center">
                    <h4>Form Add User</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <span class="text-danger">
                                <i class="fa fa-fw fa-times"></i> {{ $error }}
                            </span>
                            <br>
                        @endforeach
                    </div>
                @endif

                {!! Form::open(['method' => 'POST', 'route' => 'kota.store']) !!}
                    @include('kota._form')

                    {!! Form::button('<i class="fa fa-fw fa-plus"></i> Add Kota', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>

@endsection
