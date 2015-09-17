<div class="wizard">
    <div class="wizard-inner">
        <div class="row">
             <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                            <br>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        @include('rpd.partials.forms.components.tab_nav')

        <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="step1">

                @include('rpd.partials.forms.components.basic_info')

            </div>

            <div class="tab-pane" role="tabpanel" id="step2">

                @include('rpd.partials.forms.components.time_destination')

            </div>

            <div class="tab-pane" role="tabpanel" id="step3">

                @include('rpd.partials.forms.components.edit_participants')

            </div>

            <div class="tab-pane" role="tabpanel" id="step4">

                @include('rpd.partials.forms.components.additional_information')

            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
