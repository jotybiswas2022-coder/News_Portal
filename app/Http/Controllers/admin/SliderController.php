<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Every image managed from the "Manage Sliders" screen:
     *   slider1     — hero, desktop / tablet (wide)
     *   slider2     — hero, mobile (portrait)
     *   about_image — the homepage "Our Promise" band (portrait)
     */
    private const IMAGE_FIELDS = ['slider1', 'slider2', 'about_image'];

    // Show slider management form
    public function index()
    {
        $slider = Slider::latest()->first(); // Show latest slider
        return view('backend.sliders', compact('slider'));
    }

    // Store or update slider
    public function store(Request $request)
    {
        $this->validateImages($request);

        $slider = Slider::latest()->first() ?? new Slider();

        foreach (self::IMAGE_FIELDS as $field) {
            $this->applyImage($request, $slider, $field);
        }

        $slider->save();

        return redirect()->back()->with('success', 'Slider updated successfully!');
    }

    // Update slider (also handles clearing individual images)
    public function update(Request $request, $id)
    {
        $this->validateImages($request);

        $slider = Slider::findOrFail($id);

        foreach (self::IMAGE_FIELDS as $field) {
            $this->applyImage($request, $slider, $field);
        }

        $slider->save();

        return redirect()->back()->with('success', 'Slider updated successfully!');
    }

    // Delete the slider row and every image it owns
    public function delete($id)
    {
        $slider = Slider::findOrFail($id);

        foreach (self::IMAGE_FIELDS as $field) {
            $this->forgetImage($slider->$field);
        }

        $slider->delete();

        return redirect()->back()->with('success', 'Slider deleted successfully!');
    }

    private function validateImages(Request $request): void
    {
        $rules = [];

        foreach (self::IMAGE_FIELDS as $field) {
            $rules[$field] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096';
        }

        $request->validate($rules);
    }

    /**
     * Save a newly uploaded image, or clear the column when the request carries
     * a remove_<field> flag — which is what each card's ✕ button submits.
     */
    private function applyImage(Request $request, Slider $slider, string $field): void
    {
        if ($request->hasFile($field)) {
            $this->forgetImage($slider->$field);
            $slider->$field = $request->file($field)->store('sliders', 'public');
            return;
        }

        if ($request->boolean('remove_' . $field)) {
            $this->forgetImage($slider->$field);
            $slider->$field = null;
        }
    }

    private function forgetImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
