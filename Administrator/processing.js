// JavaScript Document
window.onresize = function(event) { setProcessing() }

function closeProcessing(){
 var el = document.getElementById("divProcess");
 if (el) { el.className = "loading-invisible"; }
}

function showProcessing(){
 var el = document.getElementById("divProcess");
 if (el) { el.className = "loading-visible"; }
 setProcessing();
}

function setProcessing(){
 var el = document.getElementById("imgProcess");
 if (el) {
  var newleft = document.documentElement.clientWidth-200;
  var newtop = document.documentElement.clientHeight-200;
  if (newleft>0) newleft = (newleft/2)+"px";
  if (newtop>0) newtop = (newtop/2)+"px";
  el.style.left = newleft;
  el.style.top = newtop;
 }
}