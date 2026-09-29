# Icon SVG mode

`Icon` can render a named icon from a local SVG file while keeping its existing
size, color, and accessibility attributes. The mode is opt-in, so existing font
icons continue to work.

Set `svgMode` to `true` on an icon or through the
`ComponentLibrary/Component/Icon/Data` filter. Supply a trusted local file path
through `ComponentLibrary/Component/Icon/SvgPath`. The resolver receives the
icon name, the effective filled state, and the component data:

```php
add_filter('ComponentLibrary/Component/Icon/Data', function (array $data): array {
    $data['svgMode'] = true;
    return $data;
});

add_filter('ComponentLibrary/Component/Icon/SvgPath', function (
    ?string $path,
    string $icon,
    bool $filled,
    array $data
): ?string {
    if (!preg_match('/^[a-z0-9_]+$/', $icon)) {
        return null;
    }

    $style = 'rounded'; // Resolve this from the theme's icon settings.
    $weight = '400';
    $fill = $filled ? '1' : '0';
    return get_template_directory() . "/assets/dist/icons/material-symbols/$style/$weight/$fill/$icon.svg";
}, 10, 4);
```

The component reads only the requested file, then caches its contents for the
request. Uploaded `.svg` links and custom SVG icons registered through
`ComponentLibrary\Component\Icon\CustomSvgIcons` retain their existing precedence.
If the resolver returns no readable file, rendering falls back to the font.
The caller is responsible for the SVG catalogue and for keeping the font
available while that fallback is in use. Inline SVGs should use `currentColor`
to inherit the component's color.
