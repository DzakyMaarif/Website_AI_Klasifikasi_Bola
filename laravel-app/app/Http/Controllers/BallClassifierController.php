<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BallClassifierController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function predict(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048'
        ]);

        $image = $request->file('image');
        
        // Simpan gambar sementara untuk ditampilkan
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = $image->storeAs('temp', $imageName, 'public');
        
        // Kirim ke API Python
        $response = Http::attach(
            'image', file_get_contents($image), $image->getClientOriginalName()
        )->post('http://localhost:5000/api/predict');

        if ($response->successful()) {
            $result = $response->json();
            
            return view('upload', [
                'prediction' => $result['prediction'],
                'imagePath' => asset('storage/' . $imagePath) // Path untuk menampilkan gambar
            ]);
        } else {
            // Hapus gambar jika API gagal
            \Storage::disk('public')->delete($imagePath);
            return back()->withErrors(['error' => 'Gagal terhubung ke API Python.']);
        }
    }
    
    // Method untuk membersihkan gambar lama (opsional)
    public function cleanupOldImages()
    {
        $files = \Storage::disk('public')->files('temp');
        $now = time();
        
        foreach ($files as $file) {
            $fileTime = \Storage::disk('public')->lastModified($file);
            // Hapus file yang lebih dari 1 jam
            if ($now - $fileTime > 3600) {
                \Storage::disk('public')->delete($file);
            }
        }
    }
}