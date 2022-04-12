<!-- footer.blade.php -->
<{{$componentElement}} id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>
 @if ($slotOnly && $slot)

     @if($prefooter)
      <div class="c-footer__prefooter-wrapper">
        <div class="o-container">
            <div class="o-grid-12">
                {{$prefooter}}
            </div>
        </div>
      </div>
    @endif
    
    {{$slot}}

    @if($postfooter)
     <div class="c-footer__postfooter-wrapper">
        <div class="o-container">
            <div class="o-grid-12">
                {{$postfooter}}
            </div>
        </div>
      </div>
    @endif
     
 @else
      <div class="g-divider g-divider--lg"></div>
      <div class="{{ $baseClass }}__body">
          <a href="{{$logotypeHref}}" class="{{ $baseClass }}__home-link">
            <img id="logotype" src="{{$logotype}}" alt="Helsingborg Stad">
          </a>
        <div class="{{$baseClass}}__nav">
          @if($slot)
            {{$slot}}
          @endif
          @if(!empty($links))
            @foreach($links as $key => $value)
              <div class="c-footer__links">
                @if(!array_key_exists('href', $value))
                  @typography([
                    "variant" => "h4",
                    "element" => "h4"
                  ])
                    {{$key}}
                  @endtypography
                @endif
                  <div class="c-footer__links">
                    @foreach ($value as $link => $linkValue)
                      <a target="{{$linkValue['target']}}" href="{{$linkValue['href']}}">{{$link}}</a>
    
                      @if(!$loop->last)
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

  @includeWhen(!empty($subfooter['content'] ?? []) || $subfooterLogotype->url ?? false, 'Footer.Partials.subfooter')
</{{$componentElement}}>