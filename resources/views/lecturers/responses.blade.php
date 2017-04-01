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
                                <p class="right-sidebar-heading">COMMENTS</p>
                                <div class="chat-list">

                                    <!-- chats go here -->

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
        var comment,sid,cid;
        var gender;


        $.ajax({
            url:"<?php echo url('/get-staff-comment-users'); ?>",
            method: "post",
            success: function (response) {
                data = JSON.parse(response);

                console.log(response);
                for(var i = 0; i < data.length; i++) {
                    var imageUrl;

                    if( data[i].gender == "Female") imageUrl = "{{url('assets/images/profile-image-1.png')}}";
                    else  imageUrl = "{{url('assets/images/profile-image.png')}}";

                    var htmlData = '<a data-gender="' + data[i].gender +
                            '" data-cid="' + data[i].cid +
                            '"  data-sid="' + data[i].sid + '" class="chat-message"> ' +
                            '<div class="chat-item"> ' +
                            '<div class="chat-item-image"> ' +
                            '<img src="' + imageUrl + '" class="circle" alt="">' +
                            '</div>' +
                            '<div class="chat-item-info"> ' +
                            '<p class="chat-name">' + data[i].name + '</p>' +
                            '<span >' + data[i].studentid + '</span> <br> ' +
                            '<span class="chat-message">' + data[i].prog + '</span><br>  ' +
                            '<span class="chat-message course" >' + data[i].course + '</span>  ' +
                            '<span class="chat-message right">LEVEL ' + data[i].level + '</span> ' +
                            '</div> ' +
                            '</div> ' +
                            '</a>';

                    $('.chat-list').append(htmlData);

                }



                $('.chat-message').click(function() {
                    $('.chat-message-link').click();
                });

                $('a.chat-message').on('click',function(){

                    gender = $(this).data('gender');
                    var count;
                    var name = $(this).find('.chat-item-info .chat-name').text();
                    var course = $(this).find('.chat-item-info .course').text();

                    sid = $(this).data("sid");
                    cid = $(this).data("cid");



                    if($('#sidebarchatname').text() == "Messages with " + name && $('#sidebarchatname').data("course") == course){
                        count = $('.message-wrapper').length;


                    } else{
                        count = 0;
                        $('.messages-container').html("");
                    }



                    $('#sidebarchatname').text("Messages with " + name );
                    $('#sidebarchatname').data('course', course);


                    getComments(count);
                });

            },
            error: function (response) {
                console.log(response);
            }
        });


        //check for new messages while user is typing
        $("#message").on('keypress',function(){getComments( $('.message-wrapper').length)});

        $('#send').on('click', function () {
            var comment = $('#message').val();

            postComment(comment);

        }); // send message when send is clicked



        $('#message').keypress(function (e) {
            if(e.which == 13) {

                var comment = $('#message').val();

                postComment(comment);

            }
        }); // send message when enter is pressed


        function getComments( count) {

            //get messages on page load
            $.ajax({
                url: '<?php echo url('/lecturer-get-comments'); ?>',
                method: 'post',
                data:{'lid': {{Auth::user()->lid}}, sid: sid, cid:cid, '_token': '{{csrf_token()}}' },

                success: function (response) {
                    var imageUrl;

                    if(gender == "Female") imageUrl = "{{url('assets/images/profile-image-1.png')}}";
                    else  imageUrl = "{{url('assets/images/profile-image.png')}}";

                    var display = $('#display');
                    var parsedResponse = JSON.parse(response);

                    for (i = count; i < parsedResponse.timeline.length; i++) {

                        if (parsedResponse.timeline[i].fromLecturer ==  "0") {



                            display.append(
                                    '<div class="message-wrapper me"> ' +
                                    '<div class="circle-wrapper">' +
                                    '<img src="' + imageUrl +'" class="circle" alt=""></div>' +
                                    '<div class="text-wrapper">' + parsedResponse.timeline[i].content + '</div>' +
//                                    '<span>' + item[i].created_at + '</span>' +
                                    '</div>'

                            );


                        } else {
                            display.append(
                                    '<div class="message-wrapper them"> ' +
                                    '<div class="circle-wrapper">' +
                                    '<img src="{{Auth::user()->photo}}" class="circle" alt=""></div>' +
                                    '<div class="text-wrapper">' + parsedResponse.timeline[i].content + '</div>' +
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

        function postComment(comment){


            $.ajax({
                url:"<?php echo url('/post-comment') ?>",
                method: "post",
                data:{ comment : comment , sid : sid, cid: cid, from:'Lecturer', '_token': '{{csrf_token()}}'},
                success: function (response) {

                    $('#message').val("");
                    var count = $('.message-wrapper').length;

                    getComments(count);
                },
                error: function (response) {
                    console.log(response);
                }
            });

        }




    })
</script>

@endsection