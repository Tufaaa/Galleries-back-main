<?php

namespace App\Service;

use App\Models\Galleries;
use Illuminate\Http\Request;


class GalleriesService
{

    public function showGalleries(Request $request)
    {
        $name = $request->input('name');

        $query = Galleries::query();

        if ($name) {
            $query->searchByName($name);
        }

        $galleries = $query->with('user')->orderBy('created_at', 'DESC')->paginate(10);

        return $galleries;
    }


    public function postGallery(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:255|string',
            'description' => 'max:1000',
            'urls' => 'required|array',
            'user_id' => 'required|exists:users,id',
        ]);

        $gallery = new Galleries();

        $gallery->name = $request->name;
        $gallery->description = $request->description;
        $gallery->urls = json_encode($request->urls);
        $gallery->user_id = $request->user_id;

        $gallery->save();

        return $gallery;
    }

    public function showGallery($id)
    {
        $gallery = Galleries::with('user', 'comments')->find($id);
        return $gallery;
    }


    public function editGallery(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:2|max:255|string',
            'description' => 'max:1000',
            'urls' => 'required',
        ]);

        $gallery = Galleries::find($id);

        $gallery->name = $request->name;
        $gallery->description = $request->description;
        $gallery->urls = $request->urls;
        $gallery->save();

        return $gallery;
    }

    public function deleteGallery($id)
    {
        Galleries::destroy($id);
    }
}
