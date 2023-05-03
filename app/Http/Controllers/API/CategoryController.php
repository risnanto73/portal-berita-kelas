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
        try{
            $category = Category::latest()->paginate('10');
            return ResponseFormatter::success(
                data: $category,
                message: 'Data berhasil diambil'
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                data: null,
                message: 'Data gagal diambil'
            );
        }
    }

    public function show($slug)
    {
        try{
            $category = Category::where('slug', $slug)->first();
            return ResponseFormatter::success(
                data: $category,
                message: 'Data berhasil diambil'
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                data: null,
                message: 'Data gagal diambil'
            );
        }
    }

    public function store(Request $request)
    {
        try{
            $this->validate($request, [
                'name' => 'required|unique:categories|max:255',
                'image' => 'required|image|mimes:png,jpg,jpeg'
            ]);

            $image = $request->file('image');
            $image->storeAs('public/categories', $image->hashName());

            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'image' => $image->hashName()
            ]);

            return ResponseFormatter::success(
                data: $category,
                message: 'Data berhasil ditambahkan'
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                data: null,
                message: 'Data gagal ditambahkan'
            );
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $this->validate($request, [
                'name' => 'required|unique:categories|max:255',
                'image' => 'required|image|mimes:png,jpg,jpeg'
            ]);

            $category = Category::findOrFail($id);

            if($request->file('image')){
                if(Storage::exists('public/categories/'.$category->image)){
                    Storage::delete('public/categories/'.$category->image);
                }

                $image = $request->file('image');
                $image->storeAs('public/categories', $image->hashName());

                $category->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name, '-'),
                    'image' => $image->hashName()
                ]);
            } else {
                $category->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name, '-')
                ]);
            }

            return ResponseFormatter::success(
                data: $category,
                message: 'Data berhasil diupdate'
            );
            
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                data: null,
                message: 'Data gagal diupdate'
            );
        }
    }
}
