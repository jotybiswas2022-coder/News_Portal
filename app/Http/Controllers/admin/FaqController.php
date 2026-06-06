<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('sort_order')->get();
        return view('backend.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('backend.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question'   => 'required|string|max:500',
            'answer'     => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['question', 'answer', 'sort_order']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        Faq::create($data);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ created successfully!');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('backend.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $request->validate([
            'question'   => 'required|string|max:500',
            'answer'     => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['question', 'answer', 'sort_order']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        $faq->update($data);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully!');
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->update(['is_active' => !$faq->is_active]);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ status updated!');
    }
}
