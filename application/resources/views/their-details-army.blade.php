@extends('layouts.app')


@section('title', 'Details of the serviceperson');

@section('content')

    <form action="/service-details" method="post" class="govuk-form" id="subject-army" novalidate="novalidate">
        <div class="govuk-form-group {{ count($errors) >0 ? 'govuk-form-group--error' :'' }}">
            <fieldset class="govuk-fieldset">

                @include('partials.form-errors')

                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="service_number">Official Service number
                        (optional)</label>
                    <input
                        value="{{ isset($service_details['service_number'] ) ? $service_details['service_number'] : old('service_number') }}"
                        class="govuk-input govuk-input--width-10" id="service_number" name="service_number" type="text"
                        spellcheck="false">
                </div>
                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="discharge_date">Year of discharge (optional)</label>
                    <span id="army-dis-1-item-hint" class="govuk-hint">
                            Approximate if you are unsure
                        </span>
                    <input
                        value="{{ isset($service_details['discharge_year'] ) ? $service_details['discharge_year'] : old('discharge_year') }}"
                        class="govuk-input govuk-input--width-4" id="discharge_date" name="discharge_year" type="number"
                        patter="[0-9]*" size="4">
                </div>
                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="regt_corps">Regt/Corps (optional)</label>
                    <span id="army-dis-1-item-hint" class="govuk-hint">
                            At time of discharge
                        </span>
                    <input
                        value="{{ isset($service_details['regt_corps'] ) ? $service_details['regt_corps'] : old('regt_corps') }}"
                        class="govuk-input govuk-input--width-10" id="regt_corps" name="regt_corps" type="text" maxlength="120"
                        spellcheck="false">
                </div>
            </fieldset>
        </div>
        <div class="govuk-form-group">
            <fieldset class="govuk-fieldset">
                <legend class="govuk-fieldset__legend govuk-fieldset__legend--m">
                    <h2 class="govuk-fieldset__heading">Why did they leave the Army? (optional)</h2>
                </legend>


                <div class="govuk-radios govuk-radios--conditional" data-module="radios">
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('leave_army_reason') == 'Demobilisation after WW2' || (isset($service_details['leave_army_reason']) && $service_details['leave_army_reason'] == 'Demobilisation after WW2')) ? 'checked' : '' }} class="govuk-radios__input"
                            type="radio" id="leave_army_reason-1" name="leave_army_reason"
                            value="Demobilisation after WW2">
                        <label class="govuk-label govuk-radios__label" for="leave_army_reason-1">Normal
                            demobilisation after WW2</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('leave_army_reason') == "Completion of 'peace-time' Regular engagement" || (isset($service_details['leave_army_reason']) && $service_details['leave_army_reason'] == "Completion of 'peace-time Regular engagement")) ? 'checked' : '' }} class="govuk-radios__input"
                            type="radio" id="leave_army_reason-2" name="leave_army_reason"
                            value="Completion of 'peace-time' Regular engagement">
                        <label class="govuk-label govuk-radios__label" for="leave_army_reason-2">Completion of regular
                            engagement</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('leave_army_reason') == 'Medical discharge' || (isset($service_details['leave_army_reason']) && $service_details['leave_army_reason'] == 'Medical discharge')) ? 'checked' : '' }} class="govuk-radios__input"
                            type="radio" id="leave_army_reason-3" name="leave_army_reason" value="Medical discharge">
                        <label class="govuk-label govuk-radios__label" for="leave_army_reason-3">Medical
                            discharge</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('leave_army_reason') == 'End of National Service' || (isset($service_details['leave_army_reason']) && $service_details['leave_army_reason'] == 'End of National Service')) ? 'checked' : '' }} class="govuk-radios__input"
                            type="radio" id="leave_army_reason-4" name="leave_army_reason"
                            value="End of National Service">
                        <label class="govuk-label govuk-radios__label" for="leave_army_reason-4">End of National
                            Service</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('leave_army_reason') == 'Other' || (isset($service_details['leave_army_reason']) && $service_details['leave_army_reason'] == 'Other')) ? 'checked' : '' }} class="govuk-radios__input"
                            id="leave-conditional-1" name="leave_army_reason" type="radio" value="other"
                            aria-controls="conditional-leave-conditional-1" aria-expanded="false">
                        <label class="govuk-label govuk-radios__label" for="leave-conditional-1">
                            Other
                        </label>
                    </div>
                    <div class="govuk-radios__conditional govuk-radios__conditional--hidden"
                         id="conditional-leave-conditional-1">
                        <div class="govuk-form-group">
                            <label class="govuk-label" for="leave_army_reason_other">
                                Please specify
                            </label>
                            <input
                                value="{{ isset($service_details['leave_army_reason_other'] ) ? $service_details['leave_army_reason_other'] : old('leave_army_reason_other') }}"
                                class="govuk-input govuk-input--width-20" id="leave_army_reason_other"
                                name="leave_army_reason_other" type="text" spellcheck="false" maxlength="120">
                        </div>
                    </div>
                </div>


            </fieldset>
        </div>
        <div class="govuk-form-group">
            <fieldset class="govuk-fieldset">
                <legend class="govuk-fieldset__legend govuk-fieldset__legend--m">
                    <h2 class="govuk-fieldset__heading">Did they serve with either of the following (optional)</h2>
                </legend>
            </fieldset>

            <div class="govuk-checkboxes" data-module="checkboxes">
                <div class="govuk-checkboxes__item">
                    <input
                        {{ (old('completion_info') == 'Territorial Army (TA)' || (isset($service_details['completion_info']) && $service_details['completion_info'] == 'Territorial Army (TA)')) ? 'checked' : '' }} class="govuk-checkboxes__input"
                        type="checkbox" id="ta_info-conditional" name="completion_info[]" value="Territorial Army (TA)"
                        aria-controls="conditional-ta_info-conditional" aria-expanded="false">
                    <label class="govuk-label govuk-checkboxes__label" for="ta_info">Territorial Army (TA)</label>
                </div>
                <div class="govuk-checkboxes__conditional govuk-checkboxes__conditional--hidden"
                     id="conditional-ta_info-conditional">
                    <div class="govuk-form-group">
                        <label class="govuk-label" for="ta_army_number">
                            Number
                        </label>
                        <input
                            {{ (old('completion_info') == 'Territorial Army (TA)' || (isset($service_details['completion_info']) && $service_details['completion_info'] == 'Territorial Army (TA)')) ? 'checked' : '' }} class="govuk-input govuk-input--width-20"
                            id="ta_army_number" name="ta_army_number" type="text" spellcheck="false" maxlength="120">
                    </div>
                    <div class="govuk-form-group">
                        <label class="govuk-label" for="ta_army_regt_corps">
                            Regt/Corps
                        </label>
                        <input
                            {{ (old('completion_info') == 'Territorial Army (TA)' || (isset($service_details['completion_info']) && $service_details['completion_info'] == 'Territorial Army (TA)')) ? 'checked' : '' }} class="govuk-input govuk-input--width-20"
                            id="ta_army_regt_corps" name="ta_army_regt_corps" type="text" spellcheck="false" maxlength="120">
                    </div>
                    <div class="govuk-form-group">
                        <label class="govuk-label" for="ta_army_regt_corps">
                            Dates
                        </label>
                        <span id="ta_army-1-item-hint" class="govuk-hint">
                                No format required
                            </span>
                        <input
                            {{ (old('completion_info') == 'Territorial Army (TA)' || (isset($service_details['completion_info']) && $service_details['completion_info'] == 'Territorial Army (TA)')) ? 'checked' : '' }} class="govuk-input govuk-input--width-20"
                            id="ta_army_dates" name="ta_army_dates" type="text" spellcheck="false" maxlength="120">
                    </div>
                </div>


                <div class="govuk-checkboxes__item">
                    <input {{ (old('completion_info') == 'Army Emergency Reserve
                            (AER)' || (isset($service_details['completion_info']) && $service_details['completion_info'] == 'Army Emergency Reserve
                            (AER)') ? 'checked' : '' )}}
                           class="govuk-checkboxes__input" type="checkbox" id="aer-conditional" name="completion_info[]"
                           value="Army Emergency Reserve
                            (AER)" aria-controls="conditional-aer-conditional" aria-expanded="false">
                    <label class="govuk-label govuk-checkboxes__label" for="ta_info">Army Emergency Reserve
                        (AER)</label>
                </div>
                <div class="govuk-checkboxes__conditional govuk-checkboxes__conditional--hidden"
                     id="conditional-aer-conditional">
                    <div class="govuk-form-group">
                        <label class="govuk-label" for="aer_number">
                            Number
                        </label>
                        <input
                            value="{{ isset($service_details['aer_number'] ) ? $service_details['aer_number'] : old('aer_number') }}"
                            class="govuk-input govuk-input--width-20" id="aer_army_number" name="aer_number" type="text"
                            spellcheck="false" maxlength="120">
                    </div>
                    <div class="govuk-form-group">
                        <label class="govuk-label" for="aer_regt_corps">
                            Regt/Corps
                        </label>
                        <input
                            value="{{ isset($service_details['aer_regt_corps'] ) ? $service_details['aer_regt_corps'] : old('aer_regt_corps') }}"
                            class="govuk-input govuk-input--width-20" id="aer_regt_corps" name="aer_regt_corps"
                            type="text" spellcheck="false" maxlength="120">
                    </div>
                    <div class="govuk-form-group">
                        <label class="govuk-label" for="aer_regt_corps">
                            Dates
                        </label>
                        <span id="ta_army-1-item-hint" class="govuk-hint">
                                No format required
                            </span>
                        <input
                            value="{{ isset($service_details['aer_dates'] ) ? $service_details['aer_dates'] : old('aer_dates') }}"
                            class="govuk-input govuk-input--width-20" id="aer_dates" name="aer_dates" type="text"
                            spellcheck="false" maxlength="120">
                    </div>
                </div>
            </div>
        </div>
        <div class="govuk-form-group">
            <fieldset class="govuk-fieldset">
                <legend class="govuk-fieldset__legend govuk-fieldset__legend--m">
                    <h2 class="govuk-fieldset__heading">Has a Disability Pension been applied for? (optional)</h2>
                </legend>
                <div class="govuk-radios" data-module="radios">
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('disability_benefit') == 'Yes' || (isset($service_details['disability_benefit']) && $service_details['disability_benefit'] == 'Yes')) ? 'checked' : '' }} class="govuk-radios__input"
                            type="radio" id="disability-conditional" name="disability_benefit" value="Yes"
                            aria-controls="conditional-disability-conditional" aria-expanded="false">
                        <label class="govuk-label govuk-radios__label" for="disability-conditional">Yes</label>
                    </div>
                    <div class="govuk-radios__conditional govuk-radios__conditional--hidden"
                         id="conditional-disability-conditional">
                        <div class="govuk-form-group">
                            <label class="govuk-label" for="disability_reason">
                                Please give details
                            </label>
                            <textarea class="govuk-textarea" id="" name="disability_reason" maxlength="1000"
                                      rows="5">{{ isset($service_details['disability_reason'] ) ? $service_details['disability_reason'] : old('disability_reason') }}</textarea>
                        </div>
                    </div>
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('disability_benefit') == 'No' || (isset($service_details['disability_benefit']) && $service_details['disability_benefit'] == 'No')) ? 'checked' : '' }} class="govuk-radios__input"
                            type="radio" id="disability-conditional" name="disability_benefit" value="No">
                        <label class="govuk-label govuk-radios__label" for="disability-conditional">No</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('disability_benefit') == "Don't know" || (isset($service_details['disability_benefit']) && $service_details['disability_benefit'] == "Don't know")) ? 'checked' : '' }} class="govuk-radios__input"
                            type="radio" id="disability-conditional" name="disability_benefit" value="Don't know">
                        <label class="govuk-label govuk-radios__label" for="disability-conditional">Don't
                            know</label>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="govuk-form-group">
            <label class="govuk-label govuk-label--s" for="leave_army_reason_otherr">
                Further information (optional)
            </label>
            <span id="nm-1-item-hint" class="govuk-hint">
                      For example Ranks, Grades, Regiments, National Insurance
                      number.
                    </span>
            <textarea class="govuk-textarea" id="further_info" name="further_info"
                      rows="5">{{ isset($service_details['further_info'] ) ? trim($service_details['further_info']) : trim(old('further_info')) }}</textarea>
        </div>
        <div class="govuk-form-group">
            @csrf
            <button type="submit" class="govuk-button">Continue</button>
        </div>
    </form>

@endsection
