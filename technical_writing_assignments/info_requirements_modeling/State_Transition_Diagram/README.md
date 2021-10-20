### II. Create a State Transition Diagram
Draw a State Transition Diagram (STD) for the RESERVATION entity based on the following scenario:

Once the front desk worker creates reservation for item(s) based on a customer's request, the
reservation is considered confirmed. Anytime up to 24 hours prior to the start time of a confirmed
reservation, a customer may cancel. A reservation, even if cancelled, is never deleted from the system. However knowing a reservation ended by being cancelled is helpful to the ISD employees.

Each night after hours the IDSS will set any confirmed reservations for the following day to awaiting
assignment. When Shelly arrives in the morning, before the office opens, she will pull up the
reservations that are awaiting assignment and schedule each to one of the equipment transporters.
Once an equipment transporter has been assigned to a reservation it is now considered assigned.

Each equipment transporter will be able to use IDSS from their smart phone to see what reservations
s/he has been assigned to for the day. Prior to the execution of a reservation, the equipment
transporter will pull the requested items from inventory and put in a holding area for later transport to the reservation location. Once the items are in the holding area, the equipment transporter set the status of the reservation to prepped.

When it is 30 minutes prior to the setup time of the reservation, the IDSS will send a message to the
equipment transporter's smart phone that a delivery needs to be made for a reservation. The IDSS will
change the status of the reservation to waiting for delivery.

When the equipment transporter retrieves the items from the holding area, s/he will set the reservation status to transporting. When the equipment transporter arrives to the location with the items, s/he will change the status to delivered.

In order to proceed further, the IDSS will present a liability agreement for the customer to sign via the transporter's smart phone. The IDSS will capture the signed form and store a picture of it as part of the reservation. If the customer refuses to sign the liability agreement, then the equipment transporter will set the status of the reservation to declined and return the items to the ISD. Otherwise, after the customer signs the liability form, the reservation will be considered in-progress.

Fifteen minutes prior to the end time of the reservation, IDSS will send a message to the assigned
equipment transporter's smart phone indicating that the reservation is awaiting pick-up. Once the
equipment transporter arrives at the reservation location, packs up the equipment and is ready to
return to the ISD, s/he will change the status to returning.

When the items are returned back to their respective storage location, the equipment transporter will
change the status of the reservation to complete.