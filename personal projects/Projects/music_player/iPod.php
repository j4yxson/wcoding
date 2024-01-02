<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPod</title>
    <link rel="stylesheet" href="ipodStyles.css">
</head>

<body>
    <div class="main">
        <div class="ipod">
            <div class="top">
                <div id="songinfo">
                    <div class="album_cover">
                        <img class="albumcover" src="">
                    </div>
                    <div class="songinfo">
                        <h3 class="title"></h3>
                        <h3 class="artist"></h3>
                    </div>
                </div>
                <div class="playbar">
                    <div class="progress"></div>
                </div>
                <!-- <div class="playbartime"></div> -->
            </div>
            <div class="bot">
                <div class="wheel">
                </div>
                <div class="forwardbackwards">
                    <div class="backwards"><img src="icons/backwards.svg"></div>
                    <div class="forwards"><img src="icons/forwards.svg"></div>
                </div>
                <div class="menuplaypause">
                    <div class="menu">MENU</div>
                    <div class="playpause">
                        <div class="play"><img src="icons/play.svg"></div>
                        <div class="pause"><img src="icons/pause.svg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<script>
    // music player controls init
    playButton = document.querySelector(".play");
    pauseButton = document.querySelector(".pause");
    backwardsButton = document.querySelector(".backwards");
    forwardsButton = document.querySelector(".forwards");
    playBar = document.querySelector(".playbar");

    //song info init
    title = document.querySelector(".title");
    artist = document.querySelector(".artist");
    albumcover = document.querySelector(".albumcover");

    // array init
    songArray = [];
    artistArray = [];
    mp3Array = [];
    coverArray = [];
    durationArray = [];
    ogdurationArray = [];
    let numSongs;


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

    // space bar to play and pause
    document.addEventListener("keydown", function(event) {
        if (event.key === " " || event.keyCode === 32) {
            if (playButton.style.display == "flex") {
                playSong();
            } else if (pauseButton.style.display == "flex") {
                pauseSong();
            }
        }
    });



    // on refresh, load the songs from the database into arrays
    document.addEventListener("DOMContentLoaded", function() {
        fetch('getSongsAPI.php')
            .then(response => response.json())
            .then(data => {
                console.log(data);
                numSongs = data.length;

                data.forEach(song => {
                    songArray.push(song.song_title);
                    artistArray.push(song.artist);
                    mp3Array.push(song.mp3_link);
                    coverArray.push(song.cover_link)

                    song = new Audio(song.mp3_link);
                    song.addEventListener("loadedmetadata", function() {
                        ogdurationArray.push(song.duration);
                        minutes = Math.floor(song.duration / 60);
                        seconds = Math.ceil(song.duration - (minutes * 60));

                        minutes = minutes + ":";
                        totaltime = minutes + seconds;


                        durationArray.push(totaltime);
                    })
                });
                title.innerHTML = songArray[0];
                artist.innerHTML = artistArray[0];
                albumcover.src = coverArray[0];
                song1 = new Audio(mp3Array[0]);
                playBar.innerHTML = durationArray[0];
            })
    })

    // backwards button to reload current song from beginning functionality
    backwardsButton.addEventListener("click", function() {
        song1.pause();
        currentPos = songArray.indexOf(title.innerHTML);

        if (currentPos !== 0) {
            nextPos = currentPos - 1;
        } else {
            nextPos = songArray.length - 1;
        }

        title.innerHTML = songArray[nextPos];
        artist.innerHTML = artistArray[nextPos];
        albumcover.src = coverArray[nextPos];
        song1 = new Audio(mp3Array[nextPos]);
        playBar.innerHTML = durationArray[nextPos];

        song1.play();
    });



    //forward button click
    forwardsButton.addEventListener("click", function() {
        song1.pause();
        currentPos = songArray.indexOf(title.innerHTML);

        if (currentPos === (songArray.length - 1)) {
            nextPos = 0;
        } else {
            nextPos = currentPos + 1;
        }

        title.innerHTML = songArray[nextPos];
        artist.innerHTML = artistArray[nextPos];
        albumcover.src = coverArray[nextPos];
        song1 = new Audio(mp3Array[nextPos]);
        playBar.innerHTML = durationArray[nextPos];

        song1.play();
    });
</script>