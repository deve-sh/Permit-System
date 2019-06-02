/*
	JavaScript File for rendering the index page of the web app. Written in JSX.
*/

class Index extends React.Component{
	constructor(props){
		super(props);

		this.state = {
			appname : 'Permit System'
		}
	}

	render(){
		return (
			<React.Fragment>
				<Header appName = {this.props.appName}/>
				<IndexPage>
					<Heading label={this.props.label}/>
					<br/>
					<div className='indexbuttons'>
						<Link target={'apply.php'} className='indexlink'><Button type='' className='btn applybutton' label='Apply'/></Link>
						<Link target={'about.php'} className='indexlink'><Button type='' className='btn aboutbutton' label='About'/></Link>
						<Link target={'./admin'} className='indexlink'><Button type='' className='btn adminbutton' label='Admin'/></Link>
						<Link target={'./viewstatus.php'} className='indexlink'><Button type='' className='btn statusbutton' label='View Status'/></Link>
					</div>
				</IndexPage>
				<Footer>
					{/* Footer */}
					<div className='col col-sm-6'>
						&copy; Someone
					</div>
					<div className='col col-sm-6'>
						<Link className='socialicon' target={'https://facebook.com'}><Icon className={'fab fa-facebook-square fa-lg'} title={'Facebook'}/></Link>
						<Link className='socialicon' target={'https://instagram.com'}><Icon className={'fab fa-instagram fa-lg'} title={'Facebook'}/></Link>
					</div>
				</Footer>
			</React.Fragment>
		);
	}
}