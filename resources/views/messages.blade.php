@extends('adminlte::page')

@section('htmlheader_title')
    Messages Page
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">

                <div class="box box-primary direct-chat direct-chat-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chat</h3>

                        <div class="box-tools pull-right">
                            <span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                                <i class="fa fa-comments"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <chat-messages v-bind:messages="messages"></chat-messages>

                        <div class="direct-chat-contacts">
                            <ul class="contacts-list">
                                <li>
                                    <a href="#">
                                        <img class="contacts-list-img" src="/img/user1-128x128.jpg" alt="User Image">

                                        <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              Count Dracula
                              <small class="contacts-list-date pull-right">2/28/2015</small>
                            </span>
                                            <span class="contacts-list-msg">How have you been? I was...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                    </a>
                                </li>
                                <!-- End Contact Item -->
                            </ul>
                            <!-- /.contatcts-list -->
                        </div>
                        <!-- /.direct-chat-pane -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <chat-form :user=" {{ Auth::user() }}" v-on:messagesent="addMessage"></chat-form>
                    </div>
                    <!-- /.box-footer-->
                </div>

            </div>
        </div>
    </div>
@endsection