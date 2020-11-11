<div class="govuk-form-group @error($field) govuk-form-group--error @enderror">
    <x-label :field="$field" :label="$label" :extra="$labelExtra" :mandatory="$mandatory"
             :hidden="$hideLabel"></x-label>
    <x-hint :hint="$hint" :field="$field"></x-hint>
    <x-error-message :field="$field"></x-error-message>
    <select class="govuk-select govuk-!-width-two-thirds @error($field) govuk-input--error @enderror" id="{{ $field }}"
            name="{{ $field }}"
            aria-describedby="@if($hint){{ $field }}-hint @endif @error($field) {{ $field }}-error @enderror"
            autocomplete="new-password">
        <option></option>
        @foreach($countries as $country)
            <option value="{{ $country[0] }}"
                    @if(old($field, session($field)) === $country[0]) selected @endif >{{ $country[0] }}</option>
        @endforeach
    </select>
</div>

@push('styles')
    <link href="{{ asset('css/location-autocomplete.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/location-autocomplete.min.js') }}"></script>
    <script type="text/javascript">
        openregisterLocationPicker({
            selectElement: document.getElementById('{{ $field }}'),
            url: '/assets/data/location-autocomplete-graph.json'
        })
    </script>
@endpush
