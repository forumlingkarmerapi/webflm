<?php

namespace App\Http\Controllers\dapur;

use Illuminate\Http\Request;
use App\Helpers\Gudangfungsi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class PublikasiController extends Controller
{
    public function index(){
        $data['judulhalaman'] = 'Publikasi';

        return view('dapur.publikasi.index', $data);
    }

    public function getList(){
        $data = DB::table('publikasi as pu')
                    ->join('publikasi_kategori as kat', 'pu.id_publikasi_kategori', '=', 'kat.id_publikasi_kategori')
                    ->orderBy('pu.created_at', 'desc')->get();

        $datatable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('judulpublikasi', function($row){
                return '<p class="ndrparagraf">'.$row->judul_publikasi.'</p>';
            })
	    ->addColumn('kategori', function($row){
                return '<p class="ndrparagraf">'.$row->nama_kategori.'</p>';
            })
            ->addColumn('tanggalposting', function($row){
                return '<p class="ndrparagraf">'.Gudangfungsi::tanggalindoshort($row->tanggal_publikasi).'</p>';
            })
            ->addColumn('counter', function($row){
                return '<p class="ndrparagraf">'.$row->hits.'</p>';
            })
            ->addColumn('filedownload', function($row){
                if ($row->berkas != ''){
                    $cat = 'publikasi';
                    $file = '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalku" onclick="showFormRead(\''.$row->id_publikasi.'\', \''.$cat.'\')"><i class="feather icon-download-cloud"></i></a>';
                }else{
                    $file = '-';
                }
                return $file;
            })
            ->addColumn('action', function($row){
                $actionBtn = '<button type="button" onclick="showFormedit(\''.$row->id_publikasi.'\')" title="Edit" class="btn btn-sm waves-effect waves-light btn-info m-b-0 " style="padding-bottom: 0px;padding-top:0px;">
                                <i class="feather icon-edit-2"></i>
                            </button>
                            <button type="button" onclick="hapus(\''.$row->id_publikasi.'\')" title="Hapus" class="btn btn-sm waves-effect waves-light btn-danger m-b-0 " style="padding-bottom: 0px;padding-top:0px;">
                                <i class="feather icon-trash-2"></i>
                            </button>';
                return $actionBtn;
            })
            ->rawColumns(['judulpublikasi', 'kategori', 'tanggalposting', 'filedownload', 'counter', 'action'])
            ->make(true);
        
        return $datatable;
    }

    public function add(){
        $data['judulmodal'] = 'Tambah Publikasi';
        $data['kategori'] = DB::table('publikasi_kategori')->orderBy('nama_kategori', 'asc');

        return view('dapur.publikasi.add', $data);
    }
	
	public function save_(Request $req){
		echo "Apa ya";
	}

    public function save(Request $req){
        $kategori_publikasi = $req->post('kategori_publikasi');
        $judul_publikasi = $req->post('judul_publikasi');
        $judul_publikasi_en = $req->post('judul_publikasi_en');
        $deskripsi = $req->post('deskripsi');
        $deskripsi_en = $req->post('deskripsi_en');
        $is_internal = $req->post('is_internal');
        $tanggal_publikasi = Gudangfungsi::tanggal_mysql($req->post('tanggal_publikasi'));

        if ($req->hasFile('gambar')){
            $file = $req->file('gambar');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namagambar = $namafileOri.'_'.time().'.'.$ekstensi;

            $file->move("public/uploads/publikasi/cover", "{$namagambar}");
        }else{
            $namagambar = '';
        }
        if ($req->hasFile('berkas')){
            $file = $req->file('berkas');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namaberkas = $namafileOri.'_'.time().'.'.$ekstensi;

            $file->move("public/uploads/publikasi", "{$namaberkas}");
        }else{
            $namaberkas = '';
        }

        if ($is_internal != ''){
            $berkas = $namaberkas;
            $berkas_sumber = 'internal';
        }else{
            $berkas = $req->post('berkas_url');
            $berkas_sumber = 'eksternal';
        }

        $data = ['id_publikasi_kategori' => $kategori_publikasi, 
                 'judul_publikasi' => $judul_publikasi,
                 'judul_publikasi_en' => $judul_publikasi_en,
                 'deskripsi' => $deskripsi,
                 'deskripsi_en' => $deskripsi_en,
                 'gambar_sampul' => $namagambar,
                 'berkas_sumber' => $berkas_sumber,
                 'berkas' => $berkas,
                 'tanggal_publikasi' => $tanggal_publikasi,
                 'created_at' => date('Y-m-d H:i:s'),
                ];

        try{
            $simpan = DB::table('publikasi')->insert($data);

            if ($simpan){
                $response = ['result'=>'success', 'message'=>'Save successfully'];
            }else{
                $response = ['result'=>'failed', 'message'=>'Save failed'];
            }
        }catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062){
                $response = ['result'=>'failed', 'message'=>'Duplicate key found.']; 
            }else{
				$response = ['result'=>'failed', 'message'=>'Error: '.errorCode];
			}
        }

        return response()->json($response);
    }

    public function edit(Request $req){
        $id = $req->get('id');

        $data['judulmodal'] = 'Edit Publikasi';
        $data['kategori'] = DB::table('publikasi_kategori')->orderBy('nama_kategori', 'asc');
        $data['data'] = DB::table('publikasi as pu')
                        ->join('publikasi_kategori as kat', 'pu.id_publikasi_kategori', '=', 'kat.id_publikasi_kategori')
                        ->where('pu.id_publikasi', $id)->first();

        return view('dapur.publikasi.edit', $data);
    }

    public function saveupdate(Request $req){
        $id_publikasi = $req->post('id_publikasi');
        $kategori_publikasi = $req->post('kategori_publikasi');
        $judul_publikasi = $req->post('judul_publikasi');
        $judul_publikasi_en = $req->post('judul_publikasi_en');
        $deskripsi = $req->post('deskripsi');
        $deskripsi_en = $req->post('deskripsi_en');
        $is_internal = $req->post('is_internal');
        $tanggal_publikasi = $req->post('tanggal_publikasi');

        if ($req->hasFile('gambar')){
            $file = $req->file('gambar');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namagambar = $namafileOri.'_'.time().'.'.$ekstensi;

            $file->move("public/uploads/publikasi/cover", "{$namagambar}");
        }else{
            $namagambar = $req->post('gambar_current');
        }
        if ($req->hasFile('berkas')){
            $file = $req->file('berkas');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namaberkas = $namafileOri.'_'.time().'.'.$ekstensi;

            $file->move("public/uploads/publikasi", "{$namaberkas}");
        }else{
            $namaberkas = $req->post('berkas_current');
        }

        if ($is_internal != ''){
            $berkas = $namaberkas;
            $berkas_sumber = 'internal';
        }else{
            $berkas = $req->post('berkas_url');
            $berkas_sumber = 'eksternal';
        }

        $data = ['id_publikasi_kategori' => $kategori_publikasi, 
                 'judul_publikasi' => $judul_publikasi,
                 'judul_publikasi_en' => $judul_publikasi_en,
                 'deskripsi' => $deskripsi,
                 'deskripsi_en' => $deskripsi_en,
                 'gambar_sampul' => $namagambar,
                 'berkas_sumber' => $berkas_sumber,
                 'berkas' => $berkas,
                 'tanggal_publikasi' => $tanggal_publikasi,
                 'updated_at' => date('Y-m-d H:i:s'),
                ];
		//var_dump($data);
        
        try{
            $simpan = DB::table('publikasi')->where('id_publikasi', $id_publikasi)->update($data);

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
        
        $data = DB::table('publikasi')->where('id_publikasi', $id);
        if ($data->count() != 0 ){
            $namagambar = $data->first()->gambar_sampul;
            if (File::exists("public/uploads/publikasi/cover/".$namagambar) == true){
                File::delete("public/uploads/publikasi/cover/".$namagambar);
            }

            $namaberkas = $data->first()->berkas;
            if (File::exists("public/uploads/publikasi/".$namaberkas) == true){
                File::delete("public/uploads/publikasi/".$namaberkas);
            }
        }

        $hapus = DB::table('publikasi')->where('id_publikasi', $id)->delete();

        if ($hapus){
            $response = ['result'=>'success', 'message'=>'Deleting data successfully'];
        }else{
            $response = ['result'=>'failed', 'message'=>'Deleteting data failed'];
        }

        return response()->json($response);
    }
}
