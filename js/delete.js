function delete(id)
{
	var xhr = null;
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
		}
	};
	xhr.open("POST", "delete_pic.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send();
	}
}
