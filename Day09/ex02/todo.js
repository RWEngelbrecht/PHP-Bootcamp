var i = 0;
var list;
var cook = [];

window.onload = function() {
	ft_list = document.querySelector("#ft_list");
	var tmp = document.cookie;
	if (tmp) {
		cook = JSON.parse(tmp);
		cook.forEach(function (e) {
			newToDo(e);
		});
	}
}

window.onunload = function() {
	var todo = list.children;
	var newCook = [];
	for (var i = 0; i < todo.length; i++) {
		newCook.unshift(todo[i].innerHTML);
	}
	document.cookie = JSON.stringify(newCook);
}

function newToDo(){
	var item = prompt("What needs to get done?", "New item");
	list = document.getElementById("ft_list");

	// console.log(item);

	if (item === '' || item == null) {
		alert("You can't do NOTHING?!")
	}
	else {
		var liItem = document.createElement("li");

		liItem.setAttribute("onclick", "remItem("+i+")");
		liItem.setAttribute("id", i);
		liItem.innerHTML = item;

		list.appendChild(liItem);
		list.prepend(liItem);
		i++;
	}

	console.log(list);
}

function remItem() {
	if (!confirm("You're done with this? You want to remove this?"))
		return;
	var arg = arguments[0];
	var rem = document.getElementById(arg);
	list.removeChild(rem);
}
