var i;
var ft_list;
var cook = [];

window.onload = function() {
	ft_list = document.getElementById("ft_list");
	cook = document.cookie.split(';');
	this.console.log(cook);
	if (cook[0]) {
		var arr;
		for (var j = 0; j <= this.cook.length - 1; j++) {
			arr = cook[j].split('=');
			this.console.log("arr of cook = "+arr);
			i = arr[0].trim();
			item = decodeURIComponent(arr[1]);
			var liItem = document.createElement("div");

			liItem.setAttribute("onclick", "remItem("+i+")");
			liItem.setAttribute("id", i);
			liItem.innerHTML = item;

			ft_list.appendChild(liItem);
			ft_list.prepend(liItem);
		}
		i++;
	}
	else
		i = 0;
}

function getRndInteger(min, max) {
	return Math.floor(Math.random() * (max - min + 1) ) + min;
}

function setCookie(cname, cvalue, exdays, iVal) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 *60 * 60 * 1000));
	var expires = "expires=" + d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function newToDo(){

	var item = prompt("What needs to get done?", "New item");

	if (item === '' || item == null) {
		alert("You can't do NOTHING?!")
	}
	else {
		var liItem = document.createElement("div");

		liItem.setAttribute("onclick", "remItem("+i+")");
		liItem.setAttribute("id", i);
		liItem.innerHTML = item;

		ft_list.appendChild(liItem);
		ft_list.prepend(liItem);
		var todos = ft_list.children;
		setCookie(i, encodeURIComponent(todos[0].innerHTML),3);
		i++;
	}
}

function remItem(id) {

	if (!confirm("You're done with this? You want to remove this?"))
		return;

	var rem = document.getElementById(id);

	ft_list.removeChild(rem);
	setCookie(id, encodeURIComponent(rem.innerHTML), -1);
}
