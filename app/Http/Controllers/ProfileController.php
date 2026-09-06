<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
        $file = $request->file('photo');

        $data['photo_data'] = file_get_contents($file->getRealPath());
        $data['photo_mime'] = $file->getMimeType();
    }

    // Pakai fill()->save() karena timestamps = false
    $user->fill($data)->save();

    return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
}

    /**
     * Stream foto profil dari database.
     */
    public function photo(User $user)
    {
        abort_unless($user->photo_data, 404);

        return response($user->photo_data, 200, [
            'Content-Type'  => $user->photo_mime ?? 'application/octet-stream',
            'Cache-Control' => 'private, max-age=3600',
        ]);
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
