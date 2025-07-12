<?php

namespace App\Services\Skpi;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;

class SkpiDocumentService implements SkpiDocumentServiceInterface
{
    public function uploadTemplate(UploadedFile $file, array $data): string
    {
        $filename = config('skpi.template.prefix') . $data['kode_prodi'] . config('skpi.template.generate.extension');
        $path = $file->storeAs(
            trim(config('skpi.template.generate.path'), '/\\'),
            $filename,
            'local'
        );

        $templatePath = Storage::disk('local')->path($path);

        Settings::setTempDir(config('skpi.temp_path'));

        $templateProcessor = new TemplateProcessor($templatePath);
        $templateProcessor->setValues($data);
        $templateProcessor->saveAs($templatePath);

        $previewTemplatePath = Storage::disk('public')->path(config('skpi.template.preview.path'));

        $this->convertToPDF($templatePath, $previewTemplatePath, str_replace('.docx', '.pdf', $filename));

        return $templatePath;
    }

    public function fillTemplate(string $templateFullPath, string $savePath, string $nim, array $singleData, array $numberingData = []): string
    {
        $saveFilename = config('skpi.prefix') . $nim . '.docx';
        $saveFullPath = $savePath . $saveFilename;

        Settings::setTempDir(config('skpi.temp_path'));

        $templateProcessor = new TemplateProcessor($templateFullPath);

        if ($numberingData) {
            foreach ($numberingData as $blockName => $data) {
                $this->injectNumberingData($templateProcessor, $blockName, $data);
            }
        }

        foreach ($singleData as $key => $value) {
            $this->injectSingleData($templateProcessor, $key, $value);
        }

        $templateProcessor->saveAs($saveFullPath);

        return $saveFullPath;
    }

    private function injectSingleData(TemplateProcessor $templateProcessor, string $key, string $value): void
    {
        $templateProcessor->setValue($key, htmlspecialchars(ucwords($value)));
    }

    private function injectNumberingData(TemplateProcessor $templateProcessor, string $blockName, array $items): void
    {
        $data = collect($items)->map(function ($item) {
            return [
                'data' => htmlspecialchars(ucfirst($item))
            ];
        })->toArray();

        $templateProcessor->cloneBlock($blockName, 0, true, false, $data);
    }

    public function convertToPDF(string $docxPath, string $savePath, ?string $filename = null): string
    {
        $command = 'soffice --headless --convert-to pdf --outdir ' . escapeshellarg($savePath) . ' ' . escapeshellarg($docxPath);
        exec($command);

        return $savePath . $filename;
    }
}
