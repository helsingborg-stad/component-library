<?php 

namespace ComponentLibrary\Integrations\Image;

use ComponentLibrary\Integrations\Image\ImageResolverInterface;
use ComponentLibrary\Integrations\Image\ImageInterface; 

class Image implements ImageInterface {

  const COMMON_SCREEN_SIZES = [425, 768, 1024, 1440, 1680]; // Common screen sizes (width only) to generate sizes for
  const MIMIMUM_SIZE_DIFFERENCE = 150; // Minimum difference between the requested size and the common screen sizes, if in proximity, omit the common screen size
  const DEFAULT_FOCUS_POINT = ['left' => '50', 'top' => '50']; // Default focus point

  public function __construct(
    private int $imageId, 
    private array $imageSize, 
    private ImageResolverInterface $resolver,
    private ?ImageFocusResolverInterface $focusResolver = null
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
  public static function factory(int $imageId, array $imageSize, ImageResolverInterface $resolver, ?ImageFocusResolverInterface $focusResolver = null): ImageInterface
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
    return new self($imageId, $imageSize, $resolver, $focusResolver); 
  }

  /**
   * @inheritDoc
   */
  public function getUrl(): ?string {
    return $this->resolver->getImageUrl($this->imageId, $this->imageSize);
  }

  /**
   * Get a low resolution image alternative
   * 
   * @return string
   */
  public function getLqipUrl(): ?string {
    return $this->resolver->getImageUrl($this->imageId, [100, false]);
  }

  /**
   * @inheritDoc
   */
  public function getAltText(): ?string {
    return $this->resolver->getImageAltText($this->imageId);
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

  /**
   * Get the focus point of the image
   * 
   * @return array
   */
  public function getFocusPoint(): array {
    if($this->focusResolver) {
      $resolvedFocus = $this->focusResolver->getFocusPoint();

      if(isset($resolvedFocus['left']) && isset($resolvedFocus['top'])) {
        return [
          'left' => $resolvedFocus['left'],
          'top' => $resolvedFocus['top']
        ];
      }
    }
    return self::DEFAULT_FOCUS_POINT;
  }

  /** 
   * Get the container query data
   * 
   * @return array
   */
  public function getContainerQueryData(): array {
    $imageSizes = $this->getImageSizes(
      $this->imageSize[0] ?? null
    );

    if(!is_array($imageSizes) || empty($imageSizes)) {
      return [];
    }

    $uniqueId = uniqid('item-');

    // Declare variables
    $previousSize = 0;
    $return = [];

    // Get the total number of sizes for reference
    $totalSizes = count($imageSizes);

    // Loop through the image sizes
    foreach($imageSizes as $index => $size) {
        $return[] = [
            'uuid' => $uniqueId . "-" . $size,
            'url' => $this->resolver->getImageUrl(
                $this->imageId,
                [$size, $this->scaledHeight($size)]
            ),
            'media' => [
              'landscape' => $this->createMediaQuery('landscape', $previousSize, $size, (bool) !($index === $totalSizes - 1)),
              'portrait'  => $this->createMediaQuery('portrait', $previousSize, $size, (bool) !($index === $totalSizes - 1)),
            ],
            'src' => $this->getUrl(),
            'imageSize' => [$size, $this->scaledHeight($size)],
            'aspectRatio' => $this->getAspectRatioFromQuery(
              $size, 
              $this->resolver->getImageUrl(
                $this->imageId,
                [$size, $this->scaledHeight($size)]
              )
            ),
        ];

        // Update $previousSize for the next iteration
        $previousSize = $size;
    }

    return $return;
  }

  /**
   * Get the aspect ratio from the query
   * 
   * @param int $size
   * @param string $url
   * 
   * @return string
   */
  private function getAspectRatioFromQuery($size, $url): ?string {

    //Get image size from size param
    if($this->scaledHeight($size)) {
      return implode('/', [$size, $this->scaledHeight($size)]);
    }

    // Get all image sizes from the URL
    preg_match_all('/(\d{2,4})x(\d{2,4})/', $url, $matches);

    // Ensure we have matches and use the last match found
    if (!empty($matches) && count($matches[0]) > 0) {
      $lastIndex = count($matches[1]) - 1; // Get the index of the last match
      if(isset($matches[1][$lastIndex]) && isset($matches[2][$lastIndex])) {
        return implode('/', [$matches[1][$lastIndex], $matches[2][$lastIndex]]);
      }
    }

    return null;
  }

  /**
   * Create a media query
   * 
   * @param string $mode            If the query is intended for landscape or portrait
   * @param int $previousSize       The previous size
   * @param int $size               The current size
   * @param bool $includeMaxWidth   If the max-width should be included
   * 
   * @return string
   */
  private function createMediaQuery($mode, $previousSize, $size, $includeMaxWidth = true): string
  {
    $queryRelativeSize = ($mode == 'landscape') ? 1 : 0.62; // If we are using 16/9 image ratio (which we do in most cases),the relative size is about half. 
    $queryDimension = ($mode == 'landscape') ? 'width' : 'height';
    if ($includeMaxWidth) {
      return sprintf(
        "(min-%s: %spx) and (max-%s: %spx)", 
        $queryDimension, 
        ceil($previousSize * $queryRelativeSize), 
        $queryDimension, 
        ceil($size * $queryRelativeSize)
      );
    }
    return sprintf(
      "(min-%s: %spx)", 
      $queryDimension, 
      ceil($previousSize * $queryRelativeSize)
    );
  }
}