<!-- footer.blade.php -->
<{{ $componentElement }} class="{{ $class }}" {!! $attribute !!}>
    @if ($slotOnly && $slot)

        <div class="c-footer__main-wrapper {{ $preFooterTextAlignment }}">

            @if (!empty($logotype))
                <div class="c-footer__header-wrapper">
                    <div class="o-container">
                        <div class="o-grid-12">
                            @link(['href' => $logotypeHref])
                            @logotype([
                              'id' => 'footer-logotype',
                              'src'=> $logotype,
                              'alt' => __('Go to homepage', 'component-library'),
                              'classList' => ['site-footer__logo', 'c-footer__logotype'],
                              'context' => 'footer.logotype'
                            ])
                            @endlogotype
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
        <div class="g-divider g-divider--lg"></div>
        <div class="{{ $baseClass }}__body">
            <a href="{{ $logotypeHref }}" class="{{ $baseClass }}__home-link">
                <img id="logotype" src="{{ $logotype }}" alt="{{ 'Go to homepage' }}">
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
