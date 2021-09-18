@extends('layouts.hometemp')
@section('content')
<div id="wrapper">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <strong>Chat room </strong> can be used to create chat room in your app.
                        You can also use a small chat in the right corner to provide live discussion.
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox chat-view">
                    <div class="ibox-title">
                        <small class="float-right text-muted">Last message:  Mon Jan 26 2015 - 18:39:23</small>
                        Chat room panel
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-9 ">
                                <div class="chat-discussion">
                                    <!-- ++++++++++++++++++++++++++ message ++++++++++++++++++++++ -->
                                    <div class="chat-message right">
                                        <img class="message-avatar" src="assets/img/a2.jpg" alt="" >
                                        <div class="message">
                                            <a class="message-author" href="#"> Michael Smith </a>
                                            <span class="message-date">  Fri Jan 25 2015 - 11:12:36 </span>
                                            <span class="message-content">
                                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="chat-message left">
                                        <img class="message-avatar" src="assets/img/a5.jpg" alt="" >
                                        <div class="message">
                                            <a class="message-author" href="#"> Alice Jordan </a>
                                            <span class="message-date">  Fri Jan 25 2015 - 11:12:36 </span>
                                            <span class="message-content">
                                            All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
                                            It uses a dictionary of over 200 Latin words.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="chat-message right">
                                        <img class="message-avatar" src="assets/img/a6.jpg" alt="" >
                                        <div class="message">
                                            <a class="message-author" href="#"> Mark Smith </a>
                                            <span class="message-date">  Fri Jan 25 2015 - 11:12:36 </span>
                                            <span class="message-content">
                                            All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
                                            It uses a dictionary of over 200 Latin words.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ++++++++++++ message End ++++++++++++++++++ -->
                            <div class="col-md-3">
                                <div class="chat-users">
                                    <div class="users-list">
                                        <!-- ++++++++++++++ User List ++++++++++++++++++                 -->
                                        <table class="table">
                                            @foreach ($users as $user)
                                            <tr>
                                                <td><img class="chat-avatar" src="assets/img/{{$user->name}}.jpg" alt="" ><a href="#">{{$user->name}}</a></td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        <!-- +++++++++++++++ user list End +++++++++++++             -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="chat-message-form">
                                    <div class="form-chat">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control">
                                            <span class="input-group-append"> 
                                            <button class="btn btn-primary" type="submit">Send
                                            </button> 
                                            </span>
                                        </div>
                                    </div>
                                    <div class="small-chat-box fadeInRight animated">
                                        <div class="heading" draggable="true">
                                            <small class="chat-date float-right">
                                            02.19.2015
                                            </small>
                                            Small chat
                                        </div>
                                        <div class="content">
                                            <div class="left">
                                                <div class="author-name">
                                                    Monica Jackson <small class="chat-date">
                                                    10:02 am
                                                    </small>
                                                </div>
                                                <div class="chat-message active">
                                                    Lorem Ipsum is simply dummy text input.
                                                </div>
                                            </div>
                                            <div class="right">
                                                <div class="author-name">
                                                    Mick Smith
                                                    <small class="chat-date">
                                                    11:24 am
                                                    </small>
                                                </div>
                                                <div class="chat-message">
                                                    Lorem Ipsum is simpl.
                                                </div>
                                            </div>
                                            <div class="left">
                                                <div class="author-name">
                                                    Alice Novak
                                                    <small class="chat-date">
                                                    08:45 pm
                                                    </small>
                                                </div>
                                                <div class="chat-message active">
                                                    Check this stock char.
                                                </div>
                                            </div>
                                            <div class="right">
                                                <div class="author-name">
                                                    Anna Lamson
                                                    <small class="chat-date">
                                                    11:24 am
                                                    </small>
                                                </div>
                                                <div class="chat-message">
                                                    The standard chunk of Lorem Ipsum
                                                </div>
                                            </div>
                                            <div class="left">
                                                <div class="author-name">
                                                    Mick Lane
                                                    <small class="chat-date">
                                                    08:45 pm
                                                    </small>
                                                </div>
                                                <div class="chat-message active">
                                                    I belive that. Lorem Ipsum is simply dummy text.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" class="form-control">
                                            <span class="input-group-append">
                                            <button type="button" class="btn btn-primary">Go!
                                            </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection