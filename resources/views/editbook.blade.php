<html>
<head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=1024">
        <link rel="icon" href="{!!asset('https://vinnybookshelf.herokuapp.com/images/expert.png')!!}"/>
        <title>Edit|{{$bookname}}</title>
        <script src="{{asset('https://vinnybookshelf.herokuapp.com/newjs/jquery-3.3.1.min.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('https://vinnybookshelf.herokuapp.com/css/styles.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<style type="text/css">
  
  .mynewmenu{
  
  width:50%;
  height:50%;
  background-color: #000;
 margin-top: 100px;
 opacity: 0.8;
 color:#fff;
  position: absolute;
  z-index: 2;
  float: right;
}

a{
  text-decoration: underline;
}
a:hover{
  text-decoration: underline;
}
</style>
<script>
$(document).ready(function(){

var bookname = document.getElementById('bookname').value
 

$.ajax({

      url:'/getDetails',
      type:'post',
      headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
      beforeSend:function(){
        document.getElementById('mainbodyII').innerHTML='<div style="margin-top:30px;font-family:candara;font-weight:bold;font-size:20px">Loading details...<img src="{{asset("https://vinnybookshelf.herokuapp.com/images/loading.gif")}}" width="100px"/></div>'
      },
      data:{
        bookname:bookname
      },
      success:function(data){
        console.log(data);
        document.getElementById('mainbodyII').innerHTML=""

        for (var i=0;i<data.length;i++){
          $("#mainbodyII").append('<div id="coveringDiv" style="width:100%"><div id="image" style="float:left"><img src="{{asset("https://vinnybookshelf.herokuapp.com/images/books/standing_tall.jpg")}}" style="width:400px;height:450px"/></div><div id="text" style="margin-left:10px;margin-top:100px;float:left;font-family:candara;font-size:20px;color:#fff"><div style="width:400px; height:30px;background-color:#500000;margin-bottom:10px" id="booknameDiv">Title : '+data[i].bookname+'</div><div style="width:400px; height:30px;background-color:#500000;margin-bottom:10px" id="rating">Rating : ' +data[i].rating+' </div><div style="width:400px; height:30px;background-color:#500000;margin-bottom:10px" id="website"> Website : https://author.com</div><div><img src="{{asset("https://vinnybookshelf.herokuapp.com/images/books/edit.png")}}" width="30px" height="30px" id="edit" style="cursor:pointer"/><img src="{{asset("https://vinnybookshelf.herokuapp.com/images/books/save.png")}}" width="30px" height="30px" id="save" style="cursor:pointer"/><img src="{{asset("https://vinnybookshelf.herokuapp.com/images/books/delete.png")}}" width="30px" height="30px" id="delete" style="cursor:pointer"/></div><div id="response" style="color:#000;font-size:12px;font-family:candara;font-weight:bold"></div></div></div>');
        }

        $("#save").hide();

        $("#edit").click(function(){
          //alert('edit');
          $(this).hide();
          $("#save").show();
          document.getElementById('booknameDiv').innerHTML="";
          document.getElementById('rating').innerHTML="";
          
          $("#booknameDiv").append('<div><input type="text" id="editbookname" style="width:400px; height="30px" value="'+data[0].bookname+'"/></div>')
          $("#rating").append('<div><input type="text"  id="editrating" style="width:400px; height="30px" value="'+data[0].rating+'"/></div>')


        })



        $("#delete").click(function(){
          $confirm = window.confirm('Delete Item?')

          if($confirm){


            var id= data[0].id;
          

          $.ajax({
            url:'/deleteBook',
            type:'post',
            headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
            beforeSend:function(){

              document.getElementById('response').innerHTML="Deleting..."

            },
            data:{
              id:id,
              
            },
            success:function(data){
              document.getElementById('response').innerHTML=""
              document.getElementById('response').innerHTML=data;
              

            },
            error(obj, status,e){
              console.log(e);
            }
          })

            
          }

        })


        $("#save").click(function(){
         // $confirm = window.confirm('Delete Item?')
          var id= data[0].id;
          var Ebookname = document.getElementById('editbookname').value;
          var Erating = document.getElementById('editrating').value;

          $.ajax({
            url:'/updateBook',
            type:'post',
            headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
            beforeSend:function(){

              document.getElementById('response').innerHTML="Updating..."

            },
            data:{
              id:id,
              Ebookname:Ebookname,
              Erating:Erating
            },
            success:function(data){
              document.getElementById('response').innerHTML=""
              document.getElementById('response').innerHTML=data;
              if(data="Update was successfully made"){
                window.location="/vinnybookshelf/admin/editbook/"+Ebookname;
              }

            },
            error(obj, status,e){
              console.log(e);
            }
          })

          


        })

        
      },
      error:function(obj,status,e){
        console.log(e);
      }

})



})






</script>
<body>
{{csrf_field()}}
<!-- Just an image -->

<div id="mainDiv">
  <div id="label">
    <div id="labelheader" align="center">
      <div id="content">
        <div id="content-left">
          <table >
            <tr><td>My Account</td><td>WishList</td><td id="login" style="cursor: pointer">Login</td><td>Register</td></tr></table>
        </div>
        
        <div id="content-right">Language<select><option>English</option><option>French</option></select></div>

      
    </div>
    </div>
    <div id="logoArea" align="center">
    <div id="logo">
    <div id="logo-left"><a href="/vinnybookshelf"><img src="{{asset('https://vinnybookshelf.herokuapp.com/booklogo.png')}}" id="booklogo"/></a><img src="{{asset('https://vinnybookshelf.herokuapp.com/images/menu.png')}}" id="menu"/>

    </div>
    <div class="mymenu"></div>
    

    <div id="logo-right"><input type="text" id="searchbtn" style="background-image: url('{{asset('https://vinnybookshelf.herokuapp.com/images/searchbtn.png')}}');background-position: right;background-repeat: no-repeat;background-size: 35px 35px"  placeholder="Search for Books" /></div>
    </div>
    </div>
    <div id="navigation" align="center">
      
      <div id="navigation-tabs">
        <table><tr><td>Children Books</td><td>Sciences & Fiction</td><td>Historical Books</td><td>Poetry</td><td>Romance</td><td>Detective Books</td></tr></table>
      </div>
    </div>
    <div id="banner">
      <img src="{{asset('https://vinnybookshelf.herokuapp.com/images/bannerbook.gif')}}" width="100%" height="200px" />

    </div>
    <div id="bodyContent" align="center"><input type="hidden" id="bookname" value="{{$bookname}}">
      <div style="float: left" id="unique"></div>
    <h2 style="margin-top: 10px">{{$bookname}} </h2>
      <div style="width:70%;height:100%"id="mainbodyII">
      




      </div>
      


    </div>

    <div id="footer" align="center">
      <div id="footerContent">
        <table>
          <tr>
            <td>
              Support
              
                <li>Customer care</li>
                <li>HotLines</li>
            </td>
            <td>AboutUs
            <li>Customer care</li>
                <li>HotLines</li></td>
            <td>Contact
            <li>Customer care</li>
                <li>HotLines</li></td>
            <td>Social Media
              <li>Twitter</li>
                <li>FacebookPage</li>
                <li>Instagram</li>
              </td>
          </tr>
          
        </table>
        <span style="font-size: 12px;font-family: candara;color: #fff">&copy; VinnyBookShelf 2019</span>

      </div>
    </div>

  </div>


</div>



</body>
</html>
