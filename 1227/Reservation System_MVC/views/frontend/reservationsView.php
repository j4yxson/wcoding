<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../../public/css/reservationStyles.css">
</head>

<body>
    <div class="main">
        <div class="header">
            <div class="logo">
                <h1>UNCLE BONGSOO'S PIZZERIA</h1>
            </div>
            <div class="navbar">
                <ul>
                    <li><a href="../../index.php">HOME</a></li>
                    <li><a href="menuView.php">MENU</a></li>
                    <li><a href="reservationsView.php">RESERVATIONS</a></li>
                </ul>
            </div>
        </div>
        <div class="body">
            <div class="options">
                <h2 class="find">CREATE NEW</h2>
                <h2 class="changecancel">CHANGE/CANCEL</h2>
                <h2>RESERVATION</h2>
            </div>
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
            <form class="updatereservation" method="post">
                <input type="text" id="confirmationcode" placeholder="Confirmation Code" autocomplete="off">
                <button type="submit" class="submitconfirmationcode">Find Reservation</button>
            </form>
            <br>
            <div class="availableReservations">
                <h2 class="aRes">AVAILABLE RESERVATIONS</h2>
                <h2 class="cRes">CURRENT RESERVATION</h2>
                <div class="reservationOutput">
                    <?php
                    if (isset($results)) {
                        echo "<h1>Reservation Details</h1>";
                        echo "<p>Reservation Holder: " . htmlspecialchars($results['reservation_holder']) . "</p>";
                        echo "<p>Phone Number: " . htmlspecialchars($results['phone_number']) . "</p>";
                        echo "<p>Confirmation Code: " . htmlspecialchars($results['confirmation_code']) . "</p>";
                    } else {
                        echo "<p>No reservation details available yet.</p>";
                    }
                    ?>
                    <form class="updateExistingReservation" method="post">
                        <input type="date" id="date1" required value="">
                        <select name=" time" id="time1" required>
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
                        <select name="patrons" id="patrons1" required>
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
                        <select name="seating" id="seating1" required>
                            <option class="bar" value="bar">Bar Seating</option>
                            <option class="table" value="table">Table</option>
                            <option class="booth" value="booth">Booth</option>
                            <option class="party_room" value="party_room">Party Room</option>
                        </select>
                        <input type="text" class="resName" placeholder="Name">
                        <input type="text" class="resPhone" placeholder="Phone Number">
                        <input type="text" class="confCode" readonly value="<?php if (isset($results['confirmation_code'])) {
                                                                                echo $results['confirmation_code'];
                                                                            } ?>">

                        <button type="submit" class="check">Let's Go!</button>
                    </form>
                    <div class="canUpdate"></div>
                </div>
                <form class="confirm" method="post">
                    <label for="reservation_holder"></label>
                    <input required type="text" id="reservation_holder" placeholder="Name" autocomplete="off" onkeydown="return event.key !== 'Enter';">
                    <label for="phone_number"></label>
                    <input required type="tel" id="phone_number" placeholder="Phone Number" autocomplete="off" onkeydown="return event.key !== 'Enter';">
                    <button type="submit" class="confirmButton">Confirm Reservation!</button>
                </form>
            </div>
        </div>

    </div>
    </div>
</body>

</html>
<script>
    let fetchedReservations;
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

        fetch('../../api/resQueryAPI.php', {
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
                    displayArea.style.fontSize = "1em";
                    newH4.innerHTML = "There is " + data + " Reservation Available on " + dateVal + " at " + document.querySelector("#time").options[document.querySelector("#time").selectedIndex].innerHTML + " for " + document.querySelector("#patrons").options[document.querySelector("#patrons").selectedIndex].innerHTML;
                    displayArea.appendChild(newH4);
                    confirmForm.style.display = "flex";
                } else if (data > 1) {
                    displayArea.innerHTML = "";
                    newH4 = document.createElement("h4");
                    displayArea.style.fontSize = "1em";
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
            fetch('../../api/resConfirmAPI.php', {
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


    //showing FIND reservation

    find = document.querySelector(".find");
    find.addEventListener("click", function() {
        reservationForm.style.display = "flex"; // shows the reservation form
        find.style.display = "none"; // hides the "find" button
        updateReservationForm.style.display = "none"; // hides the update reservation form if not hidden
        changecancel.style.display = "flex"; // shows the change/cancel option button if hidden
        currentReservationsTitle.style.display = "none";
        availableReservationsTitle.style.display = "flex";
    })

    //showing CANCEL/CHANGE RESERVATION

    changecancel = document.querySelector(".changecancel");
    updateReservationForm = document.querySelector(".updatereservation");
    availableReservationsTitle = document.querySelector(".aRes");
    currentReservationsTitle = document.querySelector('.cRes');

    changecancel.addEventListener("click", function() {
        updateReservationForm.style.display = "flex";
        find.style.display = "flex";
        changecancel.style.display = "none";
        reservationForm.style.display = "none";
        currentReservationsTitle.style.display = "flex";
        availableReservationsTitle.style.display = "none";
    })
    displayArea = document.querySelector(".reservationOutput");
    updateExistingReservationForm = document.querySelector(".updateExistingReservation");

    //finding existing reservation
    confirmationCode = document.querySelector("#confirmationcode");
    updateReservationForm.addEventListener("submit", function(event) {
        event.preventDefault();

        confirmationCode = document.querySelector("#confirmationcode");

        fetch('../../api/resFindAPI.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'confirmation_code=' + confirmationCode.value
            })
            .then(response => response.text())
            .then(data => {
                displayArea.innerHTML = data;
                // updateExistingReservationForm.style.display = "flex";
                if (!document.querySelector(".changecanceloptions")) {
                    newDiv = document.createElement("div");
                    newDiv.className = "changecanceloptions";
                    newButton1 = document.createElement("button");
                    newButton1.className = "changeReservation";
                    newButton1.innerHTML = "CHANGE";
                    newButton2 = document.createElement("button");
                    newButton2.className = "cancelReservation";
                    newButton2.innerHTML = "CANCEL"
                    newDiv.appendChild(newButton1);
                    newDiv.appendChild(newButton2);
                    displayArea.appendChild(newDiv);
                }

                // cancel existing reservation
                cancelButton = document.querySelector(".cancelReservation");
                cancelButton.addEventListener("click", function() {
                    confirmationCodeValue = confirmationCode.value;
                    fetch('../../api/resCancelAPI.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'confirmationCode=' + confirmationCodeValue
                        })
                        .then(response => response.text())
                        .then(data => {
                            displayArea.innerHTML = data
                        })
                })

                // change reservation
                // changeButton = document.querySelector(".changeReservation");
                // changeButton.addEventListener("click", function() {
                //     confirmationCodeValue = confirmationCode.value;
                //     canUpdate = document.querySelector(".canUpdate");
                //     if (canUpdate.innerHTML == "Reservation at this time Available!") {
                //         fetch('../../api/resUpdateAPI.php', {
                //                 method: 'POST',
                //                 headers: {
                //                     'Content-Type': 'application/x-www-form-urlencoded',
                //                 },
                //                 body: 'confirmationCode=' + confirmationCodeValue
                //             })
                //             .then(response => response.text())
                //             .then(data => {
                //                 displayArea.innerHTML = data
                //             })
                //     } else
                //         displayArea.innerHTML = "Find a Valid Reservation"
                // })
            })
    })
</script>