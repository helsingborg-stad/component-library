<!-- Visual dropdown list -->
<div class="{{$baseClass}}__dropdown" data-js-dropdown-element="true" aria-hidden="true">
  <ul class="{{$baseClass}}__options u-unlist u-padding--0 u-margin--0" role="listbox">
      @foreach ($options as $value => $name)
        @include('Select.partials.dropdown_item')
      @endforeach
  </ul>
  @includeWhen($search, 'Select.partials.searchNoResults')
</div>