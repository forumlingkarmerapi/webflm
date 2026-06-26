<?php

namespace App\Http\Controllers\dapur;

use Illuminate\Http\Request;
use App\Helpers\Gudangfungsi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class BeritaController extends Controller
{
    public function index(){
        $data['judulhalaman'] = 'Berita';

        return view('dapur.berita.index', $data);
    }

    public function getList(){
        $data = DB::table('berita as br')
                    ->join('berita_kategori as kat', 'br.id_berita_kategori', '=', 'kat.id_berita_kategori')
                    ->join('berita_status as st', 'br.id_status_berita', '=', 'st.id_status_berita')
                    ->orderBy('br.created_at', 'desc')->get();

        $datatable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('judulberita', function($row){
                return '<p class="ndrparagraf">'.$row->judul.'</p>';
            })
            ->addColumn('posting', function($row){
                return '<p class="ndrparagraf">'.Gudangfungsi::tanggalindoshort($row->tanggal_publikasi).'</p>';
            })
            ->addColumn('status', function($row){
                if ($row->status_berita == 'draft'){
                    $status = '<span class="badge bg-warning">'.strtoupper($row->status_berita).'</span>';
                }elseif ($row->status_berita == 'terbit'){
                    $status = '<span class="badge bg-success">'.strtoupper($row->status_berita).'</span>';
                }elseif ($row->status_berita == 'ditolak'){
                    $status = '<span class="badge bg-danger">'.strtoupper($row->status_berita).'</span>';
                }

                return '<p class="ndrparagraf">'.$status.'</p>';
            })
            ->addColumn('action', function($row){
                $actionBtn = '<button type="button" onclick="showFormedit(\''.$row->id_berita.'\')" title="Edit" class="btn btn-sm waves-effect waves-light btn-info m-b-0 " style="padding-bottom: 0px;padding-top:0px;">
                                <i class="feather icon-edit-2"></i>
                            </button>
                            <button type="button" onclick="hapus(\''.$row->id_berita.'\')" title="Hapus" class="btn btn-sm waves-effect waves-light btn-danger m-b-0 " style="padding-bottom: 0px;padding-top:0px;">
                                <i class="feather icon-trash-2"></i>
                            </button>';
                return $actionBtn;
            })
            ->rawColumns(['judulberita', 'posting', 'status', 'action'])
            ->make(true);
        
        return $datatable;
    }

    public function add(){
        $data['judulmodal'] = 'Tambah Berita';
        $data['kategori'] = DB::table('berita_kategori')->orderBy('kategori_berita', 'asc');
        $data['status'] = DB::table('berita_status')->orderBy('id_status_berita', 'asc');

        return view('dapur.berita.add', $data);
    }

    public function save(Request $req){
        $kategori_berita = $req->post('kategori_berita');
        $id_pengguna = Auth::user()->id;
        $judul = $req->post('judul');
        $slug = Gudangfungsi::slug($judul);
        $judul_en = $req->post('judul_en');
        $slug_en = Gudangfungsi::slug($judul_en);
        $isi_berita = $req->post('isi_berita');
        $isi_berita_en = $req->post('isi_berita_en');
        $id_status_berita = $req->post('status');
        $is_headline = $req->post('is_headline');
        $tanggal_publikasi = $req->post('tanggal_publikasi');

        if ($req->hasFile('gambar')){
            $file = $req->file('gambar');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafile = $namafileOri.'_'.time().'.'.$ekstensi;

            $file->move("public/uploads/berita", "{$namafile}");
        }else{
            $namafile = '';
        }

        $data = ['id_berita_kategori' => $kategori_berita, 
                 'id_pengguna' => $id_pengguna,
                 'judul' => $judul,
                 'slug' => $slug,
                 'judul_en' => $judul_en,
                 'slug_en' => $slug_en,
                 'isi_berita' => $isi_berita,
                 'isi_berita_en' => $isi_berita_en,
                 'gambar' => $namafile,
                 'id_status_berita' => $id_status_berita,
                 'is_headline' => $is_headline,
                 'tanggal_publikasi' => $tanggal_publikasi,
                 'created_at' => date('Y-m-d H:i:s'),
                ];
        
        try{
            $simpan = DB::table('berita')->insert($data);

            if ($simpan){
                $response = ['result'=>'success', 'message'=>'Save successfully'];
            }else{
                $response = ['result'=>'failed', 'message'=>'Save failed'];
            }
        }catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062){
                $response = ['result'=>'failed', 'message'=>'Duplicate key found.']; 
            }
        }

        return response()->json($response);
    }

    public function edit(Request $req){
        $id = $req->get('id');

        $data['judulmodal'] = 'Edit Berita';
        $data['kategori'] = DB::table('berita_kategori')->orderBy('kategori_berita', 'asc');
        $data['status'] = DB::table('berita_status')->orderBy('id_status_berita', 'asc');
        $data['data'] = DB::table('berita as br')
                        ->join('berita_kategori as kat', 'br.id_berita_kategori', '=', 'kat.id_berita_kategori')
                        ->join('berita_status as st', 'br.id_status_berita', '=', 'st.id_status_berita')
                        ->where('br.id_berita', $id)->first();

        return view('dapur.berita.edit', $data);
    }

    public function saveupdate(Request $req){
        $id_berita = $req->post('id_berita');
        $kategori_berita = $req->post('kategori_berita');
        $id_pengguna = Auth::user()->id;
        $judul = $req->post('judul');
        $slug = Gudangfungsi::slug($judul);
        $judul_en = $req->post('judul_en');
        $slug_en = Gudangfungsi::slug($judul_en);
        $isi_berita = $req->post('isi_berita');
        $isi_berita_en = $req->post('isi_berita_en');
        $id_status_berita = $req->post('status');
        $is_headline = $req->post('is_headline');
        $tanggal_publikasi = $req->post('tanggal_publikasi');

        if ($req->hasFile('gambar')){
            $file = $req->file('gambar');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafile = $namafileOri.'_'.time().'.'.$ekstensi;

            $file->move("public/uploads/berita", "{$namafile}");
        }else{
            $namafile = $req->post('gambar_current');
        }

        $data = ['id_berita_kategori' => $kategori_berita, 
                 'id_pengguna' => $id_pengguna,
                 'judul' => $judul,
                 'slug' => $slug,
                 'judul_en' => $judul_en,
                 'slug_en' => $slug_en,
                 'isi_berita' => $isi_berita,
                 'isi_berita_en' => $isi_berita_en,
                 'gambar' => $namafile,
                 'id_status_berita' => $id_status_berita,
                 'is_headline' => $is_headline,
                 'tanggal_publikasi' => $tanggal_publikasi,
                 'created_at' => date('Y-m-d H:i:s'),
                ];
        
        try{
            $simpan = DB::table('berita')->where('id_berita', $id_berita)->update($data);

            if ($simpan){
                $response = ['result'=>'success', 'message'=>'Save successfully'];
            }else{
                $response = ['result'=>'failed', 'message'=>'Save failed'];
            }
        }catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062){
                $response = ['result'=>'failed', 'message'=>'Duplicate key found.']; 
            }
        }

        return response()->json($response);
    }

    public function delete(Request $req){
        $id = $req->post('id');
        
        $data = DB::table('berita')->where('id_berita', $id);
        if ($data->count() != 0 ){
            $namafile = $data->first()->gambar;

            if (File::exists("public/uploads/berita/".$namafile) == true){
                File::delete("public/uploads/berita/".$namafile);
            }
        }

        $hapus = DB::table('berita')->where('id_berita', $id)->delete();

        if ($hapus){
            $response = ['result'=>'success', 'message'=>'Deleting data successfully'];
        }else{
            $response = ['result'=>'failed', 'message'=>'Deleteting data failed'];
        }

        return response()->json($response);
    }
}
