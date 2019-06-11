const input_search = document.querySelector("#pesq")
const input_modo_search = document.querySelector("#inputState")
const btnSearch = document.querySelector("#btnSearch")

btnSearch.addEventListener("click", function(){
  let enviar = true
  if($("#inputState").val() == "Categoria"){
    search = $("#select_search select").val()
	}else{
    enviar = input_search.value != "" ?  true : false
    search = $("#inputState").val() == "Tag" ? input_search.value.split(" ") : input_search.value
  }
  if(enviar){
    openPreLoad()
    $.ajax({
        method: "POST",
        url: "https://www.google.com",
        data: {
          search: search,
          modo_search: $("#inputState").val()
        }
    })
    .done(function(result){
      console.log(result)
    })
    .fail(function(result){
      let msnErr = `Erro: ${result.status} - ${result.statusText}`

      for(let i=0; i<err.length; i++) {
        if(err[i].cod == result.status){
          msnErr = 'Erro: ' + err[i].res
        }
      }
      openBoxErro(msnErr)
    })
    .always(function(){
        closePreLoad()
    })
  }
})

$('.msnError .exitMsn').click(function(){
	$('.msnError').hide(500)
})

function openPreLoad(){
	$('#root').hide(100)
	$('#preLoad').show(100)
}

function closePreLoad(){
	$('#preLoad').hide(100)
	$('#root').show(100)
}

function openBoxErro(text){
  $(".msnError .msn").text(text)
  $(".msnError .msn").show()
  $(".msnError").show()
}
