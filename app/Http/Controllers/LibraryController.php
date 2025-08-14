<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLibraryItemRequest;
use App\Http\Requests\UpdateLibraryItemRequest;
use App\Models\LibraryItem;
use App\Models\BookLoan;
use Inertia\Inertia;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = LibraryItem::with('creator')
            ->active()
            ->latest()
            ->paginate(12);
        
        return Inertia::render('library/index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('library/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLibraryItemRequest $request)
    {
        $item = LibraryItem::create(array_merge(
            $request->validated(),
            ['created_by' => auth()->id()]
        ));

        return redirect()->route('library.show', $item)
            ->with('success', 'Library item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LibraryItem $library)
    {
        $library->load('creator');
        
        // Check if current user has an active loan for this item
        $userLoan = null;
        if (auth()->check()) {
            $userLoan = BookLoan::where('library_item_id', $library->id)
                ->where('cadre_id', auth()->id())
                ->whereIn('status', ['pending', 'approved', 'borrowed'])
                ->first();
        }
        
        return Inertia::render('library/show', [
            'item' => $library,
            'userLoan' => $userLoan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LibraryItem $library)
    {
        return Inertia::render('library/edit', [
            'item' => $library
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLibraryItemRequest $request, LibraryItem $library)
    {
        $library->update($request->validated());

        return redirect()->route('library.show', $library)
            ->with('success', 'Library item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LibraryItem $library)
    {
        $library->delete();

        return redirect()->route('library.index')
            ->with('success', 'Library item deleted successfully.');
    }
}