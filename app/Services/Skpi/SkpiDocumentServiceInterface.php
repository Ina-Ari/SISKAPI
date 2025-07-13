<?php

namespace App\Services\Skpi;

use Illuminate\Http\UploadedFile;

interface SkpiDocumentServiceInterface
{
    public function uploadTemplate(UploadedFile $file, array $data): string;
    public function fillTemplate(string $templateFullPath, string $savePath, string $nim, array $singleData, array $numberingData = []): string;
    public function convertToPDF(string $docxPath, string $savePath, string $filename = null): string;
}
