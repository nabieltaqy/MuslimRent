<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create($type, $id){
        $unit =Unit::with('reviews')->findOrFail($id);
        return view('review.create', compact(['unit', 'type', 'id']));
    }
    public function store(Request $request, $type, $id)
    {
        $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Tentukan model berdasarkan tipe
        if ($type === 'user') {
            $reviewable = User::findOrFail($id);
        } elseif ($type === 'unit') {
            $reviewable = Unit::findOrFail($id);
        } else {
            return response()->json(['message' => 'Model not found'], 404);
        }

        // Tambahkan review
        $reviewable->reviews()->create([
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
            
        ]);

        return response()->json(['message' => 'Review added successfully']);
    }
}
