<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validatietaalregels
    |--------------------------------------------------------------------------
    |
    | De volgende taalregels bevatten de standaard foutmeldingen die worden
    | gebruikt door de validator-klasse. Sommige van deze regels hebben
    | meerdere versies, zoals de grootteregels. Pas deze berichten hier
    | gerust aan.
    |
    */

    'accepted' => 'Het veld :attribute moet worden geaccepteerd.',
    'accepted_if' => 'Het veld :attribute moet worden geaccepteerd wanneer :other gelijk is aan :value.',
    'active_url' => 'Het veld :attribute moet een geldige URL zijn.',
    'after' => 'Het veld :attribute moet een datum zijn na :date.',
    'after_or_equal' => 'Het veld :attribute moet een datum zijn na of gelijk aan :date.',
    'alpha' => 'Het veld :attribute mag alleen letters bevatten.',
    'alpha_dash' => 'Het veld :attribute mag alleen letters, cijfers, koppeltekens en underscores bevatten.',
    'alpha_num' => 'Het veld :attribute mag alleen letters en cijfers bevatten.',
    'any_of' => 'Het veld :attribute is ongeldig.',
    'array' => 'Het veld :attribute moet een array zijn.',
    'ascii' => 'Het veld :attribute mag alleen alfanumerieke tekens en symbolen van één byte bevatten.',
    'before' => 'Het veld :attribute moet een datum zijn vóór :date.',
    'before_or_equal' => 'Het veld :attribute moet een datum zijn vóór of gelijk aan :date.',
    'between' => [
        'array' => 'Het veld :attribute moet tussen :min en :max items bevatten.',
        'file' => 'Het veld :attribute moet tussen :min en :max kilobytes zijn.',
        'numeric' => 'Het veld :attribute moet tussen :min en :max liggen.',
        'string' => 'Het veld :attribute moet tussen :min en :max tekens lang zijn.',
    ],
    'boolean' => 'Het veld :attribute moet waar of onwaar zijn.',
    'can' => 'Het veld :attribute bevat een ongeautoriseerde waarde.',
    'confirmed' => 'De bevestiging van het veld :attribute komt niet overeen.',
    'contains' => 'Het veld :attribute mist een vereiste waarde.',
    'current_password' => 'Het wachtwoord is onjuist.',
    'date' => 'Het veld :attribute moet een geldige datum zijn.',
    'date_equals' => 'Het veld :attribute moet een datum zijn die gelijk is aan :date.',
    'date_format' => 'Het veld :attribute moet voldoen aan het formaat :format.',
    'decimal' => 'Het veld :attribute moet :decimal decimalen hebben.',
    'declined' => 'Het veld :attribute moet worden afgewezen.',
    'declined_if' => 'Het veld :attribute moet worden afgewezen wanneer :other gelijk is aan :value.',
    'different' => 'Het veld :attribute en :other moeten verschillend zijn.',
    'digits' => 'Het veld :attribute moet bestaan uit :digits cijfers.',
    'digits_between' => 'Het veld :attribute moet bestaan uit tussen :min en :max cijfers.',
    'dimensions' => 'Het veld :attribute heeft ongeldige afbeeldingsafmetingen.',
    'distinct' => 'Het veld :attribute heeft een dubbele waarde.',
    'doesnt_contain' => 'Het veld :attribute mag geen van de volgende waarden bevatten: :values.',
    'doesnt_end_with' => 'Het veld :attribute mag niet eindigen met een van de volgende waarden: :values.',
    'doesnt_start_with' => 'Het veld :attribute mag niet beginnen met een van de volgende waarden: :values.',
    'email' => 'Het veld :attribute moet een geldig e-mailadres zijn.',
    'encoding' => 'Het veld :attribute moet zijn gecodeerd in :encoding.',
    'ends_with' => 'Het veld :attribute moet eindigen met een van de volgende waarden: :values.',
    'enum' => 'De geselecteerde :attribute is ongeldig.',
    'exists' => 'De geselecteerde :attribute is ongeldig.',
    'extensions' => 'Het veld :attribute moet een van de volgende extensies hebben: :values.',
    'file' => 'Het veld :attribute moet een bestand zijn.',
    'filled' => 'Het veld :attribute moet een waarde hebben.',
    'gt' => [
        'array' => 'Het veld :attribute moet meer dan :value items bevatten.',
        'file' => 'Het veld :attribute moet groter zijn dan :value kilobytes.',
        'numeric' => 'Het veld :attribute moet groter zijn dan :value.',
        'string' => 'Het veld :attribute moet meer dan :value tekens bevatten.',
    ],
    'gte' => [
        'array' => 'Het veld :attribute moet :value items of meer bevatten.',
        'file' => 'Het veld :attribute moet groter dan of gelijk zijn aan :value kilobytes.',
        'numeric' => 'Het veld :attribute moet groter dan of gelijk zijn aan :value.',
        'string' => 'Het veld :attribute moet groter dan of gelijk zijn aan :value tekens.',
    ],
    'hex_color' => 'Het veld :attribute moet een geldige hexadecimale kleur zijn.',
    'image' => 'Het veld :attribute moet een afbeelding zijn.',
    'in' => 'De geselecteerde :attribute is ongeldig.',
    'in_array' => 'Het veld :attribute moet voorkomen in :other.',
    'in_array_keys' => 'Het veld :attribute moet ten minste een van de volgende sleutels bevatten: :values.',
    'integer' => 'Het veld :attribute moet een geheel getal zijn.',
    'ip' => 'Het veld :attribute moet een geldig IP-adres zijn.',
    'ipv4' => 'Het veld :attribute moet een geldig IPv4-adres zijn.',
    'ipv6' => 'Het veld :attribute moet een geldig IPv6-adres zijn.',
    'json' => 'Het veld :attribute moet een geldige JSON-tekenreeks zijn.',
    'list' => 'Het veld :attribute moet een lijst zijn.',
    'lowercase' => 'Het veld :attribute moet in kleine letters zijn.',
    'lt' => [
        'array' => 'Het veld :attribute moet minder dan :value items bevatten.',
        'file' => 'Het veld :attribute moet kleiner zijn dan :value kilobytes.',
        'numeric' => 'Het veld :attribute moet kleiner zijn dan :value.',
        'string' => 'Het veld :attribute moet minder dan :value tekens bevatten.',
    ],
    'lte' => [
        'array' => 'Het veld :attribute mag niet meer dan :value items bevatten.',
        'file' => 'Het veld :attribute moet kleiner dan of gelijk zijn aan :value kilobytes.',
        'numeric' => 'Het veld :attribute moet kleiner dan of gelijk zijn aan :value.',
        'string' => 'Het veld :attribute moet kleiner dan of gelijk zijn aan :value tekens.',
    ],
    'mac_address' => 'Het veld :attribute moet een geldig MAC-adres zijn.',
    'max' => [
        'array' => 'Het veld :attribute mag niet meer dan :max items bevatten.',
        'file' => 'Het veld :attribute mag niet groter zijn dan :max kilobytes.',
        'numeric' => 'Het veld :attribute mag niet groter zijn dan :max.',
        'string' => 'Het veld :attribute mag niet meer dan :max tekens bevatten.',
    ],
    'max_digits' => 'Het veld :attribute mag niet meer dan :max cijfers bevatten.',
    'mimes' => 'Het veld :attribute moet een bestand zijn van het type: :values.',
    'mimetypes' => 'Het veld :attribute moet een bestand zijn van het type: :values.',
    'min' => [
        'array' => 'Het veld :attribute moet ten minste :min items bevatten.',
        'file' => 'Het veld :attribute moet ten minste :min kilobytes zijn.',
        'numeric' => 'Het veld :attribute moet ten minste :min zijn.',
        'string' => 'Het veld :attribute moet ten minste :min tekens bevatten.',
    ],
    'min_digits' => 'Het veld :attribute moet ten minste :min cijfers bevatten.',
    'missing' => 'Het veld :attribute moet ontbreken.',
    'missing_if' => 'Het veld :attribute moet ontbreken wanneer :other gelijk is aan :value.',
    'missing_unless' => 'Het veld :attribute moet ontbreken tenzij :other gelijk is aan :value.',
    'missing_with' => 'Het veld :attribute moet ontbreken wanneer :values aanwezig is.',
    'missing_with_all' => 'Het veld :attribute moet ontbreken wanneer :values aanwezig zijn.',
    'multiple_of' => 'Het veld :attribute moet een veelvoud zijn van :value.',
    'not_in' => 'De geselecteerde :attribute is ongeldig.',
    'not_regex' => 'Het formaat van het veld :attribute is ongeldig.',
    'numeric' => 'Het veld :attribute moet een getal zijn.',
    'password' => [
        'letters' => 'Het veld :attribute moet ten minste één letter bevatten.',
        'mixed' => 'Het veld :attribute moet ten minste één hoofdletter en één kleine letter bevatten.',
        'numbers' => 'Het veld :attribute moet ten minste één cijfer bevatten.',
        'symbols' => 'Het veld :attribute moet ten minste één symbool bevatten.',
        'uncompromised' => 'De opgegeven :attribute is voorgekomen in een datalek. Kies een andere :attribute.',
    ],
    'present' => 'Het veld :attribute moet aanwezig zijn.',
    'present_if' => 'Het veld :attribute moet aanwezig zijn wanneer :other gelijk is aan :value.',
    'present_unless' => 'Het veld :attribute moet aanwezig zijn tenzij :other gelijk is aan :value.',
    'present_with' => 'Het veld :attribute moet aanwezig zijn wanneer :values aanwezig is.',
    'present_with_all' => 'Het veld :attribute moet aanwezig zijn wanneer :values aanwezig zijn.',
    'prohibited' => 'Het veld :attribute is verboden.',
    'prohibited_if' => 'Het veld :attribute is verboden wanneer :other gelijk is aan :value.',
    'prohibited_if_accepted' => 'Het veld :attribute is verboden wanneer :other is geaccepteerd.',
    'prohibited_if_declined' => 'Het veld :attribute is verboden wanneer :other is afgewezen.',
    'prohibited_unless' => 'Het veld :attribute is verboden tenzij :other in :values staat.',
    'prohibits' => 'Het veld :attribute voorkomt dat :other aanwezig is.',
    'regex' => 'Het formaat van het veld :attribute is ongeldig.',
    'required' => 'Het veld :attribute is verplicht.',
    'required_array_keys' => 'Het veld :attribute moet vermeldingen bevatten voor: :values.',
    'required_if' => 'Het veld :attribute is verplicht wanneer :other gelijk is aan :value.',
    'required_if_accepted' => 'Het veld :attribute is verplicht wanneer :other is geaccepteerd.',
    'required_if_declined' => 'Het veld :attribute is verplicht wanneer :other is afgewezen.',
    'required_unless' => 'Het veld :attribute is verplicht tenzij :other in :values staat.',
    'required_with' => 'Het veld :attribute is verplicht wanneer :values aanwezig is.',
    'required_with_all' => 'Het veld :attribute is verplicht wanneer :values aanwezig zijn.',
    'required_without' => 'Het veld :attribute is verplicht wanneer :values niet aanwezig is.',
    'required_without_all' => 'Het veld :attribute is verplicht wanneer geen van :values aanwezig is.',
    'same' => 'Het veld :attribute moet overeenkomen met :other.',
    'size' => [
        'array' => 'Het veld :attribute moet :size items bevatten.',
        'file' => 'Het veld :attribute moet :size kilobytes zijn.',
        'numeric' => 'Het veld :attribute moet :size zijn.',
        'string' => 'Het veld :attribute moet :size tekens bevatten.',
    ],
    'starts_with' => 'Het veld :attribute moet beginnen met een van de volgende waarden: :values.',
    'string' => 'Het veld :attribute moet een tekenreeks zijn.',
    'timezone' => 'Het veld :attribute moet een geldige tijdzone zijn.',
    'unique' => 'De :attribute is al in gebruik.',
    'uploaded' => 'Het uploaden van :attribute is mislukt.',
    'uppercase' => 'Het veld :attribute moet in hoofdletters zijn.',
    'url' => 'Het veld :attribute moet een geldige URL zijn.',
    'ulid' => 'Het veld :attribute moet een geldige ULID zijn.',
    'uuid' => 'Het veld :attribute moet een geldige UUID zijn.',

    /*
    |--------------------------------------------------------------------------
    | Aangepaste validatietaalregels
    |--------------------------------------------------------------------------
    |
    | Hier kun je aangepaste validatieberichten voor attributen specificeren
    | met de conventie "attribute.rule" om de regels een naam te geven.
    | Dit maakt het snel om een specifiek aangepast taalbericht te
    | specificeren voor een bepaalde attribuutregel.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'aangepast-bericht',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Aangepaste validatie-attributen
    |--------------------------------------------------------------------------
    |
    | De volgende taalregels worden gebruikt om onze attribuutplaceholder
    | te vervangen door iets leesbaarders, zoals "E-mailadres" in plaats
    | van "email". Dit helpt ons om berichten duidelijker te maken.
    |
    */

    'attributes' => [],

];