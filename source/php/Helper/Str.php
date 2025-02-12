<?php
namespace ComponentLibrary\Helper;

class Str
{
  /**
   * Truncate a string to a certain length and append an
   * ellipsis if the string is longer than the specified length.
   * 
   * @param string $string The string to truncate
   * 
   * @return string The truncated string
   */
    public static function truncateSentence($string): string
    {
      $firstPunctuation = strpbrk($string, '.,;:!?');
      if ($firstPunctuation !== false) {
        $truncatedString = substr($string, 0, strpos($string, $firstPunctuation) + 1);
      } else {
        $truncatedString = self::truncateWords($string, 15);
      }
      return $truncatedString;
    }

    /**
     * Truncate a string to a certain number of words.
     * 
     * @param string $string The string to truncate
     * 
     * @return string The truncated string
     */
    public static function truncateWords($string, $wordCount): string
    {
      $words = explode(' ', $string);
      if (count($words) > $wordCount) {
        $truncatedString = implode(' ', array_slice($words, 0, $wordCount));
      } else {
        $truncatedString = $string;
      }

      if($string !== $truncatedString){
        $truncatedString .= '…';
      }

      return $truncatedString;
    }
}
