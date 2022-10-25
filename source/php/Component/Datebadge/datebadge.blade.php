<!-- datebadge.blade.php -->
<div class="{{ $class }}" {!! $attribute !!}>
    <div class="{{$baseClass . '__daymonth'}}">
        @typography(['variant' => 'h1', 'element' => 'span', 'classList' => [$baseClass . '__date']])
            {{ $day }}
        @endtypography
        @typography(['variant' => 'h4', 'element' => 'span', 'classList' => [$baseClass . '__month']])
            {{ $month }}
        @endtypography
    </div>
    @if($includeTime)
        <div class="{{$baseClass . '__time'}}">
            @icon(['icon' => 'access_time', 'size' => 'inherit'])
            @endicon
            @typography(['variant' => 'meta', 'element' => 'span'])
                {{ $time }}
            @endtypography
        </div>
    @endif
</div>