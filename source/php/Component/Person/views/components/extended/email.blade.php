<span data-tooltip="{!! $email !!}">
    @button([
        'text' => $lang->email,
        'color' => 'default',
        'style' => 'basic',
        'href' => 'mailto:' . $email,
        'icon' => 'outgoing_mail',
        'reversePositions' => 'true',
        'attributeList' => [
            'itemprop' => 'email',
        ],
        'classList' => ['c-button--email', 'u-margin--0'],
    ])
    @endbutton
</span>
