<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    //index
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $units = Unit::with(['categories', 'reviews']) // Menggunakan relasi dengan kategori
        ->orWhereHas('categories', function($query) use ($keyword) {
            $query->where('category_name', 'like', '%' . $keyword . '%'); })
        ->orWhere('kode_unit', 'like', '%' . $keyword . '%')
        ->orWhere('nama_unit', 'like', '%' . $keyword .'%')
        ->orderBy('created_at', 'desc')
        // ->orWhereHas('categories', function($query) use ($keyword) {
        //     $query->where('category_name', 'like', '%' . $keyword . '%'); 
        // })
        ->paginate(10);

        $categories = Category::where ('id', 'like', '%' . $units . '%');

        return view('unit.index', compact(['keyword', 'units']));
    }

    //user create
    public function create()
    {
        $categories = Category::all();
        return view('unit.create', compact('categories'));
    }

    //user store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_unit' => 'required|unique:units,kode_unit',
            'nama_unit' => 'required',
            // 'category_id' => 'required|exists:categories,id',
            'categories' => 'required|array',
            'qty' => 'required|integer|min:1'
        ]);

        // @dd($request);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // mengembalikan input
        }

        // $findCategoryName = Category::where('id', 'like', '%' . $request->category_id . '%');

            $unit = Unit::create([
                'kode_unit' => $request->kode_unit,
                'nama_unit' => $request->nama_unit,
                // 'category_id' => $request->category_id,
                'qty' => $request->qty,
            ]);

            $unit->categories()->attach($request->categories);

            return redirect()->route('unit.index')->with('success', 'unit added successfully.');
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        $categories = Category::all();
        return view('unit.update', compact('unit', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'kode_unit' => 'required|unique:units,kode_unit',
            'nama_unit' => 'required',
            // 'category_id' => 'required|exists:categories,id',
            'qty' => 'required|integer|min:1'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput(); // mengembalikan input
        };

        $category = Unit::findORFail($id);

            $category -> update([
                // 'kode_unit' => $request->kode_unit,
                'nama_unit' => $request->nama_unit,
                // 'category_id' => $request->category_id,
                'qty' => $request->qty,
            ]);

        return redirect()->route('unit.index')->with('success', 'Unit berhasil diperbarui');
    }

    public function destroy($id)
    {
        Unit::destroy($id);
        return redirect()->route('unit.index')->with('success', 'Unit berhasil dihapus');
    }

    public function storeReview(Request $request, $unitId)
    {
        $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Cari unit berdasarkan ID
        $unit = Unit::findOrFail($unitId);

        // Tambahkan review menggunakan relasi polimorfik
        $unit->reviews()->create([
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
        ]);

        return redirect()->route('units.show', $unitId)->with('success', 'Review added successfully.');
    }
}
