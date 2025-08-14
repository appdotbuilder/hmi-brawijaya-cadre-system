<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendanceEventRequest;
use App\Http\Requests\UpdateAttendanceEventRequest;
use App\Models\AttendanceEvent;
use App\Models\AttendanceRecord;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = AttendanceEvent::with(['creator'])
            ->active()
            ->latest()
            ->paginate(15);
        
        return Inertia::render('attendance/index', [
            'events' => $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('attendance/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if this is an attendance event creation or attendance record creation
        if ($request->has('title')) {
            // Creating attendance event
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'activity_type' => 'nullable|string|max:100',
                'field' => 'nullable|string|max:100',
                'department' => 'nullable|string|max:100',
                'event_date' => 'required|date|after:now',
                'registration_start' => 'required|date|before:event_date',
                'registration_end' => 'required|date|after:registration_start|before_or_equal:event_date',
                'location' => 'nullable|string|max:255',
                'max_participants' => 'nullable|integer|min:1',
                'is_mandatory' => 'boolean',
                'target_audience' => 'required|in:all,active_cadres,specific_komisariat,management',
                'target_komisariat' => 'nullable|string|max:255|required_if:target_audience,specific_komisariat',
            ]);
            
            $event = AttendanceEvent::create(array_merge(
                $validated,
                [
                    'created_by' => auth()->id(),
                    'qr_code' => 'QR-' . strtoupper(uniqid()),
                    'is_mandatory' => $request->boolean('is_mandatory'),
                ]
            ));

            return redirect()->route('attendance.show', $event)
                ->with('success', 'Attendance event created successfully.');
        } else {
            // Creating attendance record (check in)
            $validated = $request->validate([
                'attendance_event_id' => 'required|exists:attendance_events,id',
                'notes' => 'nullable|string|max:500',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
            ]);
            
            $event = AttendanceEvent::findOrFail($validated['attendance_event_id']);
            
            // Check if registration is open
            $now = now();
            if ($now->lt($event->registration_start) || $now->gt($event->registration_end)) {
                return back()->withErrors(['error' => 'Registration is not currently open for this event.']);
            }
            
            // Check if user already checked in
            $existingRecord = \App\Models\AttendanceRecord::where('attendance_event_id', $event->id)
                ->where('cadre_id', auth()->id())
                ->exists();
                
            if ($existingRecord) {
                return back()->withErrors(['error' => 'You have already checked in to this event.']);
            }
            
            // Determine status based on timing
            $status = 'present';
            if ($now->gt($event->event_date)) {
                $status = 'late';
            }
            
            \App\Models\AttendanceRecord::create([
                'attendance_event_id' => $event->id,
                'cadre_id' => auth()->id(),
                'check_in_time' => $now,
                'status' => $status,
                'notes' => $validated['notes'],
                'check_in_method' => 'manual',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
            ]);

            return redirect()->route('attendance.show', $event)
                ->with('success', 'Successfully checked in to the event.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AttendanceEvent $attendance)
    {
        $attendance->load(['creator', 'attendanceRecords.cadre']);
        
        // Check if current user has already checked in
        $userAttendance = null;
        if (auth()->check()) {
            $userAttendance = AttendanceRecord::where('attendance_event_id', $attendance->id)
                ->where('cadre_id', auth()->id())
                ->first();
        }
        
        return Inertia::render('attendance/show', [
            'event' => $attendance,
            'userAttendance' => $userAttendance
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttendanceEvent $attendance)
    {
        return Inertia::render('attendance/edit', [
            'event' => $attendance
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceEventRequest $request, AttendanceEvent $attendance)
    {
        $attendance->update($request->validated());

        return redirect()->route('attendance.show', $attendance)
            ->with('success', 'Attendance event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttendanceEvent $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance event deleted successfully.');
    }


}