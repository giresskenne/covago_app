<?php
require '../Models/listing_journey.php';

$resultat  = getJourney();
$nombre=getNumberJob();

require '../Views/listing_journey.php';