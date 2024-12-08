<?php
$airlineFilter = $_GET['airlineName'] ?? '';
$departureFilter = $_GET['departureAirportCode'] ?? '';
$sort = $_GET['sort'] ?? 'departureDatetime';
$order = $_GET['order'] ?? '';

$flightQuery = "SELECT * FROM flightlogs";

$filters = [];
if ($airlineFilter != '') {
    $filters[] = "airlineName = '$airlineFilter'";
}
if ($departureFilter != '') {
    $filters[] = "departureAirportCode = '$departureFilter'";
}

if (!empty($filters)) {
    $flightQuery .= " WHERE " . implode(" AND ", $filters);
}

$flightQuery .= " ORDER BY $sort $order";

$flightResults = executeQuery($flightQuery);

$airlineNameQuery = "SELECT DISTINCT(airlineName) FROM flightlogs";
$airlineNameResults = executeQuery($airlineNameQuery);

$departureCodeQuery = "SELECT DISTINCT(departureAirportCode) FROM flightlogs";
$departureCodeResults = executeQuery($departureCodeQuery);
?>
process.php