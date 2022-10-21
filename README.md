# component-library

A library of blade components

## Known issues
Have any issues? This list is your first resort. 

###
- **Components refuse to show up shortly after creation.** 
This is due to the fact that component aliases are cached. Flush blade cache in order to display the component. If you are encountering this issue, you may be able to utilities the component name directly by referring to @component.component instead of @component. 

## Filters
When component library is used in WordPress. Filters are enabled to allow for filtering from WordPress. There are multiple filters for each component. 

### Iframe
#### ComponentLibrary/Component/Iframe/GetSuppliers
Alter the list of pre-defined suppliers (sources) for iframes

- ```@param array $suppliers``` - Array containing the suppliers as Supplier objects

```php
apply_filters('ComponentLibrary/Component/Iframe/GetSuppliers', $suppliers );
```
```php
add_filter('ComponentLibrary/Component/Iframe/GetSuppliers', function($suppliers) {
return $suppliers;
}, 10, 1 );
```
### Icon
#### ComponentLibrary/Component/Icon/AltTextPrefix
Alter the prefix used when describing icons.

- ```@param string $altTextPrefix``` - String containing prefix for alt text.

```php
add_filter('ComponentLibrary/Component/Icon/AltTextPrefix', function($altTextPrefix) {
  return $altTextPrefix;
}, 10, 1 );
```

#### ComponentLibrary/Component/Icon/AltText
Alter the array used when describing icons.

- ```@param array $altText``` - Array containing key for icon, and value string for descriptions.

```php
add_filter('ComponentLibrary/Component/Icon/AltText', function($altText) {
  return $altText;
}, 10, 1 );
```
#### ComponentLibrary/Component/Icon/AltTextUndefined
Alter the undefined message used when describing icons.

- ```@param string $altTextUndefined``` - String containing undefined message for alt text.

```php
add_filter('ComponentLibrary/Component/Icon/AltTextUndefined', function($altTextUndefined) {
  return $altTextUndefined;
}, 10, 1 );
```