<html>
<head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=1024">
        <link rel="icon" href="{!!asset('https://majorcityfinder.herokuapp.com/images/expert.png')!!}"/>
        <title>City Locator</title>
        <script src="{{asset('https://majorcityfinder.herokuapp.com/newjs/jquery-3.3.1.min.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('https://majorcityfinder.herokuapp.com/css/styles.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<style type="text/css">
  
.suggess{
  height: 100px;
  overflow-y: auto;
}

.pagerClass{
  width:100%;
  float:left;
  background-color: #e5e5e5;
  color: #fff;

  
}

.resultClass{
margin-top: 10px;
}

</style>
<script>
$(document).ready(function(){

  

  
  $("#cityname").keypress(function(){
    var finder = document.getElementById('cityname').value
    //console.log($.trim(finder).length);
    if($.trim(finder).length > 1){
       $.ajax({
                  url:'/suggestcity',
                  type:'post',
                  headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
                 // headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                 beforeSend:function(){
                  document.getElementById('autosuggest').innerHTML = 'Please Wait <img src="{{asset("https://majorcityfinder.herokuapp.com/images/loading.gif")}}" width="50px" />'
                  
                    },
                  data:{
                    city:finder
                  },
                  success:function(data){
                    //console.log(data)
                    
                    document.getElementById('autosuggest').innerHTML=""
                    $.each(data, function(index) {
            
            $('#autosuggest').append('<div class="divautosuggest" style="height:30px;cursor:pointer">'+data[index].cityName+'</div>')
             

            
                  });

                    $('#autosuggest').addClass('suggess');


                    $(".divautosuggest").click(function(){
                  //alert(document.getElementById('divautosuggest').innerHTML)
                  $real = $(this).html();
                  //alert($real)
                  $('#cityname').val($real);
                  $('#autosuggest').removeClass('suggess');
                  document.getElementById('autosuggest').innerHTML=""
                })

                  },
                  error:function(obj, status, e){
                    //alert(e);
                    console.log(e);
                  }
                })
    }
  })

$('#cityname').keyup(function(e){
  //console.log('keyup')
  if(e.keyCode == 8 || e.keyCode == 46)
    var finder = document.getElementById('cityname').value
    //console.log($.trim(finder).length);
    if($.trim(finder).length > 1){
       $.ajax({
                  url:'/suggestcity',
                  type:'post',
                  headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                 beforeSend:function(){
                  document.getElementById('autosuggest').innerHTML = 'Please Wait <img src="{{asset("https://majorcityfinder.herokuapp.com/images/loading.gif")}}" width="50px" />'
                  
                    },
                  data:{
                    city:finder
                  },
                  success:function(data){
                    
                    document.getElementById('autosuggest').innerHTML=""
                      $.each(data, function(index) {
            
            $('#autosuggest').append('<div class="divautosuggest" style="height:30px;cursor:pointer">'+data[index].cityName+'</div>')
             

            
                  });

                    $('#autosuggest').addClass('suggess');




                    $(".divautosuggest").click(function(){
                  //alert(document.getElementById('divautosuggest').innerHTML)
                  $real = $(this).html();
                  //alert($real)
                  $('#cityname').val($real);
                  $('#autosuggest').removeClass('suggess');
                  document.getElementById('autosuggest').innerHTML=""
                })



                  },
                  error:function(obj, status, e){
                    //alert(e);
                    console.log(e);
                  }
                })
    }

})  

$("#search").click(function(){
  var city = document.getElementById('cityname').value;
  var latitude = document.getElementById('latitude').value;
  var longitude = document.getElementById('longitude').value;
  

  if(city!=""){
    $.ajax({
      type:'get',
      headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
      url:'/suggession/'+city+'&'+latitude+'&'+longitude,
      beforeSend:function(){
                  document.getElementById('result').innerHTML = '<span style="font-weight:bold;font-family:candara">Fetching Result</span><img src="{{asset("https://majorcityfinder.herokuapp.com/images/loading.gif")}}" width="50px" />'
                  '/suggession?q='+city+'&Lat='+latitude+'&Long='+longitude
                    },
      success:function(data){
      //console.log(data);
      console.log(data.length);
      document.getElementById('result').innerHTML =""
      var btn = data.length/10
      if(btn >1){
        $("#pager").addClass('pagerClass')
        for (var i=0;i<btn;i++){
        $("#pager").append('<div id="pagebtn" style="float:left;width:30px;height:30px;border:2px #solid #000;background-color:#fff;color:#000;margin-left:5px;cursor:pointer" class="Dpager" align="center" ><input type="hidden" value="'+parseInt(i)*9 +'" id="'+parseInt(i+1)+'"/>'+parseInt(i+1) +'</div>')
        }
      }
      else{
        $('#Dpager').removeClass('pagerClass');
        $('#pagebtn').remove();
        document.getElementById('pager').innerHTML=""
        document.getElementById('result').innerHTML = data.length+"results"
        console.log('cityName',data)
        for(var i=1;i<data.length;i++){
          $("#result").append('<div id="covering" style="font-family:candara;width:100%;background-color:#fff;margin-bottom:10px"><table><tr><td>City Name:</td><td>'+ data[i].cityName +'('+data[i].countryID+')</td></tr><tr><td>Latitude:</td><td>'+data[i].latitude+'</td></tr><tr><td>Longitude:</td><td>'+data[i].longitude+'</td></tr></table></div>')
        }
      }

      $(".Dpager").click(function(){
       // $x = $(this).html();
        //alert(parseInt($x)+10);
        $btnnumber = $(this).find('input').attr('id').valueOf();
        $increment = $(this).find('input').attr('value').valueOf();
        //alert($btnnumber);
        $("#result").removeClass('resultClass');
        $('#covering').remove();
        document.getElementById('result').innerHTML=""
        $('#result').addClass('resultClass');
        if($btnnumber == 1){
          for(var i=0;i<10;i++){
          $("#result").append('<div id="covering" style="font-family:candara;width:100%;background-color:#fff;margin-bottom:10px"><table><tr><td>City Name:</td><td>'+ data[i].cityName +'('+data[i].countryID+')</td></tr><tr><td>Latitude:</td><td>'+data[i].latitude+'</td></tr><tr><td>Longitude:</td><td>'+data[i].longitude+'</td></tr></table></div>')
        }
        }
        else{
           //var increment = 9;
        for(var i=parseInt($btnnumber)+parseInt($increment)-1;i< parseInt($btnnumber)*10;i++){

          $("#result").append('<div id="covering" style="font-family:candara;width:100%;background-color:#fff;margin-bottom:10px"><table><tr><td>'+i+'City Name:</td><td>'+ data[i].cityName +'('+data[i].countryID+')</td></tr><tr><td>Latitude:</td><td>'+data[i].latitude+'</td></tr><tr><td>Longitude:</td><td>'+data[i].longitude+'</td></tr></table></div>')
        }
        }
       
      })
      //document.getElementById('result').innerHTML = data.length+"results"
      //$.each(data,function(index){

      //})
       for(var i=0;i<10;i++){
          $("#result").append('<div id="covering" style="font-family:candara;width:100%;background-color:#fff;margin-bottom:10px"><table><tr><td>'+i+'City Name:</td><td>'+ data[i].cityName +'('+data[i].countryID+')</td></tr><tr><td>Latitude:</td><td>'+data[i].latitude+'</td></tr><tr><td>Longitude:</td><td>'+data[i].longitude+'</td></tr></table></div>')
        }

      

      },
      error:function(obj,status,e){
        console.log(e)
      }
    })
  }

})

 
})
</script>
<body style="background-color: #e5e5e5">
{{csrf_field()}}
<!-- Just an image -->
<div style="width: 100%; height:100%" align="center">
<div style="width: 100%;height:150px;background-color: #FF4500" class="body">
  
<div style="width: 100%;height: 140px;background-color: #fff;">
<hr style=" border:2px solid #ff4500" />
<table style="width: 100%">
  <tr>
    <td style="width: 20%" align="right"><img src="{{asset('https://majorcityfinder.herokuapp.com/images/newlocator.png')}}" style="margin-left: 10px" width="100px" height="100px" /></td>
    <td>

      <div style="float: right;width: 90%;background-color: #fff;margin-top: 80px;" align="center">
        <table style="width: 100%;color:#ff4500;font-family: candara"><tr align="center"><td>The Company</td><td>What We do</td><td>Partners</td><td style="background-color: #ff4500;color:#fff;font-weight: bold;"><u>FindLocation</u></td><td>About Us</td><td>Contact Us</td></tr></table>
      </div>
    </td>
  </tr>
</table>

</div>

</div>
<div id="banner" align="center">
  <img src="{{asset('images/banner_city.gif')}}" style="margin-top: 10px" />

</div>
<div id="body" style="width: 80%">
 <table style="width: 100%; margin-top: 30px" >
   <tr><td>
     <div align="center" style="width: 100%">
  <div class="quicklink" id="quicklink" style="float: left;width: 20%;background-color: #e5e5e5;color: #000;font-family: candara" align="left">
    <div style="width: 100%; height: 30px;background-color: #ff4500;color: #fff;font-weight: bold;;font-family: candara;">
      <div style="margin-left: 30px;font-size: 22px">Quick Link</div>
    </div>
    <div style="margin-left: 30px;font-size: 16px">
    <div style="width: 100%;height:20px">>>Affliates</div>
    <div style="width: 100%;height:20px">>>Partners</div>
    <div style="width: 100%;height:20px">>>ShowCase</div>
    <div style="width: 100%;height:20px">>>DataCenter</div>
  </div>

  </div>
  <div id="locatorform" style="float: left;margin-left: 10px;width:70%" class="locatorform">
    <div style="width:100%;font-family: candara" align="left" >
      <h3>City Locator</h3>
<form>
      <input type="text" name="" class="cityname" id="cityname" style="width: 200px;height:30px" placeholder="Cities within (USA/China/France/Brazil/India)"><div style="position: absolute;z-index:2;background-color: #fff;width:200px" id=autosuggest></div>
      <input type="text" name="" class="latitude" id="latitude" style="width: 100px;height:30px" placeholder="Latitude">
      <input type="text" name="" class="longitude" id="longitude" style="width: 100px;height:30px" placeholder="Longitude">
      <input type="button" name="" id="search" value="Search" style="width: 200px;height:30px" >
    </form>
    <div id="pager"></div>
    <div id="result"></div>
    </div>
    



  </div>


   </td></tr>
 </table>

</div>
<footer style="background-color: #dedede;font-family: candara;margin-top: 150px">
  <div>Powered By VinnyScript</div>
  &copy;2019

</footer>
</div>






</div>


</body>
</html>
