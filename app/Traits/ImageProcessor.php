<?php


namespace App\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

trait ImageProcessor
{
    private $savePath = 'various';

    private function processImage(Request $request, array $formats): void
    {

        if ($request->bild) {
            $image = Image::make($request->bild);
            $width = $image->width();
            $height = $image->height();

            $orientation = $width > $height ? self::ORIENTATION_LANDSCAPE : self::ORIENTATION_PORTRAIT;;

            foreach ($formats[$orientation] as $format) {
                $newImage = Image::make($request->bild);
                if ($orientation === self::ORIENTATION_LANDSCAPE) {
                    $newImage->widen($format['base_size']);
                } else {
                    $newImage->heighten($format['base_size']);
                }
                $newImage->save($format['path']);
                $pixelatedPath = $this->getPixelated($format['path']);
                $newImage->pixelate(16)
                         ->save($pixelatedPath);
            }
        }
    }

    /**
     * @param string $id
     * @return string
     */
    public function getBasepath(Request $request, string $id): string
    {
        $this->savePath = explode('/',$request->path())[0] ?? $this->savePath;
        return public_path() . '/img/' . $this->savePath . '/' . $id;
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteImages(int $id)
    {
        foreach (glob($this->getBasepath($id) . '*.*') as $filePath) {
            unlink($filePath);
        }
        return back();
    }

    /**
     * @param $path
     * @return string
     */
    private function getPixelated(string $path): string
    {
        $explPath = explode('.', $path);
        $filename = $explPath[sizeof($explPath) - 2];
        $explPath[sizeof($explPath) - 2] = $filename . '_pixelated';
        $pixelatedPath = implode('.', $explPath);
        return $pixelatedPath;
    }
}
