<?php

namespace App\Http\Controllers;

use App\Enums\ServisStatus;
use App\Http\Requests\StoreServisRequest;
use App\Http\Requests\UpdateServisRequest;
use App\Models\Servis;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class ServisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Servis::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_servis', 'like', "%{$search}%")
                  ->orWhere('nama_konsumen', 'like', "%{$search}%")
                  ->orWhere('type_laptop', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $servis = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('servis.index', compact('servis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('servis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServisRequest $request)
    {
        $validated = $request->validated();
        $validated['nomor_servis'] = Servis::generateNomorServis();

        $servis = Servis::create($validated);

        return redirect()->route('servis.show', $servis->id)
            ->with('success', 'Data servis berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $servis = Servis::findOrFail($id);
        $pengaturan = Pengaturan::getSettings();
        return view('servis.show', compact('servis', 'pengaturan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $servis = Servis::findOrFail($id);
        $pengaturan = Pengaturan::getSettings();
        return view('servis.edit', compact('servis', 'pengaturan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServisRequest $request, string $id)
    {
        $servis = Servis::findOrFail($id);
        $validated = $request->validated();
        
        $servis->update($validated);

        return redirect()->route('servis.show', $servis->id)
            ->with('success', 'Data servis berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $servis = Servis::findOrFail($id);
        $servis->delete();

        return redirect()->route('servis.index')
            ->with('success', 'Data servis berhasil dihapus!');
    }

    /**
     * Print nota
     */
    public function print(string $id)
    {
        $servis = Servis::findOrFail($id);
        $pengaturan = Pengaturan::getSettings();
        
        return view('servis.print', compact('servis', 'pengaturan'));
    }
}
