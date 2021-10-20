### I. Create an Entity-Relationship Diagram and Data Dictionary
Create an entity relationship diagram ERD based upon the <u>scenario</u> provided below. Normalize your model to third normal form and include all entity definitions in genus/differentia format, attributes need NOT be defined at this time. Further, you are not required to resolve (forward engineer) M:N relationships. Indicate the identifier (primary key) for entities strong entities and weak entities, where appropriate; indicate participation and cardinality in all relationships; include relationship names. It is not required that you include foreign key attributes, but you may if you wish to.
<br/>
<b>Background Information</b>
The Instructional Support Department (ISD) at MYSU is responsible for maintaining instructional
equipment that MYSU faculty and staff can reserve, have delivered and set up for them, picked up and
returned for them. However, it is important to know that when the instructional equipment is in
possession of the respective faculty or staff member, that s/he is responsible for any damages to the
equipment. The employees within the ISD pride themselves on ensuring that anyone requesting
instructional equipment is to get the proper equipment, set up at the right time and taken down at the right time.

Currently, there are redundant systems: a manual, paper-based system revolving around a job ticket
and K-net, a web-based system that is not user friendly or reliable. Ideally, the employees of the ISD would like an online Instructional Delivery Support System (IDSS) that would allow them to do their jobs more efficiently by electronically storing relevant data more consistently. Below is a narrative describing their needs and usage of the proposed IDSS.
<br/>
<b>Scenario</b>
There is some data that ISD would like to track on a MYSU person. A MYSU person is someone that is
involved with MYSU, that for the ISD's interests must either be an ISD employee or a customer, but
can't be both. For a MYSU person, the ISD would like to maintain data on the person's universityID (a
unique number issued by MYSU to each member of it's community), name (including first name and
last name), and MYSU username. It is important for employees of the ISD to be able see the status of a MYSU person as being either an ISD employee or a customer.

An ISD employee is a MYSU person that works within the ISD. Each employee will have a title, which
indicates the job function performed within the department, and a cell phone number. Among the 25
ISD employees, there are a group of approximately three front desk workers. A front desk worker is an
ISD employee that creates reservations based on a request from a customer. A reservation is created by one, and only one, front desk worker. A front desk worker may not create any reservations or could
create many reservations.

There are also three equipment transporters. An equipment transporter is an ISD employee that
executes reservations. The execution of a reservation involves gathering the reserved items,
transporting them to the proper location where they are needed, setting up the items, obtaining a
signature of the responsible customer on a liability form (which will ultimately be stored as a picture within the respective reservation), transporting the equipment back to the ISD, and putting the items back in the proper storage location. A reservation isn't assigned an equipment transporter until the day before the date of the reservation. A reservation may have at most one equipment transporter. An equipment transporter may not have executed any reservations or may have executed many different reservations.

A customer is a MYSU person that has attempted to reserve equipment through the ISD. It is important
for the IDSS to maintain the office phone number for each customer, so that if an issue arises the
customer can be contacted.

When someone comes to the ISD or calls to make a reservation a front desk worker will assist them.
The front desk worker will determine the instructional equipment needs of the individual and see if the item(s) are available for the date and time needed within the IDSS. If the item(s) are not available when needed, then no changes will be made to the IDSS.

If the item(s) are available at the requested date and time, the front desk worker will check the IDSS to see if the person exists in the IDSS system as a customer. If not, the front desk worker will ask the person for his/her university ID number. The front desk worker will check MYSU's central information system to verify that the person is either part of MYSU's faculty or staff (only faculty and staff of MYSU can reserve equipment). If the person is not part of MYSU's faculty or staff, then the front desk worker informs the individual that reservations can only be made for faculty and staff members of MYSU. No changes are made to IDSS. If the person is verified to be a member of MYSU's faculty or staff, then the front desk worker will ask the person for his/her first name, last name, MYSU username, and office phone number and enter the data into the IDSS so that a reservation can be created.

A customer must request one reservation, but could request many different reservations. A reservation
must be requested by one, and only one, customer. A reservation is a booking of one or more ISD items
that is made by a customer in advance of a requested date, for a specified span of time at a specified location. A reservation will include a unique reservationID (randomly generated by IDSS), the date the equipment is to be used, a setup time, a start time, a location, an end time, and a note for special instructions.

A reservation must include an item, but could include more than one item. An item doesn't have to be
included in any reservations, but could be included in many different reservations.

A reservation must have one, and only one, event type. An event type consists of the type of event
(examples include actual class, class-related, or MYSU student activity), which is unique, and a
description that further explains the specific type of event (example: an actual class event must take place during a scheduled meeting time and in the scheduled location for the class). An event type may not be used for any reservations, but could be used for many reservations. Special events that require a fee and a journal entry are outside the scope of this system.

An item will consist of a MYSU inventory ID (a unique number attached to each item that is maintained
by the ISD), the manufacturer, model, serial number (a unique number that is given by a manufacturer
to each item created), date purchased, location of where the item is stored, and a note.

An item must be classified as one, and only one, item type. An item type may not classify any items, but could be used to classify many items. An item type is a designation that represents the category of a specific item. An item type consists of a type (a unique item classification) and a description. A few examples of a type are projector, microphone, or document camera.