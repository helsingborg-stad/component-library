# Migration Guide — aspectRatio support for Brand and Logotype

## Overview

The `Brand` and `Logotype` components now accept an optional `aspectRatio`
property.  All existing usage continues to work without any changes — this is
a fully backwards-compatible, additive change.

---

## What changed

| Component  | New property   | CSS custom property written        | Behaviour when absent / invalid |
|------------|----------------|------------------------------------|---------------------------------|
| `Brand`    | `aspectRatio`  | `--c-brand--aspect-ratio`          | Renders exactly as before       |
| `Logotype` | `aspectRatio`  | `--c-logotype--aspect-ratio`       | Renders exactly as before       |

When a **valid** `aspectRatio` value is provided it is written as a
component-namespaced CSS custom property in the component's inline `style`
attribute, processed by BaseController's `sanitizeInlineCss()` as normal.

---

## Accepted values

- A positive **number** (e.g. `2`, `1.5`, `0.75`)
- A positive **numeric string** (e.g. `"2"`, `"1.5"`)

Invalid values — `0`, negative numbers, non-numeric strings, `false`, `null`,
or an empty string — are silently ignored and the component falls back to its
default rendering.

---

## Legacy mode — no action required

The four classic Brand usage patterns remain fully supported and render
identically to before:

1. **logo + one text row** — pass `logotype` and a single-item `text` array
2. **logo + multiple text rows** — pass `logotype` and a multi-item `text` array
3. **only logotype** — pass `logotype` with an empty `text` array
4. **only text** — pass an empty `logotype` with a `text` array

None of these require `aspectRatio` to be set.

---

## Adoption path for consumers

### Step 1 — no changes required

Deploy the new component version.  Existing templates continue to work as-is.

### Step 2 — opt in to explicit aspect ratios (optional)

Pass the new property wherever a fixed aspect ratio is desired:

```php
// Brand — numeric value
@brand([
    'logotype'    => $logotype,
    'text'        => ['Acme Corp'],
    'aspectRatio' => 5,
])
@endbrand

// Logotype — numeric string
@logotype([
    'src'         => '/path/to/logo.svg',
    'alt'         => 'Acme logo',
    'aspectRatio' => '1.5',
])
@endlogotype
```

### Step 3 — verify rendering

Check that the rendered HTML includes the expected CSS custom property, e.g.:

```html
<div class="c-brand" style="--c-brand--aspect-ratio: 5;" data-component="brand" …>
<figure class="c-logotype" style="--c-logotype--aspect-ratio: 1.5;" data-component="logotype" …>
```

### Step 4 — use the variable in your CSS (optional)

Consuming themes can read the variable to apply the ratio however they need:

```css
.c-brand {
    aspect-ratio: var(--c-brand--aspect-ratio);
}

.c-logotype {
    aspect-ratio: var(--c-logotype--aspect-ratio);
}
```

---

## No breaking changes

- The `aspectRatio` property defaults to `false` in both `brand.json` and
  `logotype.json`, so omitting it is identical to the previous behaviour.
- Invalid values are treated as absent — no errors are thrown.
- The CSS custom property is written into `attributeList['style']` and is
  automatically sanitized by BaseController's `sanitizeInlineCss()`.
