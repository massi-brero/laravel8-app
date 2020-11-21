<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class HobbyController extends Controller
{

    const ORIENTATION_LANDSCAPE = 0;
    const ORIENTATION_PORTRAIT = 1;

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $hobbies = Hobby::orderBy('created_at', 'DESC')->paginate(10);
        return view('hobby.index')->with([
            'hobbies' => $hobbies,
            'meldg_success' => Session::get('meldg_success')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('hobby.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => 'required|min:5',
                'beschreibung' => 'required|min:5',
                'user_id' => 'exists:user,id',
                'bild' => 'mimes:jpg,jpeg,png,bmp,gif'
            ]
        );
        //$this->processImage($hobby, $request);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $hobby = new Hobby(
            $data
        );
        $hobby->save();

        return redirect('/hobby/' . $hobby->id)->with('meldg_hinweis', 'Bitte weise ein paar Tags zu ');

    }

    /**
     * @param Hobby $hobby
     * @return View
     */
    public function show(Hobby $hobby): View
    {
        $allTags = Tag::all();

        return view('hobby.show')->with([
            'hobby' => $hobby,
            'meldg_success' => Session::get('meldg_success'),
            'meldg_hinweis' => Session::get('meldg_hinweis'),
            'verfuegbareTags' => $allTags->diff($hobby->tags)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Hobby $hobby
     * @return View
     */
    public function edit(Hobby $hobby): View
    {
        return view('hobby.edit')->with('hobby', $hobby);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Hobby $hobby
     * @return View
     */
    public function update(Request $request, Hobby $hobby): View
    {
        $request->validate(
            [
                'name' => 'required|min:5',
                'beschreibung' => 'required|min:5',
                'bild' => 'mimes:jpg,jpeg,png,bmp,gif'
            ]
        );

        $this->processImage($hobby, $request);

        $hobby->update(
            $request->all()
        );

        return $this->index()->with([
            'meldg_success' => 'Das Hobby ' . $request->name . ' wurde aktualisiert!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Hobby $hobby
     * @return View
     * @throws \Exception
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function destroy(Hobby $hobby): RedirectResponse
    {
        $hobbyName = $hobby->name;
        $hobby->delete();

        return back()->with([
            'meldg_success' => 'Das Hobby ' . $hobbyName . ' wurde gelöscht!'
        ]);
    }

    public function deleteImages(int $hobbyId)
    {
        foreach (glob($this->getBasepath($hobbyId) . '*.*') as $filePath) {
            unlink($filePath);
        }
        return back();
    }

    private function processImage(Hobby $hobby, Request $request): void
    {
        $basePath = $this->getBasepath($hobby->id);
        $formats = $this->getImageFormats($basePath);

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

    /**
     * @param string $hobbyId
     * @return string
     */
    private function getBasepath(string $hobbyId): string
    {
        $basePath = public_path() . '/img/hobby/' . $hobbyId;
        return $basePath;
    }

    /**
     * @param string $basePath
     * @return \array[][]
     */
    private function getImageFormats(string $basePath): array
    {
        $formats = [
            self::ORIENTATION_LANDSCAPE => [
                [
                    'base_size' => 1200,
                    'path' => $basePath . '_landscape_big.jpg',
                ],
                [
                    'base_size' => 60,
                    'path' => $basePath . '_landscape_thumb.jpg',
                ]
            ],
            self::ORIENTATION_PORTRAIT => [
                [
                    'base_size' => 900,
                    'path' => $basePath . '_portrait_big.jpg',
                ],
                [
                    'base_size' => 60,
                    'path' => $basePath . '_portrait_thumb.jpg',
                ]
            ]
        ];
        return $formats;
    }
}
