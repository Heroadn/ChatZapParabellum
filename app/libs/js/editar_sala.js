list_salas = [{
		img: "img/salas/cachorro.gif",
		nome: "Melhor Amigo do Homen",
		desc: "Error my friend, this site is down, BREAKDOWN BREAKDOWN BREAKDOWN ",
		categoria: 0,
		link: "/1"
	},{
		img: "img/salas/terror.gif",
		nome: "Terror Web", 
		desc: "Error my friend, this site is down, BREAKDOWN BREAKDOWN BREAKDOWN ",
		categoria: 1,
		link: "/1"
	},{
		img: "img/salas/animais.jpg",
		nome: "Adota-se",
		desc: "Error my friend, this site is down, BREAKDOWN BREAKDOWN BREAKDOWN ",
		categoria: 2,
		link: "/1"
	},{
		img: "img/salas/animal.jpg",
		nome: "Corujas de Carterinha",
		desc: "Error my friend, this site is down, BREAKDOWN BREAKDOWN BREAKDOWN ",
		categoria: 4,
		link: "/1"
}]

function setId(t){
	$(".titulo_sala").val("")
	$("#nome_editar").val(list_salas[t].nome)
	$("#senha_editar").val(list_salas[t].senha)
	$("#desc_editar").val(list_salas[t].desc)
	$('#categoria_editar option:eq('+(list_salas[t].categoria+1)+')').prop('selected', true);
	$(".foto_new").val("")
	$(".modal-header").append(`<h1 class="p-text titulo_sala text-center">Sala: ${list_salas[t].nome}</h1>`)
	push_tags(t)
}