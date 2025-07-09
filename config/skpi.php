<?php

return [
    'prefix' => 'skpi_',
    'save_path' => 'skpi/',
    'temp_path' => storage_path('app/temp/'),
    'template' => [
        'generate' => [
            'filename' => 'skpi_template.docx',
            'path' => 'docs/',
        ],
        'preview' => [
            'filename' => 'skpi_template.pdf',
            'path' => 'pdf/',
        ]
    ]
];
