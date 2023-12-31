Use Case Document
- Introduction to the Restaurant
    - Italian Restaurant

Reservation System
- Be able to secure a seat/table in the restaurant
    - Reservation:
    Prereq: None
    Steps: 
        - Have a reservation page that allows pickable options of date, time, and party size
        - Once inputted, check against database to see if there are available tables with the inputted requirements

    Alternate Step: 
        - No more tables -- ??
        - Closed -- ??
        - If the group size is larger than the table size -- ??

    Post Conditions: 
        - Send an email and text confirmation to the user


API Schema (database table design) - data structures to contain your persisten or transferred data

- Will need 2 to 3 tables?
- Have 13 tables at my restaurant
    - 6 can seat max 1
    - 6 can seat min 2 max 4
    - 1 can seat min 8 max 12
User sends over date, time, seating data
    - should return list of available tables based on time, date, and party specified
    - ex. 12/28, 1:00 PM, 4 people
    - table of available tables should have a where clause
        - where date = 12/28
        - where time = 1:00 PM
        - where seats_available >=4
        if we do a select * from table with these requirements, 
        should return a statement stating if the slot is taken or not

UI Design/Wireframe

Restaurant
    Limited:
        number of tables
        limited chairs
        hours of operation
        (amount of food)
    



Actual Steps :
1. User selects date, time, party size, and seating area
    Caveats :
        1 Person HAS to select bar seating
        2-4 People HAVE to select table
        5-6 People HAVE to select booth
        7-12 People HAVE to select party room
        12+ should call
        //Use JS to get rid of certain options

2. Once the form is submitted, will check against my database
    If the return is less than the maximum availability of slots, it is available.
    Bar Seating Maximum/hour = 6 
    Table Seating Maximum/hour = 4
    Booth Seating Maximum/hour = 2
    Party Room Seating Maximum/hour = 1

    It will then return the number of openings for that date at that time for the party size selected
        ex. 12/28, 1:00 PM, 4 people
        3 slots open
        12/28 1:00 PM 4 people [confirm]
        12/28 1:00 PM 4 people [confirm]
        12/28 1:00 PM 4 people [confirm]

3A. After verifying that the reservation is available, should ask for name and number in addition to inputted information to INSERT INTO table with new reservation

3B. If there is no availability for requested date, time, party size, return options within 3 hours of that requested time. 
    Depending on the time, add/subtract 3 hours with same date and party size. 
        If requested time 12:00 PM, only go back to 11:00 AM but check till 3:00 PM.
        If still nothing, do nothing. Guess we're just busy. 

4. Thank you message? Confirm the date and time with them and send them away





        