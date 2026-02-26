<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Fileinput;

use ComponentLibrary\Component\ComponentInterface;

interface FileinputInterface extends ComponentInterface
{
    /**
     * Additional description or instructions.
     */
    public function getDescription(): string;

    /**
     * What file types to accept. Use MIME types. Example: audio/*,video/*,image/*.
     */
    public function getAccept(): string;

    /**
     * Allow single or multiple files.
     */
    public function getMultiple(): bool;

    /**
     * Preview.
     */
    public function getPreview(): bool;

    /**
     * Maximum file size allowed in MB. Number (int) in bytes or string (small, medium, large). Default is null (no limit).
     */
    public function getMaxSize(): string|int;

    /**
     * Message to show when upload fails.
     */
    public function getUploadErrorMessage(): string;

    /**
     * Message to show when minimum number of files is not met.
     */
    public function getUploadErrorMessageMinFiles(): string;

    /**
     * @link:component/icon.
     */
    public function getIcon(): string;

    /**
     * If field is required.
     */
    public function getRequired(): bool;

    /**
     * Maximum number of files (int). Foced to 1 if multiple is false. Default 10 for multiple.
     */
    public function getFilesMax(): int;

    /**
     * Minimum number of files (int). Default is 0.
     */
    public function getFilesMin(): int;

    /**
     * Label to show on the field.
     */
    public function getLabel(): string;

    /**
     * What text to show on the button.
     */
    public function getButtonLabel(): string;

    /**
     * What text to show on the remove button.
     */
    public function getButtonRemoveLabel(): string;

    /**
     * A label for the drop area.
     */
    public function getButtonDropLabel(): string;

    /**
     * Label for allowed file types.
     */
    public function getAllowedFileTypesLabel(): string;

    /**
     * Label for video file types.
     */
    public function getFileTypeVideosLabel(): string;

    /**
     * Label for image file types.
     */
    public function getFileTypeImagesLabel(): string;

    /**
     * Label for audio file types.
     */
    public function getFileTypeAudioLabel(): string;

    /**
     * Maximum size.
     */
    public function getMaximumSizeLabel(): string;

}
