# component-library

A library of blade components

## Known issues
Have any issues? This list is your first resort. 

###
- Components refuse to show up shortly after creation.
This is due to the fact that component aliases are cached. Flush blade cache in order to display the component. If you are encountering this issue, you may be able to utilities the component name directly by referring to @component.component instead of @component. 

