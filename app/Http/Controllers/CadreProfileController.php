<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCadreProfileRequest;
use App\Http\Requests\UpdateCadreProfileRequest;
use App\Models\CadreProfile;
use App\Models\User;
use Inertia\Inertia;

class CadreProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = CadreProfile::with(['user', 'verifier'])
            ->latest()
            ->paginate(15);
        
        return Inertia::render('cadre-profiles/index', [
            'profiles' => $profiles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('cadre-profiles/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCadreProfileRequest $request)
    {
        $profile = CadreProfile::create(array_merge(
            $request->validated(),
            ['user_id' => auth()->id()]
        ));

        return redirect()->route('cadre-profiles.show', $profile)
            ->with('success', 'Profile created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CadreProfile $cadreProfile)
    {
        $cadreProfile->load(['user', 'verifier']);
        
        return Inertia::render('cadre-profiles/show', [
            'profile' => $cadreProfile
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CadreProfile $cadreProfile)
    {
        return Inertia::render('cadre-profiles/edit', [
            'profile' => $cadreProfile
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCadreProfileRequest $request, CadreProfile $cadreProfile)
    {
        $cadreProfile->update($request->validated());

        return redirect()->route('cadre-profiles.show', $cadreProfile)
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CadreProfile $cadreProfile)
    {
        $cadreProfile->delete();

        return redirect()->route('cadre-profiles.index')
            ->with('success', 'Profile deleted successfully.');
    }
}