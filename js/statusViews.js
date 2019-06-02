// JS File in React to crate views for viewstatus.php

class ViewStatus extends React.Component{
	constructor(props){
		super(props);
	}

	render(){
		return (
			<React.Fragment>
				<Header appName={this.props.appName}/>
				<Heading label={"View Permit Status"}/>
				<Form className={"viewform"} action={""} id={"viewform"} method={"POST"}>
					{/* Putting children inside the Form */}

					<Input type={"text"} name={"permitid"} placeholder={"Permit ID"} className={"form-control"} id={""}/>
					<br/>
					<Input type={"date"} name={"permitdate"} placeholder={"Date"} className={"form-control"} id={""}/>
					<br/>
					<Button type={"submit"} className={"btn btn-primary submitbutton"} label={"Check"}/>
				</Form>
			</React.Fragment>
		);
	}
}