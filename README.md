# <div align='center'>Permit System</div>

A Permit System Web Application written in PHP, SQL and JavaScript. Based primarily on the Permit Application System of Rohtang Pass, Manali. Where visitors apply for permits and visit the location if approved.

### Working

The Web Application's basic working / process is as follows : 

- The Admin Creates an Opening (A Date for which permits to a specific place are available).
- The User applies for a permit on an available opening (That was created by the admin in Step 1).
- The Admin approves the application.
- The User checks the status and if approved, visits the place. The Admin Requests for the ID of the user and if verified, marks the user having visited the place.


### Pre - Requisites

- A Web Server that can run PHP.
- MySQL Improved Database.
- PHP 7+.
- Basic Knowledge of PHP, JS and CSS (For development or editing of the project).

## Installation and Usage

To install the script, download the zip of the repo or clone the repo to your web server.

```bash
git clone https://github.com/deve-sh/Permit-System.git
cd Permit-System
```
Then navigate to the directory in your web browser using the web server. The Script shall automatically open the /install route. Enter all the necessary details and the script shall install itself.

After the installtion, navigate to the main directory. Then use the app as normal.

To view the Admin Dashboard. Just navigate to  the **/admin** folder.

## Project Structure

```
Permit-System
├── .gitignore
├── README.md
├── about.php
├── index.php
├── ...
├── admin
│   ├── addadmin.php
│   ├── adddate.php
│   ├── index.php
│   ├── ...
├── files
│   ├── contact_us.png
│   ├── index.html
│   └── ...
├── install
│   ├── index.php
│   └── installer.php
├── inc
│   ├── index.php
│   ├── adminstyles.html
│   └── ...
├── js
│   ├── index.html
│   ├── adminOpenings.js
│   └── ...
└── styles
    └── styles.css
```

As the above structure specifies. 

- The **/admin** folder contains the admin dashboard.

- The **/files** folder contains all non-processing files required for the Application.

- The **/inc** folder contains the most necessary files and libraries for the Application.
	- The file <u>config.php</u> is the backbone of the project past installtion, do not delete it in any case.
	- The file <u>connect.php</u> is no less important, it contains the database driver necessary for the application to function.
	- The styles and necessary components for the aesthetic part of the application are included in the <u>styles.html</u> and <u>adminstyles.html</u> (For the admin dashboard).

- The **/install** folder contains the installation files.

- The **/js** folder contains the JavaScript files required for the Application.

- The **/styles** folder contains the Stylesheet for the Application (styles.css).
	- <u>**Note**</u> that the Stylesheet contains many components that are common between many elements but aren't noticeable on first look. However, slight documentation has been included to reduce the confusion in case you are looking to make changes in the styles.

- In the main directory : 
	- The **about.php** file houses info about the organisation. 
	- The **contact.php** file houses the Contact Info. 
	- These files are easy to edit and pose no problem to the application even if something goes wrong.

## Contributing and Notes

To Contribute to the project, just change any aspect of the project you deem necessary and open a pull request to the Repo.

**Note** : Before proceeding to changing the source code of the project, make sure you have enough knowledge of PHP and PHP's integration with HTML, or else you could mess a lot of things up.

Its useful to take a look at the Notes below before proceeding to development : 

#### Turning Error Reporting Off

Error Reporting is turned off by default. To enable it go to `inc/config.php` and `admin/config.php` and remove the following line.

```php
error_reporting(0);
```

#### Integrating a payments processor

If you want your applicants to make a payment. Include the PHP payment scripts (Example : PayU Money, UPI) to the `finalizeappl.php` file.

```php
// -----------------------------------
// Add your Payment Integration here.
// -----------------------------------

// Variables

$date = $db->escape($_POST['entereddate']);
$vehiclenumber = $db->escape($_POST['vehiclenumber']);
$applicant_name = $db->escape($_POST['applicantname']);
$applicant_email = $db->escape($_POST['applicantemail']);
$applicant_phone = $db->escape($_POST['applicantphone']);

```

You could even create a seperate payments processing page, and redirect the application form to that page. Have a look at the `apply.php` page : 

```html
<form action="finalizeappl.php" class="furtherdetails" method="POST">
```

Change the above to :

```html
<form action="<Your Payments Processing Page>" class='furtherdetails' methor="POST">
```

And process the data from the form and the payments accordingly.

* More notes will be added in the future.
* I am currently working on the pagination in case of large number of applications. So until then, if you have an idea for it. Do let me know. 😁

## Open Source Licenses Used

Open Source projects used in the Web Application include :

- [Twitter Bootstrap](https://getbootstrap.com)
- [Font Awesome](https://fontawesome.com)

## License

The Project comes under the MIT License. Have a look at the LICENSE File of the project to view the implications and instructions on sharing and reproduction.

## Contact and Issues

For any issue that might arise during the usage or development of the project, just raise an issue in the Repo or [Contact Me](mailto:devesh2027@gmail.com).
