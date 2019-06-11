sala_id = 0;
list_salas = [{
	img: "img/salas/cachorro.gif",
		nome: "Melhor Amigo do Homen",
		description: "Error my friend, this site is down, BREAKDOWN BREAKDOWN BREAKDOWN ",
		link: "/1"
	},{
		img: "img/salas/terror.gif",
		nome: "Terror Web",
		description: "Error my friend, this site is down, BREAKDOWN BREAKDOWN BREAKDOWN ",
		link: "/1"
	},{
		img: "img/salas/animais.jpg",
		nome: "Adota-se",
		description: "Error my friend, this site is down, BREAKDOWN BREAKDOWN BREAKDOWN ",
		link: "/1"
	},{
		img: "img/salas/animal.jpg",
		nome: "Corujas de Carterinha",
		description: "Error my friend, this site is down, BREAKDOWN BREAKDOWN BREAKDOWN ",
		link: "/1"
}]
	
vazio = isEmptyObject(list_salas)

if(vazio == true){
	$(".list-group").append(` <li class="list-group-item"> Você não tem nenhuma sala =[ </li>`)
}else{
	make_list()
}

function isEmptyObject(obj){
return obj.toSource() === "[{}]";
}

function make_list(){
	for(let i=0; i<list_salas.length; i++){
		$(".list-group").append(` <a data-toggle="modal" data-target="#editar_sala" onClick="setId(${i})"><li class="list-group-item"> <img src="${list_salas[i].img}" class="rounded mr-1" height="50px" width="50px" >${list_salas[i].nome} </li></a>`)
	}
}