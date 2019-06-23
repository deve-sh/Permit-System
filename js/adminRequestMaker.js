/*
	JavaScript file to make a request to the Admin API and display all of that.

	This file is probably invulnerable since the API only returns details if the admin is authenticated.
	However, if you find any flaw in it. Please feel free to open an issue in the Public Repo.
*/

function setDate(event){
	// Date Setter function.
	// Takes date from the DOM and passes it to the requestMaker function to render the applications on that date.

	// Prevent Screen Refresh.

	event.preventDefault();

	let dateNode = document.getElementById('date');

	if(dateNode){
		let date = dateNode.value;	// Get the date.

		requestMaker(event, date, 1);
	}
	else{
		return;
	}
}

function requestMaker(event, date = '', page = 1){
	// The main function that will make the request to the API.

	let applicationsNode = document.getElementById('applications');

	if(applicationsNode){
		
		if(!date){

			// If no date has been passed, make a direct request without a date.

			let xhr = new XMLHttpRequest();	// XHR Variable.

			xhr.open('GET','./api.php?page='+encodeURIComponent(page),true);

			xhr.onload = function(){
				let json = JSON.parse(xhr.responseText);

				if(json.status !== 200){
					// Error

					applicationsNode.innerHTML = `<br/><div class='alert alert-danger' align='center'>${(json.status===500)?"Internal Server Error.":"An Unknown Error Occured."}</div><br/>`;
				}
				else{
					if(json.numlogs === 0){
						applicationsNode.innerHTML = `<br/><div class='alert alert-info' align='center'>No applications found.</div><br/>`;
					}
					else{
						// Print the details to the webpage application by application.

						let html = '';

						for(let application in json.applications){
							html += 
							`<br/><div class='application' permitid='${json.applications[application]['permit_id']}'>
								<div class='row'>
									<div class='col-sm-4'>
										<strong>${json.applications[application]['vehicle_no']}</strong>
										<br/>
										${json.applications[application]['pdate']}
									</div>
									<div class='col-sm-4'>
										${json.applications[application]['applicant_name']}
										<br/>
										${json.applications[application]['applicant_email']}
									</div>
									<div class='col-sm-4 options'>
										`;

							// Conditional rendering now.

							if(json.applications[application]['approved'] === 0){
								// Not Approved yet.

								html += `<a title='Approve Application' onclick='window.location.reload()' href='./approveappl.php?pno=${json.applications[application]['permit_id']}' target ='_blank'><span class='btn btn-success'>Approve</span></a>`;
							}
							else{
								if(json.applications[application]['visited'] === 0){
									html += `<a onclick='window.location.reload()' title='Mark Visited' href='./markvisited.php?pno=${json.applications[application]['permit_id']}' target = '_blank'><span class='btn btn-info'>Mark Visited</span></a>`;
								}
							}

							html += `&nbsp;&nbsp;<a title = 'Delete Application' href='./deleteapplication.php?pno=${json.applications[application]['permit_id']}' target='_blank'><span class='btn btn-danger'><i class="fas fa-trash"></i></span></a>`;

							html +=	`
									</div>
								</div>
							</div>`;
						}

						// Adding buttons.

						html += `<br/><div class='paginator' align='center'>`;
						
						if(json.previous === true)
							html += `<span onclick="requestMaker(event,'${date}',${page - 1})" class='prevpage'><i class="fas fa-arrow-circle-left fa-lg"></i></span> &nbsp;&nbsp;`;

						if(json.next === true)
							html += `<span onclick="requestMaker(event,'${date}',${page + 1})" class='nextpage'><i class="fas fa-arrow-circle-right fa-lg"></i></span>`;

						html += `</div>`;

						applicationsNode.innerHTML = html;
					}
				}
			}

			xhr.send();
		}
		else{
			// If date is passed.

			let xhr = new XMLHttpRequest();	// XHR Variable.

			xhr.open('GET',`./api.php?date=${encodeURIComponent(date)}&page=${encodeURIComponent(page)}`,true);

			xhr.onload = function(){
				let json = JSON.parse(xhr.responseText);

				if(json.status !== 200){
					// Error

					applicationsNode.innerHTML = `<br/><div class='alert alert-danger' align='center'>${(json.status===500)?"Internal Server Error.":"An Unknown Error Occured."}</div><br/>`;
				}
				else{
					if(json.numlogs === 0){
						applicationsNode.innerHTML = `<br/><div class='alert alert-info' align='center'>No applications found on this date.</div><br/>`;
					}
					else{
						// Print the details to the webpage application by application.

						let html = '<br/><div class="btn proceed btn-info" onclick="reset()">Reset</div><br/><br/>';

						for(let application in json.applications){
							html += 
							`<br/><div class='application' permitid='${json.applications[application]['permit_id']}'>
								<div class='row'>
									<div class='col-sm-4'>
										<strong>${json.applications[application]['vehicle_no']}</strong>
										<br/>
										${json.applications[application]['pdate']}
									</div>
									<div class='col-sm-4'>
										${json.applications[application]['applicant_name']}
										<br/>
										${json.applications[application]['applicant_email']}
									</div>
									<div class='col-sm-4 options'>
										`;

							// Conditional rendering now.

							if(json.applications[application]['approved'] === 0){
								// Not Approved yet.

								html += `<a target='Approve Application' href='./approveappl.php?pno=${json.applications[application]['permit_id']}' target ='_blank'><span class='btn btn-success'>Approve</span></a>`;
							}
							else{
								if(json.applications[application]['visited'] === 0){
									html += `<a href='./markvisited.php?pno=${json.applications[application]['permit_id']}' target = '_blank'><span class='btn btn-info'>Mark Visited</span></a>`;
								}
							}

							html += `&nbsp;&nbsp;<a onclick='confirmdeletion(event)'><span class='btn btn-danger'><i class="fas fa-trash"></i></span></a>`;

							html +=	`
									</div>
								</div>
							</div>`;
						}

						// Adding buttons.

						html += `<br/><div class='paginator' align='center'>`;
						
						if(json.previous === true)
							html += `<span onclick="requestMaker(event,'${date}',${page - 1})" class='prevpage'><i class="fas fa-arrow-circle-left fa-lg"></i></span> &nbsp;&nbsp;`;

						if(json.next === true)
							html += `<span onclick="requestMaker(event,'${date}',${page + 1})" class='nextpage'><i class="fas fa-arrow-circle-right fa-lg"></i></span>`;

						html += `</div>`;

						applicationsNode.innerHTML = html;
					}
				}
			}

			xhr.send();
		}
	}
}

window.addEventListener('load', requestMaker);

function reset(){
	// Remove the date and reset to all applications.

	document.getElementById('date').value = '';
	requestMaker();
}