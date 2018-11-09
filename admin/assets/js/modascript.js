// JavaScript Document
/*
	WebApp-title:	Hospital management system
	Author:			Peter Umoren
	Phone number:	08076238524
	Date:			3/May/2015
*/
var pass; var p; var disp;
var xmlhttp = new XMLHttpRequest();

window.onload = function()
{ shCal(); }
function loading(who,car)
{
	pass = who;
	document.getElementById(pass.name + " ").innerHTML = "<img src=\"../images/loading.gif\" style='position:relative;top:2px' />";
	setTimeout(car + "()",1000);
}
function check()
{
	var serverPage = "sign.php?" + pass.name + "=" + pass.value;
	xmlhttp.open("GET", serverPage);
	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			document.getElementById(pass.name + " ").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send(null);
}
function contrl(i)
{
	//alert(i);
	if(i == 10)
	{
		document.getElementById("slide").children[disp].className = "pau";
		document.getElementById("ctrl").innerHTML = "<img src='images/play.png' onClick=\"contrl(" + disp + ")\" />";
		document.getElementById("ctrl").style.background = "#248138";
		clearTimeout(p);
	}
	else{ adShow(document.getElementById("slide"),i); }
}
function shCal()
{
	for(i = 0;i < document.getElementById("slide").childElementCount;i++)
	{
		document.getElementById("box").innerHTML += "<div onclick=\"dis(" + i + ")\"></div>";
	}
	uid = document.getElementById("slide")
	p = setTimeout(adShow,0,uid,0);
}
function dis(i)
{
	document.getElementById("box").children[disp].style.background = "#f90";
	document.getElementById("slide").children[disp].className = "";
	clearTimeout(p);
	adShow(document.getElementById("slide"),i);
}
function adShow(uid,i)
{
	if(i == uid.childElementCount)
	{ setTimeout(showin(0,uid),0); }
	else
	{ setTimeout(showin,0,i,uid); }	
}
function showin(d,uid)
{
	//alert(d);
	n = uid.childElementCount - 1;
	if(d == 0)
	{
		document.getElementById("box").children[n].style.background = "#f90";
		uid.children[n].className = "";
	}
	else
	{
		document.getElementById("box").children[d-1].style.background = "#f90";
		uid.children[d - 1].className = "";
	}
	disp = d;
	document.getElementById("ctrl").innerHTML = "<img src='images/pause.png' onClick=\"contrl(10)\" />";
	document.getElementById("ctrl").style.background = "#e00";
	document.getElementById("box").children[d].style.background = "#fff";
	uid.children[d].className = "is-showing";
	p = setTimeout(adShow,9975,uid,d+1);
	//alert(p);
}
function b()
{
	document.getElementById('modapage').className = 'ani';
	document.getElementById('modapage').style.display = 'block'; document.getElementById('moda').style.display = 'block';
}
function closemoda()
{	
	document.getElementById('modapage').className = 'outta';
	setTimeout('removecon()',2000);
	setTimeout("location = '../index.php'",2000);
}
function closemoda1()
{	
	document.getElementById('modapage').className = 'outta';
	setTimeout('removecon()',2000);
	setTimeout("location = 'index.php'",2000);
}
function removecon()
{
	document.getElementById('modapage').style.display = 'none'; document.getElementById('moda').style.display = 'none';
}
function show(who,d)
{
	document.getElementById(who).style.display = "block";
	document.getElementById(d).style.visibility = "visible";
}
function hide(who,d)
{ document.getElementById(who).style.display = "none";document.getElementById(d).style.visibility = "hidden"; }