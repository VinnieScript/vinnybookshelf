<html>
<head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=1024">
        <link rel="icon" href="{!!asset('https://vinnybookshelf.herokuapp.com/images/expert.png')!!}"/>
        <title>VinnyBookShelf|Register</title>
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

$("#register").click(function(){

var username = document.getElementById('username').value;
var password = document.getElementById('password').value;
var email = document.getElementById('email').value;
var cpassword = document.getElementById('cpassword').value;

if(username!="" && password!="" && email!="" && cpassword!=""){

if(cpassword== password){

  $.ajax({
    type:'post',
    url:'/register',
    headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
    beforeSend:function(){
      document.getElementById('result').innerHTML="Please wait.."
    },
    data:{
      username:username,
      password:password,
      email:email
    },
    success:function(data){
      document.getElementById('result').innerHTML=""
      //document.getElementById('result').innerHTML=data;
      if(data=="Registered"){
        document.getElementById('username').value=""
        document.getElementById('password').value=""
        document.getElementById('email').value=""
        document.getElementById('cpassword').value=""
       document.getElementById('result').innerHTML= "<span style='color:#000;font-family:candara'>Registration was Successful kindly click <a href='/login'>Here</a> to login</span>";
      }
      else{
        document.getElementById('result').innerHTML=""
        document.getElementById('result').innerHTML=data;
      }
    },
    error:function(obj,status,e){
      console.log(e);
    }

  })
}
else{

  document.getElementById('result').innerHTML="Password and Confirm Password not coressponding."
}
  
}

})
  
})
</script>
<body >
{{csrf_field()}}
<!-- Just an image -->

<div id="mainDiv">
  <div id="label">
    <div id="labelheader" align="center">
      <div id="content">
        <div id="content-left">
          <table >
            <tr><td>My Account</td><td>WishList</td><td>Login</td><td>Register</td></tr></table>
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
        <table><tr><td>Children Books</td><td>Sciences & Fiction</td><td>Historical Books</td><td>Poetry</td><td>Romance</td><td>Detective Books</td></tr></table>
      </div>
    </div>
    <div id="banner">
      <img src="{{asset('https://vinnybookshelf.herokuapp.com/images/bannerbook.gif')}}" width="100%" height="200px" />

    </div>
    <div id="bodyContent" align="center">
      
      <div id="contentInbody">
        <h3>Registration Details</h3>
      <input type="text" id="username" placeholder="Username" style="width: 300px;height: 40px;margin-bottom: 20px"><br/>
      <input type="email" id="email" placeholder="EmailAddress" style="width: 300px;height: 40px;margin-bottom: 20px"><br/> 
      <input type="password" id="password" placeholder="Password" style="width: 300px;height: 40px;margin-bottom: 20px"><br/> 
      <input type="password" id="cpassword" placeholder="Confirm Password" style="width: 300px;height: 40px;margin-bottom: 20px"><br/> 
  
      <button style="width: 100px;height: 40px" id="register">Register</button><br/>
      
      <div id="result"></div>
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
