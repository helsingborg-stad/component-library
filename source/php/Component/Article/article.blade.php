<!-- article.blade.php -->
<article>
    @if($tableOfContents)
        <nav class="table-of-contents">
            @typography([
                'element' => 'h2',
                'variant' => 'h3',
                'classList' => ['toc-title'],
            ])

                @icon(['icon' => 'toc', 'size' => 'md'])
                @endicon

                {{ $}}
            @endtypography
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