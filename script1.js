function uploadfile() {
document.getElementById('upload').submit();
}
function updatepanel(x)
{
	document.getElementById("updatepanel").style.display="block";
	if (x==1)
	{
	document.getElementById("abt1").style.display="block";
	}
	if (x==2) 
	{
		document.getElementById("addknow").style.display="block";
	}
	if (x==3) 
	{
		document.getElementById("certiup").style.display="block";
	}
}
function adminpanel(x)
 {
 	if (x) {
 			document.getElementById("loginpanel").style.display="block";
 	}
 	else
 		document.getElementById("loginpanel").style.display="none";

}
function closepanel()
{
	document.getElementById("updatepanel").style.display="none";
	document.getElementById("addknow").style.display="none";
	document.getElementById("abt1").style.display="none";
		document.getElementById("certiup").style.display="none";
}
function uploadabout()
{
var c=document.getElementById("abt").value;
var xhttp=new XMLHttpRequest();
xhttp.onreadystatechange=function(){
	if (this.readyState==4 && this.status==200) 
	{
		if (this.responseText) 
		{
		alert("uploaded!");
	document.getElementById("updatepanel").style.display="none";
	document.getElementById("abt1").style.display="none";
}
else
alert("not uploaded");
	}
};
xhttp.open("GET","ajaxfiles/uploadabt.php?x="+c, true);
xhttp.send();
}
function uploadknowledge()
{
	var c=document.getElementById("sub").value;
	var p=document.getElementById("percent").value;
	var xhttp=new XMLHttpRequest();
xhttp.onreadystatechange=function(){
	if (this.readyState==4 && this.status==200) 
	{
		if (this.responseText) 
		{
		alert("uploaded!");
	document.getElementById("updatepanel").style.display="none";
	document.getElementById("addknow").style.display="none";
	window.location="index.php";
}
else
alert("not uploaded");
	}
};
xhttp.open("GET","ajaxfiles/subjects.php?x="+c+"&p="+p, true);
xhttp.send();
}
function deletetext(x)
{
	var xhttp=new XMLHttpRequest();
xhttp.onreadystatechange=function(){
	if (this.readyState==4 && this.status==200) 
	{
		if (this.responseText) 
		{
	window.location="index.php";
}
else
alert("not done");
	}
};
xhttp.open("GET","ajaxfiles/delete.php?x="+x, true);
xhttp.send();
}
function delcerti(j)
{
if(confirm("sure to delete?"))
	{
		var hxml=new XMLHttpRequest();
		hxml.onreadystatechange=function(){
			if (this.readyState==4 && this.status==200) 
			{
				if (this.responseText) 
				{
					window.location="index.php";
				}
				else
					alert("unable to delete.")
			}
		};
		hxml.open("GET","ajaxfiles/deletecerti.php?x="+j,true);
		hxml.send();
	}
}
var image="";
function openframe(t,image,slno)
{
if (t) {
	document.getElementById('frame').style.display='flex';
	document.getElementById('framecontent').src=image;
	displaytext(slno);
}
else
	document.getElementById('frame').style.display='none';

}
function displaytext(sl)
{
		var hxml=new XMLHttpRequest();
		hxml.onreadystatechange=function(){
			if (this.readyState==4 && this.status==200) 
			{
				document.getElementById("imagetext").innerHTML=this.responseText;
			}
		};
		hxml.open("GET","ajaxfiles/extracttext.php?x="+sl,true);
		hxml.send();
}
function logout()
{
	window.location="logout.php";
}
function validate()
{ 
	document.getElementById('err').innerHTML='';
	var name=ph="";
	name=document.getElementById('name').value;
	var value1=validate_name(name);
	ph=document.getElementById('phno').value;
	value2= validate_no(ph);
	if (value1==true && value2==true)
	 	return true;
	 	else
	 	return false;
}
function validate_name(x)
{
	var form1=/[0-9]/g;
	var patt=/[!#%^&*()+\-=\[\]{};':"\\|,.<>\/?]+/ ;
	if (form1.test(x)||patt.test(x))
	 {
	 	document.getElementById('err').innerHTML='*invalid name';
	 	return false;
	 }
	 else
  return true;
}
function validate_no(x)
{
		var v=/[^0-9]/g;
	if(v.test(x)!=false)
		{
          document.getElementById('err').innerHTML = 'invalid phno';
         return false;
		}
		else
			return true;
}

function suggestionpanel()
{
window.location="msgpanel.php";
}
function check(value)
{
var len=value.length;
var c='',char='';
var str="";
var k=0;
if (value=="") 
{
		document.getElementById("predid").style.display="none";
}
for (var i = 0; i< len; i++) 
{
c=value.charAt(i);
if (c=='@') 
{
	k=i;
	for (var i = k+1; i <len; i++) 
{
	char=value.charAt(i); 
	if (char== ' ')
	mailid(str);
else{
	str=str+char;
		mailid(str);
}

}
}
else
document.getElementById("predid").style.display="none";
}

}
function mailid(x)
{
	var hxml=new XMLHttpRequest();
		hxml.onreadystatechange=function(){
			if (this.readyState==4 && this.status==200) 
			{
				document.getElementById("predid").style.display="block";
				document.getElementById("predid").innerHTML=this.responseText;
			}
		};
		hxml.open("GET","ajaxfiles/reply.php?x="+x,true);
		hxml.send();
}
var arg="";
function entervalue(arg) 
{
document.getElementById("replybox").value=arg;
document.getElementById("predid").style.display="none";
}