<?php
<script>
ten = document.querySelector("#ten");
twenty = document.querySelector("#twenty");
all = document.querySelector("#all");

tenVal = parseInt(document.querySelector("#ten").value);
twentyVal = parseInt(document.querySelector("#twenty").value);
allVal = parseInt(document.querySelector("#all").value);

function checked() {
    if (ten.checked) {
        tenVal;
    } else if (twenty.checked) {
        twentyVal;
    } else if (all.checked) {
        allVal;
    };
};

document.addEventListener('DOMContentLoaded', function() {
    refreshButton = document.querySelector(".refresh");
    refreshButton.addEventListener("click", () => {
        newSpan = document.createElement("span");
        newSpan.innerHTML =
            "<?php
                $pseudoRes = $db->query('SELECT pseudo from Chat ORDER BY date_created DESC LIMIT 1');
                $pseudoData = $pseudoRes->fetch();
                $pseudoVal = $pseudoData['pseudo']; // this returns the actual value pseudo
                echo $pseudoVal;
                ?>" + ": ";
        newSpan2 = document.createElement("span");
        newSpan2.innerHTML =
            "<?php
                $messageRes = $db->query('SELECT message from Chat ORDER BY date_created DESC LIMIT 1');
                $messageData = $messageRes->fetch();
                $messageVal = $messageData['message']; // this returns the actual value of message
                echo $messageVal;
                ?>";
        newPara = document.createElement("p");
        newPara.innerHTML =
            "<?php
                $timestampRes = $db->query('SELECT date_created from Chat ORDER BY date_created DESC LIMIT 1');
                $timestampData = $timestampRes->fetch();
                $timestampVal = $timestampData['date_created']; // this returns the actual value of message 
                echo $timestampVal;
                ?>";
        newDiv = document.createElement("div");
        newDiv.appendChild(newSpan);
        newDiv.appendChild(newSpan2);
        newDiv.appendChild(newPara);
        messagearea = document.querySelector(".messagearea");
        messagearea.appendChild(newDiv);
        messagearea.appendChild(document.createElement("br"))
    });
});
</script>