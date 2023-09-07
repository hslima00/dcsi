<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SystemController extends Controller
{

    public function index()
    {
        $systems = [];
        foreach (System::all()->toArray() as $system) {
            $systems[] = $this->getParentRelationship($system);
        }

        return Inertia::render('Systems/Index', [
            'systems' => $systems,
        ]);
    }

    public function getParentRelationship($system)
    {
        if (isset($system['parent_system_id'])) {
            $system['parent_system'] = System::where('id', $system['parent_system_id'])->first()->toArray();
            $system['parent_system'] = $this->getParentRelationship($system['parent_system']);
        }

        return $system;
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255', // Adjust max length as needed
            'parent_system_id' => 'nullable|exists:systems,id', // Make sure the parent_system_id exists in the systems table
        ]);

        // Create the system
        System::create([
            'name' => $request->name,
            'parent_system_id' => $request->parent_system_id,
        ]);

        return redirect()->route('systems.index')->with('message', 'System created successfully');
    }

    public function create()
    {
        $systems = System::all(); // Fetch systems and convert to an array

        return Inertia::render('Systems/Create', [
            'systems' => $systems,
        ]);
    }

    public function show(System $system)
    {
        return Inertia::render('Systems/Show', ['system' => $system]);
    }
}
