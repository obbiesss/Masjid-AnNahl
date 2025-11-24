<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasjidProfile;
use Illuminate\Http\Request;

class MasjidProfileAdminController extends Controller
{
    public function index()
    {
        $profile = MasjidProfile::first();
        
        return view('admin.profile.index', compact('profile'));
    }

    public function edit()
    {
        $profile = MasjidProfile::first();
        
        if (!$profile) {
            $profile = new MasjidProfile();
        }

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = MasjidProfile::first();

        if (!$profile) {
            $profile = new MasjidProfile();
        }

        // Validasi
        $request->validate([
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about_text_1' => 'required|string',
            'about_text_2' => 'nullable|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'capacity' => 'required|integer',
            'year' => 'required|integer',
            'routine_activities' => 'required|string',
            'public_info' => 'required|string',
            'whatsapp' => 'required|string',
            'address' => 'required|string',
            'maps_embed' => 'required|string',
            'operating_hours' => 'required|string',
            'maps_url' => 'required|url',
            'facility_name.*' => 'sometimes|required|string',
            'facility_icon.*' => 'sometimes|required|string',
            'facility_description.*' => 'sometimes|required|string',
        ]);

        // Upload image
        if ($request->hasFile('about_image')) {
            $path = $request->file('about_image')->store('profile', 'public');
            $profile->about_image = $path;
        }

        $profile->about_text_1        = $request->about_text_1;
        $profile->about_text_2        = $request->about_text_2;
        $profile->visi                = $request->visi;
        $profile->misi                = $request->misi;
        $profile->capacity            = $request->capacity;
        $profile->year                = $request->year;
        $profile->routine_activities  = $request->routine_activities;
        $profile->public_info         = $request->public_info;
        $profile->whatsapp            = $request->whatsapp;
        
        // LOKASI & MAPS
        $profile->address             = $request->address;
        $profile->maps_embed          = $request->maps_embed;
        $profile->operating_hours     = $request->operating_hours;
        $profile->maps_url            = $request->maps_url; 
        
        // FASILITAS
        $facilities = [];
        if ($request->facility_name) {
            foreach ($request->facility_name as $index => $name) {
                if (!empty($name)) {
                    $facilities[] = [
                        'name' => $name,
                        'icon' => $request->facility_icon[$index] ?? 'bi-building',
                        'description' => $request->facility_description[$index] ?? ''
                    ];
                }
            }
        }
        $profile->facilities = $facilities;

        $profile->save();

        return redirect()->route('admin.profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
}