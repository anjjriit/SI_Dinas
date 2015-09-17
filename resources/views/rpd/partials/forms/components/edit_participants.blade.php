@extends('rpd.partials.forms.components.participants_master')

@section('form')
    @if (count(old('id_peserta')) > 0)

        @include('rpd.partials.forms.components.participants_old_input')

    @else
        @if (count($rpd->peserta) > 0)

            @include('rpd.partials.forms.components.participants_database')

        @else

            @include('rpd.partials.forms.components.participants_empty')

        @endif
    @endif
@endsection

