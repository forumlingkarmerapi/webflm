<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Helpers\Gudangfungsi as Gudangfungsi;

class HomeController extends Controller
{
    public function index(){
        $data['sliders'] = DB::table('image_slider')->where('is_active', 'yes')->orderBy('created_at', 'desc');
        $data['berita'] = DB::table('berita')->where('id_status_berita', '2')->orderBy('tanggal_publikasi', 'desc')->limit(4);
        $data['publikasi'] = DB::table('publikasi')->orderBy('tanggal_publikasi', 'desc');
        
        return view('home', $data);
    }

    public function berita(){
        $data['judulhalaman'] = "";
        $data['berita'] = DB::table('berita as b')
                            ->join('berita_kategori as kat', 'b.id_berita_kategori', '=', 'kat.id_berita_kategori')
                            ->orderBy('tanggal_publikasi', 'desc')->paginate(12);
        $data['publikasi'] = DB::table('publikasi')->orderBy('tanggal_publikasi', 'desc')->limit(6)->get();
        $data['recentnews'] = DB::table('berita')->orderBy('tanggal_publikasi', 'desc')->limit(5)->get();
        $data['popularnews'] = DB::table('berita')->orderBy('hits', 'desc')->limit(5)->get();

        return view('berita', $data);
    }

    public function berita_baca($slug){
        $data['judulhalaman'] = "";
        $data['berita'] = DB::table('berita as b')
                            ->join('berita_kategori as kat', 'b.id_berita_kategori', '=', 'kat.id_berita_kategori')
                            ->where('slug', $slug)->first();
        $data['publikasi'] = DB::table('publikasi')->orderBy('tanggal_publikasi', 'desc')->limit(6)->get();
        $data['recentnews'] = DB::table('berita')->orderBy('tanggal_publikasi', 'desc')->limit(5)->get();
        $data['popularnews'] = DB::table('berita')->orderBy('hits', 'desc')->limit(5)->get();
        
        // Update Hits
        $id_berita = $data['berita']->id_berita;
        $curr_hits = $data['berita']->hits;
        $counter_hits = $curr_hits+1;
        DB::table('berita')->where('id_berita', $id_berita)->update(['hits'=>$counter_hits]);

        return view('berita_baca', $data);
    }

    public function berita_cari(Request $req){
        $keyword = $req->post('katakunci');

        $data['judulhalaman'] = 'Pencarian: '.$keyword;
        $data['berita'] = DB::table('berita as b')
                            ->join('berita_kategori as kat', 'b.id_berita_kategori', '=', 'kat.id_berita_kategori')
                            ->where('b.judul', 'like', '%'.$keyword.'%')
                            ->orderBy('tanggal_publikasi', 'desc')->paginate(12);
        $data['infografis'] = DB::table('infografis')->orderBy('tanggal_publikasi', 'desc')->limit(6)->get();
        $data['kategori'] = DB::table('berita_kategori')->orderBy('kategori_berita', 'asc');
        $data['recentnews'] = DB::table('berita')->orderBy('tanggal_publikasi', 'desc')->limit(5)->get();
        $data['popularnews'] = DB::table('berita')->orderBy('hits', 'desc')->limit(5)->get();

        return view('depan.berita', $data);
    }

    public function publikasi(){
        $data['judulhalaman'] = "Publikasi";
        $data['publikasi'] = DB::table('publikasi')->orderBy('tanggal_publikasi', 'desc')->limit(6)->paginate(12);
        $data['kategori'] = DB::table('berita_kategori')->orderBy('kategori_berita', 'asc');
        $data['recentnews'] = DB::table('berita')->orderBy('tanggal_publikasi', 'desc')->limit(5)->get();
        $data['popularnews'] = DB::table('berita')->orderBy('hits', 'desc')->limit(5)->get();

        return view('publikasi', $data);
    }
}
