<?php 

namespace ComponentLibrary\Image;


class Image implements ImageInterface {
  private int $minimumDimension = 500; // Minimum width for the image
  private int $minimumDifferance = 200; // Minimum differance between the sizes
  private int $maxNumberOfSizes = 3; // Max number of sizes to generate for the srcset

  public function __construct(private int $imageId, private array $imageSize) {
      $this->imageId = $imageId;
      $this->imageSize = $imageSize;
  }

  public function getUrl(): string {
    return ""; 
  }

  public function getSrcSet(): string {
    return ""; 
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
        throw new \Exception('Image size must be an array width atleast a integer representing width.');
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
    return "";
  }

  private function getImageSizes() {

    $imageSizeMax = $this->imageSize[0];
    
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