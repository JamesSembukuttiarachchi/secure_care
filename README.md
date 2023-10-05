# Secure Care - Health Insurance Platform

## Introduction
Secure Care is a web-based Health Insurance Platform developed as a group project for the Internet and Web Technologies (IWT) module during Year 1 Semester 2. The goal of this project is to provide a centralized platform where insurance companies, pharmacies, and hospitals can collaborate to advertise and offer their services.

## Features
Secure Care offers the following features:

1. **Service Listings**: Insurance companies, pharmacies, and hospitals can list their services and offerings on the platform.

2. **Up-to-Date Information**: Customers (referred to as patients) can access current information on medical facilities, their services, and pricing.

3. **Insurance Plans**: Patients can explore and compare various insurance plans provided by different agencies.

## Installation

### Prerequisites
- XAMPP
- Web browser (e.g., Chrome, Firefox)

### Steps

1. Install XAMPP:
Download and install XAMPP from the official website (https://www.apachefriends.org/index.html).
Follow the installation wizard and choose the components you need (Apache, MySQL, PHP, and phpMyAdmin).

2. Start XAMPP:
Launch XAMPP after installation.
Start the Apache and MySQL services by clicking the "Start" button next to their respective names.

3. Database Setup:
Open a web browser and go to http://localhost/phpmyadmin to access phpMyAdmin.
Create a new database named 'group project' for your project.
Default username, password and servername are used.

5. Clone the Project:
If you haven't already, clone your Secure Care project repository into the XAMPP's web server directory. The default directory is C:\xampp\htdocs\ on Windows.

6. Database Configuration:
Run XAMPP and start both Apache and MySQL.
Refer to the queries.txt file inside src folder to get the relevant pre-requisite database configurattions.
Go to localhost/phpmyadmin and navigate inside your database, then paste the queries.txt file in the sql tab and run the queries.

8. Access the Application:
Open your web browser and go to http://localhost/your-project-directory to access your Secure Care Health Insurance Platform. Replace your-project-directory with the actual name of your project's directory.
Note that this path only works for the default directory and you should change your url accordingly if you have a custom location set in XAMPP.

## Usage
- As an **Insurance Company**, you can register and list your insurance plans.
- As a **Pharmacy or Hospital**, you can register and list your services and pricing.
- As a **Patient**, you can browse services, view pricing, and compare insurance plans.

## Technologies Used
- MySQL
- HTML, CSS, JavaScript
- Bootstrap

## Contributors
- [Silverviles](https://github.com/Silverviles)
- [W.S.M. Fonseka]()
- [J.S. Sembukuttiarachchi](https://github.com/JamesSembukuttiarachchi)
- [K.G.D. Kavinda](https://github.com/kavindakgd)
- [R.T. Marambe]()

## License
This project is licensed under the [MIT License](LICENSE).

## Acknowledgments
We would like to thank our instructors and classmates for their support and guidance throughout the development of Secure Care.

## Contact
If you have any questions or feedback, please feel free to contact us at [kavindakgd@gmail.com](mailto:kavindakgd@gmail.com).

---
**Note:** This README.md provides an overview of the Secure Care project. For detailed instructions and information, please refer to the project's source code.
