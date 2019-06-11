const boxChat = document.getElementById("boxChat")
const test = [
	{name: "Leandro", text: "olá, tudo bem?"},
	{name: "Leandro", text: "oooiiiii!"},
	{name: "Leandro", text: "oooiiiii!"},
]

function testar(){
	for(let i = 0; i<test.length; i++){
		createballon("Leandro", test[i].text)
	}
	createballon("me", test[2].text)
}
testar()

function addNewMsg(){
	if($("#mensgtextarea").val() != ""){
		
	}
	createballon("me", $("#mensgtextarea").val())
	$("#mensgtextarea").val("")
}

function createballon(typePessoa, msn){
	const html = document.createElement('div')
	const content = `<p class="name">${typePessoa}</p><p class="text">${msn}</p>`;

	html.className = `ballon ${typePessoa} ${typePessoa}-${rand()}`
	html.innerHTML = content
	
	boxChat.appendChild(html)
}
function rand(){
	return Math.ceil(Math.random() * 3)
}