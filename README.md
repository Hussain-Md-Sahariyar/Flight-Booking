# Biman Bangladesh Airlines Flight Booking Management System

Software Requirements Specification (SRS)

1. Introduction

1.1 Purpose
This SRS outlines the Biman Bangladesh Airlines Flight Booking Management System, a web-based solution to provide an efficient and user-friendly flight booking platform for Biman Bangladesh Airlines. This system allows users to search, book, and manage their flights, view schedules, and contact support, while the admin panel ensures seamless management of bookings and flight details.

1.2 Intended Audience
•	Developers: To understand, build and implement the system’s functionality. 
•	Quality Assurance (QA) Team: To verify system functionality and performance. 
•	Project Managers: To oversee development and ensure alignment with goals. 
•	Stakeholders: To evaluate the project’s scope and execution.

1.3 Intended Use
•	Passengers can search for flights, book tickets, check schedules, and manage their profiles.
•	Administrators can manage flights, bookings, users, and system settings.

1.4 Product Scope
The Biman Bangladesh Airlines Flight Booking Management System is a web-based platform that simplifies the flight booking process. It allows passengers to:
•	Book domestic & international flights.
•	View & manage their reservations.
•	Check real-time flight schedules.
•	Contact the airline for assistance.
•	Access policies, terms, and conditions.
The admin panel enables airline personnel to manage:
•	Flights & schedules.
•	Passenger details & bookings.
•	User accounts.

1.5 Risk Definitions
Potential risks in the system:
•	Data Breach: Unauthorized access to passenger and booking details.
•	Payment Failure: Issues in processing online payments.
•	System Downtime: Server unavailability causing booking disruptions.
•	Incorrect Flight Data: Mismatched or outdated flight schedules.





2. Overall Description

2.1 User Classes and Characteristics
User Type	Description
Passengers	Can search flights, book tickets, view schedules, manage bookings, and check airline policies.
Registered Users	Can create an account, save travel details, manage bookings, and check travel history.
Admin Staff	Can manage flights, bookings, and user accounts, and generate reports.

2.2 User Needs
User Type	Description
Passengers	Easy flight search, secure booking, ticket details and real-time updates.
Registered Users	Secure login, saved & check travel history, manage bookings.
Admin Staff	Dashboard to manage flights, users, and bookings efficiently.

2.3 Operating Environment
•	Frontend: HTML, CSS, JavaScript. 
•	Backend: PHP and MySQL. 

2.4 Assumptions
•	Users have basic internet and device literacy. 
•	The system will handle hundreds of concurrent users efficiently.
•	Flight schedules will be updated regularly by the admin. 

3. Requirements

3.1 Functional Requirements

User Story-1: Flight Search

As a passenger, I want to search for available flights by entering my travel details, so that I can choose the best option for my journey.

Confirmation:
•	Success – Available flights displayed with details:
	Flight number, departure & arrival times, price, seat availability, and class options.
•	Failure – Error messages displayed:
	“No flights available for the selected date and route.”

User Story-2: Flight Booking

As a passenger, I want to book a flight by selecting an available option and entering my details, so that I can reserve my seat.

Confirmation:
•	Success – Flight booked successfully:
	Display “Booking successful!”
	Save booking details in the user’s profile.
•	Failure – Error messages displayed:
	“Payment failed, please try again.”
	“Selected seat no longer available.”
	“Incomplete passenger details. Please fill in all required fields.”

User Story-3: Booking Status Track

As a passenger, I want to check my booking details, so that I can confirm my flight information.

Confirmation:
•	Success – Booking details displayed:
	Flight number, departure time, seat number, and payment status.
•	Failure – Error messages displayed:
	“Invalid booking reference number.”
	“No booking found for the entered details.”

User Story 4: Flight Schedule

As a passenger, I want to check the flight schedule, so that I can plan my travel accordingly.

Confirmation:
•	Success – Display available flights for the selected date and route.
•	Failure – Error messages displayed:
	“No scheduled flights available.”
	“Invalid date selection.”

User Story-5: Contact Customer Support

As a passenger, I want to contact customer support, so that I can get assistance with my booking or other issues.

Confirmation:
•	Success – Message sent to support with confirmation email.
•	Failure – Error messages displayed:
	“Invalid email format.”
	“Message field cannot be empty.”

User Story-6: User Profile Management

As a passenger, I want to manage my personal details and travel history, so that I can book flights faster in the future.

Confirmation:
•	Success – Profile updated successfully.
•	Failure – Error messages displayed:
	“Password does not meet security requirements.”

User Story-7: Admin – Manage Flights

As an admin, I want to add, update, and remove flight details, so that I can manage the airline’s schedule efficiently.

Confirmation:
•	Success – Flight details updated successfully.
•	Failure – Error messages displayed:
	“Flight already exists.”
	“Invalid departure time format.”

User Story-8: Admin – Manage Bookings

As an admin, I want to view and update passenger bookings, so that I can assist with modifications or cancellations.

Confirmation:
•	Success – Booking updated or canceled successfully.
•	Failure – Error messages displayed:
	“Booking not found.”
	“Modification not allowed for past flights.”

3.2 Non-Functional Requirements

Performance
•	The system should handle at least 500 simultaneous users without performance drops.
•	Search results should be displayed within 3 seconds.
Safety
•	Ensures accurate flight data to prevent booking errors. 
•	Logs admin actions for accountability.
Security
•	Encrypts passenger data. 
•	Requires strong passwords and admin authentication.
Quality
•	Responsive design works seamlessly across devices. 
•	User interface is intuitive with minimal learning curve.





Meeting Minutes-1
=================

Date/Location: 27-Feb-2025, Discord (Online)
Attendees: 
Sahariyar (SA)
Abyad (AB)
Latifa (LA)
Nuzhat (NU)
Start Time: 11:04 PM
End Time: 00:53 AM

Decisions
=========

* The functional requirements will be written in User Story format with confirmation steps.
* The SRS must be finalized and reviewed by all of us by February 28, 2025, to meet the project milestone.
* Trello will be used for task management.
* GitHub will be used for version control.
* Discord will be used for team communication and discussions.

Actions
=======

Action	Allocated team member(s)	Deadline
Draft the Introduction section (Purpose, Audience, Scope)	AB, NU	28/02/2025
Draft the Overall Description section	SA, LA	28/02/2025
Draft Functional Requirements (User Stories & Confirmation)	SA, NU	28/02/2025
Draft Non-Functional Requirements	NU	28/02/2025
Review and provide feedback on SRS draft	AB, LA	28/02/2025
Proofread and finalize SRS document with revisions	SA, AB, LA, NU	28/02/2025
Set up Discord for overall project discussion	SA	01/03/2025
Create Trello board for task tracking	AB	02/03/2025
Set up GitHub repository and share access	LA	03/03/2025
