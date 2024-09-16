<?php 

namespace ComponentLibrary\Image;

class Image implements ImageInterface {
  private int $minimumDimension = 500; // Minimum width for the image, no sizes will be generated below this figure
  private int $minimumDifferance = 200; // Minimum differance between the sizes, if difference is smaller, less sizes will be generated
  private int $maxiumDifference = 400; // Maximum differance between the sizes, if difference is larger, more sizes will be generated
  private array $numberOfSizes = [3, 6]; // Number of sizes to generate. [min, max]

  public function __construct(private int $imageId, private array $imageSize) {
      $this->imageId = $imageId;
      $this->imageSize = $imageSize;
  }

  /**
   * @inheritDoc
   */
  public function getUrl(): string {
    return $this->getWpImage($this->imageId, $this->imageSize)[0];
  }

  /**
   * @inheritDoc
   */
  public function getSrcSet(): ?string {
    $srcSet = $this->getImageSizes();

    if(is_array($srcSet) && !empty($srcSet)) {
      foreach($srcSet as $size) {
        $srcSet[] = $this->getWpImage($this->imageId, $size);
      }
      return $this->getSrcSetString($srcSet);
    }
    return null;
  }

  /**
   * Factory method to create an image object
   * 
   * @param int $imageId      The WordPress ID of the image
   * @param array $imageSize  Width and height of the image
   * 
   * @return ImageInterface
   */
  public function factory($imageId, $imageSize): ImageInterface
  {
    if ($this->isWordPress()) {

      if(!isset($imageSize[0]) || !isset($imageSize[1])) {
        throw new \Exception('Image size must be an array with width and height.');
      }

      if(!is_int($imageSize[0])) {
        throw new \Exception('Image size must be an array width at least a integer representing width.');
      }

      return new self($imageId, $imageSize); 
    }
  }

  /**
   * Get the image srcset as a string
   * 
   * @param array $srcSet The srcset array
   * 
   * @return string
   */
  private function getSrcSetString($srcSet): string {
    return implode(', ', array_map(function($src) {
      return $src[0] . ' ' . $src[1] . 'w';
    }, $srcSet));
  }

  private function getImageSizes(): array {
    $sizes = [];
    
    // Minimum and maximum width
    $minWidth = $this->minimumDimension;
    $maxWidth = $this->imageSize[0]; // Provided image size width

    // Calculate the total range between the minimum and maximum width
    $range = $maxWidth - $minWidth;

    // Determine the possible number of sizes to generate based on the range and allowed differences
    // The step size must respect the minimum and maximum difference
    $idealStepSize = $range / ($this->numberOfSizes[1] - 1); // Ideal step size for maximum number of sizes
    $stepSize = max($this->minimumDifferance, min($idealStepSize, $this->maxiumDifference));

    // Calculate how many sizes we can generate with this step size
    $numSizes = floor($range / $stepSize) + 1;

    // Ensure the number of sizes is within the allowed range (min/max)
    $numSizes = min(max($numSizes, $this->numberOfSizes[0]), $this->numberOfSizes[1]);

    // Add the minimum dimension as the first size
    $sizes[] = [$minWidth, $minWidth . 'w'];

    // Generate the intermediate sizes
    for ($i = 1; $i < $numSizes - 1; $i++) {
        $currentSize = $minWidth + round($i * $stepSize);

        // Ensure the size is at least $minimumDifferance apart from the previous size
        if (count($sizes) > 0 && ($currentSize - $sizes[count($sizes) - 1][0]) < $this->minimumDifferance) {
            continue; // Skip this size if the difference is too small
        }

        // Add the size
        $sizes[] = [$currentSize, $currentSize . 'w'];
    }

    // Add the maxWidth as the last size
    $sizes[] = [$maxWidth, $maxWidth . 'w'];

    return $sizes;
  }

  /**
   * Get the image srcset
   * 
   * @return string
   */
  private function getWpImage($id, $imageSize): array
  {
    return wp_get_attachment_image_src(
      $id, 
      $imageSize
    );
  }

  /**
   * Get the image metadata
   * 
   * @return array
   */
  private function getWpImageMetaData($id): array
  {
    return wp_get_attachment_metadata($id);
  }

  /**
   * Check that the environment is WordPress
   * 
   * @return bool
   */
  private function isWordPress(): bool {
    if (defined('ABSPATH')) {
      return true;
    }
    throw new \Exception('Can not detect WordPress environment.');
  }
}