<?php

// Change the second argument for better database security so that
// only you can enter work records
define("FORM_PAGE", "addwork");

// Database location; you can change it if you want
define("DB_LOCATION", "./kudos.db");

// Something to show in page titles. You could change this to "Kudos for [My Name]", etc.
define("SITE_NAME", "Kudos");

// This changes the image bgcolor! you probably want it to be something that the text will show up on.
// use "none" for transparent, but this might cause it to not show up if the background is the same color
// as the text.
define("IMAGE_BG", "white");

// Text Drawing Settings
$id = new ImagickDraw();
$id->setFont("./fonts/open-sans.ttf");
$id->setFontSize(16);
$id->setStrokeOpacity(1);
$id->setStrokeColor("#000000");
$id->setFillColor("#000000");
