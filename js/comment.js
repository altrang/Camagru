function reboot(id){
	var xhr = null;
	var comment = document.forms['comment'].elements['comment'].value;
	console.log(comment);
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){

		}
	};
	xhr.open("POST", "solo.php?id=".concat(id), true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send();
	comment = "";
}

function commenti(id)
{
		var text = document.forms['comment'].elements['comment'].value,
			login = document.forms['comment'].elements['aa'].value;
		if (text == null || text == "")
		{
			alert("Please Write a comment !");
			return ;
		}
		if(login == null || login == "")
		{
			alert("You must be logged in to comment!");
			return ;
		}
		else
		{
			var xhr = null;
			xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
					var id = xhr.responseText;
					//reboot(id);
				}
			};
			xhr.open("POST", "comment.php", true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.send(text);
			text = "";
		}
}