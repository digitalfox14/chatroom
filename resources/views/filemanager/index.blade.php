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


<div id="MyPopup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div>
                <button type="button" class="btn btn-danger float-right mt-2 mr-2" id="close" data-dismiss="modal">
                    Close</button>    
            </div>
            <div class="hr-line-dashed"></div>
            
            <form action="{{route('filemanager.shareFiles')}}" method="post">
                @csrf
            <div>
                    <input type="hidden" name="fileId" id="fileId">
                    <input type="hidden" name="filePath" id="filePath">
                    <input type="text" name="fileName" id="fileName" disabled class="col-12 mr-1  form-control"> 
            </div>
            @foreach ($usersList as $user)
                
                <div class="hr-line-dashed"></div>
            <div>
                <h3>
                <img src="" class="ml-5" width="40px" height="40px">
                    {{$user->name}}
                    <input class="float-right mr-5 check" name="check" value="{{$user->id}}" type="checkbox">
                </h3>
            </div>
            @endforeach
            <div class="modal-footer">  
                <button type="button" name="button" id="send" class="btn btn-primary">Send</button>
            </div>
        </form>
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
                    
                    $('#'+"div-file-box").append(`<div class="file-box" id="`+value.id+`">
                    <div class="file">
                    <a href="`+value.file_path+`" target="_blank">
                    <span class="corner"></span>
                    <div class="image">
                    <center><img class="img-fluid"  width="`+value.width+`"  src="`+value.thumbnail+`"></center>
                    </div>
                    <div class="file-name" >
                    <p>
                    <small>
                    `+value.file_name+`
                    </small>
                    </a>
                    <button class="float-right btn btn-xs btn-white del ">&#x274C;</button>
                    <button class="float-right btn btn-xs btn-white shere ">&#10532; </button>
                    </p>
                    </div>
                    </div>
                    </div>
                    `); 
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
        
        $('body').on('click','.del',function() {
            var _token = $('meta[name="csrf-token"]').attr('content');
            console.log(_token);
            var id = $(this).parents('.file-box').attr('id');
            console.log(id);
            $.ajax({
                type: 'POST',
                url: "/filemanager/"+id+"/delete",
                data: {'_token':_token },
                
            });
            $(this).parents('.file-box').remove();
        });
        
        $('body').on('click','.shere',function() {
            
            var title = "Greetings";
           var body = "Welcome to ASPSnippets.com";

           $("#MyPopup .modal-title").html(title);
           $("#MyPopup .modal-body").html(body);
           $("#MyPopup").modal("show");
           var id = $(this).parents('.file-box').attr('id');
           $.ajax({
              type:'GET',
              url: '/filemanager/share/'+id,
              data:{'id':id},
              success:function(response) {
                 
                  $( response ).each(function( index,value ) {
                      var fileId = value.id;
                       var fileName = value.file_name;
                       var filePath = value.file_path;
                        $('#fileId').val(fileId);
                        $('#fileName').val(fileName);
                        $('#filePath').val(filePath);
                        console.log(fileId);
                   });
              },
           });
        });
            
        $("#send").click(function(){
            var _token = $('meta[name="csrf-token"]').attr('content');
            var userIds = new Array();
            $('input:checked').each(function(value) {
                userIds.push($(this).val());
            });
                
            var fileId = $('#fileId').val();
            var filePath = $('#filePath').val();
            $.ajax({
                    type: 'POST',
                    url:'/filemanager/share',
                    data: {'_token':_token, 'fileId':fileId, 'filePath':filePath, 'user_ids': userIds },
            });
            $('#close').click();
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
                    $('#'+"div-file-box").append(`<div class="file-box" id="`+resp.id+`">
                    <div class="file">
                    <a href="`+resp.file_path+`" target="_blank">
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
                    <button class="float-right btn btn-xs btn-white del ">&#x274C;</button>
                    <button class="float-right btn btn-xs btn-white shere ">&#10532;</button>
                    </div>
                    </div>
                    </div>
                    `);         
                },
            });
        });       
    });
</script>
@endsection                
                           