// open menu on mobile
$(document).ready(function() {
	$('.navbar-toggler-icon').click(function() {
		$(".navbar-toggler-icon").toggleClass("active");
		$("body").toggleClass("body-fixed");
	});
	$("#openVisit").click(function(){
		$(".memoriesShow").hide();
		$(".addmemory").hide();
		$('.memorytab').removeClass('active');
		$("#visitorarea").slideToggle();
	});
	$(".memorytab").click(function(){
		$("#visitorarea").hide();
		$(".memoriesShow").show();
		$(".addmemory").show();
	});
	// $("#memoryfiletoadd").change(function(){
			// var fd = new FormData();
			// var files = $('#memoryfiletoadd')[0].files[0];
			// fd.append('background_image', files);
		
			// $.ajax({
				// url: 'view-memorial.php',
				// type: 'post',
				// data: fd,
				// contentType: false,
				// processData: false,
				// success: function(response){
					// if(response != 0){
					   // alert('file uploaded');
					// }
					// else{
						// alert('file not uploaded');
					// }
				// },
			// });
	// })
	$('.addmemory').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			var formData = {
			  memorial_id: $("#memorialIdtoInput").val(),
			  memory: $("#memoryinputtoadd").val(),
			  addmemory: true,
			};
			$.ajax({
			  type: "POST",
			  url: "view-memorial.php",
			  data: formData,
			  dataType: "json",
			  encode: true,
			}).done(function (data) {
			  if(data.success === true){
				$("#MemoryonArea").load(location.href + " #MemoryonArea");
				$(".memory-result").html(
				  '<div class="alert alert-success">'+data.message+'</div>'
				);
			  }
			  if(data.success === false){
				$(".memory-result").html(
				  '<div class="alert alert-danger">'+data.message+'</div>'
				);
			  }
			});	
		}
	});
	
  //Form submission
  $("#UserRegistration").submit(function (event) {
    event.preventDefault();
    let spinner =  $('.regspinner');
    $(spinner).removeClass('d-none');
    $(spinner).addClass('fa-spin');
    var formData = {
      full_name: $("#fullname").val(),
      email: $("#email").val(),
      phone_number: $("#phone").val(),
      city: $("#city").val(),
      street: $("#street").val(),
      house_no: $("#housenumber").val(),
      apartment: $("#apartment").val(),
      register: true,
    };
    $.ajax({
      type: "POST",
      url: "create-user.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      $(spinner).addClass('d-none');
      if(data.success === true){
        $(".result").html(
          '<div class="alert alert-success">'+data.message+'</div>'
        );
        window.location.href = 'payment.php';
      }
      if(data.success === false){
        $(".result").html(
          '<div class="alert alert-danger">'+data.message+'</div>'
        );
      }
    });
  });
  //Forget password
  $("#forgetPass").submit(function(event) {
    event.preventDefault();
    let spinner =  $('.forgetspinner');
    $(spinner).removeClass('d-none');
    $(spinner).addClass('fa-spin');
    var formData = {				 
      email: $("#email").val(),	
              forget_pass:true,					  
    };
    $.ajax({
      type: "POST",
      url: "password-recovery.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      $(spinner).addClass('d-none');
      if(data.success === true){
        $(".result").html(
          '<div class="alert alert-success">'+data.message+'</div>'
        );
      }
      if(data.success === false){
        $(".result").html(
          '<div class="alert alert-danger">'+data.message+'</div>'
        );
      }
    });
  });
  //Visitor add form
  $("#visitorAdd").submit(function(event) {
    event.preventDefault();
    let spinner =  $('.visspinner');
    $(spinner).removeClass('d-none');
    $(spinner).addClass('fa-spin');
    var formData = {				 
      visitor_name: $("#addvisit").val(),
      mid: $("#vi").val(),
      visitor_add: true					  
    };
    $.ajax({
      type: "POST",
      url: "view-memorial.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      $(spinner).addClass('d-none');
      if(data.success === true){
		$("#vtable").load(location.href + " #vtable");
        $(".result").html(
          '<div class="alert alert-success">'+data.message+'</div>'
        );
      }
      if(data.success === false){
        $(".result").html(
          '<div class="alert alert-danger">'+data.message+'</div>'
        );
      }
    });
  });

  //Sign in form
  $("#LoginForm").submit(function(event) {
    event.preventDefault();
    let spinner =  $('.loginspinner');
    $(spinner).removeClass('d-none');
    $(spinner).addClass('fa-spin');
    var formData = {				 
      email: $("#email").val(),
      password: $("#password").val(),
      login: true,			  
    };
    $.ajax({
      type: "POST",
      url: "login.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      $(spinner).addClass('d-none');
      if(data.success === true){
        $(".result").html(
          '<div class="alert alert-success">'+data.message+'</div>'
        );
        window.location.href = 'create-memorial.php';
      }
      if(data.success === false){
        $(".result").html(
          '<div class="alert alert-danger">'+data.message+'</div>'
        );
      }
    });
  });

  $('#openvisitmedia').click(function(){
    $('#visitormediaadd').slideToggle();
  })
});
// open menu on mobile end


// hide show

// $('#day').addClass('active')
//   if($('#day').hasClass('active')) {
//   $('.calender-wrap').addClass('show');
//   $('.calender-wrap').removeClass('hide');
//   $('.mitzvah-data').addClass('hide');
//   $('.mitzvah-data').removeClass('show');
//   $('.tribe-box').addClass('hide');
//   $('.tribe-box').removeClass('show')
// }
// else{
//   $('.calender-wrap').addClass('hide');
//   $('.mitzvah-data').addClass('show');
//   $('.calender-wrap').removeClass('show');
//   $('.mitzvah-data').removeClass('hide');
//   $('.tribe-box').addClass('show');
//   $('.tribe-box').removeClass('hide');
// }
// $('#day').click(function() {
//   $('#day').addClass('active');
//   $('#month').removeClass('active');
//   $('.calender-wrap').addClass('show');
//   $('.calender-wrap').removeClass('hide');
//   $('.mitzvah-data').addClass('hide');
//   $('.mitzvah-data').removeClass('show');
//   $('.tribe-box').addClass('hide');
//   $('.tribe-box').removeClass('show')

//   $('.left-panel-box').removeClass('flex-view');
//   $('.main-outer').removeClass('half-width');
// });
$('.reminder-title').click(function() {
  // e.stopPropagation();
  $('.reminder-title').addClass('active');
  $('.tribe-box').addClass('show');
  $('.left-panel-box').addClass('flex-view');
  $('.main-outer').addClass('half-width');
});

$('.listing-box').click(function(e){
  e.stopPropagation();
});

$('body,html').click(function(e){
  $('.reminder-title').removeClass('active');
  $('.tribe-box').removeClass('show');
  $('.left-panel-box').removeClass('flex-view');
  $('.main-outer').removeClass('half-width');
  });

 //====================== dropdown-animation-js

 $('.dropdown').on('show.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
    });
    
    $('.dropdown').on('hide.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
    });
// dashboard
$('.toggle-icon-div').click(function() {
    $('.sidebar').toggleClass('active');
    $('.wrapper-body').toggleClass('active');

    $(this).toggleClass('active');
  
    if ($('.sidebar').hasClass('active')) {
      $(this).find('i').addClass('fa-times');
      $(this).find('i').removeClass('fa-bars');
    } else {
      $(this).find('i').addClass('fa-bars');
      $(this).find('i').removeClass('fa-times');
    }
  });




//=======Calendar-js

  // $('#example1').calendar();
$('#cal1, #cal2, #cal3, #cal4').calendar({
  type: 'date'
});
// $('#cal2').calendar({
//   type: 'date'
// });
// $('#cal3').calendar({
//   type: 'date'
// });
// $('#cal4').calendar({
//   type: 'date'
// });
// $('#example3').calendar({
//   type: 'time'
// });
// $('#rangestart').calendar({
//   type: 'date',
//   endCalendar: $('#rangeend')
// });
// $('#rangeend').calendar({
//   type: 'date',
//   startCalendar: $('#rangestart')
// });
// $('#example4').calendar({
//   startMode: 'year'
// });
// $('#example5').calendar();
// $('#example6').calendar({
//   ampm: false,
//   type: 'time'
// });
// $('#example7').calendar({
//   type: 'month'
// });
// $('#example8').calendar({
//   type: 'year'
// });
// $('#example9').calendar();
// $('#example10').calendar({
//   on: 'hover'
// });
// var today = new Date();
// $('#example11').calendar({
//   minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 5),
//   maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 5)
// });
// $('#example12').calendar({
//   monthFirst: false
// });
// $('#example13').calendar({
//   monthFirst: false,
//   formatter: {
//     date: function (date, settings) {
//       if (!date) return '';
//       var day = date.getDate();
//       var month = date.getMonth() + 1;
//       var year = date.getFullYear();
//       return day + '/' + month + '/' + year;
//     }
//   }
// });
// $('#example14').calendar({
//   inline: true
// });
// $('#example15').calendar();


//==============image-upload-js
$('#uploadFile').change(function(){
  var total_file=document.getElementById("uploadFile").files.length;
  for(var i=0;i<total_file;i++){
    $('.imagePreview').append("<span class=\"prevuploaded prevuploaded_"+i+"\"><span class=\"trashprevuploaded\" data-id='"+i+"'><img src=\"assets/images/trash.png\"></span><img class=\"hjhjdhj\" src='"+URL.createObjectURL(event.target.files[i])+"'></span>");
  }
});
 
$('.uploadvideo').change(function(){
  var total_file=document.getElementById("file-input").files.length;
  for(var i=0;i<total_file;i++){
    $('.videopreview').append("<span class=\"prevuploadedvid prevuploadedvid"+i+"\">"+
	                           "<span class=\"trashprevuploadedvid\" data-id='"+i+"' style=\"float:left !important\">"+
							   "<img src=\"assets/images/trash.png\"></span>"+
							   "<video width=\"320\" height=\"240\" controls>"+
							   "<source src='"+URL.createObjectURL(event.target.files[i])+"' type=\"video/mp4\"></video>");
  }
});

$(".imgAdd").click(function(){
  $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
});
$(document).on("click", "i.del" , function() {
// 	to remove card
  $(this).parent().remove();
// to clear image
  // $(this).parent().find('.imagePreview').css("background-image","url('')");
});
// $(function() {
//     $(document).on("change",".uploadFile", function()
//     {
//     		var uploadFile = $(this);
//         var files = !!this.files ? this.files : [];
//         if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
//         if (/^image/.test( files[0].type)){ // only image file
//             var reader = new FileReader(); // instance of the FileReader
//             reader.readAsDataURL(files[0]); // read the local file
 
//             reader.onloadend = function(){ // set image data as background of div
//                 //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
// uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
//             }
//         }
      
//     });
// });

//=========video-upload-js
// const input = document.getElementById('file-input');
// const video = document.getElementById('video');
// const videoSource = document.createElement('source');

// input.addEventListener('change', function () {
//   const files = this.files || [];

//   if (!files.length) return;

//   const reader = new FileReader();

//   reader.onload = function (e) {
//     videoSource.setAttribute('src', e.target.result);
//     video.appendChild(videoSource);
//     video.load();
//     video.play();
//   };

//   reader.onprogress = function (e) {
//     console.log('progress: ', Math.round(e.loaded * 100 / e.total));
//   };

//   reader.readAsDataURL(files[0]);
// });
//Image Upload
$('.ppupload').change(function(){
  var filename = $('.ppupload').val().replace(/C:\\fakepath\\/i, '');
  if($(this).val() !=""){
    $('.trashprofile').removeClass('d-none');
    $('.ppupd').css({
      'background':'#1B2C3A url(./assets/images/tick.png) no-repeat',
      'background-position':'95% 50%',
      'background-size':'18px'
    });
  }
  $('.replacableprofile').text(filename);
  const file = this.files[0];
  console.log(file);
  if (file){
    let reader = new FileReader();
    reader.onload = function(event){
      console.log(event.target.result);
      $('.proimg-added').attr('src', event.target.result);
    }
    reader.readAsDataURL(file);
    $(".dormnt-circle").addClass("upd-img");
    $(".proimg-added").removeClass("d-none");
  }
});

//Background Image Upload
$('.background_image').change(function(){
  if($(this).val() !=""){
    $('.trashbackground').removeClass('d-none');
    $('.backupd').css({
      'background':'#1B2C3A url(./assets/images/tick.png) no-repeat',
      'background-position':'95% 50%',
      'background-size':'18px'
    });
  }
  var filename = $('.background_image').val().replace(/C:\\fakepath\\/i, '');
  $('.replacablebackground').text(filename);
});

$('.trashprofile').click(function(){
  $('.ppupload').val("");
  $('.replacableprofile').text("");
  $(".dormnt-circle").removeClass("upd-img");
  $(".proimg-added").addClass("d-none");
  $('.trashprofile').addClass('d-none');
  $('.ppupd').css({
    'background':'#1B2C3A url(./assets/images/input-plus-icon.svg) no-repeat',
    'background-position':'95% 50%',
    'background-size':'18px'
  });
});
$('.trashbackground').click(function(){
  $('.background_image').trigger("change");
  $('.background_image').val("");
  $('.trashbackground').addClass('d-none');
  $('.replacablebackground').text("");
  $('.backupd').css({
    'background':'#1B2C3A url(./assets/images/input-plus-icon.svg) no-repeat',
    'background-position':'95% 50%',
    'background-size':'18px'
  });
})

//Validator
$('.validator').keyup(function(){
  if($(this).val() != ""){
    $(this).css({
      'background':'#1B2C3A url(./assets/images/tick.png) no-repeat',
      'background-position':'95% 50%',
      'background-size':'18px'
    });
  }
  else{
    $(this).css({
      'background':'#1B2C3A url(./assets/images/input-plus-icon.svg) no-repeat',
      'background-position':'95% 50%',
      'background-size':'18px'
    });
  }
})
$(document).on('click','.trashprevuploaded',function(){
  let index = $(this).data('id');

  let file=document.getElementById("uploadFile").files;
  let fileBuffer=[];
  Array.prototype.push.apply( fileBuffer, file );

  fileBuffer.splice(index, 1);
  const dT = new ClipboardEvent('').clipboardData || new DataTransfer(); 
  for (let file of fileBuffer) { dT.items.add(file); }
  filelistall = $('#uploadFile').prop("files",dT.files);
  $(this).parent().remove();
});

$(document).on('click','.trashprevuploadedvid',function(){
  let index = $(this).data('id');

  let file=document.getElementById("file-input").files;
  let fileBuffer=[];
  Array.prototype.push.apply( fileBuffer, file );

  fileBuffer.splice(index, 1);
  const dT = new ClipboardEvent('').clipboardData || new DataTransfer(); 
  for (let file of fileBuffer) { dT.items.add(file); }
  filelistall = $('#file-input').prop("files",dT.files);
  $(this).parent().remove();
});

