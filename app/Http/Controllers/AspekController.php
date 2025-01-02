<?php

namespace App\Http\Controllers;

use App\Models\Aspek;
use App\Models\Kriteria;
use App\Models\Peserta;
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

    public function sampah()
    {
        $aspek = Aspek::onlyTrashed()->get()->map(function ($item) {
            $item->type = 'aspek';
            return $item;
        });

        $peserta = Peserta::onlyTrashed()->get()->map(function ($item) {
            $item->type = 'peserta';
            return $item;
        });
        $kriteria = Kriteria::onlyTrashed()->get()->map(function ($item) {
            $item->type = 'kriteria';
            return $item;
        });

        $deletedItems = collect()
            ->concat($aspek)
            ->concat($peserta)
            ->concat($kriteria);

        return view('admin.Dashboard.BarusajaDihapus', compact('deletedItems'));
    }

    public function restore($id)
    {
        $restored = false;

        $aspek = Aspek::onlyTrashed()->where('id', $id)->first();
        if ($aspek) {
            $aspek->restore();
            $restored = true;
        }

        $peserta = Peserta::onlyTrashed()->where('id', $id)->first();
        if ($peserta) {
            $peserta->restore();
            $restored = true;
        }

        $kriteria = Kriteria::onlyTrashed()->where('id', $id)->first();
        if ($kriteria) {
            $kriteria->restore();
            $restored = true;
        }

        // Kembalikan respons
        if ($restored) {
            return redirect()->route('admin.sampah')->with('success', 'Item berhasil direstore.');
        }

        return redirect()->back()->with('error', 'Item tidak ditemukan untuk direstore.');
    }

    public function hapusPermanen($id)
    {
        $deleted = false;

        // Coba hapus dari model Aspek
        $aspek = Aspek::onlyTrashed()->where('id', $id)->first();
        if ($aspek) {
            $aspek->forceDelete();
            $deleted = true;
        }

        // Coba hapus dari model Peserta
        $peserta = Peserta::onlyTrashed()->where('id', $id)->first();
        if ($peserta) {
            $peserta->forceDelete();
            $deleted = true;
        }

        // Coba hapus dari model Kriteria
        $kriteria = Kriteria::onlyTrashed()->where('id', $id)->first();
        if ($kriteria) {
            $kriteria->forceDelete();
            $deleted = true;
        }

        // Redirect dengan pesan
        if ($deleted) {
            return redirect()->route('admin.sampah')->with('success', 'Data berhasil dihapus permanen.');
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan untuk dihapus permanen.');
    }
}