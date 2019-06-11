function switchSearch(){
	$('#text').text("Pesquisar Sala por "+$("#inputState").val()+":");
	if($("#inputState").val() == "Categoria"){
		$("#inputSearch").hide()
		$("#select_search").show()
	}else{
		$("#select_search").hide()
		$("#inputSearch").show()
	}
}
switchSearch()