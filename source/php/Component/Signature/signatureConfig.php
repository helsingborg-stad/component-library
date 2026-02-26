<?php

return [
    'slug' => 'signature',
    'default' => (object) [
        'author' => '',
        'authorRole' => '',
        'avatar' => '',
        'avatar_size' => 'md',
        'published' => '',
        'updated' => '',
        'link' => '',
        'updatedLabel' => 'Updated',
        'publishedLabel' => 'Published',
        'placeholderAvatar' => true,
    ],
    'description' => [
        'author' => 'The name of the  author',
        'authorRole' => 'Byline of the aythors name. Usally what role the user has related to the page.',
        'avatar' => 'Link to an image',
        'avatar_size' => 'Size of the avatar',
        'published' => 'A formatted published date',
        'updated' => 'A formatted update date',
        'link' => 'Links the whole component to another place.',
        'updatedLabel' => 'Label text updated.',
        'publishedLabel' => 'Label text published.',
        'placeholderAvatar' => 'If there should be a placeholder avatar.',
    ],
    'view' => 'signature.blade.php',
];
