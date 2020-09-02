$_DOMAIN = 'http://localhost/shareanime/';
function opentab(evt,id) {
	var tabcontent,active;
	tabcontent = document.getElementsByClassName("list_popular");
	for (var i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = 'none';
	}
	active = document.getElementsByClassName("opentab");
	for (var i = 0; i < active.length; i++) {
		active[i].className = active[i].className.replace("active","");
	}
	document.getElementById(id).style.display = 'block';
	evt.currentTarget.className+= " active";
}
if (document.getElementById("opened")) {
	document.getElementById("opened").click();
}


function opentab2(evt,id) {
	var tabcontent,active;
	tabcontent = document.getElementsByClassName("input_login");
	for (var i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = 'none';
	}
	active = document.getElementsByClassName("opentab");
	for (var i = 0; i < active.length; i++) {
		active[i].className = active[i].className.replace("btn_border"," ");
	}
	document.getElementById(id).style.display = 'block';
	evt.currentTarget.className+= " btn_border";
}
if (document.getElementById("opened2")) {
	document.getElementById("opened2").click();
}

$(".page").hide();
$('.page').click(function() {
	$('body,html').animate({
	scrollTop: 0
	})
	});
	$(window).scroll(function () {
	var e = $(window).scrollTop();
	if (e > 300) {
		$(".page").show();
	} else {
		$(".page").hide();
	}
});
var lastScrollTop = 0;
$(window).scroll(function(event){
   var st = $(this).scrollTop();
   if (st > lastScrollTop){
   		$(".header").removeClass('pined');
      	$(".header").addClass('unpin');
   } else {
   		
      	$(".header").removeClass('unpin');
        $(".header").addClass('pined');
   }
   lastScrollTop = st;
});
$('#load_more').on('click',  function(event) {
	$row_now = Number($('#row_now').val());
	$row_all = Number($('#row_all').val());
	$limit =2;
	$row_now+= $limit;
	if ($row_now<=$row_all) {
		$('#row_now').val($row_now);
		$('#load_more').val('Loading...');
		$('.web').css('opacity', '0.8');
		$.ajax({
			url: $_DOMAIN+ 'loadmore.php',
			type: 'POST',
			data: {
				row_now: $row_now,
				action: 'load_more'
			},
			success: function (data) {
				setTimeout(function () {
				$('.load:last').after(data).show().fadeIn("slow");
				$row_now+= $limit;
				$('#load_more').val('Xem thêm');
				$('.web').css('opacity', '1');
				if ($row_now>=$row_all) {
				$('#load_more').html("");
				$('#load_more').css('display', 'none');
				}
				},200);
			},
			error : function () {
			}
		})
		
	}
});
$('.layout').on('click', function(event) {
	$(this).addClass('hidden');
});
$('#btn_sidebar').on('click',function(event) {
	$('.sidebar').css({
		width: '250px'
	});
	$('.layer').removeClass('hidden');
});
$('.layer').on('click', function(event) {
	$('.modal_popup').addClass('hidden');
	// $(this).toggleClass('hidden');
	$('.sidebar').width(0);
});

$('#input-search').on('keyup', function(event) {
	$search = $(this).val();
	if ($search) {
		$('.search_quick').removeClass('hidden');
            $.ajax({
                url: $_DOMAIN+'search.php',
                type: 'POST',
                data: {
                    search: $search
                },
                success:function (data) {
                    $('#list_popular').html(data);
                },
                error:function () {

                 }
            })
    }
    else{
    	$(".search_quick").addClass('hidden');
    }
});
$("#input-search").focusin(function(){
    $(".search_quick").removeClass('hidden');
    $('#list_popular').empty();
  });
  $('.space').on('click',  function(event) {
  	 $(".search_quick").addClass('hidden');
  	 $('#input-search').val('');
  });
  $('.btn_modal').on('click', function(event) {
  	event.preventDefault();
	$('.modal_popup').removeClass('hidden');
});
  $('.input_item').on('focus', function(event) {
	if ($(this).val()=='') {
		$(this).parent().addClass('focus');
		$(this).parent().parent().addClass('focus');
	}
	
	console.log(Math.random());
});
$('.input_item').on('blur', function(event) {
	
	if ($(this).val()=='') {
		$(this).parent().removeClass('focus');
		$(this).parent().parent().removeClass('focus');
	}
});



$('#formSignin #btn_signin').on('click', function() {

    $this = $('#formSignin button');
    $this.html('Đang tải ...');
    $user_signin = $('#formSignin #user_signin').val();
    $pass_signin = $('#formSignin #pass_signin').val();
    alert($user_signin+" - "+$pass_signin);
    if ($user_signin == '' || $pass_signin == '')
    {
        $('#formSignin .alert').removeClass('hidden');
        $('#formSignin .alert').html('Vui lòng điền đầy đủ thông tin.');
        $this.html('Đăng nhập');
    }
    else
    {
        $.ajax({
            url : $_DOMAIN + 'admin/signin.php',
            type : 'POST',
            data : {
                user_signin : $user_signin,
                pass_signin : $pass_signin
            }, success : function(data) {
                $('#formSignin .alert').removeClass('hidden');
                $('#formSignin .alert').html(data);
                $this.html('Đăng nhập');
            }, error : function() {
                $('#formSignin .alert').removeClass('hidden');
                $('#formSignin .alert').html('Không thể đăng nhập vào lúc này, hãy thử lại sau.');
                $this.html('Đăng nhập');
            }
        });
    }
});