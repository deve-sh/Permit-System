function openNav() {
	if(screen.width > 600){
		document.getElementById("sidenav").style.width = "220px";
		
		if(document.getElementsByClassName('main').length > 0)
	    	document.getElementsByClassName("main")[0].style.marginRight = "220px";
	}
	else{
		document.getElementById("sidenav").style.width = "100%";
	}
}

function closeNav() {
  document.getElementById("sidenav").style.width = "0";

  if(document.getElementsByClassName('main').length > 0)
  	document.getElementsByClassName("main")[0].style.marginRight = "0";
}