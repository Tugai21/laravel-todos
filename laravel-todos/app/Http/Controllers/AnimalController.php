<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Photo;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $query = Animal::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('species', 'like', '%' . $request->search . '%');
            });
        }

        $allowedSorts = ['name', 'species', 'age'];
        if ($request->filled('sort') && in_array($request->sort, $allowedSorts)) {
            $direction = $request->direction === 'desc' ? 'desc' : 'asc';
            $query->orderBy($request->sort, $direction);
        }

        $animals = $query->paginate(10)->withQueryString();
        return view('admin.animals.index', compact('animals'));
    }

    public function create()
    {
        $photos = Photo::all();
        return view('admin.animals.create', compact('photos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'species' => 'required',
            'age' => 'nullable|integer',
            'description' => 'nullable',
            'photo_id' => 'nullable|exists:photos,id'
        ]);

        Animal::create($request->all());

        return redirect()->route('admin.animals.index')
            ->with('success', 'Animal created');
    }

    public function edit(Animal $animal)
    {
        $photos = Photo::all();
        return view('admin.animals.edit', compact('animal', 'photos'));
    }

    public function update(Request $request, Animal $animal)
    {
        $request->validate([
            'name' => 'required',
            'species' => 'required',
            'age' => 'nullable|integer',
            'description' => 'nullable',
            'photo_id' => 'nullable|exists:photos,id'
        ]);

        $animal->update($request->all());

        return redirect()->route('admin.animals.index')
            ->with('success', 'Animal updated');
    }

    public function destroy(Animal $animal)
    {
        $animal->delete();

        return redirect()->route('admin.animals.index')
            ->with('success', 'Animal deleted');
    }
}