<?php

namespace App\Http\Controllers\dapur;

use Illuminate\Http\Request;
use App\Helpers\Gudangfungsi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class ImagesliderController extends Controller
{
    public function index(){
        $data['judulhalaman'] = 'Image Slider';

        return view('dapur.imageslider.index', $data);
    }

    public function getList(){
        $data = DB::table('image_slider')
                    ->orderBy('created_at', 'desc')->get();

        $datatable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('gambarslider', function($row){
                return '<img src="'.asset('uploads/imagesliders/'.$row->gambar).'" width="100px" style="margin-top:10px;border-radius:5px;border:1px solid #cdcdcd;">';
            })
            ->addColumn('isactive', function($row){
                if ($row->is_active == 'yes'){
                    return '<span class="badge bg-success">Yes</span>';
                }else{
                    return '<span class="badge bg-primary">No</span>';
                }
            })
            ->addColumn('tanggalposting', function($row){
                return '<p class="ndrparagraf">'.Gudangfungsi::tanggalindoshort($row->tanggal_publikasi).'</p>';
            })
            ->addColumn('action', function($row){
                $actionBtn = '<button type="button" onclick="showFormedit(\''.$row->id_image_slider.'\')" title="Edit" class="btn btn-sm waves-effect waves-light btn-info m-b-0 " style="padding-bottom: 0px;padding-top:0px;">
                                <i class="feather icon-edit-2"></i>
                            </button>
                            <button type="button" onclick="hapus(\''.$row->id_image_slider.'\')" title="Hapus" class="btn btn-sm waves-effect waves-light btn-danger m-b-0 " style="padding-bottom: 0px;padding-top:0px;">
                                <i class="feather icon-trash-2"></i>
                            </button>';
                return $actionBtn;
            })
            ->rawColumns(['gambarslider', 'isactive', 'tanggalposting', 'action'])
            ->make(true);
        
        return $datatable;
    }

    public function add(){
        $data['judulmodal'] = 'Tambah Image Slider';

        return view('dapur.imageslider.add', $data);
    }

    public function save(Request $req){
        $judul_slider = $req->post('judul_slider');
        $alamat_url = $req->post('alamat_url');
        $is_active = ($req->post('is_active') != '' ? 'yes' : 'no');
        $tanggal_publikasi = $req->post('tanggal_publikasi');

        if ($req->hasFile('gambar')){
            $file = $req->file('gambar');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namagambar = $namafileOri.'_'.time().'.'.$ekstensi;

            $file->move("public/uploads/imagesliders", "{$namagambar}");
        }else{
            $namagambar = '';
        }

        $data = ['judul_slider' => $judul_slider, 
                 'alamat_url' => $alamat_url,
                 'gambar' => $namagambar,
                 'is_active' => $is_active,
                 'tanggal_publikasi' => $tanggal_publikasi,
                 'created_at' => date('Y-m-d H:i:s'),
                ];
        
        try{
            $simpan = DB::table('image_slider')->insert($data);

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

        $data['judulmodal'] = 'Edit Image Slider';
        $data['data'] = DB::table('image_slider')
                        ->where('id_image_slider', $id)->first();

        return view('dapur.imageslider.edit', $data);
    }

    public function saveupdate(Request $req){
        $id_imageslider = $req->post('id_imageslider');
        $judul_slider = $req->post('judul_slider');
        $alamat_url = $req->post('alamat_url');
        $is_active = ($req->post('is_active') != '' ? 'yes' : 'no');
        $tanggal_publikasi = $req->post('tanggal_publikasi');

        if ($req->hasFile('gambar')){
            $file = $req->file('gambar');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namagambar = $namafileOri.'_'.time().'.'.$ekstensi;

            $file->move("public/uploads/imagesliders", "{$namagambar}");
        }else{
            $namagambar = $req->post('gambar_current');
        }

        $data = ['judul_slider' => $judul_slider, 
                 'alamat_url' => $alamat_url,
                 'gambar' => $namagambar,
                 'is_active' => $is_active,
                 'tanggal_publikasi' => $tanggal_publikasi,
                 'updated_at' => date('Y-m-d H:i:s'),
                ];
        
        try{
            $simpan = DB::table('image_slider')->where('id_image_slider', $id_imageslider)->update($data);

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
        
        $data = DB::table('image_slider')->where('id_image_slider', $id);
        if ($data->count() != 0 ){
            $namagambar = $data->first()->gambar;
            if (File::exists("public/uploads/imagesliders/".$namagambar) == true){
                File::delete("public/uploads/imagesliders/".$namagambar);
            }
        }

        $hapus = DB::table('image_slider')->where('id_image_slider', $id)->delete();

        if ($hapus){
            $response = ['result'=>'success', 'message'=>'Deleting data successfully'];
        }else{
            $response = ['result'=>'failed', 'message'=>'Deleteting data failed'];
        }

        return response()->json($response);
    }
}
