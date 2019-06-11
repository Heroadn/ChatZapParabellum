// parte para puxar as tag do banco
tags_bd = [{ tags : "animais aventura passatempo cachorros gatos"
		},{tags : "terror medo creepypasta loira_do_banheiro nudes_do_jailson"
		},{tags : "adotar_um_animal caridade cachurros adopta-se bem10_forca_alienigina"
		},{tags : "animal felipe_neto nando_cabeculinha_moura"}]
id_sala = 0;
tags_editar = "";
function push_tags( ind ){
	$("#tags_new_input").html("")
	$(".tag_add_area").html("")
	id_sala = ind;
	tags_editar = tags_bd[ind].tags
	total_editar = contarpalavra(tags_editar);
	for(let i=0; i<total_editar+1; i++){
		new_id = "total_editar"+i
		tag  = pegarXpalavra(i, tags_editar)
		$(".tag_add_area").append(`<button type="button" onClick="remove_tag('${tag}');remove_button(${new_id})" class="btn btn-purple purple-light m-1" id="${new_id}"> <span aria-hidden="true"> &times;</span> ${tag} </button>`)
	}
}
function pegarXpalavra (numero_da_palavra, palavra){
	var xpalavra = palavra.split(' ')[numero_da_palavra];// separar str por espaços
	return(xpalavra);
}
function mod_tag(){
	tag = $("#tags_new_input").val()
	if(tag != ""){
		console.log("passei")
		tag = no_space(tag)
		tags_editar = tags_editar+" "+tag
		console.log(tags_editar)
		new_id = "total_editar"+total_editar
		$(".tag_add_area").append(`<button type="button" onClick="remove_tag('${tag}');remove_button(${new_id})" class="btn btn-purple purple-light m-1" id="${new_id}"> <span aria-hidden="true"> &times;</span> ${tag} </button>`)
		total_editar++
		$("#tags_new_input").val("")
	}
}

function remove_tag(nometag){
	tags_editar = tags_editar.replace(" "+nometag,"");	
}
function contarpalavra(valor){         
    valor.replace(/(\r\n|\n|\r)/g," ").trim();
            
    var cont = valor.split(/\s+/g).length - 1;
	
	return cont
}
function no_space(vlr){
	while(vlr.indexOf(" ") != -1){
		vlr = vlr.replace(" ", "_");
	}
	return vlr;
}