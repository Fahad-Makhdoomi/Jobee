# Jobee
A simple job posting application using PHP with an Admin Panel.  Register, Login and create the job in apnel. The job gets posted on index page.

Remember that the code will not work unless you make database tables as in the code. Edit the code to suit your databse or crate the follwing tables in yoyr datbase. Also be sure to check the conection.php and make necessary changes.

Datebase - Name 'test'
Database - Tables :

emplogin{
	s.no(primary)(a.i.) 	Email 	Password 	fName 	lName 	Phone
}
jobposts{
Full texts
	s.no(primary)(a.i.)  	JobDescreption 	JobTitle
}
//The product table was included in the second comit.
products{
	Full texts
	id(primary)(a.i.) 	productName 	productDescription 	productImage 	productPrice
}
