<?php

namespace App\Http\Controllers;

use App\Models\Sitesettings;
use Illuminate\Http\Request;

class SiteSettingsController extends Controller
{
    public function update(Request $request)
    {
        $data = [
            'site_name' => $request->site_name,
            'site_url' => $request->site_url,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'copyright_text' => $request->copyright_text,
            'primary_color' => $request->primary_color,
            'primary_hover_color' => $request->primary_hover_color,
            'styling' => $request->styling,
        ];
        Sitesettings::where('id',1)->update($data);
        return back()->with('success','Information has been updateting');
    }
}
