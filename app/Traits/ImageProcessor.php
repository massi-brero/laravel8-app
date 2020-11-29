<?php


namespace App\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

trait ImageProcessor
{
    private $orientationLandscape = 0;
    private $orientationPortrait = 1;

    private $imageTypeSubFolder = 'various';
    private $imageFormats;
    private $savePath;

    private function processImage(Request $request): void
    {
        if ($request->bild) {
            $image = Image::make($request->bild);
            $width = $image->width();
            $height = $image->height();

            $this->makeAndStoreImages($width, $height, $request);
        }
    }

    /**
     * @param Request $request
     * @param string $id
     */
    public function setImageBasepath(Request $request, string $id): void
    {
        $this->imageTypeSubFolder = explode('/',$request->path())[0] ?? $this->imageTypeSubFolder;
        $this->savePath =  public_path() . '/img/' . $this->imageTypeSubFolder . '/' . $id;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProcessedImages()
    {
        foreach (glob($this->savePath . '*.*') as $filePath) {
            unlink($filePath);
        }
    }

    /**
     * @param $path
     * @return string
     */
    private function getPixelatedImageName(string $path): string
    {
        $explPath = explode('.', $path);
        $filename = $explPath[sizeof($explPath) - 2];
        $explPath[sizeof($explPath) - 2] = $filename . '_pixelated';
        $pixelatedPath = implode('.', $explPath);
        return $pixelatedPath;
    }

    public function setImageFormats(array $imageFormats)
    {
        $this->imageFormats = $imageFormats;
    }

    /**
     * replace with configuration solution
     *
     * @param string $basePath
     * @return \array[][]
     */
    private function getImageFormats(): array
    {
        return $this->imageFormats;
    }

    /**
     * @param int $width
     * @param int $height
     * @param array $formats
     * @param Request $request
     */
    private function makeAndStoreImages(int $width, int $height, Request $request): void
    {
        $orientation = $width > $height ? $this->orientationLandscape : $this->orientationPortrait;;
        $formats = $this->getImageFormats();

        foreach ($formats[$orientation] as $format) {
            $newImage = Image::make($request->bild);
            if ($orientation === $this->orientationLandscape) {
                $newImage->widen($format['base_size']);
            } else {
                $newImage->heighten($format['base_size']);
            }
            $newImage->save($this->savePath . $format['imgName']);
            $pixelatedPath = $this->getPixelatedImageName($this->savePath . $format['imgName']);
            $newImage->pixelate(16)
                     ->save($pixelatedPath);
        }
    }
}
