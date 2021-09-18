@extends ('layouts.app')
@section ('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Agile board</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Miscellaneous</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Agile board</strong>
                        </li>
                    </ol>
                </div>
            </div>
  
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>To-do</h3>
                    <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>

                    <form  action="{{route('task.store')}}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="task" placeholder="Add new task. " class="input form-control-sm form-control" value="{{$ee->task  ?? '' }}">
                        <span class="input-group-append">
                        <button type="submit" class="btn btn-sm btn-white"> <i class="fa fa-plus"></i> Add task</button>
                        </span>
                    </div>
                </form>

                    <ul class="sortable-list connectList agile-list" id="todo">
                        @foreach ($todoTask as $todo)
                        <li class="danger-element" id="{{$todo->id}}">
                            <p contenteditable="true" class="editable">{{$todo->task}}</p>
                            <div class="agile-detail">
                                <button class="float-right btn btn-xs btn-white delete" >&#128465;</button>
                                <i class="fa fa-clock-o"></i> {{$todo->created_at}}
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>In Progress</h3>
                    <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>
                    <ul class="sortable-list connectList agile-list" id="inprogress">
                        @foreach ($inprogressTask as $inprogress)
                        <li class="warning-element"  id="{{$inprogress->id}} ">
                            <p contenteditable="true" class="editable">{{$inprogress->task}}</p>
                            <div class="agile-detail">
                                <button class="float-right btn btn-xs btn-white delete">&#128465;</button>
                                <i class="fa fa-clock-o"></i> {{$inprogress->created_at}}
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Completed</h3>
                    <p class="small" id="drag"><i class="fa fa-hand-o-up"></i> Drag task between list</p>
                    <ul class="sortable-list connectList agile-list" id="completed">
                        @foreach ($completedTask as $completed)
                        <li class="success-element"  id="{{$completed->id}}">
                            <p contenteditable="true" class="editable" >{{$completed->task}}</p>
                            <div class="agile-detail">
                                <button class="float-right btn btn-xs btn-white delete">&#128465; </button>
                                <i class="fa fa-clock-o"></i> {{$completed->created_at}}
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h4>
                Serialised Output
            </h4>
            <p>
                Serializes the sortable's item id's into an array of string.
            </p>

            <div class="output p-m m white-bg"></div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script>
$(document).ready(function(){
    $("#todo, #inprogress, #completed").sortable({
        connectWith: ".connectList",
        cancel: '[contenteditable]',
        update: function( event, ui ) {
            var todo = $( "#todo" ).sortable( "toArray" );
            var inprogress = $( "#inprogress" ).sortable( "toArray" );
            var completed = $( "#completed" ).sortable( "toArray" );
            $('.output').html("ToDo: " + window.JSON.stringify(todo) + "<br/>" + "In Progress: " + window.JSON.stringify(inprogress) + "<br/>" + "Completed: " + window.JSON.stringify(completed));
        },
        stop: function (event, ui) {
            var id = ui.item.attr("id");
            var events = ui.item.parent().attr("id");
            var _token =  $('meta[name="csrf-token"]').attr('content');
            var order = ui.item.attr("order");
            var loop = ui.item.parent().children();
            var orders = [];
            
            $( loop ).each(function( index) {
                var orderNumber = ($(this).attr('id'));
                orders.push(orderNumber);
            });
            
            $(orders).each(function(orders,id){
                $.ajax({
                    url:"/task/"+id+"/change-order",
                    type:'POST',
                    data:{'orders':orders, 'events' : events, '_token':_token},
                    dataType : 'json',
                    success:function(data){
                        alert(data.success);
                    }
                });   
            });
        },  
    });
        
    $('.delete').on('click',function(){
        $(this).parents('li').remove();
        var id = $(this).parents('li').attr('id');
        var _token =  $('meta[name="csrf-token"]').attr('content');
    
        $.ajax({
            url:id+"/task/delete",
            type:'POST',
            data:{'_token':_token},
            dataType : 'json',
            success:function(data){
                alert(data.success);
            }
        });       
    });

    $('.editable').on('focusout', function() {
        var _token =  $('meta[name="csrf-token"]').attr('content');
        var newTask = $(this).text();
        var id = $(this).parents('li').attr('id');
        $.ajax({
            url:'/task/'+id+'/change-task',
            type:'POST',
            data:{'newTask':newTask, '_token':_token},
            dataType:'json',
        });
    });
});

</script>
@endsection