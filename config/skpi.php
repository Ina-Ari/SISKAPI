<?php

return [
    'prefix' => 'skpi_',
    'save_path' => 'skpi/',
    'final_path' => 'skpi/final/',
    'temp_path' => storage_path('app/temp/'),
    'template' => [
        'prefix' => 'skpi_template_',
        'generate' => [
            'path' => 'docs/',
            'extension' => '.docx'
        ],
        'preview' => [
            'path' => 'pdf/',
            'extension' => '.pdf',
        ],
    ]
];
