total = 0
tags = ""
function add_new_tag(){
	tag = $(".tag_new").val()
	if(tag != ""){
		tag = no_space(tag)
		tags = tags+" "+tag
		console.log(tags)
		new_id = "total"+total
		$(".new_tag_area").append(`<button type="button" onClick="remove_tag('${tag}');remove_button(${new_id})" class="btn btn-purple purple-light m-1" id="${new_id}"> <span aria-hidden="true"> &times;</span> ${tag} </button>`)
		total++
		$(".tag_new").val("")
	}
}

function remove_tag(nometag){
	tags = tags.replace(" "+nometag,"");	
}
function remove_button(id){
	$(id).hide(400);
}

function no_space(vlr){
	while(vlr.indexOf(" ") != -1){
		vlr = vlr.replace(" ", "_");
	}
	return vlr;
}