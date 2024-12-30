<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('username', 'like', "%{$search}%");
        })->paginate(10);

        return view('admin.Dashboard.UsersEvaluator', compact('users', 'search'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|string',
                'username' => 'required|string|unique:users,username|max:255',
                'password' => 'required|string|min:8',
                'role' => 'required|in:admin,evaluator',
            ],
            [
                'username.unique' => 'Username sudah digunakan, silakan coba Nim lain.',
                'password' => 'Password Kurang Dari 8 Karakter',
            ]
        );

        $validatedData['password'] = bcrypt($validatedData['password']);

        $validatedData['remember_token'] = Str::random(10);

        $user = User::create($validatedData);
        return redirect()->route('admin.evaluator')->with('success', 'Berhasil Menambahkan Data Evaluator');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|string',
                'username' => [
                    'required',
                    'max:255',
                    Rule::unique('users')->ignore($id), // Mengecualikan username pengguna yang sedang diupdate
                ],
                'password' => 'nullable|string|min:8',
                'role' => 'required|in:admin,evaluator',
            ],
            [
                'username.unique' => 'Username sudah digunakan, silakan coba Nim lain.',
                'password' => 'Password Kurang Dari 8 Karakter',
            ]
        );

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $users = User::findOrFail($id);
        $users->update($validatedData);

        return redirect()->route('admin.evaluator')->with('success', 'Data Evaluator Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.evaluator')->with('success', 'Data Evaluator Berhasil Dihapus');
    }
}
