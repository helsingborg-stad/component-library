<?php

namespace ComponentLibrary\Component\Imageinput;

class Imageinput extends \ComponentLibrary\Component\BaseController implements ImageinputInterface
{
    private $unpassable = ['class', 'attribute'];

    public function init()
    {
        //Remove keys that is not passable to child component
        $passDownData = $this->data ?? []; 

        foreach ($this->unpassable as $key) {
            unset($passDownData[$key]);
        }
        
        $this->data['accept'] = (function ($accept) {
            is_string($accept) && $accept = explode(',', $accept);
            $accept = (array) $accept;
            $accept = array_filter($accept, fn($mime) => str_contains($mime, 'image'));
        
            return implode(',', $accept);
        })($this->data['accept'] ?? []);

        //Map all data to data key (passtrough component)
        $this->data['passDownData'] = $passDownData;
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'imageinput';
    }

    // -------------------------------------------------------------------------
    // ImageinputInterface — generated getters
    // -------------------------------------------------------------------------

    public function getDescription(): string
    {
        return $this->data['description'] ?? '';
    }

    public function getAccept(): string
    {
        return $this->data['accept'] ?? 'audio/*,video/*,image/*';
    }

    public function getMultiple(): bool
    {
        return $this->data['multiple'] ?? false;
    }

    public function getPreview(): bool
    {
        return $this->data['preview'] ?? true;
    }

    public function getMaxSize(): string|int
    {
        return $this->data['maxSize'] ?? null;
    }

    public function getUploadErrorMessage(): string
    {
        return $this->data['uploadErrorMessage'] ?? null;
    }

    public function getUploadErrorMessageMinFiles(): string
    {
        return $this->data['uploadErrorMessageMinFiles'] ?? null;
    }

    public function getIcon(): string
    {
        return $this->data['icon'] ?? 'file_upload';
    }

    public function getRequired(): bool
    {
        return $this->data['required'] ?? false;
    }

    public function getFilesMax(): int
    {
        return $this->data['filesMax'] ?? 1;
    }

    public function getFilesMin(): int
    {
        return $this->data['filesMin'] ?? 0;
    }

    public function getLabel(): string
    {
        return $this->data['label'] ?? '';
    }

    public function getButtonLabel(): string
    {
        return $this->data['buttonLabel'] ?? 'Select file';
    }

    public function getButtonRemoveLabel(): string
    {
        return $this->data['buttonRemoveLabel'] ?? 'Remove file';
    }

    public function getButtonDropLabel(): string
    {
        return $this->data['buttonDropLabel'] ?? 'Drop files here';
    }

    public function getAllowedFileTypesLabel(): string
    {
        return $this->data['allowedFileTypesLabel'] ?? 'Allowed files: ';
    }

    public function getFileTypeVideosLabel(): string
    {
        return $this->data['fileTypeVideosLabel'] ?? 'Videos';
    }

    public function getFileTypeImagesLabel(): string
    {
        return $this->data['fileTypeImagesLabel'] ?? 'Images';
    }

    public function getFileTypeAudioLabel(): string
    {
        return $this->data['fileTypeAudioLabel'] ?? 'Audios';
    }

    public function getMaximumSizeLabel(): string
    {
        return $this->data['maximumSizeLabel'] ?? 'Maximum size';
    }
}
