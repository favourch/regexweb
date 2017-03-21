@extends('layouts.app')

@section('content')

     @include('sidebars.admin')
     <main class="mn-inner">
         <div  class="card upload" >
             <div class="card-content">

                 <table>
                     <tr>
                         <th>Staff ID</th>
                         <th>Name</th>
                         <th>Qualification</th>
                         <th>Phone</th>
                         <th>Email</th>
                         <th>Role</th>

                     </tr>
                     @foreach($lecturers as $item)
                     <tr>
                         <td>{{$item->staffid}}</td>
                         <td>{{$item->name}}</td>
                         <td>{{$item->qualification}}</td>
                         <td>{{$item->phone}}</td>
                         <td>{{$item->email}}</td>
                         <td>{{$item->role}}</td>
                         <td colspan="2">

                                 <select data-lid="{{$item->lid}}" class="role">
                                     <option>HOD</option>
                                     <option>DEAN</option>
                                     <option>SUPERVISOR</option>
                                     <option>ADMIN</option>
                                     <option>LECTURER</option>
                                 </select>

                         </td>
                         <td>
                             <button data-lid="{{$item->lid}}" class="btn waves-effect waves-light changeRoleButton">Change
                                 <i class="material-icons right">send</i>
                             </button>
                         </td>
                     </tr>
                      @endforeach

                 </table>
             </div>
          </div>
    </main>

    <script>
        $(document).ready(function(){


           $('.changeRoleButton').on('click',function(){

               self = $(this);
               var lid = self.data('lid');
               var role = '';

               $('.role').each(function(){
                   var roleLid = $(this).data('lid');
                   if(roleLid == lid ) role = $(this).val();
               });



               console.log(role);
               $.ajax({
                   url: baseUrl + "/admins/change-roles",
                   method: "post",
                   data: {'lid': lid, 'role' : role , '_token': '{{csrf_token()}}'},
                   success: function(){
                       self.text('Changed');
                       self.addClass('disabled');


                       self.parent().prev('td').prev('td').text(role);
                       Materialize.toast("Role Changed to " + role, 3000 );

                   },
                   error: function(response){
                       self.removeClass('disabled');

                       Materialize.toast("Sorry an error occurred. Try again.", 3000 );

                       console.log('error');
                       console.log(response);
                   }
               });
           });
        });
    </script>

@endsection