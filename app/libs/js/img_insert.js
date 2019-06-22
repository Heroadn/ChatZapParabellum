function wayFile(IdForImg){
	$('#'+IdForImg).click()
}

function changeImg(IdForImg,IdForShow){
	console.log('ok')
	const input = document.getElementById(IdForImg);
	if(imgValid(input.value)){
		const fReader = new FileReader();
		fReader.readAsDataURL(input.files[0]);
		fReader.onloadend = function(event){
			const imgUser = document.getElementById(IdForShow);
			imgUser.src = event.target.result;
		}
	}
}

function imgValid(nameImg){

	let res = false
	const extensionsValid = [".jpg",".gif",".png",".jpeg"]
	for(let i = 0;  i < extensionsValid.length; i++){
		if(nameImg.toLowerCase().indexOf(extensionsValid[i]) > -1){
			res = true
		}
	}
	return res
}
