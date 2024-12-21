<?php

namespace App\Http\Controllers;

use App\Models\Aspek;
use Illuminate\Http\Request;

class AspekController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $aspek = Aspek::when($search, function ($query) use ($search) {
            return $query->where('aspek_penilaian', 'like', "%{$search}%")
                ->orWhere('core_faktor', 'like', "%{$search}%")
                ->orWhere('Secondary_faktor', 'like', "%{$search}%");
        })->paginate(10);

        return view('admin.Dashboard.DataAspek', compact('aspek', 'search'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'aspek_penilaian' => 'required',
                'presentase' => 'required',
                'core_faktor' => 'required',
                'secondary_faktor' => 'required',
            ],
            [
                'aspek_penilaian' => 'Data di isi Terlebih Dahulu',
                'presentase' => 'Data di isi Terlebih Dahulu',
                'core_faktor' => 'Data di isi Terlebih Dahulu',
                'secondary_faktor' => 'Data di isi Terlebih Dahulu',
            ]
        );

        $aspek = Aspek::create($validatedData);
        return redirect()->route('admin.aspek')->with('success', 'Behasil Menambahkan Data Aspek');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'aspek_penilaian' => 'required',
                'presentase' => 'required',
                'core_faktor' => 'required',
                'secondary_faktor' => 'required',
            ],
            [
                'aspek_penilaian' => 'Data di isi Terlebih Dahulu',
                'presentase' => 'Data di isi Terlebih Dahulu',
                'core_faktor' => 'Data di isi Terlebih Dahulu',
                'secondary_faktor' => 'Data di isi Terlebih Dahulu',
            ]
        );
        $aspek = Aspek::findOrFail($id);
        $aspek->update($validatedData);
        return redirect()->route('admin.aspek')->with('success', 'Data Aspek Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        $aspek = Aspek::findOrFail($id);
        $aspek->delete();
        return redirect()->route('admin.aspek')->with('success', 'Data Aspek Berhasil Dihapus');
    }
}
