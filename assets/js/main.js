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

document.onkeydown = function(e) {
  if(event.keyCode == 123) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
     return false;
  }
}