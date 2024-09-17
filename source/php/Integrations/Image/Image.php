<?php 

namespace ComponentLibrary\Image;

class Image implements ImageInterface {
  private int $minimumDimension = 500; // Minimum width for the image, no sizes will be generated below this figure
  private int $minimumDifferance = 200; // Minimum differance between the sizes, if difference is smaller, less sizes will be generated
  private int $maxiumDifference = 400; // Maximum differance between the sizes, if difference is larger, more sizes will be generated
  private array $numberOfSizes = [3, 6]; // Number of sizes to generate. [min, max]

  private mixed $resolver; // The callable that resolves the image in the native system

  public function __construct(
    private int $imageId, 
    private array $imageSize, 
    callable $resolver,
  ) {
    $this->imageId = $imageId;
    $this->imageSize = $imageSize;

    if($this->verifyCallableSignature($resolver) === true) {
      $this->resolver = $resolver;  
    }
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

      // Check the return type
      if ($reflection->getReturnType() !== 'string') {
        throw new \InvalidArgumentException('The callable must return an string with the url of the image asset.');
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
    $srcSet = $this->getImageSizes();
    if(is_array($srcSet) && !empty($srcSet)) {
      foreach($srcSet as $size) {
        $srcSet[] = [$size, call_user_func($this->resolver, $this->imageId, $size)];
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
  public function factory(int $imageId, array $imageSize, callable $resolver): ImageInterface
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

  /**
   * Get the image sizes
   * 
   * @return array
   */
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
}