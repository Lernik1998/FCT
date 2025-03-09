<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\UserActivitiesReservations;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtengo todas las actividades donde el status sea active
        $activities = Activity::where('status', 'active')->get();

        return inertia('Public/Activity', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //Obtener la actividad
        $activity = Activity::findOrFail($activity->id);

        //Retornar la actividad
        return inertia('Activity/ActivityCard', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        //
    }

    // USER - Activity
    public function showUserActivity($id)
    {
        //Obtener la actividad
        $activity = Activity::findOrFail($id);

        //Retornar la actividad
        return inertia('User/ActivityOptions/ActivityShow', compact('activity'));
    }
}
