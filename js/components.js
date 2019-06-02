/*
 * JavaScript file to house the components required for rendering pages.
*/

// Button Component

const Button = (props) => <button type={props.type} className={props.className}>{props.label}</button>;

Button.defaultProps = {
	className : 'btn',
	type : 'submit',
	label : 'Submit'
}

// Input field component

const Input = (props) => <input type={props.type} name={props.name} className={props.className} placeholder={props.placeholder} id={props.id} required/>

Input.defaultProps = {
	type : 'text',
	className : 'form-control',
	placeholder : '',
	id : '',
	name: ''
}

// Non - Required Input field Component

const NonReqInput = (props) => <input type={props.type} name={props.name} className={props.className} placeholder={props.placeholder} id={props.id}/>

Input.defaultProps = {
	type : 'text',
	className : 'form-control',
	placeholder : '',
	id : '',
	name : ''
}

// Link component 

const Link = (props) => <a href={props.target} className={props.className}>{props.children}</a>;

Link.defaultProps = {
	target : '',
	className: '',
	label : ''
}

// Header Component

const Header = (props) => {
	return (
		<div className='header row'>
			<div className='col col-sm-6'><span className='heading'>{props.appName}</span></div>
			<div className='col col-sm-6'>
				{
				/* Links 
					Modify this in order to change the links in the webpage.
				*/
				}
				<Link target={'./apply.php'} className='headerlink'>{'Apply'}</Link>
				<Link target={'./admin'} className='headerlink'>{'Admin'}</Link>
			</div>
		</div>
	);
}

// Form Component
// It is a component as it will be used multiple times around the app.

class Form extends React.Component{
	constructor(props){
		super(props);
	}

	render(){
		return(
			<form id={this.props.id} className={this.props.className} action = {this.props.action} method={this.props.method}>
				{/* Action and Method as its a PHP App and onSubmit works only for JS. */}
				{this.props.children}
				{/* Render the Children passed from the parent component. */}
			</form>
		);
	}
}

Form.defaultProps = {
	id: '',
	className : 'form',
	action : '',
	method : 'POST',
	children : <Input/>
}

// Heading Component

const Heading = (props) => <div className = 'heading'>{props.label}</div>;

Heading.defaultProps = {
	label: ''
}

// Index Page Component

class IndexPage extends React.Component{
	constructor(props){
		super(props);
	}

	render(){
		return (
			<div className={'indexpage'}>
				{this.props.children}
			</div>
		);
	}
}

// Icon Component

const Icon = (props) => <i className={props.className} title={props.title}></i>

Icon.defaultProps = {
	className: '',
	title : 'Icon'
}

// Footer Component

const Footer = (props) => <footer className='row'>{props.children}</footer>