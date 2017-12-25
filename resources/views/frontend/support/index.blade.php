@extends('layouts.app')

@section('content')
    <h3>Wat kun jij doen om ons te ondersteunen?</h3>

    <p>Het referendum collectief is altijd opzoek naar vrijwilligers. Voor het verspreiden van promotie materiaal, of het bekostigen ervan.</p>

    <p>
        Er zijn ook andere manieren om actief te helpen. U kunt ons gemakkelijk online steunen door op Twitter, Mensen uit te nodigen 
        voor onze facebook-pagina of deze te delen in uw groepen. Ook u kunt een opiniestuk schrijven en deze sturen naar een krant, tijdschrift 
        of website. Heeft u een goed idee voor een (ludieke) actie? ga ervoor! Mail ons als u daar meer organisatie bij nodig heeft. 
    </p>
    <p>
        Indien u zich geroepen voelt aarzal dan niet en contracteer ons via de contact pagina. Of op het 
        Email adres (<a href="mailto:acties@activisme.be">acties@activisme.be</a>).
    </p>

    <h3>Organisaties die het referendum ondersteunen.</h3>

    @if (count($supports) > 0)
        <div class="row">
            @foreach ($supports as $support)
                <div class="col-md-4">
                    <i class="fa fa-asterisk"></i> 
                    <a href="{{ $support->link }}">{{ $support->name }}</a>
                </div> 
            @endforeach
        </div>
    @else {{-- Geen organisaties gevonden --}}
        <div class="alert alert-info alert-imporant" role="alert">
            <strong><i class="fa fa-info-circle"></i> Info:</strong> 
            Deze petitie word momenteel nog niet ondersteund door organisaties.
        </div>
    @endif
@endsection