<!-- footer.blade.php -->
@scope(['name' => ['footer']])
<{{ $componentElement }} class="{{ $class }}" {!! $attribute !!}>
    @if ($slotOnly && $slot)
        <div class="c-footer__main-wrapper">
            @if (!empty($logotype))
                <div class="c-footer__header-wrapper">
                    <div class="o-container">
                        <div class="o-grid-12">
                            @link(['href' => $logotypeHref])
                                @scope(['name' => ['mainfooterlogotype']])
                                    @logotype([
                                        'id' => 'footer-logotype',
                                        'src'=> $logotype,
                                        'alt' => __('Go to homepage', 'component-library'),
                                        'classList' => ['site-footer__logo', 'c-footer__logotype'],
                                        'context' => 'footer.logotype',
                                        'maskable' => true,
                                    ])
                                    @endlogotype
                                @endscope
                            @endlink
                        </div>
                    </div>
                </div>
            @endif

            @if (!empty($prefooter))
                <div class="c-footer__prefooter-wrapper">
                    <div class="o-container">
                        <div class="o-grid-12">
                            {{ $prefooter }}
                        </div>
                    </div>
                </div>
            @endif

            {{ $slot }}

            @if (!empty($footerareas))
                <div class="o-container">
                    <div class="o-grid">
                        @if ($footerareas)
                            {{ $footerareas }}
                        @endif
                    </div>
                </div>
            @endif

            @if (!empty($postfooter))
                <div class="c-footer__postfooter-wrapper">
                    <div class="o-container">
                        <div class="o-grid-12">
                            {{ $postfooter }}
                        </div>
                    </div>
                </div>
            @endif

        </div>
    @else
        <div class="{{ $baseClass }}__body">
            <a href="{{ $logotypeHref }}" class="{{ $baseClass }}__home-link">
                @scope(['name' => ['footerlogotype']])
                    @logotype([
                        'id' => 'footer-logotype',
                        'src'=> $logotype,
                        'alt' => __('Go to homepage', 'component-library'),
                        'classList' => ['site-footer__logo', 'c-footer__logotype'],
                        'context' => 'footer.logotype',
                        'maskable' => true,
                    ])
                    @endlogotype
                @endscope
            </a>
            <div class="{{ $baseClass }}__nav">
                @if ($slot)
                    {{ $slot }}
                @endif
                @if (!empty($links))
                    @foreach ($links as $key => $value)
                        <div class="c-footer__links">
                            @if (!array_key_exists('href', $value))
                                @typography([
                                  "variant" => "h4",
                                  "element" => "h4"
                                ])
                                {{ $key }}
                                @endtypography
                            @endif
                            <div class="c-footer__links">
                                @foreach ($value as $link => $linkValue)
                                    <a target="{{ $linkValue['target'] }}"
                                        href="{{ $linkValue['href'] }}">{{ $link }}</a>

                                    @if (!$loop->last)
                                        <span class="c-footer__link-divider"></span>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endif

    @includeWhen($displaySubFooter,'Footer.Partials.subfooter')
</{{ $componentElement }}>
@endscope