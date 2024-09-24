<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImagesController extends Controller
{
    public function index()
    {
        $path = '/var/www/globaldrinks_usr/data/www/globaldrinkshub.com/uploads';
        //dd(public_path());
        // Path to the folder you want to display
        $folderPath = public_path('uploads');
        //$folderPath = 'https://globaldrinkshub.com/uploads';

        // Get list of files in the folder
        $files = File::files($folderPath);
        //dd($folderPath);
        return view('products.images', compact('files'));
    }

    public function remove(Request $request)
    {
        $imageName = $request->title;
        $imagePath = public_path('uploads/' . $imageName);

        if (File::exists($imagePath)) {
            // Delete the image file
            File::delete($imagePath);
            echo "Image $imageName deleted successfully.";
        } else {
            echo "Image $imageName not found.";
        }
    }
}
