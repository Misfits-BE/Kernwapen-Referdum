@extends('layouts.app')

@section('content')
    <p>
        Deze website is eigendom van <a href="{{ config('platform.author.website')  }}">{{ config('platform.author.name') }}</a>.
        Door de toegang tot en het gebruik van deze website verklaart u zich uitdrukkelijk akkoord met de volgende algemene voorwaarden.
    </p>

    <h3>Intellectuele eigendomsrechten</h3>

    <p>
        De inhoud van deze site met inbegrip van de merken, logo's, tekeningen, data, product of bedrijfsnamen, teksten, beelden e.d zijn beschermd door intellectuele rechten en
        behoren toe aan {{ config('platform.author.name') }} of rechthoudende derden.
    </p>

    <h3>Beperking van aansprakelijkheid</h3>

    <p>
        De informatie op de website is van algemene aard. De informatie is niet aangepast aan persoonlijke of specifieke omstandigheden, en kan dus niet als een persoonlijk,
        professioneel of juridisch advies aan de gebruiker worden beschouwd.
    </p>

    <p>
        {{ config('platform.author.name') }} levert grote inspanningen opdat de ter beschikking gestelde informatie volledig, juist, nauwkeurig en bijgewerkt zou zijn. Ondanks deze inspanningen
        kunnen onjuistheden zich voordoen in de ter beschikking gestelde informatie. Indien de verstrekte informatie onjuistheden zou bevatten of indien bepaalde informatie op
        of via de site onbechikbaar zou zijn, zal {{ config('platform.author.name') }} de grootst mogelijke inspanning leveren om dit zo snel mogelijk recht te zetten. {{ config('platform.author.name') }} kan evenwel niet
        aansprakelijk worden gesteld voor rechtstreekse of onrechtstreekse schade die ontstaat uit het gebruik van de informatie op deze site. Indien u onjuistheden zou
        vaststellen in de informatie die via de site ter beschikking wordt gesteld, kan u de beheerder van de site contacteren.
    </p>

    <p>
        De inhoud van de site (links inbegrepen) kan te allen tijde zonder aankondiging of kennisgeving aangepast, gewijzigd of aangevuld worden. {{ config('platform.author.name') }} geeft geen garenties voor de goede
        werking van de website en kan op geen enkele wijze aansprakelijk gehouden worden voor een slechte werking of tijdelijke (on)beschikbaarheid van de website of voor enige vorm van schade,
        rechtstreekse of onrechtstreekse, die zou voortvloeien uit de toegang tot of het gebruik van de website.
    </p>

    <p>
        {{ config('platform.author.name') }} kan in geen geval tegenover wie dan ook, op directe of indirecte, bijzondere of andere wijze aansprakelijk worden gesteld voor schade te wijten aan het gebruik van deze site
        of van een andere, inzonderheid als gevolg van links of hyperlinks, met inbegrip, zonder beperking, van alle verliezen, werkonderbrekingen, beschadiging van programma's of andere gegevens
        op het computersysteem, van apparatuur, programmatuur of andere van de gebruiker.
    </p>

    <p>
        De website kan hyperlinks bevatten naar websites of pagina's van derden, of daar onrechtstreeks naar verwijzen. Het plaatsten van links naar deze websites of pagina's impliceert op
        geen enkele wijze een impliciete goedkeuring van de inhoud ervan. {{ config('platform.author.name') }} verklaart uitdrukkelijk dat zij geen zeggenschap heeft over de inhoud over de inhoud of
        over andere kenmerken van deze websites en kan in geen geval aansprakelijk gehouden worden voor de inhoud of de kenmerken ervan of voor enige andere vorm van schade door het gebruik ervan.
    </p>

    <h3>Privacybeleid.</h3>

    <p><strong>{{ config('platform.author.name') }} hecht belang aan uw privacy.</strong></p>
    <p>In geval de gebruiker van de website om persoonlijke informatie gevraagd wordt:</p>

    <p>
        De verantwoordelijke voor de verwerking, {{ config('platform.author.name') }} respecteert de Belgische wetgeving van 8 december 1992 met betrekking tot de bescherming van het privéleven in
        de verwerking van de persoonlijke gegevens. De door u meegedeelde persoonsgegevens zullen gebruikt worden voor de volgende doeleinden: Ons ledenbeheer, ondertekenen van petities.
    </p>

    <p>
        U beschikt over een wettelijk recht op inzage en eventuele correctie van uw persoonsgegevens. Miet bewijs van identiteit (kopie identiteitskaart) kun u via een schriftelijke gedateerde
        en ondertekende aanvraag aan {{ config('platform.author.name') }}, <i><a href="mailto:{{ config('platform.author.email') }}">({{ config('platform.author.email') }})</a></i> gratis de schriftelijke mededeling bekomen van uw persoonsgegevens. Indien nodig kunt u ook vragen de gegevens te corrigeren die onjuist,
        niet volledig of niet pertinent zouden zijn.
    </p>

    <p>
        Het is mogelijk dat de verkregen persoonsgegevens worden doorgegegeven aan de technische mensen van {{ config('platform.author.name') }}. Uw persoonsgegevens niet worden doorgegeven worden aan derden. <br>
        <i>(Overheid valt niet onder derden)</i>
    </p>

    <p>
        De technische mensen van {{ config('platform.author.name') }} kunnen ook tevens geaggregeerde gegevens verzamelen van niet persoonlijke aard, zoals browser type of IP adres, het besturingsprogramma dat u gebruikt of de
        domeinnaam van de website langs waar u op deze website gekomen bent, of waarlangs u deze verlaat. Dit maakt het ons mogelijk deze website permanent te optimaliseren voor de gebruikers.
    </p>

    <h3>Het gebruik van "cookies"</h3>

    <p>
        Tijdens een bezoek aan de site kunnen 'cookies' op de harde schijf van uw computer geplaatst worden. Een cookie is een tekstbestand dat door de server van een website in de browser van uw computer
        of op uw mobiel apperaat geplaatst wordt wanneer u een website raadpleegt. Cookies kunnen niet worden gebruikt om personen te identificeren, een cookie kan slechts een machine identificeren.
    </p>

    <p>
        U kan uw internetbrowser zodanig instellen dat cookies niet worden geaccepteerd, dat u een waarschuwing ontvangt wanneer een cookie geinstalleerd wordt of dat de cookies nadien van uw harde
        schijf worden verwijderd. Dit kan u doen via de instellingen van uw browser (via de help-functie). Hou er hierbij wel rekening mee dat bepaalde grafische elementen niet correct kunnen verschijnen,
        of dat u bepaalde applicaties zal kunnen gebruiken.
    </p>

    <p>Door gebruik van onze website, gaat u akkoord met ons gebruik van cookies.</p>

    <h3>Google analytics</h3>

    <p>
        Deze website maakt gebruik van Google Analytics. een webanalyse-service die wordt aangeboden door Google Inc. Google Analytics maakt gebruik van "cookies". (tekstbestandjes die op uw computer worden geplaatst)
        Om de website te helpen analyseren hoe de gebruikers de site gebruiken. De door het cookie gegenereerde informatie over uw gebruik van de website (met inbegrip van uw ip-adres) wordt overgebracht naar en door
        Google opgeslagen op servers in de Vernigde Staten. Google gebruikt deze informatie om bij te houden hoe u de website gebruikt, rapporten over de website-activiteit op te stellen voor de website-exploitanten en
        andere diensten aan te bieden met betrekking tot website-activiteit en internetgebruik. Google mag deze informatie aan derden verschaffen indien Google hiertoe wettelijk wordt verplicht, of voor zover deze derden
        deze informatie verwerken namens Google. Google zal uw ip-adres niet combineren met andere gegevens waarover Google beschikt.
    </p>
@endsection