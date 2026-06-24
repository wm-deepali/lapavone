<?php
// app/Http/Controllers/Admin/HeroSectionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    public function edit()
    {
        $hero = HeroSection::firstOrCreate([], [
            'heading_line1' => "LUXURY ISN'T LOUDER.",
            'heading_line2' => "IT'S BETTER MADE",
            'btn1_label' => 'Shop All',
            'btn1_url' => 'shopall.html',
            'btn2_label' => 'New Arrivals',
            'btn2_url' => 'shopall.html',
        ]);

        return view('admin.home.hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading_line1' => 'nullable|string|max:150',
            'heading_line2' => 'nullable|string|max:150',
            'btn1_label' => 'required|string|max:50',
            'btn1_url' => 'required|string|max:255',
            'btn2_label' => 'required|string|max:50',
            'btn2_url' => 'required|string|max:255',
            'background_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3048',
        ]);

        $hero = HeroSection::firstOrCreate([]);

        $data = $request->only([
            'heading_line1',
            'heading_line2',
            'btn1_label',
            'btn1_url',
            'btn2_label',
            'btn2_url',
        ]);

        if ($request->hasFile('background_image')) {

            // Delete old image only if it exists
            if (
                !empty($hero->background_image) &&
                Storage::disk('public')->exists($hero->background_image)
            ) {
                Storage::disk('public')->delete($hero->background_image);
            }

            // Store new image
            $data['background_image'] = $request->file('background_image')
                ->store('home/hero', 'public');
        }

        $hero->update($data);

        return redirect()->route('admin.home.hero.edit')
            ->with('success', 'Hero section updated successfully.');
    }
}