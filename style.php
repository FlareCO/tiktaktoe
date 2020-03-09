<?php

header("Content-type: text/css");

?>
.game-board{
    width: 90%;
	height: 400px;
	margin: 0 auto;
    background-color: #34495e;
    color: #fff;
    border: 6px solid #2c3e50;
    border-radius: 10px;
    display: grid;
    grid-template: repeat(3, 1fr) / repeat(3, 1fr);
}

.box{
    border: 6px solid #2c3e50;
    border-radius: 2px;
    font-family: Helvetica;
    font-weight: bold;
    font-size: 4em;
    display: flex;
    justify-content: center;
    align-items: center;
}

.hidden{
    visibility: hidden;
    position: absolute;
    left: -9999px;
}
body {
	background-color: #787878;
}