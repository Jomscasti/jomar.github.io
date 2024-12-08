<?php
include("connect.php");
include("process.php");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flight Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row my-5 ">
            <div class="col">
                <form>
                    <div class="card p-4 rounded-5">
                        <div class="h6">
                            Filter
                        </div>
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="mb-2">
                                <label for="airlineSelect">Airline Name</label>
                                <select id="airlineSelect" name="airlineName" class="form-control"
                                    style="width: 100%; max-width: 200px;">
                                    <option value="">Any</option>
                                    <?php
                                    if (mysqli_num_rows($airlineNameResults) > 0) {
                                        while ($airlineNameRow = mysqli_fetch_assoc($airlineNameResults)) {
                                            ?>
                                            <option <?php if ($airlineFilter == $airlineNameRow['airlineName']) {
                                                echo "selected";
                                            } ?> value="<?php echo $airlineNameRow['airlineName'] ?>">
                                                <?php echo $airlineNameRow['airlineName'] ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-2 ms-2">
                                <label for="departureSelect">Departure Code</label>
                                <select id="departureSelect" name="departureAirportCode" class="form-control"
                                    style="width: 100%; max-width: 200px;">
                                    <option value="">Any</option>
                                    <?php
                                    if (mysqli_num_rows($departureCodeResults) > 0) {
                                        while ($departureRow = mysqli_fetch_assoc($departureCodeResults)) {
                                            ?>
                                            <option <?php if ($departureFilter == $departureRow['departureAirportCode']) {
                                                echo "selected";
                                            } ?> value="<?php echo $departureRow['departureAirportCode'] ?>">
                                                <?php echo $departureRow['departureAirportCode'] ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-2 ms-2">
                                <label for="sort">Sort By</label>
                                <select id="sort" name="sort" class="form-control"
                                    style="width: 100%; max-width: 200px;">
                                    <option value="departureDatetime" <?php if ($sort == "departureDatetime") {
                                        echo "selected";
                                    } ?>>Departure Time</option>
                                    <option value="arrivalDatetime" <?php if ($sort == "arrivalDatetime") {
                                        echo "selected";
                                    } ?>>Arrival Time</option>
                                    <option value="flightNumber" <?php if ($sort == "flightNumber") {
                                        echo "selected";
                                    } ?>>Flight Number</option>
                                </select>
                            </div>

                            <div class="mb-2 ms-2">
                                <label for="order">Order</label>
                                <select id="order" name="order" class="form-control"
                                    style="width: 100%; max-width: 200px;">
                                    <option value="ASC" <?php if ($order == "ASC") {
                                        echo "selected";
                                    } ?>>Ascending
                                    </option>
                                    <option value="DESC" <?php if ($order == "DESC") {
                                        echo "selected";
                                    } ?>>Descending
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary ms-2 mt-4" style="width: fit-content">Submit</button>
                    </div>
            </div>
            </form>
        </div>

        <div class="row">
            <div class="col">
                <div class="card p-4 rounded-5">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Flight Number</th>
                                    <th scope="col">Airline Name</th>
                                    <th scope="col">Departure Airport Code</th>
                                    <th scope="col">Arrival Airport Code</th>
                                    <th scope="col">Departure Date</th>
                                    <th scope="col">Arrival Date</th>
                                    <th scope="col">Duration (mins)</th>
                                    <th scope="col">Aircraft</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($flightResults) > 0) {
                                    while ($flightRow = mysqli_fetch_assoc($flightResults)) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $flightRow['flightNumber'] ?></th>
                                            <td><?php echo $flightRow['airlineName'] ?></td>
                                            <td><?php echo $flightRow['departureAirportCode'] ?></td>
                                            <td><?php echo $flightRow['arrivalAirportCode'] ?></td>
                                            <td><?php echo $flightRow['departureDatetime'] ?></td>
                                            <td><?php echo $flightRow['arrivalDatetime'] ?></td>
                                            <td><?php echo $flightRow['flightDurationMinutes'] ?></td>
                                            <td><?php echo $flightRow['aircraftType'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>