
var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject()
{
  var xmlHttp= new XMLHttpRequest();
  return xmlHttp;
}

function recher()
{

    if(xmlHttp.readyState==0 || xmlHttp.readyState==4)
  {
    var rech=document.getElementById('rech').value;



  xmlHttp.open("GET","/admin/listtemoignage/ajax?rech="+rech,true);
  xmlHttp.send(null);

  xmlHttp.onreadystatechange = result;


  }
  else {

    setTimeout('rech()',1000);
  }

}

function result()
{
  if(xmlHttp.readyState==4 || xmlHttp.readyState==0)
  {
    if(xmlHttp.status==200)
    {



    document.getElementById("affichage").innerHTML=xmlHttp.responseText;



  }else {
    alert("some");
  }
  }
}









function ajoutaffich()
{

    if(xmlHttp.readyState==0 || xmlHttp.readyState==4)
  {

  xmlHttp.open("GET","phpfile.php?nom11=jjj",true);
  xmlHttp.send(null);
  xmlHttp.onreadystatechange = handleServerResponse;


  }
  else {

    setTimeout('ajoutaffich()',1000);
  }

}

function handleServerResponse()
{
  if(xmlHttp.readyState==4 || xmlHttp.readyState==0)
  {
    if(xmlHttp.status==200)
    {



    document.getElementById("affichage").innerHTML=xmlHttp.responseText;



  }else {
    alert("some");
  }
  }

}


function valider()
{    if(xmlHttp.readyState==0 || xmlHttp.readyState==4)
{
var nom=document.getElementById('n').value;
xmlHttp.open("GET","phpfile.php?nom="+nom,true);
xmlHttp.send(null);
xmlHttp.onreadystatechange = hndle;


}
else {

  setTimeout('ajoutaffich()',1000);
}

}
function hndle()
{
  if(xmlHttp.readyState==4 || xmlHttp.readyState==0)
  {
    if(xmlHttp.status==200)
    {



    document.getElementById("ctr").innerHTML=xmlHttp.responseText;



  }else {
    alert("some");
  }
  }
}
