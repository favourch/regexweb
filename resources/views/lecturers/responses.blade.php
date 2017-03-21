@extends('layouts.app')
@section('content')
@include('sidebars.lecturers')


        <!-- chat -->
<aside id="chat-messages" class="side-nav white">
    <p class="sidebar-chat-name" id="sidebarchatname">Tom Simpson<a href="#" data-activates="chat-messages" class="chat-message-link"><i class="material-icons">keyboard_arrow_right</i></a></p>
    <div id="display" class="messages-container">


    </div>
    <div class="message-compose-box">
        <div class="input-field">
            <input id="message" placeholder="Write message"  type="text">
        </div>
    </div>
</aside>

<!--  chat -->

<main class="mn-inner container">
    <div class="row">
        <div class="col s5 m5 l5">
            <div class="card" >
                <div class="card-content">
                    <div class="row">
                        <div class="">
                            <div id="sidebar-chat-tab" class="col s12 sidebar-messages right-sidebar-panel">
                                <p class="right-sidebar-heading">COMMMENTS</p>
                                <div class="chat-list">
                                    <a href="javascript:void(0)" class="chat-message">
                                        <div class="chat-item">
                                            <div class="chat-item-image">
                                                <img src="{{url('assets/images/profile-image.png')}}" class="circle" alt="">
                                            </div>
                                            <div class="chat-item-info">
                                                <p class="chat-name">Toby Okeke</p>
                                                <span class="chat-message">02110113</span> <br>
                                                <span class="chat-message">ISS</span>
                                                <span class="chat-message">LEVEL 100</span>
                                                <span class="chat-message right">Jan 21th 2017</span>
                                            </div>

                                        </div>
                                    </a>


                                </div>
                                <br><br>
                                <div class="chat-sidebar-options">
                                    <a  id="newMessage" class="left"><i class="material-icons">edit</i></a>
                                    <a href="#" class="right"><i class="material-icons">settings</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col s4 m4 l4">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script>
    $(document).ready(function () {
        var reciever;
        var sender = $('#message').data('sender');

        $.ajax({
            url:"<?php echo url('/getStaffMessageUsers'); ?>",
            method: "get",
            success: function (response) {
                data = JSON.parse(response);

                for(var i = 0; i < data.length; i++) {

                    var htmlData = '<a  data-lid="' + data[i].lid + '" class="chat-message"> ' +
                            '<div class="chat-item"> ' +
                            '<div class="chat-item-image"> ' +
                            '<img src="{{url('assets/images/profile-image.png')}}" class="circle" alt="">' +
                            '</div>' +
                            '<div class="chat-item-info"> ' +
                            '<p class="chat-name">' + data[i].name + '</p>' +
                            '<span >' + data[i].staffid + '</span> <br> ' +
                            '<span class="chat-message">' + data[i].dept + '</span>  ' +
                            '<span class="chat-message right">' + "Jan 23rd 2017" + '</span> ' +
                            '</div> ' +
                            '</div> ' +
                            '</a>'

                    $('.chat-list').append(htmlData);

                }



                $('.chat-message').click(function() {
                    $('.chat-message-link').click();
                });

                $('a.chat-message').on('click',function(){
                    console.log('in');

                    var count;
                    var name = $(this).find('.chat-item-info .chat-name').text();
                    console.log(name);
                    reciever = $(this).data("lid");
                    console.log(reciever);

                    if($('#sidebarchatname').text() == "Messages with " + name){
                        count = $('.message-wrapper').length;

                    } else{
                        count = 0;
                        $('.messages-container').html("");
                    }




                    $('#sidebarchatname').text("Messages with " + name );


                    getMessages(reciever,count);
                });

            },
            error: function (response) {
                console.log(response);
            }
        });



        $('#send').on('click', function () {
            var message = $('#message').val();
            var sender = $('#message').data("sender");

            sendMessage(sender,reciever,message);

        }); // send message when send is clicked

        $('#message').keypress(function (e) {
            if(e.which == 13) {
                console.log("enter pressed");
                var message = $('#message').val();
                var sender = $('#message').data("sender");

                sendMessage(sender,reciever,message);

            }
        }); // send message when enter is pressed


        function getMessages(lid, count) {


            //get messages on page load
            $.ajax({
                url: '<?php echo url('/messages'); ?>',
                method: 'post',
                data:{'lid': lid, '_token': '{{csrf_token()}}' },

                success: function (response) {

                    console.log(response);
                    var display = $('#display');
                    var parsedResponse = JSON.parse(response);
                    var item = parsedResponse.timeline;


                    for (i = count; i < parsedResponse.timeline.length; i++) {

                        if (parsedResponse.timeline[i].sender ==  {{Auth::user()->lid}}) {



                            display.append(
                                    '<div class="message-wrapper me"> ' +
                                    '<div class="circle-wrapper">' +
                                    '<img src="assets/images/profile-image-1.png" class="circle" alt=""></div>' +
                                    '<div class="text-wrapper">' + parsedResponse.timeline[i].message + '</div>' +
//                                    '<span>' + item[i].created_at + '</span>' +
                                    '</div>'

                            );


                        } else {
                            display.append(
                                    '<div class="message-wrapper them"> ' +
                                    '<div class="circle-wrapper">' +
                                    '<img src="assets/images/profile-image-1.png" class="circle" alt=""></div>' +
                                    '<div class="text-wrapper">' + parsedResponse.timeline[i].message + '</div>' +
//                                    '<span>' + item[i].created_at + '</span>' +
                                    '</div>'
                            );
                        }


                    }


                },
                error: function (response) {
                    console.log(response);
                }
            });
        }

        function sendMessage(sender, reciever, message){

            $.ajax({
                url:"<?php echo url('/sendMessage') ?>",
                method: "post",
                data:{ sender : sender , reciever : reciever, message: message, '_token': '{{csrf_token()}}'},
                success: function (response) {

                    $('#message').val("");
                    var count = $('.message-wrapper').length;
                    setMessageRead(reciever);

                    getMessages(reciever,count);
                },
                error: function (response) {
                    console.log(response);
                }
            });

        }

        function setMessageRead(uid){
            $.ajax({
                url:"{{url('/setMessageRead')}}",
                method: "post",
                data:{uid: uid, '_token': '{{csrf_token()}}'},
                success: function (response){
                },
                error: function () {

                }
            });
        }



    })
</script>

@endsection