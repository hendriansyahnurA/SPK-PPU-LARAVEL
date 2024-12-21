<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $peserta = Peserta::when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', "%{$search}%")
                ->orWhere('nim', 'like', "%{$search}%");
        })->paginate(10);

        return view('admin.Dashboard.DataAlternatif', compact('peserta', 'search'));
    }


    public function store(Request $request)
    {

        $request->merge(['ipk' => str_replace(',', '.', $request->input('ipk'))]);

        $validateData = $request->validate(
            [
                "nama" => "required",
                "nim" => "required|unique:peserta,nim",
                "prodi" => "required",
                "semester" => "required",
                'ipk' => 'required|numeric|between:0,4',
            ],
            [
                'nim.unique' => 'Nim sudah digunakan, silakan coba Nim lain.',
                'ipk.numeric' => 'IPK harus berupa angka dengan format desimal',
            ]
        );

        $peserta = Peserta::create($validateData);
        return redirect()->route('admin.alternatif')->with('success', 'Berhasil Menambahkan Data Peserta');
    }

    public function update(Request $request, $id)
    {
        $request->merge(['ipk' => str_replace(',', '.', $request->input('ipk'))]);

        $validateData = $request->validate(
            [
                "nama" => "required",
                "nim" => "required",
                "prodi" => "required",
                "semester" => "required",
                'ipk' => 'required|numeric|between:0,4',
            ],
            [
                'nim.unique' => 'Nim sudah digunakan, silakan coba Nim lain.',
                'ipk.numeric' => 'IPK harus berupa angka dengan format desimal',
            ]
        );
        $peserta = Peserta::findOrFail($id);
        $peserta->update($validateData);

        return redirect()->route('admin.alternatif')->with('success', 'Data peserta berhasil diperbarui');
    }
    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->delete();

        return redirect()->route('admin.alternatif')->with('success', 'Peserta berhasil dihapus');
    }
}
