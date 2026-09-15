# Typed component configuration

Component input contracts can now be defined with typed PHP objects, while component metadata lives in a separate `config.php` file.

## Define a component data object

```php
final class ButtonData
{
    public function __construct(
        public ?string $text = null,
        public ?string $href = null,
        public bool $toggle = false,
    ) {
    }
}
```

- Constructor defaults define optional values.
- Parameters without defaults are required.
- Nullable values use `?Type`.
- Union types use native PHP syntax such as `string|array`.

## Define component metadata separately

```php
return new ComponentConfig(
    slug: 'button',
    view: 'button.blade.php',
    data: ButtonData::class,
    dependencies: [
        'sass' => [
            'components' => ['button', 'icon'],
        ],
    ],
);
```

`ComponentConfig` describes the component itself. The data object describes what input the component accepts.

## Nested structures

Use additional typed objects for nested structures:

```php
final class AccordionItemData
{
    public function __construct(
        public string|array $heading,
        public string $content,
    ) {
    }
}

final class AccordionData
{
    /**
     * @param AccordionItemData[] $list
     */
    public function __construct(
        public array $list = [],
    ) {
    }
}
```

Use PHPDoc only where PHP itself cannot express collection element types.

## Runtime behaviour

- The library reflects typed data objects to derive default values and accepted types.
- Existing Blade views and controllers still receive arrays.
- Object-to-array conversion happens once at the registration/controller boundary.
- Legacy array-based component calls still work for migrated components.

## Migration strategy

Components can be migrated one by one:

1. Add a typed `*Data` class.
2. Add `config.php` returning `ComponentConfig`.
3. Keep the existing controller and Blade view unchanged unless the contract itself needs adjustments.
4. Keep legacy json configuration for non-migrated components until they are converted.

This allows typed contracts and legacy configuration to coexist during migration.
