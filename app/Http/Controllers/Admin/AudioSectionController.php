<?php
// app/Http/Controllers/Admin/AudioSectionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AudioSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AudioSectionController extends Controller
{
    public function edit()
    {
        $audio = AudioSection::firstOrCreate([], [
            'heading' => 'THE FRAGRANCE OF RESTRAINT.',
        ]);

        return view('admin.home.audio.edit', compact('audio'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => 'nullable|string|max:255',
            'section_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3048',
            'audio_file' => 'nullable|mimetypes:audio/mpeg,audio/mp3,audio/wav,audio/ogg|max:20480',
        ]);

        $audio = AudioSection::firstOrCreate([]);

        $data = $request->only('heading');

        if ($request->hasFile('section_image')) {

            // Delete old image only if it exists
            if (
                !empty($audio->section_image) &&
                Storage::disk('public')->exists($audio->section_image)
            ) {
                Storage::disk('public')->delete($audio->section_image);
            }

            // Store new image
            $data['section_image'] = $request->file('section_image')
                ->store('home/audio', 'public');
        }


        if ($request->hasFile('audio_file')) {

            if (
                !empty($audio->audio_file) &&
                Storage::disk('public')->exists($audio->audio_file)
            ) {
                Storage::disk('public')->delete($audio->audio_file);
            }

            $data['audio_file'] = $request->file('audio_file')
                ->store('home/audio', 'public');
        }

        $audio->update($data);

        return redirect()->route('admin.home.audio.edit')
            ->with('success', 'Audio section updated successfully.');
    }
}