<?php

namespace App\Http\Controllers;

use App\Models\FileManager;
use Illuminate\Http\Request;
use Auth;
class FileManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = FileManager::get();
        return view('filemanager.index', ['files' => $files,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = new FileManager;
        $fileOriginalName = $request->file->getClientOriginalName();
        $fileExt = $request->file->getClientMimeType();
        $path = $request->file('file')->store('files');
        $path_url = url('storage/'.$path);
        $file->user_id = Auth::id();
        $file->file_name = $fileOriginalName;
        $file->file_ext = $fileExt;
        $file->file_path = $path_url;
        $file->save();
        return response()->json($file);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FileManager  $fileManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileManager $fileManager)
    {
        //
    }
    
    public function all()
    {
         $userId = Auth::id();
         $files = FileManager::where('user_id',$userId)->get();
         return view('filemanager.index', ['files' => $files]);
         return redirect()->route('filemanager.index');
    }
    
    public function documents()
    {
        $userId = Auth::id();
        $pdf = 'application/pdf';
        $doc ='application/vnd.openxmlformats-officedocument.wordprocessingml.document';
        $zip = 'application/zip';
        $data = FileManager::where(function($query)use($userId){
            $query->where('user_id', $userId);
        })->where(function($query)use($pdf,$doc,$zip){
            $query->where('file_ext',$pdf)
            ->orwhere('file_ext',$doc)
            ->orwhere('file_ext',$zip);
        })->get();
        
        return view('filemanager.index', ['data' => $data]);
        return redirect()->route('filemanager.index');
    }
    
    public function audio()
    {
        $userId = Auth::id();
        $wav = 'audio/wav';
        $mp3 = 'audio/mp3';
        $data = FileManager::where(function($query)use($userId){
            $query->where('user_id', $userId);
        })->where(function($query)use($wav,$mp3){
            $query->where('file_ext',$wav)
            ->orwhere('file_ext',$mp3);
        })->get();
        
        return view('filemanager.index', ['data' => $data ]);
        return redirect()->route('filemanager.index');
    }
    
    public function images()
    {
        $userId = Auth::id();
        $jpeg = 'image/jpeg';
        $png = 'image/png';
        $data = FileManager::where(function($query)use($userId){
            $query->where('user_id', $userId);
        })->where(function($query)use($jpeg,$png){
            $query->where('file_ext',$jpeg)
            ->orwhere('file_ext',$png);
        })->get();
        
        return view('filemanager.index', ['data' => $data ]);    
        return redirect()->route('filemanager.index');
    }
    
}
