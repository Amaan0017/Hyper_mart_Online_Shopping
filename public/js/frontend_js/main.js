/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

	//this code generates prize with different sizes through ajax
$(document).ready(function(){
	$("#selSize").change(function(){
		var idSize = $(this).val();
		if(idSize==""){
			return false;
		}
		$.ajax({
			type : 'get',
			url : '/get-product-price',
			data : {idSize:idSize},
			success:function(resp){
				//alert(resp); 
			var arr = resp.split('#');
				$("#getPrice").html("PKR "+arr[0]);
				$('#price').val(arr[0]);
				if(arr[1]==0){
					$("#cartButton").hide();
					$("#Availability").text("Out of Stock");
				}else{
					$("#cartButton").show();
					$("#Availability").text("In Stock");
				}
			},error:function(){
				alert("Error");
			}
	 });
});

});

$(document).ready(function(){
	$(".changeImage").click(function(){
	var image = $(this).attr('src');
	$(".mainImage").attr("src",image);
	
 });
});
//zoom functionality
$(document).ready(function(){
// Instantiate EasyZoom instances
var $easyzoom = $('.easyzoom').easyZoom();

// Setup thumbnails example
var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

$('.thumbnails').on('click', 'a', function(e) {
	var $this = $(this);

	e.preventDefault();

	// Use EasyZoom's `swap` method
	api1.swap($this.data('standard'), $this.attr('href'));
});

// Setup toggles example
var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

$('.toggle').on('click', function() {
	var $this = $(this);

	if ($this.data("active") === true) {
		$this.text("Switch on").data("active", false);
		api2.teardown();
	} else {
		$this.text("Switch off").data("active", true);
		api2._init();
	}
});
});

//Validarion for register form
$().ready(function(){
	$("#registerForm").validate({
		rules:{
			name:{
				required:true,
				minLength:2,
				accept : "[a-zA-Z]+"
			},
			email:{
			  required:true,
			  email:true,
			  remote : "/check-email"
		  },
			password:{
				required:true,
				minLength:6
			}
		},
		messages:{
			name:{
				required : "Please Enter Your Name!",
				minLength : "Your name must contain 2 letters",
				accept : "Your name must contain letters only"
			}, 
			email:{
			  required : "Please enter your email",
			  email : "Please enter valid email",
			  remote : "Email already exists!"
		  },
			password:{
				required: "Please provide your Password",
				minLength: "Your Password must have 6 chracters long"	  
			  }
		}
	 });

//Validarion for login form
	 $("#loginForm").validate({
		rules:{
			email:{
			  required:true,
			  email:true
		  },
			password:{
				required:true
			}
		},
		messages:{ 
			email:{
			  required : "Please enter your email",
			  email : "Please enter valid email"
		  },
			password:{
				required: "Please provide your Password"	  
			  }
		}
	 });
	 $("#accountForm").validate({
		rules:{
			email:{
			  required:true,
			  email:true
		  },
			name:{
				required:true
			},
			address:{
				required:true
			},
			city:{
				required:true
			},
			state:{
				required:true
			}
		},
		messages:{ 
			email:{
			  required : "Please enter your email",
			  email : "Please enter valid email"
		  },
			name:{
				required: "Please provide your Name"	  
			  },
			address:{
				required: "Please provide your Address"	  
			  },
			city:{
				required: "Please provide your City"	  
			  },
			state:{
				required: "Please provide your State"	  
			  },
		}
	 });
//Check Current pwd matched or not!!!
     $("#current_pwd").keyup(function(){
		var current_pwd = $(this).val();
	    $.ajax({
			headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
		  type:'post',
		  url:'/check-user-pwd',
		  data:{current_pwd:current_pwd},
		  success:function(resp){
			  //alert(resp);
			if(resp=="true"){
				$("#chkPwd").html("<font color='green'>Current Password is correct</font>");
			}else{
				$("#chkPwd").html("<font color='red'>Current Password is inCorrect</font>");
			}
		  },error:function(){
			  alert("Error");
		  }
		});
	 });	 
	 //Password Strenghten JQuery
	 $('#myPassword').passtrength({
		minChars: 4,
		passwordToggle: true,
		tooltip: true,
		eyeImg : "/images/frontend_img/eye.svg"
		});
		//Copy Billing Address to Shipping Address Script
		$("#billtoship").click(function(){
			if(this.checked){
			$("#shipping_name").val($("#billing_name").val());
			$("#shipping_address").val($("#billing_address").val());
			$("#shipping_city").val($("#billing_city").val());
			$("#shipping_state").val($("#billing_state").val());
			$("#shipping_country").val($("#billing_country").val());
			$("#shipping_pincode").val($("#billing_pincode").val());
			$("#shipping_mobile").val($("#billing_mobile").val());
			}else{
			$("#shipping_name").val('');	
			$("#shipping_address").val('');
			$("#shipping_city").val('');
			$("#shipping_state").val('');
			$("#shipping_country").val('');
			$("#shipping_pincode").val('');
			$("#shipping_mobile").val('');
			}
		});
	});
//Select PAyment Method
function selectPaymentMethod(){
	if($('#paypal').is(':checked') || $('#COD').is(':checked')){
     // alert("Checked");
	}else{
		alert('Please Select Payment Method');
		return false;
	}
}





