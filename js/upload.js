function previewFile()
{
  var 	preview = document.querySelector('#photo'),
   		file    = document.querySelector('input[type=file]').files[0],
   		reader  = new FileReader(),
   		canvas  = document.querySelector('#canvas');


  reader.onloadend = function()
  {
	preview.src = reader.result;
  }
  if (file)
  {
	  preview.width = 400;
	  preview.height = 300;
	  file.width = 400;
	  file.height = 300;
	var extension = file.name.substring(file.name.lastIndexOf('.'));
    // Only process image files.
    var validFileType = ".jpg";
    if (validFileType.toLowerCase().indexOf(extension) < 0) {
        alert("please select valid file type. The supported file type is .jpg ");
        return false;
    }
	reader.readAsDataURL(file);
	return (preview.src);
  }
  else
  {
	preview.src = "kitten.jpg";

  }
}

function sendphoto(data)
{
  var xhr = null;
  xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function()
  {
	  if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
	  {
	  }
  };
  xhr.open("POST", "save.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(data);
}

function sendgalerie(data)
{
  var xhr = null;
  xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function()
  {
	  if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
	  {
		  document.getElementById("side").innerHTML = xhr.responseText;
	  }
  };
  xhr.open("POST", "cam2.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send();
}

function clearphoto()
{
  	var context = canvas.getContext('2d');
  	context.fillStyle = "#AAA";
  	context.fillRect(0, 0, canvas.width, canvas.height);
  	var data = canvas.toDataURL('image/png');
  	photo.setAttribute('src', 'kitten.jpg');
}

function takepicture1()
{
	var 	preview = document.querySelector('#photo');
	if(previewFile())
	{
  var xhr = null;
  xhr = new XMLHttpRequest();
  var data = previewFile();
  var photo = document.querySelector('#photo');
  var file = document.querySelector('#file');
  if (document.getElementById('barbee').checked)
  {
	  xhr.open("POST",'filter1.php?filter=barbee',true);
	  document.getElementById('barbee').checked = false;
	  document.getElementById('palmierr').checked = false;
  }
  else if (document.getElementById('chapeauu').checked)
  {
	  xhr.open("POST",'filter1.php?filter=chapeauu',true);
	  document.getElementById('chapeauu').checked = false;
	  document.getElementById('palmierr').checked = false;
  }
  else if (document.getElementById('palmierr').checked)
  {
	  xhr.open("POST",'filter1.php?filter=palmierr',true);
	  document.getElementById('chapeauu').checked = false;
	  document.getElementById('barbee').checked = false;
  }
  else
  {
	  alert("Merci de bien vouloir choisir un filtre");
	  return;
  }
  xhr.setRequestHeader("Content-type", "application/upload");
  xhr.send(data);
  xhr.onreadystatechange = function()
  {
	  if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
	  {
		  photo.setAttribute('src', xhr.responseText);
		  data = xhr.responseText;
		  sendphoto(data);
		  sendgalerie(data);
		  file.value = "";
		  preview.src = "kitten.jpg";
	  }
  }
  }
  else {
  	alert("merci de choisir une image") ;
  }
 }
