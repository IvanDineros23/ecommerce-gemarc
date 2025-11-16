<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReceivingEntry;
use App\Models\Product;
use Illuminate\Support\Str;

class ReceivingEntryController extends Controller
{
    /**
     * Show the Receiving Entry page (Blade view)
     */
    public function index(Request $request)
    {
        if ($request->wantsJson() || $request->ajax()) {
            $search = trim($request->get('search', ''));

            // 1) Get all entries
            $entries = ReceivingEntry::orderByDesc('id')->get()->map(function (ReceivingEntry $entry) {
                return [
                    'id'               => $entry->id,
                    'part_number'      => $entry->part_number,
                    'item_name'        => $entry->item_name,
                    'item_description' => $entry->item_description,
                    'supplier'         => $entry->supplier,
                    'supplier_group'   => $entry->supplier_group,
                    'quantity'         => $entry->quantity,
                    'unit_cost'        => $entry->unit_cost,
                    'unit'             => $entry->unit,
                    'currency'         => $entry->currency,
                    // Only decode if value is a string, otherwise trust Eloquent cast
                    'date_received'    => is_string($entry->date_received) ? json_decode($entry->date_received, true) : ($entry->date_received ?? []),
                    'fo_number'        => is_string($entry->fo_number) ? json_decode($entry->fo_number, true) : ($entry->fo_number ?? []),
                    'location'         => is_string($entry->location) ? json_decode($entry->location, true) : ($entry->location ?? []),
                    'intended_to'      => is_string($entry->intended_to) ? json_decode($entry->intended_to, true) : ($entry->intended_to ?? []),
                ];
            });

            // 2) If search, filter in PHP (case-insensitive)
            if ($search !== '') {
                $term = mb_strtolower($search);
                $entries = $entries->filter(function ($row) use ($term) {
                    // simple string fields
                    foreach ([
                        'part_number', 'item_name', 'item_description',
                        'supplier', 'supplier_group', 'quantity',
                        'unit_cost', 'unit', 'currency'
                    ] as $field) {
                        $value = mb_strtolower((string)($row[$field] ?? ''));
                        if (str_contains($value, $term)) {
                            return true;
                        }
                    }
                    // array fields: date_received, fo_number, location, intended_to
                    foreach (['date_received', 'fo_number', 'location', 'intended_to'] as $field) {
                        $arr = $row[$field] ?? [];
                        foreach ((array)$arr as $v) {
                            $value = mb_strtolower((string)$v);
                            if (str_contains($value, $term)) {
                                return true;
                            }
                        }
                    }
                    return false;
                })->values(); // reindex
            }
            return response()->json($entries);
        }

        // normal blade load
        return view('dashboard.purchasing.receiving_entry');
    }

    /**
     * Return products for the All Products tab (for receiving entry)
     */
    public function products()
    {
        $products = Product::with('images')
            ->select(
                'id',
                'sku',
                'fo_number',
                'name',
                'brand',
                'category',
                'unit_price',
                'stock'
            )
            ->orderByDesc('created_at') // newest product first
            ->get();

        $mapped = $products->map(function ($p) {
            $imagePath = $p->firstImagePath(); // assume helper sa Product model
            return [
                'id'          => $p->id,
                'part_number' => $p->sku ?? '',
                'fo_number'   => $p->fo_number ?? '',
                'name'        => $p->name,
                'brand'       => $p->brand ?? '',
                'category'    => $p->category ?? '',
                'unit_price'  => $p->unit_price,
                'stock'       => $p->stock ?? 0,
                'image_url'   => $imagePath ? asset('storage/' . ltrim($imagePath, '/')) : null,
            ];
        });

        return response()->json($mapped);
    }

    public function pdf($id)
    {
        $entry = ReceivingEntry::findOrFail($id);

        $pdf = \PDF::loadView('pdf.receiving_entry', compact('entry'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("receiving-entry-{$entry->id}.pdf");
    }

    public function update(Request $request, $id)
    {
        $entry = ReceivingEntry::findOrFail($id);

        $validated = $request->validate([
            'part_number'      => 'nullable|string|max:255',
            'item_name'        => 'nullable|string|max:255',
            'item_description' => 'nullable|string|max:255',
            'supplier'         => 'nullable|string|max:255',
            'supplier_group'   => 'nullable|string|max:255',
            'dates'            => 'nullable|array',
            'dates.*.date'     => 'nullable|string',
            'dates.*.fo'       => 'nullable|string',
            'quantity'         => 'nullable|string|max:255',
            'unit_cost'        => 'nullable|string|max:255',
            'unit'             => 'nullable|string|max:255',
            'currency'         => 'nullable|string|max:255',
            'locations'        => 'nullable|array',
            'locations.*'      => 'nullable|string',
            'intendeds'        => 'nullable|array',
            'intendeds.*'      => 'nullable|string',
        ]);

        $entry->update([
            'part_number'      => $validated['part_number'] ?? null,
            'item_name'        => $validated['item_name'] ?? null,
            'item_description' => $validated['item_description'] ?? null,
            'supplier'         => $validated['supplier'] ?? null,
            'supplier_group'   => $validated['supplier_group'] ?? null,
            'date_received'    => array_values(array_filter(array_column($validated['dates'] ?? [], 'date'))),
            'fo_number'        => array_values(array_filter(array_column($validated['dates'] ?? [], 'fo'))),
            'quantity'         => $validated['quantity'] ?? null,
            'unit_cost'        => $validated['unit_cost'] ?? null,
            'unit'             => $validated['unit'] ?? null,
            'currency'         => $validated['currency'] ?? null,
            'location'         => array_values(array_filter($validated['locations'] ?? [])),
            'intended_to'      => array_values(array_filter($validated['intendeds'] ?? [])),
        ]);

        return response()->json(['success' => true, 'entry' => $entry]);
    }

    public function destroy($id)
    {
        ReceivingEntry::destroy($id);
        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'part_number'      => 'nullable|string|max:255',
            'item_name'        => 'nullable|string|max:255',
            'item_description' => 'nullable|string|max:255',
            'supplier'         => 'nullable|string|max:255',
            'supplier_group'   => 'nullable|string|max:255',
            'dates'            => 'nullable|array',
            'dates.*.date'     => 'nullable|string',
            'dates.*.fo'       => 'nullable|string',
            'quantity'         => 'nullable|string|max:255',
            'unit_cost'        => 'nullable|string|max:255',
            'unit'             => 'nullable|string|max:255',
            'currency'         => 'nullable|string|max:255',
            'locations'        => 'nullable|array',
            'locations.*'      => 'nullable|string',
            'intendeds'        => 'nullable|array',
            'intendeds.*'      => 'nullable|string',
        ]);

        $entry = new ReceivingEntry();
        $entry->part_number      = $validated['part_number'] ?? null;
        $entry->item_name        = $validated['item_name'] ?? null;
        $entry->item_description = $validated['item_description'] ?? null;
        $entry->supplier         = $validated['supplier'] ?? null;
        $entry->supplier_group   = $validated['supplier_group'] ?? null;
        $entry->date_received    = collect($validated['dates'] ?? [])->pluck('date')->filter()->values();
        $entry->fo_number        = collect($validated['dates'] ?? [])->pluck('fo')->filter()->values();
        $entry->quantity         = $validated['quantity'] ?? null;
        $entry->unit_cost        = $validated['unit_cost'] ?? null;
        $entry->unit             = $validated['unit'] ?? null;
        $entry->currency         = $validated['currency'] ?? null;
        $entry->location         = array_values(array_filter($validated['locations'] ?? []));
        $entry->intended_to      = array_values(array_filter($validated['intendeds'] ?? []));
        $entry->save();

        return response()->json(['success' => true, 'entry' => $entry]);
    }
}
