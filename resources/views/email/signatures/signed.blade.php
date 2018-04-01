@component('mail::message')
# U hebt de petitie van {{ config('app.name') }} ondertekend.

Via deze weg willen we je laten weten dat je de petitie van {{ config('app.name') }} hebt ondertekend. 
Met het jouw E-mail adres ({{ $signature->email }}). Indien jij dit niet bent kun je je verwijderen uit de lijst 
door op de knop uitschrijven te drukken.

@component('mail::button', ['url' => route('signature.delete', ['token' => $signature->unsubscribe_token ])])
Uitschrijven
@endcomponent

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent
