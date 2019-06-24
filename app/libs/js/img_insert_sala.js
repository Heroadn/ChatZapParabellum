function wayFile(){
	$('#foto_new').click()
}

function changeImg(){
	const input = document.getElementById("foto_new");
	if(imgValid(input.value)){
		const fReader = new FileReader();
		fReader.readAsDataURL(input.files[0]);
		fReader.onloadend = function(event){
			const imgUser = document.getElementById("img_criar_sala");
			imgUser.src = event.target.result;
		}
	}
}

function imgValid(nameImg){
	
	let res = false 
	const extensionsValid = [".jpg",".gif",".png",".bitmap",".svg",".raw",".webp",".exif",".tiff"]
	for(let i = 0;  i < extensionsValid.length; i++){
		if(nameImg.indexOf(extensionsValid[i]) > -1){
			res = true
		} 
	}
	return res
}