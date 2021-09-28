<?php

namespace App\Http\Controllers;

use App\Models\FileManager;
use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\User;
use App\Models\ShereFile;
use Auth;
use Illuminate\Support\Facades\Storage;


class FileManagerController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {   $auth = Auth::id();
        
        $file = FileManager::WhereHas('shares', function ($query) {
            $query->where('user_id', Auth::id());
            
        })->get();
        
        $usersList = User::where('id','!=',$auth)->get();
        return view('filemanager.index',['usersList' => $usersList]);
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        
        
        $fileOriginalName = $request->file->getClientOriginalName();
        $fileextension = pathinfo($fileOriginalName);
        $fileExt = $fileextension['extension'];
        
        $file = new FileManager;
        $fileOriginalName = $request->file->getClientOriginalName();    
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
         $delId = $fileManager->id;
         $del_user_id = $fileManager->user_id;
            $file = ShereFile::where(function ($query)use($delId,$del_user_id){
                        $query->where('file_id', $delId)
                        ->where('user_id', Auth::id());
                        if ($del_user_id == Auth::id()) {
                            $del = FileManager::where('id',$delId);
                            $del->delete();
                            
                        }
                    });
                    $file->delete();
    }
    
    public function files(Request $request)
    {
        $type = $request->type ? $request->type : 'all';
        
        $files = FileManager::where(function ($query){
            $query->where('user_id', Auth::id());
            $query->orWhereHas('shares', function($query) {
                $query->where('user_id', Auth::id());
            });
        });
                    
        if ($type == 'image') {
            $files = $files->whereIn('file_ext', ['jpg', 'png']);
        }
        
        elseif ($type == 'audio') {
            $files = $files->whereIn('file_ext', ['wav']);
        }
        
        elseif ($type == 'doc') {
            $files = $files->whereIn('file_ext', ['pdf']);
        }
        
        else {            
        }
        
        $files = $files->get();
        return response()->json($files);
    }
    
    public function share(Request $id)
    {
        $shereId = $id->id;
        $shere = FileManager::where('id',$shereId)->get();
        return response()->json($shere);
    }
    
    public function ShareFiles(Request $request)
    {
        
        foreach ($request->user_ids as $user_id) 
        {
            $shareFile = new ShereFile;
            $shareFile->file_id = $request->fileId;
            $shareFile->user_id = $user_id;
            $shareFile->share_by = Auth::id();
            $shareFile->save();
        }
    }
}

