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

        $this->data['acceptedFilesList'] = $this->createAcceptedFilesList($accept);

        // Indicate multiple or not
        $this->data['attributeList']['data-js-file-is-multi'] = $multiple;

        // Set class empty
        $this->data['classList'][] = "is-empty";

        // Set required attribute
        $this->data['required'] = $required ?? false;
    }

    private function createAcceptedFilesList($accept): string
    {
        if (!is_string($accept)) {
            return $accept;
        }

        return( $this->data['lang']->allowedFiles ?? 'Allowed files') . ': ' . implode(' ', array_map(function($type) {
            if ($type === "video/*") return $this->data['lang']->videos ?? "Videos";
            if ($type === "image/*") return $this->data['lang']->images ?? "Images";
            if ($type === "audio/*") return $this->data['lang']->audios ?? "Audios";
            return $type;
        }, explode(',', $accept)));
    }
}
