<?php 

namespace ComponentLibrary\Integrations\Image;

use ComponentLibrary\Integrations\Image\ImageResolverInterface;
use ComponentLibrary\Integrations\Image\ImageInterface; 

class Image implements ImageInterface {

  const COMMON_SCREEN_SIZES = [425, 768, 1024, 1440]; // Common screen sizes (width only) to generate sizes for
  const MIMIMUM_SIZE_DIFFERENCE = 150; // Minimum difference between the requested size and the common screen sizes, if in proximity, omit the common screen size

  public function __construct(
    private int $imageId, 
    private array $imageSize, 
    private ImageResolverInterface $resolver,
  ) {}

  /**
   * Factory method to create an image object
   * 
   * @param int $imageId      The ID of the image
   * @param array $imageSize  Width and height of the image
   * 
   * @throws Exception       If the image size is not an array with two values  
   * @throws Exception       If the image size is not an array with at least a integer representing width  
   * @throws Exception       If the image size is an array with more than two values  
   * 
   * @return ImageInterface
   */
  public static function factory(int $imageId, array $imageSize, ImageResolverInterface $resolver): ImageInterface
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
   * @inheritDoc
   */
  public function getUrl(): string {
    return $this->resolver->getImageUrl($this->imageId, $this->imageSize);
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
        $result[] = $this->resolver->getImageUrl(
          $this->imageId,
          [$size, $this->scaledHeight($size)]
        ) . ' ' . $size . 'w';
      }
      return implode(', ', $result);
    }
    return null;
  }

  /** 
   * Get the scaled height of the image, if exists
   * 
   * @param int $width
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
      foreach (self::COMMON_SCREEN_SIZES as $size) {
          if ($size <= $requestedImageSize) {
            if (abs($requestedImageSize - $size) > self::MIMIMUM_SIZE_DIFFERENCE) {
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