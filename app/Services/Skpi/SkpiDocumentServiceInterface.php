<?php

namespace App\Services\Skpi;

use Illuminate\Http\UploadedFile;

interface SkpiDocumentServiceInterface
{
    public function uploadTemplate(UploadedFile $file): string;
    public function fillTemplate(string $nim, array $singleData, array $numberingData = []): string;
    public function convertToPDF(string $docxPath, string $templatePath, string $filename = null): string;
}
