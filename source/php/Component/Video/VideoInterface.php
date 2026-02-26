<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Video;

use ComponentLibrary\Component\ComponentInterface;

interface VideoInterface extends ComponentInterface
{
    /**
     * Adds UI controls for play and pause.
     */
    public function getHasControls(): bool;

    /**
     * If there should be audio enabled.
     */
    public function getIsMuted(): bool;

    /**
     * If the video should start automatically (requires isMuted).
     */
    public function getShouldAutoplay(): bool;

    /**
     * A message to display when video is not supported.
     */
    public function getErrorMessage(): string;

    /**
     * Array of formats.
     */
    public function getFormats(): array;

    /**
     * Initial height of video.
     */
    public function getHeight(): int;

    /**
     * Initial width of video.
     */
    public function getWidth(): int;

    /**
     * Array of subtitles for video.
     */
    public function getSubtitles(): bool;

}
