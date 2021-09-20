@extends ('layouts.app')
@section('content')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>File Manager</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item">
                App Views
            </li>
            <li class="breadcrumb-item active">
                <strong>File Manager</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="file-manager">
                        <h5>Show:</h5>
                        <a href="{{route('filemanager.all')}}" class="file-control active">All</a>
                        <a href="{{route('filemanager.documents')}}" class="file-control">Documents</a>
                        <a href="{{route('filemanager.audio')}}" class="file-control">Audio</a>
                        <a href="{{route('filemanager.images')}}" class="file-control">Images</a>
                        <div class="hr-line-dashed"></div>
                        <form action="{{route('filemanager.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" value="" class="btn btn-primary btn-block">
                            <button type="submit" class="btn btn-primary btn-block" name="button">Upload</button>
                        </form>
                        <div class="hr-line-dashed"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    @foreach ($files as $file)
                    <div class="file-box">
                        <div class="file">
                            <a href="{{$file->file_path}}">
                                <span class="corner"></span>
                                <div class="image">
                                    @if ($file->file_ext == 'application/pdf')
                                    <img alt="pdf" class="img-fluid" src="{{asset('assets/img/pdf.png')}}">
                                    @elseif ($file->file_ext == 'audio/wav')
                                    <img alt="Audio" class="img-fluid" src="{{asset('assets/img/audio.jpeg')}}"> 
                                    @elseif ($file->file_ext == 'image/jpeg' || 'image/jpg' || 'image/png')
                                    <img alt="image" class="img-fluid" src="{{$file->file_path}}">
                                    @endif
                                </div>
                                <div class="file-name">
                                    {{$file->file_name}}
                                    <br>
                                    <small>{{$file->updated_at}}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach    
                </div>
            </div>
        </div>
    </div>
</div>




@endsection                