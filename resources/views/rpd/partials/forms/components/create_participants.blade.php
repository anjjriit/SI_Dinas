@extends('rpd.partials.forms.components.participants_master')

@section('form')
    @if (count(old('id_peserta')) > 0)

        @include('rpd.partials.forms.components.participants_old_input')

    @else

        @include('rpd.partials.forms.components.participants_empty')

    @endif
@endsection

