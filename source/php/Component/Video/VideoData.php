<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Video;
final class VideoData { public function __construct(public bool $hasControls = true, public bool $isMuted = false, public bool $shouldAutoplay = false, public string $errorMessage = 'This component is not supported by your browser.', public array $formats = [], public int $height = 300, public int $width = 600, public bool $subtitles = false) {} }
