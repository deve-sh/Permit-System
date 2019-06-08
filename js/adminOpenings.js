// JavaScript file to run an XML HTTP Request to the Admin API and render the dates obtained from it.

function renderDates(){
	let xhr = new XMLHttpRequest();
	let datesNode = document.getElementById('dates');

	if(datesNode){
		xhr.open('GET','./dateapi.php',true);

		xhr.onload = function(){
			let json = JSON.parse(xhr.responseText);

			console.log(json);

			if(json.status !== 200){
				datesNode.innerHTML = `<br/><div class='alert alert-danger'>Error ${json.status} : Could not fetch dates.</div>`;
			}
			else{
				if(json.numrows === 0){
					datesNode.innerHTML = `<br/><div class='alert alert-info'>No Openings from now.</div>`;
				}
				else{
					html = ``;

					for(date in json.dates){
						html += `<br/><div class='date' pdate='${json.dates[date]['pdate']}'>
								<div class='row'>
									<div class='col-sm-6'>
										Date : <strong>${json.dates[date]['pdate']}</strong>
										<br/>
										Number of Permits : ${json.dates[date]['npermits']}
									</div>
									<div class='col-sm-6 options'>
										<a target='_blank' href='./removedate.php?date=${json.dates[date]['pdate']}'><span class='btn btn-danger'><i class="fas fa-trash"></i></span></a>
									</div>
								</div>
							</div>`;
					}

					datesNode.innerHTML = html;
				}
			}
		}

		xhr.send();
	}
}