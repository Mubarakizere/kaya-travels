<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageHelper;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::latest()->paginate(10);
        return view('admin.trips.index', compact('trips'));
    }

    public function create()
    {
        return view('admin.trips.create');
    }

    public function store(Request $request)
    {
        \Log::info('Trip Form Submitted', $request->except(['thumbnail', 'gallery']));

        $data = $request->validate([
            'title' => 'required|string',
            'category' => 'required|in:adventure,luxury,cultural,weekend',
            'destination_id' => 'required|exists:destinations,id',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'short_description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'itinerary' => 'nullable|string',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
        ]);

        // ✅ Ensure unique slug
        $slugBase = Str::slug($request->title);
        $slug = $slugBase;
        $count = 1;
        while (Trip::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $count++;
        }
        $data['slug'] = $slug;

        $data['status'] = $request->has('status');
        $data['is_top'] = $request->has('is_top');
        $data['meta_title'] = $request->meta_title ?? $request->title;
        $data['meta_description'] = $request->meta_description ?? Str::limit(strip_tags($request->short_description), 160);

        $data['itinerary'] = $request->filled('itinerary') ? json_encode(array_filter(preg_split("/\r\n|\n|\r/", $request->itinerary))) : json_encode([]);
        $data['inclusions'] = $request->filled('inclusions') ? json_encode(array_filter(preg_split("/\r\n|\n|\r/", $request->inclusions))) : json_encode([]);
        $data['exclusions'] = $request->filled('exclusions') ? json_encode(array_filter(preg_split("/\r\n|\n|\r/", $request->exclusions))) : json_encode([]);

        try {
            $trip = Trip::create($data);
            \Log::info('Trip created successfully', ['id' => $trip->id]);
            return redirect()->route('admin.trips.uploadImages', $trip->id);
        } catch (\Exception $e) {
            \Log::error('Trip insert failed: ' . $e->getMessage());
            return back()->with('error', 'Trip insert failed: ' . $e->getMessage());
        }
    }

    public function uploadImagesForm(Trip $trip)
    {
        return view('admin.trips.upload-images', compact('trip'));
    }

    public function uploadImages(Request $request, Trip $trip)
    {
        $request->validate([
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($request->file('thumbnail')->isValid()) {
                $trip->thumbnail = ImageHelper::compressAndStore($request->file('thumbnail'), 'trips');
                \Log::info('Thumbnail uploaded', ['path' => $trip->thumbnail]);
            }
        }

        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $img) {
                if ($img->isValid()) {
                    try {
                        $gallery[] = ImageHelper::compressAndStore($img, 'trips/gallery');
                    } catch (\Exception $ex) {
                        \Log::warning('Gallery image failed to store', ['name' => $img->getClientOriginalName(), 'error' => $ex->getMessage()]);
                    }
                }
            }
            if (!empty($gallery)) {
                $trip->gallery = json_encode($gallery);
                \Log::info('Gallery images uploaded', ['paths' => $gallery]);
            }
        }

        $trip->save();

        return redirect()->route('admin.trips.index')->with('success', 'Images uploaded successfully.');
    }

   public function edit(Trip $trip)
{
    $trip->itinerary = is_string($trip->itinerary) ? json_decode($trip->itinerary, true) ?? [] : $trip->itinerary;
    $trip->inclusions = is_string($trip->inclusions) ? json_decode($trip->inclusions, true) ?? [] : $trip->inclusions;
    $trip->exclusions = is_string($trip->exclusions) ? json_decode($trip->exclusions, true) ?? [] : $trip->exclusions;
    $trip->gallery = is_string($trip->gallery) ? json_decode($trip->gallery, true) ?? [] : $trip->gallery;

    return view('admin.trips.edit', compact('trip'));
}


   public function update(Request $request, Trip $trip)
{
    $data = $request->validate([
        'title' => 'required|string',
        'category' => 'required|in:adventure,luxury,cultural,weekend',
        'destination_id' => 'required|exists:destinations,id',
        'price' => 'required|numeric',
        'duration' => 'required|string',
        'short_description' => 'nullable|string',
        'full_description' => 'nullable|string',
        'itinerary' => 'nullable|string',
        'inclusions' => 'nullable|string',
        'exclusions' => 'nullable|string',
    ]);

    // ✅ Ensure unique slug only if title changed
    $slugBase = Str::slug($request->title);
    $slug = $slugBase;
    $count = 1;

    while (Trip::where('slug', $slug)->where('id', '!=', $trip->id)->exists()) {
        $slug = $slugBase . '-' . $count++;
    }

    $data['slug'] = $slug;
    $data['status'] = $request->has('status');
    $data['is_top'] = $request->has('is_top');
    $data['meta_title'] = $request->meta_title ?? $request->title;
    $data['meta_description'] = $request->meta_description ?? Str::limit(strip_tags($request->short_description), 160);

    $data['itinerary'] = $request->filled('itinerary')
        ? json_encode(array_filter(preg_split("/\r\n|\n|\r/", $request->itinerary)))
        : json_encode([]);

    $data['inclusions'] = $request->filled('inclusions')
        ? json_encode(array_filter(preg_split("/\r\n|\n|\r/", $request->inclusions)))
        : json_encode([]);

    $data['exclusions'] = $request->filled('exclusions')
        ? json_encode(array_filter(preg_split("/\r\n|\n|\r/", $request->exclusions)))
        : json_encode([]);

    $trip->update($data);

    return redirect()->route('admin.trips.index')->with('success', 'Trip updated successfully.');
}


    public function destroy(Trip $trip)
    {
        if ($trip->thumbnail) {
            Storage::disk('public')->delete($trip->thumbnail);
        }

        if (is_array($trip->gallery)) {
            foreach ($trip->gallery as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $trip->delete();
        return back()->with('success', 'Trip deleted.');
    }
}
