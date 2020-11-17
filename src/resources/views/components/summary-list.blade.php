@props([
'rows' => [],
])

<dl class="govuk-summary-list govuk-!-margin-bottom-9">
    @foreach($rows as $row)
        <div class="govuk-summary-list__row">
            <dt class="govuk-summary-list__key">{{ $row['label'] }}</dt>
            <dd class="govuk-summary-list__value">{{ $row['value'] }}</dd>
            <dd class="govuk-summary-list__actions">
                @if(\Illuminate\Support\Str::endsWith($row['field'], 'date'))
                    <a class="govuk-link" href="{{ route($row['route']) }}#{{$row['field']}}-day">Change<span
                            class="govuk-visually-hidden"> {{ $row['change'] ?? '' }}</span></a>
                @else
                <a class="govuk-link" href="{{ route($row['route']) }}#{{$row['field']}}">Change<span
                        class="govuk-visually-hidden"> {{ $row['change'] ?? '' }}</span></a>
                @endif
            </dd>
        </div>
    @endforeach
</dl>
