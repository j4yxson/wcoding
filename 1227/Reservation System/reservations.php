<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="reservationStyles.css">
</head>

<body>
    <div class="main">
        <div class="header">
            <div class="logo">
                <h1>UNCLE BONGSOO'S PIZZERIA</h1>
            </div>
            <div class="navbar">
                <ul>
                    <li><a href="landingPage.php">HOME</a></li>
                    <li><a href="menu.php">MENU</a></li>
                    <li><a href="reservations.php">RESERVATIONS</a></li>
                </ul>
            </div>
        </div>
        <div class="body">
            <h2>FIND A RESERVATION</h2>
            <form class="reservation" method="post">
                <input type="date" id="date" required>
                <select name="time" id="time" required>
                    <option value="11:00">11:00 AM</option>
                    <option value="12:00">12:00 PM</option>
                    <option value="13:00">1:00 PM</option>
                    <option value="14:00">2:00 PM</option>
                    <option value="15:00">3:00 PM</option>
                    <option value="16:00">4:00 PM</option>
                    <option value="17:00">5:00 PM</option>
                    <option value="18:00">6:00 PM</option>
                    <option value="19:00">7:00 PM</option>
                    <option value="20:00">8:00 PM</option>
                    <option value="21:00">9:00 PM</option>
                    <option value="22:00">10:00 PM</option>
                </select>
                <select name="patrons" id="patrons" required>
                    <option value="1">1 Person</option>
                    <option value="2">2 People</option>
                    <option value="3">3 People</option>
                    <option value="4">4 People</option>
                    <option value="5">5 People</option>
                    <option value="6">6 People</option>
                    <option value="7">7 People</option>
                    <option value="8">8 People</option>
                    <option value="9">9 People</option>
                    <option value="10">10 People</option>
                    <option value="11">11 People</option>
                    <option value="12">12 People</option>
                </select>
                <select name="seating" id="seating" required>
                    <option class="bar" value="bar">Bar Seating</option>
                    <option class="table" value="table">Table</option>
                    <option class="booth" value="booth">Booth</option>
                    <option class="party_room" value="party_room">Party Room</option>
                </select>
                <button type="submit" class="submit">Let's Go!</button>
            </form>
            <br>
            <div class="availableReservations">
                <h2>AVAILABLE RESERVATIONS</h2>
                <div class="reservationOutput">
                    <!-- <h4>There are __ Reservations Available on __ at __ for __ People!</h4> -->
                </div>
                <form class="confirm" method="post">
                    <label for="reservation_holder"></label>
                    <input required type="text" id="reservation_holder" placeholder="Name" onkeydown="return event.key !== 'Enter';">
                    <label for="phone_number"></label>
                    <input required type="tel" id="phone_number" placeholder="Phone Number" onkeydown="return event.key !== 'Enter';">
                    <button type="submit" class="confirmButton">Confirm Reservation!</button>
                </form>
            </div>
        </div>

    </div>
    </div>
</body>

</html>
<script>
    //auto applying values for easier querying
    dateInput = document.querySelector("#date");
    timeInput = document.querySelector("#time");
    patronsInput = document.querySelector("#patrons");
    seatingInput = document.querySelector("#seating");

    // function to update seating options based on patrons
    function updateSeatingOptions() {
        if (patronsInput.value == '1') {
            seatingInput.innerHTML = "";
            newBar = document.createElement("option");
            newBar.className = "bar";
            newBar.value = "bar";
            newBar.innerHTML = "Bar Seating";
            seatingInput.appendChild(newBar);
        } else if (parseInt(patronsInput.value) >= 2 && parseInt(patronsInput.value) <= 4) {
            seatingInput.innerHTML = "";
            newTable = document.createElement("option");
            newTable.className = "table";
            newTable.value = "table";
            newTable.innerHTML = "Table Seating";
            seatingInput.appendChild(newTable);
        } else if (parseInt(patronsInput.value) > 4 && parseInt(patronsInput.value) <= 6) {
            seatingInput.innerHTML = "";
            newBooth = document.createElement("option");
            newBooth.className = "booth";
            newBooth.value = "booth";
            newBooth.innerHTML = "Booth Seating";
            seatingInput.appendChild(newBooth);
        } else if (parseInt(patronsInput.value) > 6) {
            seatingInput.innerHTML = "";
            newPartyRoom = document.createElement("option");
            newPartyRoom.className = "party_room";
            newPartyRoom.value = "party_room";
            newPartyRoom.innerHTML = "Party Room Seating";
            seatingInput.appendChild(newPartyRoom);
        }
    }
    patronsInput.addEventListener("change", updateSeatingOptions);
    patronsInput.addEventListener("change", function() {
        confirmationForm.style.display = 'none';
    });
    dateInput.addEventListener("change", function() {
        confirmationForm.style.display = 'none';
    });
    timeInput.addEventListener("change", function() {
        confirmationForm.style.display = 'none';
    });
    seatingInput.addEventListener("change", function() {
        confirmationForm.style.display = 'none';
    });

    // call the function initially to set the seating options based on the initial value
    updateSeatingOptions();

    //submitting reservation data


    reservationForm = document.querySelector(".reservation");

    reservationForm.addEventListener("submit", function(event) {
        event.preventDefault();

        dateVal = document.querySelector("#date").value;
        timeVal = document.querySelector("#time").value;
        timeVal2 = document.querySelector("#time");
        patronsVal = parseInt(document.querySelector("#patrons").value);
        seatingVal = document.querySelector("#seating").value;
        displayArea = document.querySelector(".reservationOutput");
        confirmForm = document.querySelector(".confirm");

        fetch('resQueryAPI.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'date=' + dateVal + '&time=' + timeVal + '&patrons=' + patronsVal + '&seating=' + seatingVal
            })
            .then(response => response.text())
            .then(data => {
                if (data == 1) {
                    displayArea.innerHTML = "";
                    newH4 = document.createElement("h4");
                    newH4.innerHTML = "There is " + data + " Reservation Available on " + dateVal + " at " + document.querySelector("#time").options[document.querySelector("#time").selectedIndex].innerHTML + " for " + document.querySelector("#patrons").options[document.querySelector("#patrons").selectedIndex].innerHTML;
                    displayArea.appendChild(newH4);
                    confirmForm.style.display = "flex";
                } else if (data > 1) {
                    displayArea.innerHTML = "";
                    newH4 = document.createElement("h4");
                    newH4.innerHTML = "There are " + data + " Reservations Available on " + dateVal + " at " + document.querySelector("#time").options[document.querySelector("#time").selectedIndex].innerHTML + " for " + document.querySelector("#patrons").options[document.querySelector("#patrons").selectedIndex].innerHTML;
                    displayArea.appendChild(newH4);
                    confirmForm.style.display = "flex";
                } else {
                    displayArea.innerHTML = "";
                    newH4 = document.createElement("h4");
                    newH4.innerHTML = data;
                    displayArea.appendChild(newH4);
                }
            })
    })

    // confirming reservation
    confirmationForm = document.querySelector(".confirm");
    confirmationForm.addEventListener("submit", function(event) {
        event.preventDefault();


        dateVal = document.querySelector("#date").value;
        timeVal = document.querySelector("#time").value;
        patronsVal = parseInt(document.querySelector("#patrons").value);
        seatingVal = document.querySelector("#seating").value;
        reservationHolderVal = document.querySelector("#reservation_holder").value
        phoneNumberVal = document.querySelector("#phone_number").value;

        if (reservationHolderVal !== "" && phoneNumberVal.length == 10) {
            fetch('resConfirmAPI.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'date=' + dateVal + '&time=' + timeVal + '&patrons=' + patronsVal + '&seating=' + seatingVal + '&name=' + reservationHolderVal + '&phone=' + phoneNumberVal
                })
                .then(response => response.text())
                .then(data => {
                    displayArea = document.querySelector(".reservationOutput");
                    displayArea.innerHTML = "";
                    displayArea.style.fontSize = "40px";
                    displayArea.style.fontWeight = "bold";
                    displayArea.innerHTML = data;
                    confirmationForm.style.display = "none";
                })
        } else if (reservationHolderVal !== "" && phoneNumberVal.length !== 10) {
            document.querySelector(".confirmButton").innerHTML = 'Please Enter Valid Phone Number'
        }
    })
</script>