<?php 

namespace ComponentLibrary\Integrations\Image;

class Image implements ImageInterface {

  private array $commonScreenSizes = [425, 768, 1024, 1440]; // Common screen sizes (width only) to generate sizes for

  private mixed $resolver; // The callable that resolves the image in the native system

  public function __construct(
    private int $imageId, 
    private array $imageSize, 
    callable $resolver,
  ) {
    if($this->verifyCallableSignature($resolver) === true) {
      $this->resolver = $resolver;  
    }
  }

  /**
   * Factory method to create an image object
   * 
   * @param int $imageId      The WordPress ID of the image
   * @param array $imageSize  Width and height of the image
   * 
   * @return ImageInterface
   */
  public static function factory(int $imageId, array $imageSize, callable $resolver): ImageInterface
  {
    if(!isset($imageSize[0]) || !isset($imageSize[1])) {
      throw new \Exception('Image size must be an array with width and height (keys 0,1).');
    }

    if(!is_int($imageSize[0])) {
      throw new \Exception('Image size must be an array width at least a integer representing width.');
    }

    if(count($imageSize) > 2) {
      throw new \Exception('Image size must be an array with max two values.');
    }

    // Sanitize the image size, ensure the values are integers or false
    $imageSize = array_map(function($value) {
      if(is_numeric($value)) {
        return (int) round($value);
      }
      return false; 
    }, $imageSize);

    //Factory
    return new self($imageId, $imageSize, $resolver); 
  }

  /**
   * Verify the signature of the callable
   * 
   * @param callable $resolver
   * 
   * @return bool   True if the signature is correct, otherwise an InvalidArgumentException is thrown
   */
  private function verifyCallableSignature(callable $resolver): true
  {
      // Reflection can help to verify the signature of the callable
      $reflection = new \ReflectionFunction($resolver);

      // Check the number of parameters (we expect 2)
      if ($reflection->getNumberOfParameters() !== 2) {
        throw new \InvalidArgumentException('The callable must accept exactly 2 parameters (int $id, array $size = [{$width}, {$height}]).');
      }

      // Check for a return type
      if(!$reflection?->getReturnType()) {
        throw new \InvalidArgumentException('The callable must have a return type, none defined.');
      }

      // Check the return type
      if ($reflection->getReturnType()?->getName() !== 'string') {
        throw new \InvalidArgumentException('The callable must return an string with the url of the image asset. Returned: ' . ($reflection->getReturnType()?->getName()) ?: 'unknown'); 
      }

      return true;
  }

  /**
   * @inheritDoc
   */
  public function getUrl(): string {
    return call_user_func($this->resolver, $this->imageId, $this->imageSize);
  }

  /**
   * @inheritDoc
   */
  public function getSrcSet(): ?string {
    $srcSet = $this->getImageSizes(
      $this->imageSize[0] ?? null
    );
    if(is_array($srcSet) && !empty($srcSet)) {
      foreach($srcSet as $size) {
        $result[] = call_user_func(
          $this->resolver, 
          $this->imageId, 
          [
            $size, 
            $this->scaledHeight($size)
          ]) . ' ' . $size . 'w';
      }
      return implode(', ', $result);
    }
    return null;
  }

  /** 
   * Get the scaled height of the image, if exists
   */
  public function scaledHeight(int $width): int {
    if(!isset($this->imageSize[1]) || $this->imageSize[1] === false) {
      return false; 
    }
    return (int) round($this->imageSize[1] * ($width / $this->imageSize[0]));
  }

  /**
   * Get the image sizes
   * 
   * @return array
   */
   public function getImageSizes(?int $requestedImageSize): ?array
  {
      if ($requestedImageSize === null) {
        return null;
      }
      $sizes = [];
      foreach ($this->commonScreenSizes as $size) {
          if ($size <= $requestedImageSize) {
            if (abs($requestedImageSize - $size) > 100) {
              $sizes[] = $size;
            }
          }
      }

      if(!empty($sizes)) {
        $sizes[] = $requestedImageSize;
      }

      return $sizes ?: null;
  }
}