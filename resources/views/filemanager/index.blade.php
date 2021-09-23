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
                        <a href="javascript:void(0)" id="all" class="file-control ">All</a>
                        <a href="javascript:void(0)"  id="doc" class="file-control">Documents</a>
                        <a href="javascript:void(0)"  id="audio" class="file-control">Audio</a>
                        <a href="javascript:void(0)" id="image" class="file-control">Images</a>
                        <div class="hr-line-dashed"></div>
                        <form method="post" id="file-form" enctype="multipart/form-data" action="/filemanager/store">
                            @csrf
                            <label class="btn btn-primary btn-block " id="fileUpload">Upload File</label>
                            <input type="file" hidden name="file" id="file" class="btn btn-primary btn-block">
                        </form>
                        <div class="hr-line-dashed"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="row">
                <div class="col-lg-12" id="div-file-box">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection   
@section('extra-scripts')
<script>

    function getFiles(type = 'all') {
        $.ajax({
            type: 'GET',
            url: '/filemanager/files',
            data: { type },
            success:function (resp){
                $(resp).each(function( index,value ) {
                    $('#'+"div-file-box").append(`<div class="file-box" id="{{$file->id??''}}">
                    <div class="file">
                    <a href="`+value.file_path+`">
                    <span class="corner"></span>
                    <div class="image">
                    <center><img class="img-fluid"  width="`+value.width+`"  src="`+value.thumbnail+`"></center>
                    </div>
                    <div class="file-name" >
                    <small>
                    `+value.file_name+`
                    </small>
                    </a>
                    <button class="float-right btn btn-xs btn-white delete mr-2">&#x274C;</button>
                    <button class="float-right btn btn-xs btn-white shere mr-1">&#10532; </button>
                    </div>
                    </div>
                    </div>`); 
                });
            }
        });
    };


    $(document).ready(function() {
        getFiles();
        
        
        $('#fileUpload').click(function(){
            $('#file').click();
            
        });

        $('.file-control').click(function() {
            $("#div-file-box").empty()
            var type = $(this).attr('id');
            getFiles(type);
        });
        
        $('#file').change(function() {
            var formData =  new FormData(document.getElementById('file-form'));
            $.ajax({
                type: 'POST',
                url: '/filemanager/store',
                enctype: 'multipart/form-data',
                data: formData,
                processData: false,
                contentType: false,
                success: function (resp) {
                    $('#'+"div-file-box").append(`<div class="file-box" id="{{$file->id??''}}">
                    <div class="file">
                    <a href="`+resp.file_path+`">
                    <span class="corner"></span>
                    <div class="image">
                    <center><img class="img-fluid" height="`+resp.height+`" width="`+resp.width+`"  src="`+resp.thumbnail+`"></center>
                    </div>
                    <div class="file-name" >
                    <br>
                    <small>
                    `+resp.file_name+`
                    </small>
                    </a>
                    <button class="float-right btn btn-xs btn-white delete mr-2">&#x274C;</button>
                    <button class="float-right btn btn-xs btn-white shere mr-1">&#10532; </button>
                    </div>
                    </div>
                    </div>`);         
                },
            });
        });       
    });
</script>
@endsection                
                           