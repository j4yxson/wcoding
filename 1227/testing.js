// create form function

dateVal = '2023-12-13';
timeVal = '14:00';
patronsVal = 3;
nameVal = "Jason";
phoneVal = '2155007842';
confVal = 'a552ce09';

function createForm(dateVal, timeVal, patronsVal, nameVal, phoneVal, confVal) {
    // creating date form element
    dateInput = document.createElement("input");
    dateInput.type = "date";
    dateInput.id = "date1";
    dateInput.value = dateVal;

    //creating time form element
    timeSelect = document.createElement("select");
    timeSelect.name = "time";
    timeSelect.id = "time1"

    //creating options for time form element
    for (i = 11; i < 23; i++) {
        timeOptions = document.createElement("option");
        timeOptions.value = i + ":00";
        let a = "";
        if (i < 12) {
            a = " AM";
        } else {
            a = " PM";
        }
        if (i == 11 || i == 12) {
            timeOptions.innerHTML = i + ":00" + a;
            timeSelect.appendChild(timeOptions);
        } else {
            timeOptions.innerHTML = (i - 12) + ":00" + a;
            timeSelect.appendChild(timeOptions);
        }
    }
    formElem.appendChild(timeSelect);

    for (var i = 0; i < timeSelect.options.length; i++) {
        var option = timeSelect.options[i];
        if (option.value === timeVal) {
            option.setAttribute('selected', 'selected');
        } else {
            // Ensure that other options don't have the 'selected' attribute
            option.removeAttribute('selected');
        }
    }



}