<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combo</title>
    <style>
        :root {
            --gen-border-radius: 5px;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 2rem;
            font-family: sans-serif;
            font-weight: bold;
            font-size: 1.25rem;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background-image: url('https://media.istockphoto.com/id/1366624125/photo/mother-and-graduating-daughter-pose-cheek-to-cheek-for-photo.jpg?s=612x612&w=0&k=20&c=Ctm_MVP3OB4sz7ri8ujXYpVNbytqoiK0Bxc3hYeRRBQ=');
            background-size: cover;
            background-repeat: no-repeat;
            filter: blur(5px) opacity(60%) sepia(75%);
            z-index: -1;
        }

        #combo {
            display: flex;
            gap: 0.25rem;
            position: relative;
        }

        input {
            width: 30rem;
            /* height: 1.5rem; */
            border-radius: var(--gen-border-radius);
            border: 1px solid grey;
            outline: none;
            padding: 0.5rem 0.5rem;
            font-size: inherit;
        }

        button {
            background-color: slateblue;
            color: white;
            width: 200px;
            font-size: inherit;
            font-weight: inherit;
            border: none;
            border-radius: var(--gen-border-radius);
        }

        #matches {
            position: absolute;
            top: 2rem;
            border: 1px solid lightgray;
            background: white;
            width: 30rem;
            box-sizing: border-box;
            display: none;
        }

        #matches>div {
            padding: 0.1rem 0.5rem;
        }

        #matches>div:focus {
            background-color: bisque;
            outline: none;
        }

        #results {
            height: 200px;
            background: white;
            padding: 2rem 4rem;
            border-radius: var(--gen-border-radius);
            background-color: transparent;
        }

        .detailRow {
            display: flex;
            gap: 0.5rem;
        }

        .detailRowProp {
            width: 10rem;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="overlay"></div>
    <div id="combo">
        <input tabindex="1" type="text" placeholder="Enter the name of a university...">
        <div id="matches"></div>
        <button tabindex="2">Search</button>
    </div>
    <div id="results"></div>
    <script>
        const inputElem = document.querySelector("input");
        const matchesElem = document.querySelector("#matches");
        const buttonElem = document.querySelector("button");
        const resultsElem = document.querySelector("#results");

        // const allSchools = JSON.parse(`[{"web_pages": ["http://www.marywood.edu"], "alpha_two_code": "US", "domains": ["marywood.edu"], "name": "Marywood University", "state-province": null, "country": "United States"}, {"web_pages": ["http://www.lindenwood.edu/"], "alpha_two_code": "US", "domains": ["lindenwood.edu"], "name": "Lindenwood University", "state-province": null, "country": "United States"}, {"web_pages": ["https://sullivan.edu/"], "alpha_two_code": "US", "domains": ["sullivan.edu"], "name": "Sullivan University", "state-province": null, "country": "United States"}, {"web_pages": ["https://www.fscj.edu/"], "alpha_two_code": "US", "domains": ["fscj.edu"], "name": "Florida State College at Jacksonville", "state-province": null, "country": "United States"}, {"web_pages": ["https://www.xavier.edu/"], "alpha_two_code": "US", "domains": ["xavier.edu"], "name": "Xavier University", "state-province": null, "country": "United States"}, {"web_pages": ["https://home.tusculum.edu/"], "alpha_two_code": "US", "domains": ["tusculum.edu"], "name": "Tusculum College", "state-province": null, "country": "United States"}]`);
        let allSchools = [];
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "http://universities.hipolabs.com/search?country=United+States");
        xhr.addEventListener("load", function() {
            allSchools = JSON.parse(xhr.responseText);
            allSchools.sort((a, b) => a.name.localeCompare(b.name));
        });
        xhr.send();

        function showSchool() {
            matchesElem.style.display = "none";

            const school = allSchools.find(v => {
                const lowerName = v.name.toLowerCase();
                const lowerInput = inputElem.value.toLowerCase();
                return lowerName === lowerInput;
            });

            if (school) {
                let newHtml = "";
                for (let prop of Object.keys(school)) {
                    newHtml += `
                        <div class="detailRow">
                            <div class="detailRowProp">${prop}:</div>
                            <div class="detailRowValue">${school[prop]}</div>
                        </div>`;
                }
                resultsElem.style.backgroundColor = "white";
                resultsElem.innerHTML = newHtml;
            }
        }
        buttonElem.addEventListener("click", showSchool);

        function selectSchool(school) {
            matchesElem.style.display = "none";
            inputElem.value = school.name;
            inputElem.focus();
        }

        function navSchool(event) {
            const focusedElem = document.activeElement;
            if (focusedElem && matchesElem.style.display !== "none") {
                if (event.key === 'ArrowUp' || event.key === 'ArrowDown') {
                    // const focusedElem = event.target;
                    if (focusedElem.tabIndex) {
                        let nextSchool = null;
                        if (event.key === 'ArrowUp') {
                            nextSchool = document.querySelector(`[tabindex="${focusedElem.tabIndex - 1}"]`);
                        } else {
                            if (focusedElem.tabIndex === 1) { // Go directly from input to list. Skip button.
                                nextSchool = document.querySelector(`[tabindex="3"]`); // First match in list.
                            } else {
                                nextSchool = document.querySelector(`[tabindex="${focusedElem.tabIndex + 1}"]`);
                            }
                        }
                        if (nextSchool) nextSchool.focus();
                    }
                } else if (event.key === 'Enter') {
                    const school = allSchools.find(v => v.name === focusedElem.innerHTML);
                    if (school) selectSchool(school);
                }
            }
        }
        // document.addEventListener("keyup", navSchool);

        inputElem.addEventListener("keyup", function(event) {
            // console.log("KEY EVENT:", event);

            if (event.key === 'Enter') {
                matchesElem.style.display = "none";
                showSchool();
            } else if (event.key === 'ArrowDown') {
                navSchool(event);
            } else {
                // Reset all the match results.
                matchesElem.style.display = "none";
                matchesElem.innerHTML = "";

                if (inputElem.value.length > 2) { // Need at least 3 characters to start.
                    // Search through the allSchools to find matching results.
                    const matchingSchools = allSchools.filter(v => {
                        const lowerName = v.name.toLowerCase();
                        const lowerInput = inputElem.value.toLowerCase();
                        return lowerName.includes(lowerInput);
                    });

                    // console.log("MATCHES:", matchingSchools, allSchools);
                    matchingSchools.forEach((school, idx) => {
                        const newDiv = document.createElement("div");
                        newDiv.innerHTML = school.name;
                        newDiv.tabIndex = idx + 3;

                        newDiv.addEventListener("click", function() {
                            selectSchool(school);
                        });

                        newDiv.addEventListener("keyup", navSchool);

                        matchesElem.appendChild(newDiv);
                    });

                    matchesElem.style.display = "block"; // Show
                }
            }
        });

        inputElem.focus();
    </script>
</body>

</html>