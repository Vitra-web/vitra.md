@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">



            <div class="row mb-2 align-items-start w-50">
                <div class="col-sm-2">
                    <a href="{{route('chat')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                <div class="col-sm-4">
                    <h1 class="">{{$title}}</h1>
                </div>
                <div class="col-sm-4">
                    <h1 class="" style="color:{{$chat->industry->color}}">{{$chat->industry->name}}</h1>
                </div>

            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="chat_box">

{{--            <!-- Conversations are loaded here -->--}}
{{--            <div class="direct-chat-messages">--}}
{{--                <!-- Message. Default to the left -->--}}
{{--                <div class="direct-chat-msg">--}}
{{--                    <div class="direct-chat-infos clearfix">--}}
{{--                        <span class="direct-chat-name float-left">Alexander Pierce</span>--}}
{{--                        <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.direct-chat-infos -->--}}
{{--                    <img class="direct-chat-img" src="{{asset('images/admin-panel/asc-message.png')}}" alt="message user image">--}}
{{--                    <!-- /.direct-chat-img -->--}}
{{--                    <div class="direct-chat-text">--}}
{{--                        Is this template really for free? That's unbelievable!--}}
{{--                    </div>--}}
{{--                    <!-- /.direct-chat-text -->--}}
{{--                </div>--}}
{{--                <!-- /.direct-chat-msg -->--}}
{{--                <!-- Message to the right -->--}}
{{--                <div class="direct-chat-msg right">--}}
{{--                    <div class="direct-chat-infos clearfix">--}}
{{--                        <span class="direct-chat-name float-right">Sarah Bullock</span>--}}
{{--                        <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.direct-chat-infos -->--}}
{{--                    <img class="direct-chat-img" src="{{asset('images/admin-panel/answer-message.png')}}" alt="message user image">--}}
{{--                    <!-- /.direct-chat-img -->--}}
{{--                    <div class="direct-chat-text">--}}
{{--                        You better believe it!--}}
{{--                    </div>--}}
{{--                    <!-- /.direct-chat-text -->--}}
{{--                </div>--}}
{{--                <!-- /.direct-chat-msg -->--}}
{{--                <!-- Message. Default to the left -->--}}




            <div class="admin_chat_block">
{{--                <div class="direct-chat-messages">--}}
                @foreach($messages as $message)
                    @if($message->type == 'send')
                            <div class="direct-chat-msg ">
                                <div class="direct-chat-infos clearfix ">
{{--                                    <span class="direct-chat-name float-left">Alexander Pierce</span>--}}
                                    <span class="direct-chat-timestamp float-right">{{$message->created_at}}</span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="{{asset('images/admin-panel/asc-message.png')}}" alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text admin_chat_block_first">
                                    {{$message->message}}
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>

{{--                    <div class="admin_chat_block_first">--}}
{{--                      {{$message->message}}--}}
{{--                    </div>--}}



                    @elseif($message->type == 'answer')

                            <div class="direct-chat-msg right ">
                                <div class="direct-chat-infos clearfix ">
                                    <span class="direct-chat-name float-right">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                                    <span class="direct-chat-timestamp float-left">{{$message->created_at}}</span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="{{asset('images/admin-panel/answer-message.png')}}" alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text admin_chat_block_second">
                                    {{$message->message}}
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
{{--                        <div class="d-flex justify-content-end">--}}
{{--                            <div class="admin_chat_block_second">{{$message->message}}</div>--}}
{{--                        </div>--}}

                    @endif
                @endforeach
{{--                </div>--}}

            </div>
            <div class="admin_message_block">
                <input class="admin_message_block_input" name="message" onkeydown="pressEnter(event, {{$chat->industry_id}}, '{{$chat->user_id}}')" placeholder="Tastează raspunde tău aici..."  type="text">
                <div class="admin_message_block_btn" onclick="sendMessage({{$chat->industry_id}}, '{{$chat->user_id}}')" >
                    <img class="admin_message_block_icon" src="/images/communication.png" alt="Send icon">
                </div>
            </div>

        </div>



        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @endsection


    @push('script')

    <script>

        window.onload=function() {
            Pusher.logToConsole = true;
            const pusher  = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'eu'});
            const channel = pusher.subscribe('send');

            const chat = {!! $chat !!};

            console.log(chat.user_id)
            //Receive messages
            channel.bind('chat', function (data) {
                console.log('data',data.userId)
                if(data.user_id === chat.userId) {
                    console.log('yes')
                    $('.admin_chat_block').append('<div class="admin_chat_block_first">' + data.message + '</div>');
                }

            });
        };

        function pressEnter(event, industryId, userId) {
            if (event.key === "Enter") {
                event.preventDefault();
                sendMessage(industryId, userId)
            }
        }
        function sendMessage(industryId, userId) {
            const input = document.querySelector('.admin_message_block_input')
            const secondBlockContainer = document.createElement('div')
            secondBlockContainer.style.display ='flex'
            secondBlockContainer.style.justifyContent ='flex-end'

            secondBlockContainer.innerHTML = `
            <div class="admin_chat_block_second" >${input.value}</div>
            `
            document.querySelector('.admin_chat_block').append(secondBlockContainer)


            const message = input.value;

            console.log(message)
            const pusher  = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'eu'});
            $.ajax({
                url:     "/panel/send-message",
                method:  'POST',
                headers: {
                    'X-Socket-Id': pusher.connection.socket_id
                },
                data:    {
                    _token:  '{{csrf_token()}}',
                    userId,
                    industryId,
                    message,
                }
            }).done(function (res) {
                console.log(res)
                input.value = ''

            });


        }

    </script>

    @endpush

@section('after_styles')
    <style>
        .chat_box {
            border: 1px #cbc3c3 solid;
            border-radius: 15px;
        }

        @media (min-width: 1050px) {
            .chat_box {
                width: 50%;
            }
        }

        .admin_chat_block {
            height: 500px;
            overflow-y: scroll;
            border-bottom: 1px #bdbbbb solid;
            padding: 20px;
            -ms-overflow-style: none;
        }
        .admin_chat_block::-webkit-scrollbar {
            display: none;
        }
        .admin_chat_block_first {
            /*width: 60%;*/
            background-color: rgba(189, 187, 187, 0.3);
            padding: 10px;
            /*border-radius: 15px;*/
            margin-bottom: 20px;
        }

        .admin_chat_block_second {

            /*width: 60%;*/
            /*border-radius: 15px;*/
            padding: 10px;
            color: #fff;
            background-color: #007bff;;
            margin-bottom: 20px;
            font-size: 15px;
            line-height: 22px;
        }

        .admin_chat_block_second::after {
            border-left-color: #007bff !important;
        }

        .admin_message_block {
            position: relative;
            height: 80px;
            /*overflow-y: scroll;*/
            -ms-overflow-style: none;

        }

        .admin_message_block::-webkit-scrollbar {
            display: none;
        }

        .admin_message_block_btn {
            position: absolute;
            top: 20px;
            right: 30px;
            cursor: pointer;
        }
        .admin_message_block_icon {
            width: 25px;
        }
        .admin_message_block_input {
            width: 100%;
            height: 100%;
            border: none;
            padding: 20px 60px 40px 20px;
            background-color: #fff;
            color: #0a0a0a;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }
        .admin_message_block_input:focus{
            outline: none;
        }

    </style>
    @endsection
