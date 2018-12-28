var header = $('header');
var scrollDelta = 10;
var scrollOffset = 200;
var isScroll = false;
var previousTop = 0;
var currentTop = 0;
var loc = window.location.pathname;
$(window).scroll(function() {
	if (!isScroll) {
		isScroll = true;
		(window.requestAnimationFrame)
			? requestAnimationFrame(autoHideHeader)
			: setTimeout(autoHideHeader, 250);
	}
var winT = $(this).scrollTop(),
	winH = document.documentElement.clientHeight,
	winW = document.documentElement.clientWidth;
if(winT > 100 && winW <= 428){
	document.getElementById("back-to-top").setAttribute('style', 'display:block');
} else{
	document.getElementById("back-to-top").setAttribute('style', 'display:none');}
});
function autoHideHeader() {
	currentTop = $(window).scrollTop();
	var distance = header.offset().top - header.height();
	if (previousTop >= currentTop) {
		if (previousTop - currentTop >= scrollDelta) {
			header.removeClass('is-hide');
		}
	}
	else {
		if (currentTop - previousTop >= scrollDelta && currentTop > scrollOffset) {
			header.addClass('is-hide');
		}
	}
	previousTop = currentTop;
	isScroll = false;
}
$('.scroll-h,#back-to-top').click(function() {
	$('html,body').animate({
		scrollTop: '0px'
	},
	800);
});
$('.scroll-c').click(function() {
	if($("#header").attr("class").indexOf("is-hide")>-1){
		var Ch = 40;
	}else{
		var Ch = -20;
	}
	$('html,body').animate({
		scrollTop: $('#comments').offset().top + Ch
	},
	800);
});
$('.scroll-b').click(function() {
	$('html,body').animate({
		scrollTop: $('#footer').offset().top
	},
	800);
});
function touchStart(event){
 $(this).addClass("scrollhover");
}
function touchEnd(event){
 $(this).removeClass("scrollhover");
}
$(".scroll-h,.scroll-b,.scroll-c,#gb2big5,#nightmode-btn,#sum-btn,#sidehb_a").on("touchstart",touchStart);
$(".scroll-h,.scroll-b,.scroll-c,#gb2big5,#nightmode-btn,#sum-btn,#sidehb_a").on("touchmove",touchEnd);
$(".scroll-h,.scroll-b,.scroll-c,#gb2big5,#nightmode-btn,#sum-btn,#sidehb_a").on("mouseover",touchStart);
$(".scroll-h,.scroll-b,.scroll-c,#gb2big5,#nightmode-btn,#sum-btn,#sidehb_a").on("mouseout",touchEnd);
$().fancybox({
	selector : '[data-fancybox="gallery"]',
	loop : true
});
var vir = document.getElementById("copyright");
var OS = function() {
var a = navigator.userAgent,
		b = /(?:Android)/.test(a),
		d = /(?:Firefox)/.test(a),
		e = /(?:Mobile)/.test(a),
		f = b && e,
		g = b && !f,
		c = /(?:iPad.*OS)/.test(a),
		h = !c && /(?:iPhone\sOS)/.test(a),
		k = c || g || /(?:PlayBook)/.test(a) || d && /(?:Tablet)/.test(a),
		a = !k && (b || h || /(?:(webOS|hpwOS)[\s\/]|BlackBerry.*Version\/|BB10.*Version\/|CriOS\/)/.test(a) || d && e);
return {
		android: b,
		androidPad: g,
		androidPhone: f,
		ipad: c,
		iphone: h,
		tablet: k,
		phone: a
}
}();
var k=0,l=0;
$("#article-content img,#article img").each(function(k) {
var b = $(this),c = (b.attr("title"), b.parent("a")),d = typeof b.attr("noGallery");
//var m = b.attr("data-src"), n = b.attr("src"),;
var o = b.attr("alt"), o=o+"";
if(typeof Blazy != 'undefined' && Blazy instanceof Function){
  var m = b.attr("data-src");
}else{
  var m = b.attr("src");
}
if (o.indexOf(".")>-1){
var p = '.'+o.split(".")[o.split(".").length-1],q = o.replace(p,""),r = q.replace(/\./g," ");
}else{
var r=o;
}
void 0 !== b.attr("max") && b.wrap('<div class="max-img"></div>'), "undefined" === d && (c.length < 1 && (c = b.wrap('<a data-no-instant="true" data-fancybox="gallery" data-type="image" href="' + m + '"></a>').parent("a")), c.addClass("light-link"),b.addClass("lazy lazy2 lazyloading b-lazy"),c.parent("p").addClass("tc"));
k++;
if(document.getElementById("onlyimg")) {b.addClass("nomargin");}else{

if(document.getElementById("autotitle")){
if(typeof Blazy != 'undefined' && Blazy instanceof Function){
c.after( '<span class="loadimg">图 '+ k +'：'+ r +'</span><a data-no-instant="true" id="loadimg" href="javascript:Blazy()" title="重新加载图片"><span class="showorno">（图片不显示？）</span></a>');
}else{
c.after( '<span class="loadimg">图 '+ k +'：'+ r +'</span>');}}

}
});
if(document.getElementById("autotitle")){
$("#article-content table").each(function() {
	l++;
	var c = $(this).wrap('<div class="article-table" id="article-table-'+ l +'"></div>'),
	d = document.getElementById('article-table-'+l).nextSibling,
	r = d.innerText,
	f = d.id;
	if (r.length<1){
		r = d.textContent;
	}
	if (r.length>0 && !f.indexOf("tbn")){
		$(this).after('<span class="loadimg">表 '+ l +'：' + r + '</span>');
	}else{
		$(this).after('<span class="loadimg">表 '+ l + '</span>');
	}
});
}
$("#search-box").bind("input porpertychange",function() { 
	-1 != $("#search-box").val().indexOf("自杀") && 
	ArmMessage.error('如需帮助请<a href="/about.html"><i class="fa fa-heart"></i> 联系我们</a><i class="fa fa-heart"></i>。') &&
	$('#search-box').val("");
});
function grin(tag) {
	var myField;
	tag = ' ' + tag + ' ';
if (document.getElementById('comment-text') && document.getElementById('comment-text').type == 'textarea') {
		myField = document.getElementById('comment-text');
	} else {
		return false;
	}
	if (document.selection) {
		myField.focus();
		sel = document.selection.createRange();
		sel.text = tag;
		myField.focus();
	}
	else if (myField.selectionStart || myField.selectionStart == '0') {
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		var cursorPos = endPos;
		myField.value = myField.value.substring(0, startPos)
			+ tag
			+ myField.value.substring(endPos, myField.value.length);
		cursorPos += tag.length;
		myField.focus();
		myField.selectionStart = cursorPos;
		myField.selectionEnd = cursorPos;
	}
	else {
		myField.value += tag;
		myField.focus();
	}
$("#smiles-sidebar").hide();
}
$("#smilies").click(function(){
	if($("#smiles-sidebar").css("display")=="none"){
	$("#smiles-sidebar").show();
	if(typeof Blazy != 'undefined' && Blazy instanceof Function){
		Blazy();
	}
	} else {
		$("#smiles-sidebar").hide();
	}
});
$("#alus").click(function(){
	if(typeof Blazy != 'undefined' && Blazy instanceof Function){
		Blazy();
	}
});
$(document).bind('click', function (e) {
	if($(e.target).closest("#form-emoji").length == 0 && $(e.target).closest("#smiles-sidebar").length == 0 && $("#smiles-sidebar").css("display")!="none"){
	$("#smiles-sidebar").hide();
}});
function getScrollHeight() {
	return document.body.scrollHeight || document.documentElement.scrollHeight;
}
function getClientHeight() {
	return Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
}
function getScrollTop() {
	return document.body.scrollTop || document.documentElement.scrollTop;
}
$('.toggle-title').on('click', function () {
	$(this).parent().toggleClass('active')
});
$('.tabs-title').on('click', 'li', function (e) {
	e.preventDefault()
	const index = $(this).index()
	$(this).parent().find('li').removeClass('active')
	$(this).addClass('active')
	$('.tabs-content').removeClass('active')
	$('#mc-tab-' + index).addClass('active')
});
if($('#response').length <1){
	$('.comment-reply').css('display','none');
};
$('#form-user-edit').on('click', function (e) {
	e.preventDefault()
	$(this)
	.parent()
	.remove()
$('#form-user').removeClass('form-item-hide');
});
$(".mc-button").each(function() {
var b = $(this);
if (b.length > 0){
b.wrap('<p class="tc"></p>');
}
});
$("#mc-video").each(function() {
	var b = $(this);
if (b.length > 0){
	b.wrap('<p class="tc"></p>');
}
});
if(!vir||vir.innerHTML != 'VIRCLOUD'){
	alert('开发不易，留个版权声明就那么难么？');
}
$('#sharewx').click(function() {
	var b = $('#wxscimg'),
	c = b.attr('data-src')
	if(c){
	b.attr('src',c);
	}
});
$('#groupwx,#tabali').click(function() {
	var b = $('#groupqr'),
	c = b.attr('data-src')
	if(c){
		b.attr('src',c);
	}
});
$('#like-shang,#index-shang').click(function() {
var b = $('#shangqr'),
	c = b.attr('data-src')
	if(c){
		b.attr('src',c);
}
});
$('#sidehb_a').click(function() {
        var b = $('#sidehbqr'),
            c = b.attr('data-src');
        if(c){
                b.attr('src',c);
        }
});
$('.wz-title').on('click', 'li', function (e) {
	e.preventDefault()
	const index = $(this).index()
	$(this).parent().find('li').removeClass('active')
	$(this).addClass('active')
	$('.wz-content').removeClass('active')
	$('#wz-tab-' + index).addClass('active')
});
if (window.location.hash){ //更新分页链接
	var r = window.location.hash;
	$("a").each(function(){
		var g = $(this),
		    c = g.attr("href");
		if (typeof c != 'undefined'){
			var d = c.indexOf("comment-page-"),
			    e = c.indexOf("ipage=");
			if (d >-1){
				if(e > -1){
					c = c + r;
				}
				if (e < 1 && getQueryVariable("ipage")){
					var j = c.split("#")[1],
				    	k = c.split("#")[0];
					c = k + "?ipage=" + getQueryVariable("ipage") + "#" + j;
				}
				g.attr("href",c);
			}
		}
	});
}

if(OS.phone){
	if(document.getElementById("disableservice")) {$("#tabs-service").hide(); }
	if(document.getElementById("disabletags")) { $("#tabs-label").hide(); }
	if(document.getElementById("disableads")) {$("#tabs-recom").hide(); }
	if(document.getElementById("disablestat")) {$("#tabs-sum").hide(); }
	if(document.getElementById("disablerecommend")) { $("#tabs-recomp").hide();}
	if(document.getElementById("disableabout")) { $("#tabs-related").hide(); }
	if(document.getElementById("disableaboutme")) { $("#tabs-aboutme").hide();}
}
var display =$('#tabs-sum').css('display');
if(display == 'none'){
 $("#usetime").addClass("first");
}
var loc = window.location.pathname;
var hid = loc.indexOf("page");
var first = loc.indexOf("/1/");
var link = loc.indexOf("link.html");
var cross = loc.indexOf("cross.html");
var guestbook = loc.indexOf("guestbook.html");
var offer = loc.indexOf("offer");
var about = loc.indexOf("about.html");
var search = loc.indexOf("search.html");
var saying = loc.indexOf("saying.html");
if (hid>-1 && first <1){
	$("#tabs-label").hide();
	$("#tabs-aboutme").hide();
}
(function($){
	$('.fancybox').fancybox({parent:'body'});
if(link>-1){
	$("#link").addClass("current");
}
if(saying>-1){
	$("#saying").addClass("current");
}
if(cross>-1){
	$("#cross").addClass("current");
}
if(guestbook>-1){
	$("#guestbook").addClass("current");
}
if(offer>-1){
	$("#offer").addClass("current");
}
if(about>-1){
	$("#about").addClass("current");
}
if(search>-1){// && document.readyState=="complete"){
        var wh = document.getElementById("search-box");
	//wh.focus();
	$("#search-single").on("click",function(){
		wh.focus();});
	$("#search-single").click();
}
})(jQuery);

