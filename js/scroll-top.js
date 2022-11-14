document.addEventListener("DOMContentLoaded", function(event) { 

	const button = document.querySelector('#scroll-top');

	button.addEventListener('click', function(){
		window.scrollTo(0, 0);
	});

	window.addEventListener('scroll', function(){
		if(window.scrollY == 0){
			button.style.opacity = "0";
		} else {
			button.style.opacity = "1";
		}
	});
  
});