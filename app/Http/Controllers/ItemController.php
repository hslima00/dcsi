<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\System;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $systems = System::all();
        $dueCalibrationItems = Item::where('calibration_date', '>=', Carbon::now())
            ->where('calibration_date', '<=', Carbon::now()->addMonths(2))
            ->get();

        return Inertia::render('Items/Index', [
            'items' => $items,
            'dueCalibrationItems' => $dueCalibrationItems,
            'systems' => $systems,

        ]);
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'stock' => 'required|integer|min:0',
            'name' => 'required|string|max:255',
            'serial_n' => 'string|max:255|nullable',
            'price' => 'integer|nullable',
            'calibration_date' => 'date|nullable',
            'part_number' => 'string|nullable',
            'comment' => 'string|max:255|nullable',
            'image' => 'string|nullable',
            'system_id' => 'integer|nullable',
        ]);

        // Handle the creation of a new item here
        // You can use the $request data to create a new item

        // Example:
        Item::create([
            'stock' => $request->stock,
            'name' => $request->name,
            'serial_n' => $request->serial_n ?? null,
            'price' => $request->price ?? null,
            'calibration_date' => $request->calibration_date ?? null,
            'part_number' => $request->part_number ?? null,
            'comment' => $request->comment ?? null,
            'system_id' => $request->system_id ?? null,
            'image' => $request->image ?? null,
        ]);

        // Return a response or redirect as needed
        return redirect()->route('items.index')->with('message', 'Item created successfully');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create() // resources/js/Pages/Blogs/Create.vue
    {
        $items = Item::all();
        $systems = System::all();

        return Inertia::render('Items/Create', [
            'items' => $items,
            'systems' => $systems,

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return Inertia::render('Items/Show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return Inertia::render('Items/Show', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'stock' => 'integer|min:0',
            'name' => 'string|max:255',
            'serial_n' => 'string|max:255|nullable',
            'price' => 'integer|nullable',
            'calibration_date' => 'date|nullable',
            'part_number' => 'string|nullable',
            'comment' => 'string|max:255|nullable',
            'image' => 'string|nullable',
        ]);

        // Update the item attributes
        $item->update($request->all());



        // Return a response or redirect as needed
        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('message', 'Item Delete Successfully');
    }

}
