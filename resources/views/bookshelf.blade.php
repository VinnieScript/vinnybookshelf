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

  var click =1;

  $("#menu").click(function(){

if(click==1){
  addItem();
  click-=1
  

}
else if(click==0){
  removeItem();
  click+=1;
  //alert('Removed'+click)
}



  })
$("#login").click(function(){
 window.location='/login'
})

$("#register").click(function(){
 window.location='/registerpage'
})

  function addItem(){

    $(".mymenu").addClass('mynewmenu');
   $(".mymenu").append('<div id="contentAdded" style="border:1px solid #000"><div style="width:100%;font-family:candara;font-size14px;font-weight:bold;background-color:#500000;color:#fff;float:left">Menu</div><div><table style="width:100%;margin:20px;color:#fff;font-family:candara;font-size:20px;"><tr style="height:30px"><td><a style="text-decoration:underline;cursor:pointer">Children Books</a></td></tr><tr style="height:30px"><td><a style="text-decoration:underline;cursor:pointer">Sciences & Fiction</a></td></tr><tr style="height:30px"><td><a style="text-decoration:underline;cursor:pointer">Historical Books</a></td></tr><tr style="height:30px"><td><a style="text-decoration:underline;cursor:pointer">Poetry</a></td></tr><tr style="height:30px"><td><a style="text-decoration:underline;cursor:pointer">Romance</a></td></tr><tr style="height:30px"><td><a style="text-decoration:underline;cursor:pointer">Detective Books</a></td></tr></table></div></div>')
   
  }

  function removeItem(){
    $('.mymenu').removeClass('mynewmenu');
    $('#contentAdded').remove();
  }


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
              $("#mainbodyII").append('<div><h2>BookShelf</h2></div>')
              for(var i=0; i<10;i++){
                $('#mainbodyII').append('<div class="books" style="float:left;margin:10px;"><input type="hidden" value="'+data[i].bookname+'"/><img src="https://ademilola.s3.amazonaws.com/'+ data[i].imagepath+'" style="width:130px;height:180px;cursor:pointer"/><br/>Rating:<br/>'+star_rating(data[i].rating)+'</div>')
              }
              

            }
            else{
              for(var i=0; i<data.length;i++){
                $('#mainbodyII').append('<div class="books" style="margin:30px"><input type="hidden" value="'+data[i].bookname+'"/><img src="https://ademilola.s3.amazonaws.com/'+ data[i].imagepath+'" style="width:130;height:180;cursor:pointer"/></div>')
              }
              


            }
            
              
            $(".btnDiv").click(function(){
           $x = $(this).find('input').attr('value').valueOf();
          $increment = $(this).find('input').attr('id').valueOf();
           

          if($x == 1){
            $(".books").remove();
            document.getElementById('mainbodyII').innerHTML="";
            $("#mainbodyII").append('<div><h2>BookShelf</h2></div>')
            for(var i=0; i<10;i++){
                $('#mainbodyII').append('<div class="books" style="float:left;margin:10px;"><input type="hidden" value="'+data[i].bookname+'"/><img src="https://ademilola.s3.amazonaws.com/'+ data[i].imagepath+'" style="width:130px;height:180px;cursor:pointer"/><br/>Rating:<br/>'+star_rating(data[i].rating)+'</div>')
              }
          }
          else{
            $(".books").remove();
            document.getElementById('mainbodyII').innerHTML="";
            $("#mainbodyII").append('<div><h2>BookShelf</h2></div>')
            for(var i= parseInt($x)+parseInt($increment)-1;i<20;i++){
              $('#mainbodyII').append('<div class="books" style="float:left;margin:10px;"><input type="hidden" value="'+data[i].bookname+'"/><img src="https://ademilola.s3.amazonaws.com/'+ data[i].imagepath+'" style="width:130px;height:180px;cursor:pointer"/><br/>Rating:<br/>'+star_rating(data[i].rating)+'</div>')
            }
          }

            })

            $(".books").click(function(){
              $bookname = $(this).find('input').attr('value').valueOf();
              //alert($bookname);

              window.location="/VinnyBookShelf/viewbook/"+$bookname;



            })


          },
          error:function(obj, status, e){
            console.log(e)
          }



 })

    function star_rating(x){
      if(x==2){
        return '<img src={{asset("https://vinnybookshelf.herokuapp.com//images/books/2star.png")}} width="130px" height="20px"/>'
      }
      else if(x==3){
         return '<img src={{asset("https://vinnybookshelf.herokuapp.com//images/books/3star.png")}} width="130px" height="20px"/>'
      }
      else if(x== 4){
         return '<img src={{asset("https://vinnybookshelf.herokuapp.com//images/books/4star.jpg")}} width="130px" height="20px"/>'
      }
    }


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
            <tr><td>My Account</td><td>WishList</td><td id="login" style="cursor: pointer">Login</td><td id="register" style="cursor: pointer">Register</td></tr></table>
        </div>
        
        <div id="content-right">Language<select><option>English</option><option>French</option></select></div>

      
    </div>
    </div>
    <div id="logoArea" align="center">
    <div id="logo">
    <div id="logo-left"><img src="{{asset('https://vinnybookshelf.herokuapp.com/images/booklogo.png')}}" id="booklogo"/><a href="/vinnybookshelf"><img src="{{asset('https://vinnybookshelf.herokuapp.com/images/menu.png')}}" id="menu"/></a>

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
    <div id="bodyContent" align="center">
      
       <div id="btn_btn" style="width:70%"></div>
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
