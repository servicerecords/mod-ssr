@extends('layouts.app')

@section('title', 'Your details')

@section('content')

    <form action="/your-details/relationship" method="post" class="govuk-form">
        <div class="govuk-form-group {{ count($errors) >0 ? 'govuk-form-group--error' :'' }}">

            @include('partials.form-errors')

            <fieldset class="govuk-fieldset">
                <legend class="govuk-fieldset__legend govuk-fieldset__legend--m">
                    <h2 class="govuk-fieldset__heading">How are you related to the serviceperson?</h2>
                </legend>


                <div class="govuk-form-group">
                    @if($errors->first('related'))
                        <span id="service-error" class="govuk-error-message">{{$errors->first('relationship')}}</span>
                    @endif
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('relationship') == "I am not related" || (isset($your_details_relationship['relationship']) && $your_details_relationship['relationship'] == "I am not related")) ? 'checked' : '' }} class="govuk-radios__input"
                            type="radio" id="relationship-0" name="relationship" value="I am not related">
                        <label class="govuk-label govuk-radios__label" for="relationship-0">I am not related</label>
                    </div>
                    <div class="govuk-radios govuk-radios--conditional" data-module="radios">
                        <div class="govuk-radios__item">
                            <input
                                {{ (old('relationship') == "Spouse/Civil Partner" || (isset($your_details_relationship['relationship']) && $your_details_relationship['relationship'] == "Spouse/Civil Partner")) ? 'checked' : '' }} class="govuk-radios__input"
                                type="radio" id="relationship-1" name="relationship" value="Spouse/Civil Partner"
                                aria-controls="conditional-relationship-1-conditional" aria-expanded="false">
                            <label class="govuk-label govuk-radios__label" for="relationship-1">I am their
                                spouse/civil
                                partner</label>
                        </div>
                        <div class="govuk-radios__conditional govuk-radios__conditional--hidden"
                             id="conditional-relationship-1-conditional">
                            <div class="govuk-form-group">
                                <div class="govuk-checkboxes">
                                    <div class="govuk-checkboxes__item">
                                        <input
                                            {{ (old('spouse_at_time_of_death') == "Yes" || (isset($your_details_relationship['related']) && $your_details_relationship['spouse_at_time_of_death'] == "Yes")) ? 'checked' : '' }} class="govuk-checkboxes__input"
                                            id="spouse_at_time_of_death" name="spouse_at_time_of_death" type="checkbox"
                                            value="Yes">
                                        <label class="govuk-label govuk-checkboxes__label"
                                               for="spouse_at_time_of_death">
                                            Confirm here if you were their spouse/civil partner at the time of
                                            death
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="govuk-radios__item">
                            <input
                                {{ (old('relationship') == "Son/Daughter" || (isset($your_details_relationship['relationship']) && $your_details_relationship['relationship'] == "Son/Daughter")) ? 'checked' : '' }} class="govuk-radios__input"
                                type="radio" id="relationship-2" name="relationship" value="Son/Daughter">
                            <label class="govuk-label govuk-radios__label" for="relationship-2">I am their
                                son/daughter</label>
                        </div>
                        <div class="govuk-radios__item">
                            <input
                                {{ (old('relationship') == "Grandchild" || (isset($your_details_relationship['relationship']) && $your_details_relationship['relationship'] == "Grandchild")) ? 'checked' : '' }} class="govuk-radios__input"
                                type="radio" id="relationship-3" name="relationship" value="Grandchild">
                            <label class="govuk-label govuk-radios__label" for="relationship-3">I am their
                                grandchild</label>
                        </div>
                        <div class="govuk-radios__item">
                            <input
                                {{ (old('relationship') == "Mother/Father" || (isset($your_details_relationship['relationship']) && $your_details_relationship['relationship'] == "Mother/Father")) ? 'checked' : '' }} class="govuk-radios__input"
                                type="radio" id="relationship-4" name="relationship" value="Mother/Father"
                                aria-controls="conditional-relationship-4-conditional" aria-expanded="false">
                            <label class="govuk-label govuk-radios__label" for="relationship-4">I am their
                                mother/father</label>
                        </div>
                        <div class="govuk-radios__conditional govuk-radios__conditional--hidden"
                             id="conditional-relationship-4-conditional">
                            <div class="govuk-form-group">
                                <div class="govuk-checkboxes">
                                    <div class="govuk-checkboxes__item">
                                        <input
                                            {{ (old('parent') == "Yes" || (isset($your_details_relationship['parent']) && $your_details_relationship['parent'] == "Yes")) ? 'checked' : '' }} class="govuk-checkboxes__input"
                                            id="no_living_spouse" name="parent" type="checkbox" value="Yes">
                                        <label class="govuk-label govuk-checkboxes__label" for="no_living_spouse">
                                            Confirm here if the serviceperson did NOT have a living Spouse/Civil
                                            Partner at the time of death
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="govuk-radios__item">
                            <input
                                {{ (old('relationship') == "Brother/Sister" || (isset($your_details_relationship['relationship']) && $your_details_relationship['relationship'] == "Brother/Sister")) ? 'checked' : '' }} class="govuk-radios__input"
                                type="radio" id="relationship-5" name="relationship" value="Brother/Sister">
                            <label class="govuk-label govuk-radios__label" for="relationship-5">I am their
                                brother/sister</label>
                        </div>
                        <div class="govuk-radios__item">
                            <input
                                {{ (old('relationship') == "Neice/Nephew" || (isset($your_details_relationship['relationship']) && $your_details_relationship['relationship'] == "Neice/Nephew")) ? 'checked' : '' }} class="govuk-radios__input"
                                type="radio" id="relationship-6" name="relationship" value="Neice/Nephew">
                            <label class="govuk-label govuk-radios__label" for="relationship-6">I am their
                                niece/nephew</label>
                        </div>
                        <div class="govuk-radios__item">
                            <input
                                {{ (old('relationship') == "Grandparent" || (isset($your_details_relationship['relationship']) && $your_details_relationship['relationship'] == "Grandparent")) ? 'checked' : '' }} class="govuk-radios__input"
                                type="radio" id="relationship-7" name="relationship" value="Grandparent">
                            <label class="govuk-label govuk-radios__label" for="relationship-7">I am their
                                grandparent</label>
                        </div>
                        <div class="govuk-radios__item">
                            <input
                                {{ (old('relationship') == "Other" || (isset($your_details_relationship['relationship']) && $your_details_relationship['relationship'] == "Other")) ? 'checked' : '' }} class="govuk-radios__input"
                                id="relastionship=8" name="relationship" type="radio" value="Other"
                                aria-controls="conditional-relationship-8-conditional" aria-expanded="false">
                            <label class="govuk-label govuk-radios__label" for="relationship-8">
                                Other
                            </label></div>
                        <div class="govuk-radios__conditional govuk-radios__conditional--hidden"
                             id="conditional-relationship-8-conditional">
                            <div class="govuk-form-group">
                                <label class="govuk-label" for="relationship-8-other">
                                    Please specify
                                </label>
                                @if($errors->first('relationship_other'))
                                    <span id="service-error"
                                          class="govuk-error-message">{{$errors->first('relationship_other')}}</span>
                                @endif
                                <input
                                    value="{{(isset($your_details_relationship['relationship_other']) ? $your_details_relationship['relationship_other'] : old('relationship_other')) }}"
                                    class="govuk-input" id="relationship-8-other" name="relationship_other" type="text"
                                    spellcheck="false" maxlength="120">
                            </div>
                        </div>
                    </div>
                <!-- <div class="govuk-form-group">
                    <fieldset class="govuk-fieldset">
                        <legend class="govuk-fieldset__legend govuk-fieldset__legend--m">
                            <h1 class="govuk-fieldset__heading">
                                Confirm here if you hold Power Of Attorney over the immediate Next of Kin
                            </h1>
                        </legend>
                        <div class="govuk-radios govuk-radios--inline">
                            <div class="govuk-radios__item">
                                <input class="govuk-radios__input"
                                       id="poa"
                                       name="poa"
                                       type="radio" value="Yes"
                                       {{ (old('poa') == "Yes" || (isset($your_details_relationship ['poa']) && $your_details_relationship['poa'] == "Yes")) ? 'checked' : '' }}>
                                <label class="govuk-label govuk-radios__label" for="poa">
                                    Yes
                                </label>
                            </div>
                            <div class="govuk-radios__item">
                                <input class="govuk-radios__input"
                                       id="poa2"
                                       name="poa"
                                       type="radio"
                                       value="No"
                                        {{ (old('poa') == "No" || (isset($your_details_relationship ['poa']) && $your_details_relationship['poa'] == "Yes")) ? 'checked' : '' }}>
                                <label class="govuk-label govuk-radios__label" for="poa2">
                                    No
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </div> -->
                </div>
                <div class="govuk-form-group">
                    <details class="govuk-details" role="group">
                        <summary class="govuk-details__summary" role="button"
                                 aria-controls="details-content-e0c053e5-5ef7-40ff-be62-f8146fe9ff57"
                                 aria-expanded="false">
                                <span class="govuk-details__summary-text">
                                    Who the MOD regards as the immediate Next of Kin?
                                </span>
                        </summary>
                        <div class="govuk-details__text" id="details-content-e0c053e5-5ef7-40ff-be62-f8146fe9ff57"
                             aria-hidden="true">
                            <p class="govuk-body">The MOD will regard the Next of Kin to be the first living
                                relative from the following list:</p>
                            <ul class="govuk-list govuk-list--bullet">
                                <li>Spouse/Civil Partner</li>
                                <li>Son/Daughter</li>
                                <li>Grandchild</li>
                                <li>Brother/Sister</li>
                                <li>Nephew/Neice</li>
                                <li>Grandparent</li>
                                <li>Other</li>
                            </ul>
                        </div>
                    </details>
                </div>
            </fieldset>
        </div>
        <div class="govuk-form-group">
            @csrf
            <button type="submit" class="govuk-button">Continue</button>
        </div>
    </form>

@endsection
