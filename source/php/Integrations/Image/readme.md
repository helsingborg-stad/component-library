# Image
This interface could be sent to any component that is requiring a image source. It will deliver a convinient interface to get the requested image as an url, and additionally a source set string containing smaller variants of the image.

## Callable function resolver
The third argument to the factory, must be a resolver that resolves images based on the parameters given (int id, array size). It should return a string with an image url.

## Example factory

```php
  $image = Image::factory(1, [1000, false], function($imageId, $size) {
    $image = wp_get_attachment_image_src($imageId, $size); 
    if($image !== false && isset($image[0])) {
      return $image[0]; 
    } 
    return null; 
  }]);

  //Will return something like: https://example.com/image-1000x1000.jpg
  echo $image->getUrl();

  //Will return something like: https://example.com/image.jpg 425w, https://example.com/image.jpg 768w
  echo $image->getSrcSet();

```