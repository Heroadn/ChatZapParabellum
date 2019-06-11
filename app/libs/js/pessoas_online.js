online = [{ 
	img : "img/usuarios/leandro.png",
	nome : "leandro",
	id : 69 },{
	img : "img/usuarios/tijolinha.jpg",
	nome : "Tijolinha de Paraiba",
	id : 24 },{
	img : "img/usuarios/tijolo.png",
	nome : "Tijolo Venancio",
	id : 13 }]
		
showOnlinePerson()
function showOnlinePerson(){
	online_bd = online //recebe a lista de pessoas do banco, para verificar se a que ter uma atualizacao
	if(online_bd == online){ //trocar por !=
		online = online_bd
		$(".pessoas_online").html('')
		$(".pessoas_online").append('<hr>')
		for(let i=0; i<online.length; i++){
			$(".pessoas_online").append(`
			<a class="nav-link float-left" data-toggle="modal" data-target="#perfilpessoa${i}" href="removeFADE()"><h4 class="float-left"> - ${online[i].nome} </h4></a>
			<span class="badge badge-success badge-pill float-right m-2">ONLINE</span>
			
			<hr>
						
			<div class="modal fade" id="perfilpessoa${i}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="right: auto;left: 0px;">
			  <div class="modal-dialog" role="document" style="width:650px;">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Perfil da Pessoa</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
						<div class="col-4">
							<img class="border-purple rounded" src="${online[i].img}" height="260px" width="220px">
						</div>
						<div class="col-8">
							<h2 class="p-text">${online[i].nome}</h2>
						</div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>
			`)
		}
	}
}