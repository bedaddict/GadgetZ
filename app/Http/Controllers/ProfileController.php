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
        [$bytes, $mime] = $this->compressPhoto($file->getRealPath());

        // base64: PDO's pgsql driver sends string params as UTF-8 text, and raw
        // image bytes aren't valid UTF-8, so binary bytes must be encoded first.
        $data['photo_data'] = base64_encode($bytes);
        $data['photo_mime'] = $mime;
    }

    // Pakai fill()->save() karena timestamps = false
    $user->fill($data)->save();

    return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
}

    /**
     * Resize ke maksimum 512px lalu re-encode sebagai JPEG kualitas 75,
     * supaya ukuran yang disimpan (base64, di kolom text) jauh lebih kecil.
     */
    private function compressPhoto(string $path): array
    {
        if (!function_exists('imagecreatefromstring')) {
            return [file_get_contents($path), mime_content_type($path)];
        }

        $source = @imagecreatefromstring(file_get_contents($path));

        if (!$source) {
            return [file_get_contents($path), mime_content_type($path)];
        }

        $width = imagesx($source);
        $height = imagesy($source);
        $ratio = min(1, 512 / max($width, $height));
        $newWidth = (int) round($width * $ratio);
        $newHeight = (int) round($height * $ratio);

        $resized = imagecreatetruecolor($newWidth, $newHeight);
        imagefill($resized, 0, 0, imagecolorallocate($resized, 255, 255, 255));
        imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        ob_start();
        imagejpeg($resized, null, 75);
        $bytes = ob_get_clean();

        imagedestroy($source);
        imagedestroy($resized);

        return [$bytes, 'image/jpeg'];
    }

    /**
     * Stream foto profil dari database.
     */
    public function photo(User $user)
    {
        abort_unless($user->photo_data, 404);

        return response(base64_decode($user->photo_data), 200, [
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
