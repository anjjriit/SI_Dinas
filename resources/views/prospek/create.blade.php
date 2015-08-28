@extends('layouts.app')

@section('page_title', 'Add Prospek')

@section('content')

        <div class="row">
            <div class="col-md-12">
                <div class="page-header text-center">
                    <h4>Form Add Prospek</h4>
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

                {!! Form::open(['method' => 'POST', 'route' => 'prospek.store']) !!}
                    @include('prospek._form')

                    {!! Form::button('<i class="fa fa-fw fa-plus"></i> Add Prospek', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>

@endsection
