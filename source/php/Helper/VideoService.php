<?php
namespace ComponentLibrary\Helper;

class VideoService
{
    protected $url;
    private $imageLocations = [
        'youtube'   => 'https://img.youtube.com/vi/%s/maxresdefault.jpg',
        'vimeo'     => 'https://vumbnail.com/%s.jpg'
    ];
    
    public function __construct(string $url)
    {
        $this->url = $url;
    }
    
    /**
     * It checks if the url contains the string 'vimeo' or 'youtu' and returns the service name if it
     * does
     *
     * @param string url The url of the video
     *
     * @return A string of the video service name.
     */
    public function detectVideoService(string $url = null)
    {
        $url = $this->getUrl($url);
        
        if (str_contains($url, 'vimeo')) {
            return 'vimeo';
        }
        if (str_contains($url, 'youtu')) { //Matches youtu.be and full domain
            return 'youtube';
        }
        
        return false;
    }
   /**
    * > This function returns the url if it's not empty, otherwise it returns the url property
    * 
    * @param string url The URL to the API.
    * 
    * @return The url property of the object.
    */
    private function getUrl(string $url = null) {
        if(empty($url)) {
            return $this->url;
        }
        return $url;
    }
   /**
    * It gets the video id from the url.
    * 
    * @param string url The url of the video. If not provided, the url will be taken from the request.
    * @param string videoService The video service you want to use. If you don't specify one, it will
    * try to detect it.
    * 
    * @return The video ID is being returned.
    */
    public function getVideoId(string $url = null, string $videoService = null)
    {
        $url = $this->getUrl($url);
        
        if(empty($videoService)) {
            $videoService = $this->detectVideoService($url);
        }
        
        if ($videoService == 'youtube') {
            return $this->parseYoutubeId($url);
        }

        if ($videoService == 'vimeo') {
            return $this->parseVimeoId($url);
        }

        return false;
    }

    /**
     * Get youtube id from embed url
     *
     * @param  string $url    The embed link
     * @return string $id           The id in embed link
     */
    private function parseYoutubeId(string $url = null)
    {
        
        $url = $this->getUrl($url);
        
        if(empty($url)) {
            return;
        }
        
        $urlParts = parse_url($url);
        $hostname = $urlParts['host'];
        
        //https://youtu.be/ID
        if ($hostname == 'youtu.be') {
            return trim(rtrim(parse_url($url, PHP_URL_PATH), "/"), "/");
        }
        
        //https://www.youtube.com/embed/ID
        if (str_contains($urlParts['path'], 'embed')) {
            return trim(rtrim(str_replace('/embed/', '', $urlParts['path'])));
        }
        
        //https://www.youtube.com/watch?v=ID
        parse_str(
            parse_url($url, PHP_URL_QUERY),
            $queryParameters
        );
        if (isset($queryParameters['v']) && !empty($queryParameters['v'])) {
            return $queryParameters['v'];
        }
        

        return false;
    }

    /**
     * Get vimeo id from embed url
     *
     * @param  string $url    The embed link
     * @return string $id           The id in embed link
     */
    private function parseVimeoId(string $url = null)
    {
        $url = $this->getUrl($url);
        if(empty($url)) {
            return;
        }
        $parts = explode('/', $url);

        if (is_array($parts) & !empty($parts)) {
            foreach ($parts as $part) {
                if (is_numeric($part)) {
                    return $part;
                }
            }
        }
        return false;
    }
    
   /**
    * It takes a video service and a video id, and returns the url of the video's cover image
    * 
    * @param string id The video ID.
    * @param string videoService The video service you want to get the cover image for.
    * 
    * @return The cover image url for the video.
    */
    public function getCoverUrl(string $id = null, string $videoService = null)
    {
        if (empty($videoService) || empty($id)) {
            $url = $this->getUrl();
        }
        
        if(empty($videoService)) {
            $videoService = $this->detectVideoService($url);
        }
        
        if(empty($id)) {
            $id = $this->getVideoId($url);
        }
        
        if (isset($this->imageLocations[$videoService])) {
            return sprintf($this->imageLocations[$videoService], $id);
        }
        return false;
    }
}
