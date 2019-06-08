// JavaScript file to perform Administrator actions on Applications.

function confirmdeletion(event){
	if(confirm("Are you sure you want to delete this Application?")){
		let permitid = event.target.parentElement.parentElement;
		console.log(permitid);
		window.open(`deleteapplication.php?pno=${permitid}`,'_blank');
	}

	return;
}

function confirmDateRemoval(event){
	if(confirm("Are you sure tou want to delete this opening and all applications associated with it?")){
		let date = event.target;

		console.log(date);
	}
}