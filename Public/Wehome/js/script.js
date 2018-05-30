// JavaScript Document
$(function(){
	$(".tableft ul li").click(function(){
		var num = $(".tableft ul li").index(this)
		$(".tableft ul li").removeClass("cur")
		$(this).addClass("cur")
		$(".tabmain").hide()
		$(".tabmain").eq(num).show()
		
		})
	$(".rec img").click(function(){
		$(this).siblings("input.text1").val("")
		
		})
	$("#txr").focus(function(){
		  if($(this).val()=="请输入您发现的问题"){
			  $(this).val("")
		   }
		 })
	$("#txr").blur(function(){
		  if($(this).val()==""){
			  $(this).val("请输入您发现的问题")
		   }
		 })
		
	var _height = $(".shanleft").height() 
	$(".shanright").css("line-height",_height+"px")
	
	function hei(){
		var _height = $(".shanleft").height() 
		$(".shanright").css("line-height",_height+"px")
		if($(".shanright").css("line-height",_height+"px")){
			
			clearInterval(n)
			}
		
		
		}
	var n = setInterval(hei,1)
	
	 var arr = []
	$("#del").click(function(){
		
		if(arr.length==0){
		 $(".shan").stop().animate({marginLeft:-20+"%"},300)
		 $(this).text("完成")
		 arr.push($(this).text())
		  }
	  else if(arr.length!=0&&arr[0]=="完成"){
		  $(this).text("编辑")
		  $(".shan").stop().animate({marginLeft:0},300)
		  arr.length=0
		  }
		 
		})
	$(".tra").click(function(){
		$(this).val("")
		$(this).css("color","#333333")
		
		})




	})