<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class AuthController extends Controller
{
        public function register()
    {
        return view('auth.register');
    }

    public function registersave(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                Rule::when($request->role === 'admin', [
                    function ($attribute, $value, $fail) {
                        if (!str_ends_with($value, 'desapurwomartani@slemankab.go.id')) {
                            $fail('Email admin harus menggunakan email kalurahan');
                        }
                    },
                ]),
            ],
            'password' => 'required|string|min:8|max:12|confirmed', // Ubah validasi password
            'role' => 'required|in:admin,karyawan',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }
  
    public function login()
    {
        return view('auth/login');
    }
  
    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();
  
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
  
        $request->session()->regenerate();
  
        return redirect()->route('home');
    }
  
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
  
        $request->session()->invalidate();
  
        return redirect('/');
    }
    
    public function berita()
    {
        $beritaAcara = BeritaAcara::all(); // Ambil semua data dari tabel BeritaAcara

        return view('berita', compact('beritaAcara')); // Kirim $beritaAcara ke view
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_rapat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'ruang' => 'required|string|max:255',
            'jumlah_peserta' => 'required|integer',
            'hasil_rapat' => 'required|string|max:255',
        ]);

        $berita = BeritaAcara::create([
            'nama_rapat' => $request->nama_rapat,
            'tanggal' => $request->tanggal,
            'ruang' => $request->ruang,
            'jumlah_peserta' => $request->jumlah_peserta,
            'hasil_rapat' => $request->hasil_rapat,
        ]);

        return redirect()->back()->with('success', 'Berita acara berhasil disimpan!');
    }

    public function downloadPDF($id)
    {
        // Cari data berdasarkan id_input, bukan id
        $beritaAcara = BeritaAcara::where('id_input', $id)->firstOrFail();

        // Siapkan data untuk tampilan PDF
        $tanggal = $beritaAcara->tanggal;
        $ruang = $beritaAcara->ruang;
        $nama_rapat = $beritaAcara->nama_rapat;
        $jumlah_peserta = $beritaAcara->jumlah_peserta;
        $hasil_rapat = $beritaAcara->hasil_rapat;

        // Render tampilan PDF menggunakan Blade
        $pdf = FacadePdf::loadView('pdf.berita_acara', compact('tanggal', 'ruang', 'nama_rapat', 'jumlah_peserta', 'hasil_rapat'));

        // Unduh file PDF
        return $pdf->download('berita_acara_' . $beritaAcara->id_input . '.pdf');
    }

    public function form()
    {
        // Cek jika ada data yang dikirim
        $data = session('data');
        return view('berita', compact('data'));
    }

    public function profile()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar opsional
        ]);
    
        $user = auth()->user();
    
        // Simpan gambar profil jika diunggah
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $folderPath = public_path('storage/profile_pictures/' . $user->id);
    
            // Buat folder jika belum ada
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0755, true);
            }
    
            // Hapus gambar lama jika ada
            $oldPicture = $folderPath . '/profile_picture.jpg';
            if (file_exists($oldPicture)) {
                unlink($oldPicture);
            }
    
            // Simpan file baru dengan nama tetap (profile_picture.jpg)
            $file->move($folderPath, 'profile_picture.jpg');
        }
    
        // Perbarui nama pengguna
        $user->name = $request->name;
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
