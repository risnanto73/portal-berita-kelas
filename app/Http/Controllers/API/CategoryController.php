<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $category = Category::latest()->paginate('10');

            if ($category) {
                return ResponseFormatter::success($category, 'Data category berhasil diambil');
            } else {
                return ResponseFormatter::error(null, 'Data category tidak ada', 404);
            }
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error'   => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function create(Request $request)
    {
        try {
            //validate request
            $this->validate($request, [
                'name'  => 'required|string|max:255',
                'image' => 'required|mimes:png,jpg,jpeg'
            ]);

            $image = $request->file('image');
            $image->storeAs('public/categories', $image->hashName());

            // use Illuminate\Support\Str;
            $category = Category::create([
                'name'  => $request->name,
                'slug'  => Str::slug($request->name, '-'),
                'image' => $image->hashName()
            ]);

            if ($category) {
                return ResponseFormatter::success($category, 'Data category berhasil ditambahkan');
            } else {
                return ResponseFormatter::error(null, 'Data category gagal ditambahkan', 404);
            }
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'data'      => null,
                'message' => 'Data gagal ditambahkan',
                'error'   => $error
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrfail($id);
            //delete image
            Storage::disk('local')->delete('public/categories/' . basename($category->image));
            //delete data
            $category->delete();

            if ($category) {
                return ResponseFormatter::success($category, 'Data category berhasil dihapus');
            } else {
                return ResponseFormatter::error(null, 'Data category tidak ada', 404);
            }
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'data'      => null,
                'message' => 'Data gagal dihapus',
                'error'   => $error
            ]);
        }
    }

    //update data
    public function update(Request $request, $id)
    {
        try {
            //validate request
            $this->validate($request, [
                'name'  => 'required|string|max:255',
                'image' => 'required|mimes:png,jpg,jpeg'
            ]);

            $category = Category::findOrfail($id);

            if ($request->file('image')) {
                //delete old image
                Storage::disk('local')->delete('public/categories/' . basename($category->image));
                //upload new image
                $image = $request->file('image');
                $image->storeAs('public/categories', $image->hashName());
                //update data
                $category->update([
                    'name'  => $request->name,
                    'slug'  => Str::slug($request->name, '-'),
                    'image' => $image->hashName()
                ]);
            } else {
                //update data
                $category->update([
                    'name'  => $request->name,
                    'slug'  => Str::slug($request->name, '-')
                ]);
            }

            if ($category) {
                return ResponseFormatter::success($category, 'Data category berhasil diupdate');
            } else {
                return ResponseFormatter::error(null, 'Data category tidak ada', 404);
            }
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'data'      => null,
                'message' => 'Data gagal diupdate',
                'error'   => $error
            ]);
        }
    }
}
