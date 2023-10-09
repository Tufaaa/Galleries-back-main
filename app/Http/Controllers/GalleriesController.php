<?php

namespace App\Http\Controllers;

use App\Service\GalleriesService;
use Illuminate\Http\Request;

class GalleriesController extends Controller
{
    public GalleriesService $galleryService;

    public function __construct(GalleriesService $galleryService)
    {
        $this->galleryService = $galleryService;
        $this->middleware('auth:api')->only(['store', 'update', 'destroy']);
    }
   
    public function index(Request $request)
    {
        $galleries = $this->galleryService->showGalleries($request);

        return $galleries;
    }


    public function store(Request $request)
    {
        $gallery = $this->galleryService->postGallery($request);

        return $gallery;
    }

    public function show(string $id)
    {
        $gallery = $this->galleryService->showGallery($id);

        return $gallery;
    }
 
    public function update(Request $request, string $id)
    {
        $gallery = $this->galleryService->editGallery($request, $id);

        return $gallery;
    }

  
    public function destroy(string $id)
    {
        $gallery = $this->galleryService->deleteGallery($id);

        return $gallery;
    }
}
