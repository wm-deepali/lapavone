<?php
// app/Http/Controllers/Admin/TestimonialSectionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestimonialSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialSectionController extends Controller
{
    public function edit()
    {
        $testimonial = TestimonialSection::firstOrCreate([], [
            'quote_line1' => 'A very beautiful way',
            'quote_line2' => 'to start the day!',
            'author' => 'Bilal Khilji',
        ]);

        return view('admin.home.testimonial.edit', compact('testimonial'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'quote_line1' => 'nullable|string|max:255',
            'quote_line2' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:100',
            'background_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3048',
        ]);

        $testimonial = TestimonialSection::firstOrCreate([]);

        $data = $request->only(['quote_line1', 'quote_line2', 'author']);


        if ($request->hasFile('background_image')) {

            // Delete old image only if it exists
            if (
                !empty($testimonial->background_image) &&
                Storage::disk('public')->exists($testimonial->background_image)
            ) {
                Storage::disk('public')->delete($testimonial->background_image);
            }

            // Store new image
            $data['background_image'] = $request->file('background_image')
                ->store('home/testimonial', 'public');
        }


        $testimonial->update($data);

        return redirect()->route('admin.home.testimonial.edit')
            ->with('success', 'Testimonial updated successfully.');
    }
}