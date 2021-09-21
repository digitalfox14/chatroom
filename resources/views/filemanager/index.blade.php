@extends ('layouts.app')
@section('content')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>File Manager</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Home</a>
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
                        <form method="post" id="file-form" enctype="multipart/form-data" action="/filemanager/store">
                            @csrf
                            <input type="file" name="file" id="file" class="btn btn-primary btn-block">
                            <!-- <button type="button" id="uploadBtn" class="btn btn-primary btn-block" name="button">Upload</button> -->
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
                                    
                                    <img alt="pdf" class="img-fluid"  height="50%" width="40%"  src="{{$file->file_path}}"></center>
                                    
                                </div>
                                <div class="file-name" >
                    
                                    <br>
                                    <small>
                                        {{$file->file_name}}
                                    </small>
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
@section('extra-scripts')
<script>

    $('#file').change(function() {
        var formData =  new FormData(document.getElementById('file-form'));

        $.ajax({
               type: 'POST',
               url: '/filemanager/store',
               enctype: 'multipart/form-data',
               data: formData,
               processData: false,
               contentType: false,

           });
});


</script>
@endsection                
                           