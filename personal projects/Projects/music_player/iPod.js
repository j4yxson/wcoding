// music player js

// music player controls init
playButton = document.querySelector(".play");
pauseButton = document.querySelector(".pause");
backwardsButton = document.querySelector(".backwards");
forwardsButton = document.querySelector(".forwards");

//song info init
title = document.querySelector(".title");
artist = document.querySelector(".artist");
albumcover = document.querySelector(".albumcover");


// test song
let song1;

// initializing style to allow for space bar functionality to work
playButton.style.display = "flex";

// play and pause functions
function playSong() {
    song1.play();
    playButton.style.display = "none";
    pauseButton.style.display = "flex";
}

function pauseSong() {
    song1.pause();
    playButton.style.display = "flex";
    pauseButton.style.display = "none";
}

playButton.addEventListener("click", playSong);
pauseButton.addEventListener("click", pauseSong);



// backwards button to reload current song from beginning functionality
backwardsButton.addEventListener("click", function () {
    song1.load();
    playSong();
})


// space bar to play and pause
document.addEventListener("keydown", function (event) {
    if (event.key === " " || event.keyCode === 32) {
        if (playButton.style.display == "flex") {
            playSong();
        } else if (pauseButton.style.display == "flex") {
            pauseSong();
        }
    }
});


songArray = [];
artistArray = [];
mp3Array = [];
coverArray = [];

document.addEventListener("DOMContentLoaded", function () {
    fetch('getSongsAPI.php')
        .then(response => response.json())
        .then(data => {
            // console.log(data[0]['cover_link']);
            console.log(data)

            data.forEach(song => {
                songArray.push(song.song_title);
                artistArray.push(song.artist);
                mp3Array.push(song.mp3_link);
                coverArray.push(song.cover_link)
            });
            title.innerHTML = songArray[0];
            artist.innerHTML = artistArray[0];
            albumcover.style.src = coverArray[0];
            song1 = new Audio(mp3Array[0]);
        })


})


forwardsButton.addEventListener("click", function () {
    song1.pause();
    currentPos = songArray.indexOf(title.innerHTML);
    nextPos = currentPos + 1;

    title.innerHTML = songArray[nextPos];
    artist.innerHTML = artistArray[nextPos];
    albumcover.style.src = coverArray[nextPos];
    song1 = new Audio(mp3Array[nextPos]);

    song1.play();
})
// function parseJson(assArray) {
//     for (i = 0; i < assArray.length; i++) {

//     }
//     console.log(assArray);
// }