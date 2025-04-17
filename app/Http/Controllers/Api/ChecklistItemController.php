<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use Illuminate\Http\Request;

class ChecklistItemController extends Controller
{
    public function index(Checklist $checklist)
    {
        $items = $checklist->items()->get();
        return response()->json([
            'success' => true,
            'data'    => $items,
        ], 200);
    }

    public function show(Checklist $checklist, ChecklistItem $item)
    {
        if ($item->checklist_id !== $checklist->id) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in this checklist'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $item,
        ], 200);
    }

    public function store(Request $request, Checklist $checklist)
    {
        $item = $checklist->items()->create([
            'item_name' => $request->item_name,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Item created',
            'data'    => $item,
        ], 201);
    }

    public function update(Request $request, Checklist $checklist, ChecklistItem $item)
    {
        if ($item->checklist_id !== $checklist->id) {
            return response()->json([
                'success' => false,
                'message' => 'Item status gagal diganti',
            ], 404);
        }

        $status = $request->has('status') ? $request->status : true;
        $item->status = $status;
        $item->save();

        return response()->json([
            'success' => true,
            'message' => 'Item status updated',
            'data'    => $item,
        ]);
    }

    public function destroy(Checklist $checklist, ChecklistItem $item)
    {
        if ($item->checklist_id !== $checklist->id) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan!'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item dihapus!',
        ], 200);
    }

    public function rename(Request $request, Checklist $checklist, ChecklistItem $item)
    {
        if ($item->checklist_id !== $checklist->id) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan',
            ], 404);
        }

        $item->item_name = $request->item_name;
        $item->save();

        return response()->json([
            'success' => true,
            'message' => 'Item name updated successfully',
            'data'    => $item,
        ], 200);
    }
}
