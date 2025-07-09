<?php

namespace App\Services\Skpi;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;

class SkpiDocumentService implements SkpiDocumentServiceInterface
{
    public function uploadTemplate(UploadedFile $file): string
    {
        $path = $file->storeAs(
            config('skpi.template.generate.path'),
            config('skpi.template.generate.filename'),
            'local');

        $templatePath = storage_path("app/$path");
        $previewTemplatePath = Storage::disk('public')->path(config('skpi.template.preview.path'));

        $this->convertToPDF($templatePath, $previewTemplatePath, config('skpi.template.preview.filename'));

        return $templatePath;
    }

    public function fillTemplate(string $nim, array $singleData, array $numberingData = []): string
    {
        $templatePath = Storage::disk('local')->path(
            config('skpi.template.generate.path') . config('skpi.template.generate.filename')
        );

        $savePath = Storage::disk('public')->path(config('skpi.save_path'));
        $saveFilename = config('skpi.prefix') . $nim . '.docx';
        $saveFullPath = $savePath . $saveFilename;

        Settings::setTempDir(config('skpi.temp_path'));

        $templateProcessor = new TemplateProcessor($templatePath);

        if ($numberingData) {
            foreach ($numberingData as $blockName => $data) {
                $this->injectNumberingData($templateProcessor, $blockName, $data);
            }
        }

        $templateProcessor->setValues($singleData);

        $templateProcessor->saveAs($saveFullPath);

        return $saveFullPath;
    }

    private function injectNumberingData(TemplateProcessor $templateProcessor, string $blockName, array $items): void
    {
        $data = collect($items)->map(function ($item, $index) {
            return [
                'i' => $index + 1,
                'data' => ucfirst($item)
            ];
        })->toArray();

        $templateProcessor->cloneBlock($blockName, 0, true, false, $data);
    }

    public function convertToPDF(string $docxPath, string $savePath, string $filename = null): string
    {
        $command = 'soffice --headless --convert-to pdf --outdir ' . escapeshellarg($savePath) . escapeshellarg($docxPath);
        exec($command, $output, $result);

        return $savePath . $filename;
    }
}
