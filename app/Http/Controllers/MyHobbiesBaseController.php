<?php


namespace App\Http\Controllers;


use App\Traits\ImageProcessor;
use Illuminate\Http\Request;

class MyHobbiesBaseController extends Controller
{

    use ImageProcessor;

    /**
     * @param Request $request
     * @param int $id
     * @param string $entity
     */
    public function saveImages(Request $request, int $id, string $entity): void
    {
        $this->setImageBasepath($request, $id);
        $this->setImageFormats(\Config::get('constants.images.formats.' . $entity));
        $this->processImage($request);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteImages(Request $request, int $id)
    {
        $this->setImageBasepath($request, $id);
        $this->deleteProcessedImages();
        return back();
    }
}
