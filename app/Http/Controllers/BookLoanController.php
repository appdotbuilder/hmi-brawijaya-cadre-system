<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookLoanRequest;
use App\Models\BookLoan;
use App\Models\LibraryItem;
use Inertia\Inertia;
use Illuminate\Http\Request;

class BookLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = BookLoan::with(['libraryItem', 'cadre', 'approver']);
        
        // Filter based on user role
        if (auth()->user()->isCadre()) {
            $query->where('cadre_id', auth()->id());
        }
        
        $loans = $query->latest()->paginate(15);
        
        return Inertia::render('book-loans/index', [
            'loans' => $loans
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookLoanRequest $request)
    {
        $libraryItem = LibraryItem::findOrFail($request->library_item_id);
        
        // Check if item is available
        if ($libraryItem->type === 'print' && $libraryItem->available_copies <= 0) {
            return back()->withErrors(['error' => 'This item is currently not available for loan.']);
        }
        
        // Check if user already has an active loan for this item
        $existingLoan = BookLoan::where('library_item_id', $request->library_item_id)
            ->where('cadre_id', auth()->id())
            ->whereIn('status', ['pending', 'approved', 'borrowed'])
            ->exists();
            
        if ($existingLoan) {
            return back()->withErrors(['error' => 'You already have an active loan request for this item.']);
        }
        
        $loan = BookLoan::create(array_merge(
            $request->validated(),
            [
                'cadre_id' => auth()->id(),
                'requested_date' => now()->toDateString()
            ]
        ));

        return redirect()->route('book-loans.show', $loan)
            ->with('success', 'Loan request submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BookLoan $bookLoan)
    {
        $bookLoan->load(['libraryItem', 'cadre', 'approver', 'returnHandler']);
        
        return Inertia::render('book-loans/show', [
            'loan' => $bookLoan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookLoan $bookLoan)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,returned',
            'admin_notes' => 'nullable|string',
            'loan_duration_days' => 'nullable|integer|min:1|max:90'
        ]);
        
        $updateData = [
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ];
        
        if ($request->status === 'approved') {
            $updateData['approved_by'] = auth()->id();
            $updateData['approved_date'] = now()->toDateString();
            $updateData['loan_duration_days'] = $request->loan_duration_days ?? 14;
            $updateData['due_date'] = now()->addDays($request->loan_duration_days ?? 14)->toDateString();
            $updateData['status'] = 'borrowed'; // Auto-transition to borrowed
            
            // Decrease available copies
            $bookLoan->libraryItem->decrement('available_copies');
        } elseif ($request->status === 'returned') {
            $updateData['returned_to'] = auth()->id();
            $updateData['returned_date'] = now()->toDateString();
            
            // Increase available copies
            $bookLoan->libraryItem->increment('available_copies');
        }
        
        $bookLoan->update($updateData);

        return redirect()->route('book-loans.show', $bookLoan)
            ->with('success', 'Loan status updated successfully.');
    }
}