(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
	  last        = document.querySelector('#last'),

      startbutton  = document.querySelector('#startbutton'),
      width = 400,
      height = 0;

  navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

  navigator.getMedia(
    {
      video: true,
      audio: false
    },
    function(stream) {
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
		video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },
    function(err) {
      console.log("An error occured! " + err);
    }
  );

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

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
	};

	function sendgalerie(data)
	{
		var xhr = null;
		xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function ()
		{
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
			{
				document.getElementById("side").innerHTML = xhr.responseText;
			}
		};
		xhr.open("POST", "cam2.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send();
	};

	function takepicture()
	{
		var xhr = null;
		xhr = new XMLHttpRequest();
    	canvas.width = width;
    	canvas.height = height;
    	canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    	var data = canvas.toDataURL('image/png');
		if (document.getElementById('barbee').checked)
		{
			xhr.open("POST",'filter.php?filter=barbee',true);
			document.getElementById('barbee').checked = false;
			document.getElementById('palmierr').checked = false;
			document.querySelector('#startbutton').style.backgroundColor = "rgb(219,219,219)";
			document.querySelector('#startbutton').style.borderColor = "rgb(219,219,219)";
		}
		else if (document.getElementById('chapeauu').checked)
		{
			xhr.open("POST",'filter.php?filter=chapeauu',true);
			document.getElementById('chapeauu').checked = false;
			document.getElementById('palmierr').checked = false;
			document.querySelector('#startbutton').style.backgroundColor = "rgb(219,219,219)";
			document.querySelector('#startbutton').style.borderColor = "rgb(219,219,219)";
		}
		else if (document.getElementById('palmierr').checked)
		{
			xhr.open("POST",'filter.php?filter=palmierr',true);
			document.getElementById('chapeauu').checked = false;
			document.getElementById('barbee').checked = false;
			document.querySelector('#startbutton').style.backgroundColor = "rgb(219,219,219)";
			document.querySelector('#startbutton').style.borderColor = "rgb(219,219,219)";
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
			}
		};
	}

	startbutton.addEventListener('click', function(ev)
	{
      	takepicture();
    	ev.preventDefault();
  	}, false);

})();
