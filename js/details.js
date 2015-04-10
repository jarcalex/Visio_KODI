/**
	Detail page scripts
*/

$('#popover-ram').popover({
	html : true,
	placement : 'bottom',
	trigger : 'hover',
	title : function() {
		return $("#popover-ram-head").html();
	},
	content : function() {
		return $("#popover-ram-body").html();
	}
});

$('#popover-cpu').popover({
	html : true,
	placement : 'bottom',
	trigger : 'hover',
	title : function() {
		return $("#popover-cpu-head").html();
	},
	content : function() {
		return $("#popover-cpu-body").html();
	}
});

/**
    EagleVisual page script
*/

function getText(ID, TYPE) {

	$("#vignette").load('modules/info_bulle.php?type='+TYPE+'&id='+ID);


	boucle('slow');
	
	tooltip.show(document.getElementById('vignette').innerHTML, 2000);

}

function boucle(vitesse) {
	var millisecondes = null;
	
	switch(vitesse) {
		case 'fast':
			millisecondes = 250;
		break;
		
		case 'slow':
			millisecondes = 30000;
		break;
		
		default:
			millisecondes = 500;
		break;
	}
	
	setTimeout(function() {
		boucle(vitesse);
	}, millisecondes);
}

var tooltip=function(){
 var id = 'tt';
 var top = -10;
 var left = 3;
 var maxw = 300;
 var speed = 10;
 var timer = 20;
 var endalpha = 95;
 var alpha = 0;
 var tt,t,c,b,h;
 var ie = document.all ? true : false;
 return{
  show:function(v,w){
   if(tt == null){
    tt = document.createElement('div');
    tt.setAttribute('id',id);
    t = document.createElement('div');
    t.setAttribute('id',id + 'top');
    c = document.createElement('div');
    c.setAttribute('id',id + 'cont');
    b = document.createElement('div');
    b.setAttribute('id',id + 'bot');
    tt.appendChild(t);
    tt.appendChild(c);
    tt.appendChild(b);
    document.body.appendChild(tt);
    tt.style.opacity = 0;
    tt.style.filter = 'alpha(opacity=0)';
    document.onmousemove = this.pos;
   }
   tt.style.display = 'block';
   c.innerHTML = v;
   setTimeout(function() {},1500);
   tt.style.width = w ? w + 'px' : 'auto';
   if(!w && ie){
    t.style.display = 'none';
    b.style.display = 'none';
    tt.style.width = tt.offsetWidth;
    t.style.display = 'block';
    b.style.display = 'block';
   }
  if(tt.offsetWidth > maxw){tt.style.width = maxw + 'px'}
  h = parseInt(tt.offsetHeight) + top;
  clearInterval(tt.timer);
  tt.timer = setInterval(function(){tooltip.fade(1)},timer);
  },
  pos:function(e){
   var u = ie ? event.clientY + document.documentElement.scrollTop : e.pageY;
   var l = ie ? event.clientX + document.documentElement.scrollLeft : e.pageX;
   tt.style.top = (u - h) + 'px';
   tt.style.left = (l + left) + 'px';
  },
  fade:function(d){
   var a = alpha;
   if((a != endalpha && d == 1) || (a != 0 && d == -1)){
    var i = speed;
   if(endalpha - a < speed && d == 1){
    i = endalpha - a;
   }else if(alpha < speed && d == -1){
     i = a;
   }
   alpha = a + (i * d);
   tt.style.opacity = alpha * .01;
   tt.style.filter = 'alpha(opacity=' + alpha + ')';
  }else{
    clearInterval(tt.timer);
     if(d == -1){tt.style.display = 'none'}
  }
 },
 hide:function(){
  clearInterval(tt.timer);
  c.innerHTML = "";
   tt.timer = setInterval(function(){tooltip.fade(-1)},timer);
  }
 };
}();


/* 
    BOX retractive
*/

$(function(){
	"use strict";
	$("[data-widget='collapse']").click(function(){
		var box=$(this).parents(".box").first();
		var bf=box.find(".box-body, .box-footer");
		if(!box.hasClass("collapsed-box")){
			box.addClass("collapsed-box");
			$(this).children(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
			bf.slideUp();
		}else{
			box.removeClass("collapsed-box");
			$(this).children(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
			bf.slideDown();
		}
	});
});