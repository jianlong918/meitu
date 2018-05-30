//关闭依蓝企鹅
$(function(){
	$('.lan_bg p').click(function(){
		$('.findlan').hide();
	})
})

//页面跳转
var timer=null;
window.onload=function(){
	timer=setTimeout(function(){
		$('.loader,.title').hide();
		$('.ly_company,.findlan,.login').fadeIn(1000);
		$('#preloader').fadeIn(1000);
		$('#preloader').css('background','url(img/logins.png) center center no-repeat');
		$('#preloader').css('background-size','cover');
		clearTimeout(timer);
	},2500)
}
$(function(){
	$('.findlan a img').mouseover(function(){
		$('.findlan a img').attr('src','img/findme_02.png');
	})
	$('.findlan a img').mouseout(function(){
		$('.findlan a img').attr('src','img/findme_03.png');
	})
})