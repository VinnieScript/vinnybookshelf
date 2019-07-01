<html>
<head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=1024">
        <link rel="icon" href="{!!asset('images/expert.png')!!}"/>
        <title>Expert System Analyst</title>
        <script src="{{asset('newjs/jquery-3.3.1.min.js')}}"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<script>
$(document).ready(function(){
  
 
$("#monthlyEva").click(function(){
  $("#monthlyappend").remove();
  $("#evlautionresult").remove();
  $("#indicator").remove();
  $("#overallAnalysis").remove();

$("#display").append('<div style="width:100%" id="monthlyappend"><h3>Monthly Evaluation Analysis</h3><select id="monthselect" style="width:100%"><option>Select Month</option><option>January</option><option>Febuary</option><option>March</option><option>April</option><option>May</option><option>June</option><option>July</option><option>August</option><option>September</option></select></div>')
$("#monthselect").change(function(){
  //alert($(this).val())
  month = $(this).val();
   $.ajax({
    url:'/monthlyEvaluation',
    type:'POST',
    headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
    beforeSend:function(){
      $("#display").append('<div id="waitingmsg">Please Wait...</div>');
    },
    data:{
      month:month
    },
    success:function(data){
      
       $("#waitingmsg").remove();
       console.log(data)
       console.log(data[0]['samsung'])

       samsungpecentage = (data[0]['samsung'] * 100)/50
       itelpecentage = (data[0]['itel'] * 100)/50
       nokiapecentage = (data[0]['nokia'] * 100)/50
       technopecentage = (data[0]['techno'] * 100)/50
       iphonepecentage = (data[0]['iphone'] * 100)/50

       
       $("#evlautionresult").remove()
       $('#indicator').remove();
       $("#display").append('<div id="evlautionresult" style="width:100%;margin-top:20px"><h3>'+month+'</h3><table style="width:100%;border-collapse:collapse" border="1"><tr style="background-color:#000;color:#fff;font-family:candara;font-weight:bold"><td>Goods</td><td width="50px">Percentage Ranked</td><td>Analysis</td></tr><tr><td width="50px">SamSung</td><td id="samsungStyle">'+samsungpecentage+'</td><td>Analysis</td></tr><tr><td>Itel</td><td id="itelStyle">'+itelpecentage+'</td><td>Analysis</td></tr><tr><td>Nokia</td><td id="nokiaStyle">'+nokiapecentage+'</td><td>Analysis</td></tr><tr><td>Techno</td><td id="technoStyle">'+technopecentage+'</td><td>Analysis</td></tr><tr><td>Iphone</td><td id="iphoneStyle">'+iphonepecentage+'</td><td>Analysis</td></tr></table></div>')

       $("#display").append('<div id="indicator" style="width:100%"><br/><span style="font-family:candara">Indicator</span><div><table><tr><td style="background-color:#003300; width:20px"></td><td>Super Excellent Sales</td></tr></table></div><div><table><tr><td style="background-color:#7CFC00; width:20px"></td><td>Excellent Sales</td></tr></table></div><div><table><tr><td style="background-color:#ffff00; width:20px"></td><td>Fair Sales</td></tr></table></div><div><table><tr><td style="background-color:#808000; width:20px"></td><td>Fallen Sales</td></tr></table></div><div><table><tr><td style="background-color:#ff0000; width:20px"></td><td>Dropped Sales</td></tr></table></div></div>')

if(samsungpecentage >= 80){
        $("#samsungStyle").css('background-color','#003300')
        $("#samsungStyle").css('color','#fff')
        $("#samsungStyle").css('font-weight','bold')
       }
       else if(samsungpecentage >=69){
         $("#samsungStyle").css('background-color','#7CFC00')
         $("#samsungStyle").css('color','#fff')
         $("#samsungStyle").css('font-weight','bold')
       }
       else if(samsungpecentage >=51){
        $("#samsungStyle").css('background-color','#ffff00')
        $("#samsungStyle").css('color','#000')
        $("#samsungStyle").css('font-weight','bold')
       }
       else if(samsungpecentage >=40){
        $("#samsungStyle").css('background-color','#808000')
        $("#samsungStyle").css('color','#fff')
        $("#samsungStyle").css('font-weight','bold')
       }
       else if(samsungpecentage <40){
        $("#samsungStyle").css('background-color','#ff0000')
        $("#samsungStyle").css('color','#fff')
        $("#samsungStyle").css('font-weight','bold')
       }


       if(itelpecentage >= 80){
        $("#itelStyle").css('background-color','#003300')
        $("#itelStyle").css('color','#fff')
         $("#itelStyle").css('font-weight','bold')
       }
       else if(itelpecentage >=69){
         $("#itelStyle").css('background-color','#7CFC00')
         $("#itelStyle").css('color','#fff')
         $("#itelStyle").css('font-weight','bold')
       }
       else if(itelpecentage >=51){
        $("#itelStyle").css('background-color','#ffff00')
        $("#itelStyle").css('color','#000')
         $("#itelStyle").css('font-weight','bold')
       }
       else if(itelpecentage >=40){
        $("#itelStyle").css('background-color','#808000')
        $("#itelStyle").css('color','#fff')
         $("#itelStyle").css('font-weight','bold')
       }
       else if(itelpecentage <40){
        $("#itelStyle").css('background-color','#ff0000')
        $("#itelStyle").css('color','#fff')
         $("#itelStyle").css('font-weight','bold')
       }

       if(technopecentage >= 80){
        $("#technoStyle").css('background-color','#003300')
        $("#technoStyle").css('color','#fff')
         $("#technoStyle").css('font-weight','bold')
       }
       else if(technopecentage >=69){
         $("#technoStyle").css('background-color','#7CFC00')
         $("#technoStyle").css('color','#fff')
         $("#technoStyle").css('font-weight','bold')
       }
       else if(technopecentage >=51){
        $("#technoStyle").css('background-color','#ffff00')
        $("#technoStyle").css('color','#000')
         $("#technoStyle").css('font-weight','bold')
       }
       else if(technopecentage >=40){
        $("#technoStyle").css('background-color','#808000')
        $("#technoStyle").css('color','#fff')
         $("#technoStyle").css('font-weight','bold')
       }
       else if(technopecentage <40){
        $("#technoStyle").css('background-color','#ff0000')
        $("#technoStyle").css('color','#fff')
         $("#technoStyle").css('font-weight','bold')
       }
if(nokiapecentage >= 80){
        $("#nokiaStyle").css('background-color','#003300')
        $("#nokiaStyle").css('color','#fff')
         $("#nokiaStyle").css('font-weight','bold')
       }
       else if(nokiapecentage >=69){
         $("#nokiaStyle").css('background-color','#7CFC00')
         $("#nokiaStyle").css('color','#fff')
         $("#nokiaStyle").css('font-weight','bold')
       }
       else if(nokiapecentage >=51){
        $("#nokiaStyle").css('background-color','#ffff00')
        $("#nokiaStyle").css('color','#000')
         $("#nokiaStyle").css('font-weight','bold')
       }
       else if(nokiapecentage >=40){
        $("#nokiaStyle").css('background-color','#808000')
        $("#nokiaStyle").css('color','#fff')
         $("#nokiaStyle").css('font-weight','bold')
       }
       else if(nokiapecentage <40){
        $("#nokiaStyle").css('background-color','#ff0000')
        $("#nokiaStyle").css('color','#fff')
         $("#nokiaStyle").css('font-weight','bold')
       }


       if(iphonepecentage >= 80){
        $("#iphoneStyle").css('background-color','#003300')
        $("#iphoneStyle").css('color','#fff')
         $("#iphoneStyle").css('font-weight','bold')
       }
       else if(iphonepecentage >=69){
         $("#iphoneStyle").css('background-color','#7CFC00')
         $("#iphoneStyle").css('color','#fff')
         $("#iphoneStyle").css('font-weight','bold')
       }
       else if(iphonepecentage >=51){
        $("#iphoneStyle").css('background-color','#ffff00')
        $("#iphoneStyle").css('color','#000')
         $("#iphoneStyle").css('font-weight','bold')
       }
       else if(iphonepecentage >=40){
        $("#iphoneStyle").css('background-color','#808000')
        $("#iphoneStyle").css('color','#fff')
         $("#iphoneStyle").css('font-weight','bold')
       }
       else if(iphonepecentage <40){
        $("#iphoneStyle").css('background-color','#ff0000')
        $("#iphoneStyle").css('color','#fff')
         $("#iphoneStyle").css('font-weight','bold')
       }


 
    },
    error:function(obj, status, e){
      alert(e);
    }

  });
  

})

})



$("#overall").click(function(){
    
  $("#monthlyappend").remove();
  $("#evlautionresult").remove();
  $("#indicator").remove();
  $("#overallAnalysis").remove();

//alert(username+password);
  $.ajax({
    url:'/overall',
    type:'POST',
    headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
    beforeSend:function(){
      $("#display").append('<div id="waitingmsg">Please Wait...</div>');
    },
    data:{
      month:'All'
    },
    success:function(data){
      $("#waitingmsg").remove();
     console.log(data)

     var sumSamsung = 0
     sumItel = 0
     sumTechno = 0
     sumNokia = 0
     sumIphone = 0
     months = 0
     
$.each(data, function(index) {
            //console.log(data[index].samsung);
            sumSamsung += parseInt(data[index].samsung)
            sumIphone += parseInt(data[index].iphone)
            sumNokia += parseInt(data[index].nokia)
            sumTechno += parseInt(data[index].techno)
            sumItel += parseInt(data[index].itel)
            months+=1

            
        });

console.log('Samsung',sumSamsung)
console.log('sumItel',sumItel)
console.log('sumTechno',sumTechno)
console.log('sumNokia',sumNokia)
console.log('sumIphone',sumIphone)
console.log('Month',months)

samsungpecentage = (sumSamsung/(months * 50)) * 100
itelpecentage = (sumItel/(months * 50)) * 100
nokiapecentage = (sumNokia/(months * 50)) * 100
technopecentage = (sumTechno/(months * 50)) * 100
iphonepecentage = (sumIphone/(months * 50)) * 100


    


     $("#display").append('<div id="overallAnalysis" style="width:100%; margin-left:10px"><h3>Overall Analysis</h3><div id="samsungStyle"><div style="font-family:candara;font-size:30px">Samsung('+samsungpecentage+'%)</div><div style="width:100%;background-color:#fff;color:#000;font-family:candara">This products</div></div><div id="itelStyle"><div style="font-family:candara;font-size:30px">Itel('+itelpecentage+'%)</div><div style="width:100%;background-color:#fff;color:#000;font-family:candara">This products</div></div><div id="iphoneStyle"><div style="font-family:candara;font-size:30px">Iphone('+iphonepecentage+'%)</div><div style="width:100%;background-color:#fff;color:#000;font-family:candara">This products</div></div><div id="nokiaStyle"><div style="font-family:candara;font-size:30px">Nokia('+nokiapecentage+'%)</div><div style="width:100%;background-color:#fff;color:#000;font-family:candara">This products</div></div><div id="technoStyle"><div style="font-family:candara;font-size:30px">Techno('+technopecentage+'%)</div><div style="width:100%;background-color:#fff;color:#000;font-family:candara">This products</div></div></div>')

     if(samsungpecentage >= 80){
        $("#samsungStyle").css('background-color','#003300')
        $("#samsungStyle").css('color','#fff')
        $("#samsungStyle").css('font-weight','bold')
        $("#samsungStyle").css('margin-bottom','10px')

        
       
        
       }
       else if(samsungpecentage >=69){
         $("#samsungStyle").css('background-color','#7CFC00')
         $("#samsungStyle").css('color','#fff')
         $("#samsungStyle").css('font-weight','bold')
         $("#samsungStyle").css('margin-bottom','10px')
       }
       else if(samsungpecentage >=51){
        $("#samsungStyle").css('background-color','#ffff00')
        $("#samsungStyle").css('color','#000')
        $("#samsungStyle").css('font-weight','bold')
        $("#samsungStyle").css('margin-bottom','10px')
       }
       else if(samsungpecentage >=40){
        $("#samsungStyle").css('background-color','#808000')
        $("#samsungStyle").css('color','#fff')
        $("#samsungStyle").css('font-weight','bold')
        $("#samsungStyle").css('margin-bottom','10px')
       }
       else if(samsungpecentage <40){
        $("#samsungStyle").css('background-color','#ff0000')
        $("#samsungStyle").css('color','#fff')
        $("#samsungStyle").css('font-weight','bold')
        $("#samsungStyle").css('margin-bottom','10px')
       }

       if(itelpecentage >= 80){
        $("#itelStyle").css('background-color','#003300')
        $("#itelStyle").css('color','#fff')
         $("#itelStyle").css('font-weight','bold')
         $("#itelStyle").css('margin-bottom','10px')
       }
       else if(itelpecentage >=69){
         $("#itelStyle").css('background-color','#7CFC00')
         $("#itelStyle").css('color','#fff')
         $("#itelStyle").css('font-weight','bold')
         $("#itelStyle").css('margin-bottom','10px')
       }
       else if(itelpecentage >=51){
        $("#itelStyle").css('background-color','#ffff00')
        $("#itelStyle").css('color','#000')
         $("#itelStyle").css('font-weight','bold')
         $("#itelStyle").css('margin-bottom','10px')
       }
       else if(itelpecentage >=40){
        $("#itelStyle").css('background-color','#808000')
        $("#itelStyle").css('color','#fff')
         $("#itelStyle").css('font-weight','bold')
         $("#itelStyle").css('margin-bottom','10px')
       }
       else if(itelpecentage <40){
        $("#itelStyle").css('background-color','#ff0000')
        $("#itelStyle").css('color','#fff')
         $("#itelStyle").css('font-weight','bold')
         $("#itelStyle").css('margin-bottom','10px')
       }

       if(technopecentage >= 80){
        $("#technoStyle").css('background-color','#003300')
        $("#technoStyle").css('color','#fff')
         $("#technoStyle").css('font-weight','bold')
         $("#technoStyle").css('margin-bottom','10px')
       }
       else if(technopecentage >=69){
         $("#technoStyle").css('background-color','#7CFC00')
         $("#technoStyle").css('color','#fff')
         $("#technoStyle").css('font-weight','bold')
         $("#technoStyle").css('margin-bottom','10px')
       }
       else if(technopecentage >=51){
        $("#technoStyle").css('background-color','#ffff00')
        $("#technoStyle").css('color','#000')
         $("#technoStyle").css('font-weight','bold')
         $("#technoStyle").css('margin-bottom','10px')
       }
       else if(technopecentage >=40){
        $("#technoStyle").css('background-color','#808000')
        $("#technoStyle").css('color','#fff')
         $("#technoStyle").css('font-weight','bold')
         $("#technoStyle").css('margin-bottom','10px')
       }
       else if(technopecentage <40){
        $("#technoStyle").css('background-color','#ff0000')
        $("#technoStyle").css('color','#fff')
         $("#technoStyle").css('font-weight','bold')
         $("#technoStyle").css('margin-bottom','10px')
       }
if(nokiapecentage >= 80){
        $("#nokiaStyle").css('background-color','#003300')
        $("#nokiaStyle").css('color','#fff')
         $("#nokiaStyle").css('font-weight','bold')
         $("#nokiaStyle").css('margin-bottom','10px')
       }
       else if(nokiapecentage >=69){
         $("#nokiaStyle").css('background-color','#7CFC00')
         $("#nokiaStyle").css('color','#fff')
         $("#nokiaStyle").css('font-weight','bold')
         $("#nokiaStyle").css('margin-bottom','10px')
       }
       else if(nokiapecentage >=51){
        $("#nokiaStyle").css('background-color','#ffff00')
        $("#nokiaStyle").css('color','#000')
         $("#nokiaStyle").css('font-weight','bold')
         $("#nokiaStyle").css('margin-bottom','10px')
       }
       else if(nokiapecentage >=40){
        $("#nokiaStyle").css('background-color','#808000')
        $("#nokiaStyle").css('color','#fff')
         $("#nokiaStyle").css('font-weight','bold')
         $("#nokiaStyle").css('margin-bottom','10px')
       }
       else if(nokiapecentage <40){
        $("#nokiaStyle").css('background-color','#ff0000')
        $("#nokiaStyle").css('color','#fff')
         $("#nokiaStyle").css('font-weight','bold')
         $("#nokiaStyle").css('margin-bottom','10px')
       }


       if(iphonepecentage >= 80){
        $("#iphoneStyle").css('background-color','#003300')
        $("#iphoneStyle").css('color','#fff')
         $("#iphoneStyle").css('font-weight','bold')
         $("#iphoneStyle").css('margin-bottom','10px')
       }
       else if(iphonepecentage >=69){
         $("#iphoneStyle").css('background-color','#7CFC00')
         $("#iphoneStyle").css('color','#fff')
         $("#iphoneStyle").css('font-weight','bold')
         $("#iphoneStyle").css('margin-bottom','10px')
       }
       else if(iphonepecentage >=51){
        $("#iphoneStyle").css('background-color','#ffff00')
        $("#iphoneStyle").css('color','#000')
         $("#iphoneStyle").css('font-weight','bold')
         $("#iphoneStyle").css('margin-bottom','10px')
       }
       else if(iphonepecentage >=40){
        $("#iphoneStyle").css('background-color','#808000')
        $("#iphoneStyle").css('color','#fff')
         $("#iphoneStyle").css('font-weight','bold')
         $("#iphoneStyle").css('margin-bottom','10px')
       }
       else if(iphonepecentage <40){
        $("#iphoneStyle").css('background-color','#ff0000')
        $("#iphoneStyle").css('color','#fff')
         $("#iphoneStyle").css('font-weight','bold')
         $("#iphoneStyle").css('margin-bottom','10px')
       }


    },
    error:function(obj, status, e){
      alert(e);
    }

  });
  


  })

  $("#submitbtn").click(function(){
    
  var username = document.getElementById('username').value;
  var password = document.getElementById('password').value;
   

//alert(username+password);
  $.ajax({
    url:'/adminlogin',
    type:'POST',
    headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
    beforeSend:function(){
      $("#submitbtn").attr('disabled','disabled');
    },
    data:{
      username:username,
      password:password
    },
    success:function(data){
      if(data == "Successful"){
        window.location="/admin"
      }
      else{
        document.getElementById('result').innerHTML = data;
        $("#submitbtn").removeAttr('disabled');
      }
    },
    error:function(obj, status, e){
      alert(e);
    }

  });
  


  })

})
</script>
<body style="background-color: #e5e5e5">
{{csrf_field()}}
<!-- Just an image -->
<div style="width: 100%; height:100%" align="center">

<div style="margin-top:10px;width:80%" align="center">
<div id="banner" style="width:80%; border:1px solid #000" align="center" >
 <div style="position: absolute;z-index: 2;color: #fff;font-family: candara;margin-top:70px;font-weight: bold;font-size: 25px;margin-left: 10px">
  Expert System<br/> Analyst
</div>

<div style="position: relative;z-index: 1; width:100%" align="center">
<img src="{{URL::asset('/images/banner.gif')}}" height="200px" width="100%">
</div>
</div>

<div id="body">
<table style="width:80%">
  <tr>
<td id="tab"style="width:20%;border:2px solid #fff" >
<div style="width:100%;color: #000080;font-family: candara;border-bottom: 1px solid #fff;cursor: pointer;" id="monthlyEva">Monthly Evaluation</div>
<div style="width:100%;color: #000080;font-family: candara;cursor: pointer;" id="overall">Overall Evaluation</div>
</td>




<td>
 <div id="display" style="position: fixed;width: 50%;z-index: 3;height:100%;overflow-y: scroll"></div>

</td>

  </tr>

</table>

<div>




</div>


</div>



  </div>

</body>
</html>
