const baseUrl = "http://localhost/projects/regex/public";

$( document ).ready(function() {


    $("html").niceScroll({cursorcolor:"#6FAF09"});
    $(".side-nav").niceScroll({cursorcolor:"#800000"});
    $(".fixed-sidebar").niceScroll({cursorcolor:"#800000"});
    Materialize.showStaggeredList('#sidebar');
    $('.modal-trigger').leanModal();
    $('.tooltipped').tooltip({delay: 50});

      var displayed = false;

    $('#uploadHelp').hover(function(){
        if(!displayed){
            Materialize.toast("Click to browse or Drag and drop files to upload", 5000 );
            displayed = true;
        }

    });

    $('.upload .dropdown-content li').click(populateCourses);

    function populateCourses(){
        var semester = $('#semester').val();

        var level = $('#level').val();

        var url = baseUrl + "/courses/" +  level + "/" + semester;

        $('.select-wrapper:nth-child(3) .select-wrapper').hide();

        $('#hiddenCid').val($('#courses').val());

        console.log($('#courses').val());

        $.ajax({
            url : url,
            method: "GET",
            success: function(response){

                var data = '<option value="" disabled="" selected="">Select the course:</option>';
                console.log(response);
                courses = JSON.parse(response);

                for(i=0; i< courses.length; i++){
                    console.log(courses[i].name);

                   data += "<option value='" + courses[i].cid + "'>" + courses[i].name + "<option>";

                }

                $('#courses').html(data);


            },
            error: function (response) {
                console.log(response.status);
            }

        });


        // Select
        $('.upload select').material_select();

        $('.select-wrapper:nth-child(3) .select-wrapper').show();

        $('.upload .dropdown-content li').click(populateCourses);


    }




});
