


$(document).ready(function() {
    $("#Register").click(function() {
        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
        var email = $("#email").val();
        var pass = $("#pass").val();
        var gender = $("#gender").val();
        if (firstName == '' ||lastName == ''|| email == '' || pass == '' || gender == '') {
            alert("Please fill all fields...!!!!!!");
        } else {
            $.post("registr.php", {
                firstName1: firstName,
                lastName1: lastName,
                email1: email,
                pass1: pass,
				gender1:gender
            }, function(data) {
                if (data == 'Login to your account to get started') {
                	document.getElementById("registerForm").reset();
                }
                alert(data);
            });
        }
    }); 
});
$(document).ready(function(){
    $("#post_button").click(function(){
    	 var postText = $("#postText").val();
    	 

        if( postText != ""){
            $.ajax({
                url:'post_template.php',
                type:'post',
                data:{postText1:postText},
                success:function(response){
                    
                    
                }
            });
        }
    });
});


$(document).ready(function(){
    $("#Login").click(function(){
    	 var emailGet = $("#emailGet").val();
    	 var passGet = $("#passGet").val();

        if( emailGet != "" && passGet != "" ){
            $.ajax({
                url:'login.php',
                type:'post',
                data:{email2:emailGet,pass2:passGet},
                success:function(response){
                    var msg = "";
                    if(response == 1){
                        window.location.href = "home.php";
                    }else{
                       alert("Invalid username and password!");
                    }
                }
            });
        }
    });
});


 
 

$(document).ready(function() {
	$("#imageUpload").click(function() {
		window.location.href="multiupload.php";
		
	});
});

$(document).ready(function() {
	$("input[type='image']").click(function() {
		if($("input[id='my_file']").click()){
			var path=$("#my_file").val();
			var picName = path.substring(60,100);
			$.post("avatar.php",{
				avatar:picName
			});
		}
	});
});

$(document).ready(function() {
	$("#gallery").click(function() {
		window.location.href="gallery.php";
	});
});
//
//
//$( document ).ready(function() {
//	$(".post_button").click(function(){
//		var text = $("#post").val();
//		$.ajax({
//			cache:false,
//			type:"POST",
//			data:{contect:text},
//			url:"../addPost.php",
//			success:function(msg){
//				var data = $.parseJSON(msg);
//				$("#test").innerHTML = "<ul>";
//				for(var i = 0; i < data.length;i++){
//					$("#test").append("<li>"+data[i]['name']+"</li>");
//				}
//				$("#test").append("</ul>");
//				$(".profilePost").append(text);
//			},
//			error:function(msg){
//				
//			}
//		});
//	});
//});