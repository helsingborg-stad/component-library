<?php

namespace ComponentLibrary\Component\Fileinput;

class Fileinput extends \ComponentLibrary\Component\BaseController
{
    private $filesMax = 50;

    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if(empty($this->data['id']) ) {
            $this->data['id'] = $this->sanitizeIdAttribute(uniqid());
        }

        // Set as dropzone
        $this->data['attributeList']['data-js-file'] = "dropzone";

        // Set 10 as default max files, when multiple
        if($multiple) {
            $this->data['filesMax'] = $filesMax = $filesMax != 1 ? $filesMax : 10;
            $this->data['attributeList']['data-js-file-max'] = $filesMax;
        }

        // If multiple is false, set max files to 1
        if(!$multiple) {
            $this->data['filesMax'] = 1;
            $this->data['attributeList']['data-js-file-max'] = 1;
        }

        // Do not allow -1 as max files, or more than $this->filesMax
        if($multiple && ($filesMax == -1 || $filesMax > $this->filesMax)) {
            $this->data['filesMax'] = $this->filesMax;
            $this->data['attributeList']['data-js-file-max'] = $this->filesMax;
        }

        $acceptedTypesArray = is_array($accept) ? $accept : explode(',', $accept);
        $this->data['acceptedFilesList'] = $this->createAcceptedFilesList($acceptedTypesArray);
        
        $maxFileSize = $this->determineMaxSize($maxSize, $acceptedTypesArray);

        if ($maxFileSize) {
            $this->data['attributeList']['data-js-file-max-size'] = $maxFileSize;
        }

        // Indicate multiple or not
        $this->data['attributeList']['data-js-file-is-multi'] = $multiple;


        // Set class empty
        $this->data['classList'][] = "is-empty";

        // Set required attribute
        $this->data['required'] = $required ?? false;
    }

    private function determineMaxSize(int|string $maxSize, array $accept): ?string
    {
        // If numeric, return as is
        if (is_numeric($maxSize)) {
            return (string)$maxSize;
        }

        // Define category size limits in MB
        $sizePresets = [
            'video' => [
                'small' => '10',
                'medium' => '30',
                'large' => '50',
            ],
            'audio' => [
                'small' => '5',
                'medium' => '10',
                'large' => '15',
            ],
            'image' => [
                'small' => '2',
                'medium' => '5',
                'large' => '10',
            ],
            'document' => [
                'small' => '1',
                'medium' => '5',
                'large' => '10',
            ],
        ];

        $videoTypes = ['video/', 'mov', 'webm', 'mp4'];
        $audioTypes = ['audio/', 'mp3', 'ogg', 'aac'];
        $imageTypes = ['image/', 'jpg', 'jpeg', 'png', 'gif'];
        $documentTypes = ['doc', 'docx', 'xls', 'xlsx', 'pdf'];

        // Check if any of $accept items are in videoTypes, etc.
        if (count(array_intersect($accept, $videoTypes)) > 0) {
            return $sizePresets['video'][$maxSize] ?? $sizePresets['video']['large'];
        } 
        if (count(array_intersect($accept, $audioTypes)) > 0) {
            return $sizePresets['audio'][$maxSize] ?? $sizePresets['audio']['large'];
        }
        if (count(array_intersect($accept, $imageTypes)) > 0) {
            return $sizePresets['image'][$maxSize] ?? $sizePresets['image']['large'];
        }
        if (count(array_intersect($accept, $documentTypes)) > 0) {
            return $sizePresets['document'][$maxSize] ?? $sizePresets['document']['large'];
        }

        return null;
    }



    private function createAcceptedFilesList(array $accept): string
    {
        return( $this->data['lang']->allowedFiles ?? 'Allowed files') . ': ' . implode(' ', array_map(function($type) {
            if ($type === "video/*") return $this->data['lang']->videos ?? "Videos";
            if ($type === "image/*") return $this->data['lang']->images ?? "Images";
            if ($type === "audio/*") return $this->data['lang']->audios ?? "Audios";
            return $type;
        }, $accept));
    }
}
