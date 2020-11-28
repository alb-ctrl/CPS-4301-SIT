//Variables

let nav = document.getElementById('nav');
let menu = document.getElementById('links');

function menus(){
	let Actual_Scroll = window.pageYOffset;
	
	if(Actual_Scroll <= 529){
		nav.classList.remove('nav2');
		nav.className = ('nav1');
		nav.style.transition = '1s';
	}else{
		nav.classList.remove('nav1');
		nav.className = ('nav2');
		nav.style.transition = '1s';
	}
	
	
}

window.addEventListener('scroll', function(){
	console.log(window.pageYOffset);
	menus();
});