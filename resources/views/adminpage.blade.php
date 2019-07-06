<html>
<head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=1024">
        <link rel="icon" href="{!!asset('https://vinnybookshelf.herokuapp.com/images/expert.png')!!}"/>
        <title>VinnyBookShelf</title>
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

  $("#logout").click(function(){

    $.ajax({
          url:'/logout',
          type:'post',
          headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
          beforeSend:function(){
            document.getElementById('result').innerHTML="Please wait.."
          },
          
          data:{logout:'logout'},
          success:function(data){
            //document.getElementById('result').innerHTML=data
            if(data=="Session Destroyed"){

              window.location='/login';

            }

          },
          error:function(obj, status, e){
            console.log(e)
          }



 })
  })

$("#upload").click(function(){
 var bookname = document.getElementById('bookname').value;
 var bookrate = document.getElementById('bookrate').value;
 var bookimage = $('#bookimage')[0].files[0]
if(bookname!="" && bookrate!="" && bookimage!=""){
  
  var formData = new FormData();
 formData.append('bookname',bookname);
 formData.append('bookrate',bookrate);
 formData.append('file',bookimage);

 $.ajax({
          url:'/uploadBook',
          type:'post',
          headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
          beforeSend:function(){
            document.getElementById('result').innerHTML="Please wait.."
          },
          processData: false, 
          contentType: false,
          data:formData,
          success:function(data){
            document.getElementById('result').innerHTML=data
          },
          error:function(obj, status, e){
            console.log(e)
          }



 })
}
 


//console.log(bookimage);
})

$("#view").click(function(){

  document.getElementById('mainbodyII').innerHTML="";

    $.ajax({
          url:'/viewBook',
          type:'post',
          headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
          beforeSend:function(){
            document.getElementById('mainbodyII').innerHTML="Uploading Books"
          },
          data:{city:'city'},
          success:function(data){
            console.log(data);
            document.getElementById('mainbodyII').innerHTML=""
            var btn = data.length/10;

            if(btn > 1){
              for (var i=0;i<btn;i++){
                $('#btn_btn').append('<div class="btnDiv" style="float:left;margin:5px;"><input type="submit"  id="'+ parseInt(i)*9 +'"value="'+parseInt(i+1)+'"/></div>')
              }
              $("#mainbodyII").append('<div><h2>Uploaded Books</h2></div>')
              for(var i=0; i<10;i++){
                $('#mainbodyII').append('<div class="books" style="float:left;margin:10px;cursor:pointer"><input type="hidden" value="'+data[i].bookname+'"/><img src="https://ademilola.s3.amazonaws.com/'+ data[i].imagepath+'" style="width:130px;height:180px"/><br/>Rating:<br/>'+star_rating(data[i].rating)+'</div>')
              }
              

            }
            else{
              for(var i=0; i<data.length;i++){
                $('#mainbodyII').append('<div class="books" style="margin:30px"><input type="hidden" value="'+data[i].bookname+'"/><img src="https://ademilola.s3.amazonaws.com/'+ data[i].imagepath+'" style="width:130;height:180"/></div>')
              }
              


            }
            
              
            $(".btnDiv").click(function(){
           $x = $(this).find('input').attr('value').valueOf();
          $increment = $(this).find('input').attr('id').valueOf();
           

          if($x == 1){
            $(".books").remove();
            document.getElementById('mainbodyII').innerHTML="";
            $("#mainbodyII").append('<div><h2>Uploaded Books</h2></div>')
            for(var i=0; i<10;i++){
                $('#mainbodyII').append('<div class="books" style="float:left;margin:10px;cursor:pointer"><input type="hidden" value="'+data[i].bookname+'"/><img src="https://ademilola.s3.amazonaws.com/'+ data[i].imagepath+'" style="width:130px;height:180px"/><br/>Rating:<br/>'+star_rating(data[i].rating)+'</div>')
              }
          }
          else{
            $(".books").remove();
            document.getElementById('mainbodyII').innerHTML="";
            $("#mainbodyII").append('<div><h2>Uploaded Books</h2></div>')
            for(var i= parseInt($x)+parseInt($increment)-1;i<20;i++){
              $('#mainbodyII').append('<div class="books" style="float:left;margin:10px;cursor:pointer"><input type="hidden" value="'+data[i].bookname+'"/><img src="https://ademilola.s3.amazonaws.com/'+ data[i].imagepath+'" style="width:130px;height:180px"/><br/>Rating:<br/>'+star_rating(data[i].rating)+'</div>')
            }
          }




            })


            $(".books").click(function(){
              $bookname = $(this).find('input').attr('value').valueOf();
             // alert($bookname);

              window.location="/vinnybookshelf/admin/editbook/"+$bookname;



            })
            
            


          },
          error:function(obj, status, e){
            console.log(e)
          }



 })

    function star_rating(x){
      if(x==2){
        return '<img src={{asset("https://vinnybookshelf.herokuapp.com/images/books/2star.png")}} width="130px" height="20px"/>'
      }
      else if(x==3){
         return '<img src={{asset("https://vinnybookshelf.herokuapp.com/images/books/3star.png")}} width="130px" height="20px"/>'
      }
      else if(x== 4){
         return '<img src={{asset("https://vinnybookshelf.herokuapp.com/images/books/4star.jpg")}} width="130px" height="20px"/>'
      }
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
    <div id="logo-left"><img src="{{asset('https://vinnybookshelf.herokuapp.com/images/booklogo.png')}}" id="booklogo"/><img src="{{asset('https://vinnybookshelf.herokuapp.com/images/menu.png')}}" id="menu"/>

    </div>
    <div class="mymenu"></div>
    

    <div id="logo-right"><input type="text" id="searchbtn" style="background-image: url('{{asset('https://vinnybookshelf.herokuapp.com/images/searchbtn.png')}}');background-position: right;background-repeat: no-repeat;background-size: 35px 35px"  placeholder="Search for Books" /></div>
    </div>
    </div>
    <div id="navigation" align="center">
      
      <div id="navigation-tabs">
        <table><tr><td>Welcome @if(Session::has('username'))
    {{ Session::get('username') }}
@endif</td></tr></table>
      </div>
    </div>
    <div id="banner">
      <img src="{{asset('https://vinnybookshelf.herokuapp.com/images/bannerbook.gif')}}" width="100%" height="200px" />

    </div>
    <div id="bodyContent" align="center">

      <div style="width:70%; height: 100px">
        <div id="mainbody" style=" background-color:#000;color:#fff;width: 20%; float: left;margin-left: 10px;font-family: candara" align="left">
          <div style="width: 100%; height:20px;background-color: #500000">Menu</div>
          <div id="create">Create/Upload Book</div>
          <div id="view" style="cursor: pointer;">View Uploaded</div>
          <div id="logout" style="cursor: pointer">Logout</div>


        </div>
        <div id="mainbodyII" style="width: 100%; float: left;margin-left: 10px;font-size: 13px;font-family: candara;" align="left">

          <h3>Create Book</h3>
          <form>
            <input type="text" id="bookname" style="width:300px;height: 30px;margin-bottom: 10px" placeholder="Book Name"><br/>
            <input type="text" id="bookrate" style="width:300px;height: 30px;margin-bottom: 10px" placeholder="Rating"><br/>
            <input type="file" id="bookimage" style="width:300px;height: 30px;margin-bottom: 10px" placeholder="Book Name"><br/>

            <input type="button" id="upload" value="Upload">
            <div id="result"></div>





          </form>

        </div>
        <div id="btn_btn"></div>

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
