<?php

header('Content-Type: text/calendar');

try {

  require 'classes/twente_milieu.php';
  require 'classes/ical.php';

  // Support both query parameters (for backwards compatibility) and path-based routing
  $postcode = $_GET['postcode'] ?? null;
  $huisnummer = $_GET['huisnummer'] ?? null;

  if ( !$postcode || !$huisnummer ) {
    throw new Exception("Postcode en huisnummer zijn verplicht");
  }

  $afvalkalender  = new TwenteMilieu($postcode, $huisnummer);
  $ical_generator = new iCal('TwenteMilieu', 'Afvalkalender');

  // Find first of this month
  $request_date = new DateTime();
  $request_date->setDate($request_date->format('Y'), $request_date->format('m'), 1);
  $request_date->setTime(0,0,0);
  $request_date->setTimezone(new DateTimeZone('Europe/Amsterdam'));

  $events = $afvalkalender->getEvents($request_date);
  echo $ical_generator->render($events);

} catch ( Exception $e ) {

	echo "ERROR: {$e->getMessage()}";

}

?>