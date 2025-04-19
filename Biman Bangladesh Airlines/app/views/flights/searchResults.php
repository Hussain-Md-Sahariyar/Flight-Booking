<!-- app/views/flights/searchResults.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flight Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: url('images/back.jpeg') no-repeat center center fixed;
            background-size: cover;
        }
        .flight-card, .flight-details, .extra-details, .flight-pricing, .tag {
            color: #fff;
        }
        .book-button {
            background-color: #0d6efd;
            padding: 8px 16px;
            color: #fff;
            border-radius: 5px;
        }
        .toggle-dropdown {
            cursor: pointer;
            color: #0dcaf0;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <?php if (!empty($flights)): ?>
        <?php foreach ($flights as $row): ?>
            <?php $detailsId = "extra_" . $row['flight_no']; ?>
            <div class="card mb-4 p-3 bg-dark text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5><?= $row['flying_from'] ?> to <?= $row['flying_to'] ?> (<?= $row['flight_no'] ?>)</h5>
                        <p><?= $row['departure_date'] ?> | <?= $row['departure_time'] ?> - <?= $row['arrival_time'] ?></p>
                        <p>Aircraft: <?= $row['aircraft'] ?> | Class: <?= $row['class'] ?></p>
                    </div>
                    <div class="text-end">
                        <p class="fw-bold">BDT <?= $row['price'] ?></p>
                        <a href="index.php?action=book&flight_no=<?= urlencode($row['flight_no']) ?>&flying_from=<?= urlencode($row['flying_from']) ?>&flying_to=<?= urlencode($row['flying_to']) ?>&departure_date=<?= urlencode($row['departure_date']) ?>&class=<?= urlencode($row['class']) ?>" class="book-button">BOOK NOW</a>
                    </div>
                </div>
                <div class="flight-details mt-2">
                    <span class="tag">One Way</span>
                    <span class="tag"><?= $row['class'] ?></span>
                    <span class="tag"><?= ucfirst($row['refundable']) ?></span>
                    <span class="toggle-dropdown" onclick="toggleDetails('<?= $detailsId ?>')">Flight Details ▼</span>
                </div>
                <div class="extra-details mt-3" id="<?= $detailsId ?>" style="display:none;">
                    <p><strong>From:</strong> <?= $row['departure_city'] ?> (<?= $row['departure_city_code'] ?>), <?= $row['departure_airport'] ?>, Terminal: <?= $row['departure_terminal'] ?></p>
                    <p><strong>To:</strong> <?= $row['arrival_city'] ?> (<?= $row['arrival_city_code'] ?>), <?= $row['arrival_airport'] ?>, Terminal: <?= $row['arrival_terminal'] ?></p>
                    <p><strong>Duration:</strong> <?= $row['duration'] ?></p>
                    <p><strong>Baggage:</strong> <?= $row['baggage_type'] ?> | Cabin: <?= $row['cabin_baggage'] ?> | Check-in: <?= $row['check_in_baggage'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-white text-center fw-bold fs-4">No flights found with the selected criteria.</p>
    <?php endif; ?>
</div>

<script>
    function toggleDetails(id) {
        const section = document.getElementById(id);
        section.style.display = (section.style.display === "none" || section.style.display === "") ? "block" : "none";
    }
</script>

</body>
</html>
