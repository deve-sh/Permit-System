// JavaScript file to perform Administrator actions on Applications.

function confirmdeletion(event){
	if(confirm("Are you sure you want to delete this Application?")){
		let permitid = event.target.parentElement.parentElement.parentElement.parentElement.getAttribute('permitid');
		window.open(`deleteapplication.php?pno=${permitid}`,'_blank');
	}

	return;
}