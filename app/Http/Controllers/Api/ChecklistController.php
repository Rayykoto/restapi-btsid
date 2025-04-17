<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function index()
    {
        $checklist = Checklist::all();
        return response()->json([
            'success' => true,
            'data' => $checklist
        ], 200);
    }

    public function store(Request $request)
    {
        $checklist = Checklist::create([
            'name' => $request->name
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Checklist berhasil dibuat!',
            'data' => $checklist
        ], 201);
    }

    public function destroy($id)
    {
        $checklist = Checklist::find($id);
        $checklist->delete();
        return response()->json([
            'success' => true,
            'message' => 'Checklist telah dihapus'
        ], 200);
    }
}
