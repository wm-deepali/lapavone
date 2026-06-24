<?php
// app/Http/Controllers/Admin/BannerSectionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BannerSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerSectionController extends Controller
{
    public function edit()
    {
        $banner = BannerSection::firstOrCreate([], [
            'heading' => 'Rooted in culture. Designed for today.',
        ]);

        return view('admin.home.banner.edit', compact('banner'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3048',
        ]);

        $banner = BannerSection::firstOrCreate([]);

        $data = $request->only('heading');

        if ($request->hasFile('background_image')) {

            // Delete old image only if it exists
            if (
                !empty($banner->background_image) &&
                Storage::disk('public')->exists($banner->background_image)
            ) {
                Storage::disk('public')->delete($banner->background_image);
            }

            // Store new image
            $data['background_image'] = $request->file('background_image')
                ->store('home/banner', 'public');
        }

        $banner->update($data);

        return redirect()->route('admin.home.banner1.edit')
            ->with('success', 'Banner updated successfully.');
    }
}