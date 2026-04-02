<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolProfile;
use App\Models\Post;
use App\Models\PpdbSetting;

class HomeController extends Controller
{
    public function index()
    {
        $profiles = [
            'nama_sekolah' => SchoolProfile::getValue('nama_sekolah'),
            'alamat' => SchoolProfile::getValue('alamat'),
            'tlp' => SchoolProfile::getValue('tlp'),
            'email' => SchoolProfile::getValue('email'),
            'logo' => SchoolProfile::getValue('logo'),
            'hero_image' => SchoolProfile::getValue('hero_image'),
        ];
        $berita = Post::where('type', 'berita')->whereNotNull('published_at')->latest()->take(3)->get();
        $acara = Post::where('type', 'acara')->whereNotNull('published_at')->latest()->take(3)->get();
        $prestasi = Post::where('type', 'prestasi')->whereNotNull('published_at')->latest()->take(3)->get();
        $ekskul = Post::where('type', 'ekstrakurikuler')->whereNotNull('published_at')->latest()->take(3)->get();
        
        $ppdb = PpdbSetting::where('is_open', true)
            ->where(function ($query) {
                $query->whereNull('open_date')->orWhere('open_date', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('close_date')->orWhere('close_date', '>=', now());
            })
            ->first();

        return view('home', compact('profiles', 'berita', 'acara', 'prestasi', 'ekskul', 'ppdb'));
    }
}
