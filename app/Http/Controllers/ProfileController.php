<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil
     */
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    /**
     * Update data profil
     */
    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name'  => ['required', 'string', 'max:255'],
        'email' => [
            'required', 'email', 'max:255',
            Rule::unique('users', 'email')->ignore($user->id),
        ],
        'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
    ], [
        'name.required'  => 'Nama lengkap wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.unique'   => 'Email sudah digunakan oleh pengguna lain.',
        'photo.image'    => 'File harus berupa gambar.',
        'photo.max'      => 'Ukuran foto maksimal 2MB.',
    ]);

    $data = [
        'name'  => $request->name,
        'email' => $request->email,
    ];

    if ($request->hasFile('photo')) {
        // Hapus foto lama kalau ada
        if ($user->photo && Storage::disk('public')->exists('profile_photos/' . $user->photo)) {
            Storage::disk('public')->delete('profile_photos/' . $user->photo);
        }

        $file     = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('profile_photos', $filename, 'public'); // disk 'public' eksplisit

        $data['photo'] = $filename;
    }

    // Pakai fill()->save() karena timestamps = false
    $user->fill($data)->save();

    return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
}

    /**
     * Tampilkan halaman ubah password
     */
    public function password()
    {
        $user = Auth::user();

        return view('profile.password', compact('user'));
    }

    /**
     * Proses update password
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => [
                'required',
                'string',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()
                ->withErrors([
                    'current_password' => 'Password lama tidak sesuai.',
                ])
                ->withInput();
        }

        $user->fill([
            'password' => Hash::make($request->password),
        ])->save();

        return redirect()
            ->route('profile.password')
            ->with('success', 'Password berhasil diperbarui.');
    }
}
