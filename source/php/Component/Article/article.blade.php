<!-- article.blade.php -->
<article>
    @if($tableOfContents)
        <nav class="table-of-contents">
            @if($tableOfContentsTitle)
                @typography([
                    'element' => 'h2',
                    'variant' => 'h3',
                    'classList' => ['toc-title', 'u-display--flex', 'u-gutter--1']
                ])
                    @icon(['icon' => 'toc', 'size' => 'md'])@endicon
                    {{ $tableOfContentsTitle }}
                @endtypography
            @endif

            @listing([
                'list' => $tableOfContents,
                'elementType' => 'ul',
                'class' => 'toc-list',
                'baseClass' => 'toc-item',
                'icon' => false,
            ])
            @endlisting
        </nav>
    @endif

    {!! $slot !!}
</article>