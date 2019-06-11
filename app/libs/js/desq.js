test = [{
			img: "img/salas/error.jpg",
			nome: "Error Data not Found",
			description: "Error my friend, this site is down, BREAKDOWN BREAKDOWN BREAKDOWN "
		},{
			img: "img/salas/animais.jpg",
			nome: "Mundo Animal",
			description: "Esse animal e um animal muito animal,  seja quando e um animal a propossito, ou seja, animal sendo um animal, eu quando ele vai ser animal na jaula de animal dos animais."
		}]

test2 = [{
			img: "img/salas/cachorro.gif",
			nome: "Error Data not Found",
			description: "Error my friend, this site is down, BREAKDOWN BREAKDOWN BREAKDOWN ",
			link: "/1"
		},{
			img: "img/salas/terror.gif",
			nome: "Mundo Animal",
			description: "Error my friend, this site is down, BREAKDOWN BREAKDOWN BREAKDOWN ",
			link: "/1"
		},{
			img: "img/salas/animais.jpg",
			nome: "Mundo Animal",
			description: "Error my friend, this site is down, BREAKDOWN BREAKDOWN BREAKDOWN ",
			link: "/1"
		},{
			img: "img/salas/animal.jpg",
			nome: "Mundo Animal",
			description: "Error my friend, this site is down, BREAKDOWN BREAKDOWN BREAKDOWN ",
			link: "/1"
		}]


function addDesqCat(objt){
	for(let i=0; i<objt.length; i++){
		let active = i == 0 ?  "active" : ""
		$(".carousel-inner").append(`
		<div class='carousel-item ${active}'>
			<div class="card border-purple w-100">
				<div class="w-100 top" style="background-image: url(' ${objt[i].img} ');"></div>
				<div class="line"></div>
				<div class="purple titleDesq">
				<h4> ${objt[i].nome} </h4>
				</div>
			</div>
				<div class="card-body">
				<p class="card-text">${objt[i].description}</p>
				</div>
			</div>
		</div> `)
	}
}

function addDest(obj){
	for(let i=0; i<obj.length; i++){
		$("#top-4").append(`
		<div class="col-sm-12 col-md-6">
			<a href="${obj[i].link}">
				<div class="p-1 m-1 rounded border-purple top" style="background-image: url('${obj[i].img}');">
					<div class="purple titleDesq titleDesq_m-0">
							<h4> ${obj[i].nome} </h4>
					</div>
				</div>
			</a>
		</div>
		`)
	}
}

addDest(test2)
addDesqCat(test)
