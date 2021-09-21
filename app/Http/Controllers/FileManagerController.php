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
        return view('filemanager.index', ['files' => $files]);
         
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
        //echo "<pre>"; print_r($request->file); die;
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
          return redirect()->route('filemanager.index');
          $files = FileManager::get();
          return view('filemanager.index', ['files' => $files]);
          
         
         
         

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FileManager  $fileManager
     * @return \Illuminate\Http\Response
     */
    public function show(FileManager $fileManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FileManager  $fileManager
     * @return \Illuminate\Http\Response
     */
    public function edit(FileManager $fileManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FileManager  $fileManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileManager $fileManager)
    {
        //
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
    
    // public function all()
    // {
    // 
    //      $files = FileManager::get();
    //      return view('filemanager.index', ['files' => $files]);
    // 
    // }
    // 
    // public function documents()
    // {
    //     $pdf = 'application/pdf';
    //     $doc ='application/vnd.openxmlformats-officedocument.wordprocessingml.document';
    //     $zip = 'application/zip';
    //     $data = FileManager::where('file_ext','=', $pdf)->orwhere('file_ext','=', $doc)->orwhere('file_ext','=', $zip)->get();
    // 
    //     return view('filemanager.index', ['data' => $data]);
    // 
    //     //return view('filemanager.index', ['files' => $files]);
    // }
    // 
    // public function audio()
    // {
    //     $wav = 'audio/wav';
    //     $mp3 = 'audio/mp3';
    //     $data = FileManager::where('file_ext','=', $wav)->orwhere('file_ext','=', $mp3)->get();
    //     return view('filemanager.index', ['data' => $data ]);
    // }
    // 
    // public function images()
    // {
    //     $jpeg = 'image/jpeg';
    //     $png = 'image/png';
    //     $data = FileManager::where('file_ext','=', $jpeg)->orwhere('file_ext','=', $png)->get();
    //     return view('filemanager.index', ['data' => $data ]);
    // }
    
}
