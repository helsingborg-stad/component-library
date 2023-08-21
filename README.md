# Component Library

A library of blade components compatible with WordPress.

## Known issues
Have any issues? This list is your first resort. 

###
- **Components refuse to show up shortly after creation.** 
This is due to the fact that component aliases are cached. Flush blade cache in order to display the component. If you are encountering this issue, you may be able to utilities the component name directly by referring to @component.component instead of @component. 

## Example usage
A registered component can be utilized as a component or directive just as in laravel. They do however have the added functionality to load the controller before render to enshure that stuff is formatted and defined.

### Render a component
```php
@icon(['icon' => 'apps', 'size' => 'md'])
@endicon
```
## Data flow
Base controller components
This controller handles all data flow to every component. 
There are multiple ways of inputting data to a component. 
  
1. The default configuration of the component.
These settings are made in the configuration json 
in each component folder. All variables used in the 
controller SHOULD be declared here. This is to
avoid undeclared variabe varnings. 
 
2. By populating the directive (in view file). 
This should be data that idicates states like
isDisabled => true etc. This is the main location 
of end user customization. 

3. By data manipulation in the controller connected
to each component. This data can be in every form,
but should focus on translating other input to view 
data. This file can contain clear-text-classes. 

Example: 
```php
if($isDisabled) { 
    $this->classList[] = 'disabled'; 
}
```


## Filters
When component library is used in WordPress. Filters are enabled to allow for filtering from WordPress. There are multiple filters for each component. 
 
Filter (General):
BladeComponentLibrary/Component/Data - Takes $data

Filter (Component specific): 
ComponentLibrary/Component/ComponentName/Data - Takes $data
    
Filter class (General):
ComponentLibrary/Component/Class - Takes $class

Filter class (Component specific): 
ComponentLibrary/Component/ComponentName/Class - Takes $class

Each data attribute also has a corresponding filter eg. ComponentLibrary/Component/ComponentName/dataVar 

### Additional paths (WordPress Specific)

You may ask the component library to render more view paths by using the ComponentLibrary/ViewPaths filter. Simply add 
another path to the component library by doing the following:

```
add_filter('ComponentLibrary/ViewPaths', function($viewPaths) (
  if(is_array($viewPaths)) {
    $viewPaths = [];
  }
  $viewPaths[] = "/path/to/plugin/views";
  return $viewPaths; 
));
```

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

## Add a builtin component
The most efficient and proposed way of adding a compning is by a PR to this package. It will then be available for everyone to be used. A internal component requires three different files. 

- View (name.blade.php)
- Controller (Name.php)
- Configuration (name.json)

### The view 
The view sould be as simple as possible, in most cases just a few if-statements. For more advanced solution, please consider to use components as childs to a larger component according to Atomic design principle. 

**Example:** 

```php
<a class="{{ $class }}" target="{{ $target }}" href="{{ $href or '#' }}">{{ $slot or $text }}</a>
```

### The controller 
The controller should handle all logic associated with a component. This file soule purpose is to remove any logic from the view. 

**Example:** 

```php
namespace BladeComponentLibrary\Component\Foo;

class Foo extends \BladeComponentLibrary\Component\BaseController 
{
    public function init() {
        $this->data['foo'] = "bar"; 
    }
}
```

### The configuration 
A simple configuration of the slug for the component (used as component name). The default parameters and the view name (defaults to the slug name). The configuration should be written in a valid json format. This file must contain the keys "slug", "default" (default parameters), description and "view". 

**Example:** 

```json
{
    "slug":"foo",
    "default":{
       "foo":true,
    },
    "description":{
       "foo": "Is it foo?",
    },
    "view":"foo.blade.php"
 }
```