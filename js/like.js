function ajax_like(but){
	var xhr = null;
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
		}
	};
	xhr.open("POST", "like.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send();
	}

function ajax_unlike(but){
	var xhr = null;
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
		}
	};
	xhr.open("POST", "unlike.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send();
	}



function likedd(but)
{
	console.log(but);
	var varA;
	if (but.style.backgroundColor == 'green')
	{
		varA = "0";
		but.style.backgroundColor = 'pink';
	}
	else {

		varA = "1";
		but.style.backgroundColor = 'green';
	}
	if (varA == "1")
	{
		ajax_like(but);
	}
	if (varA == "0")
	{
		ajax_unlike(but);
	}

}
