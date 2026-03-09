<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'restaurant') {
    header("Location: ../auth/login.php");
    exit;
}

include "../config/db.php";
include "../includes/header.php";

/* Query with yesterday price */
$query = "
SELECT 
    p.product_name,
    v.vendor_name,
    d.price AS today_price,
    d.price_date,
    (
        SELECT dp2.price 
        FROM daily_prices dp2
        WHERE dp2.product_id = d.product_id
          AND dp2.vendor_id = d.vendor_id
          AND dp2.price_date < d.price_date
        ORDER BY dp2.price_date DESC
        LIMIT 1
    ) AS yesterday_price
FROM daily_prices d
JOIN products p ON d.product_id = p.product_id
JOIN vendors v ON d.vendor_id = v.vendor_id
ORDER BY p.product_name, d.price ASC
";

$result = mysqli_query($conn, $query);
?>

<div class="container">

    <h1>Daily Prices</h1>
    <p class="subtitle">
        Compare today’s prices with historical trends.
    </p>

    <!-- CARD START -->
    <div class="card">

        <table>
            <tr>
                <th>Product</th>
                <th>Vendor</th>
                <th>Today Price</th>
                <th>Yesterday</th>
                <th>Trend</th>
            </tr>

            <?php
            if (mysqli_num_rows($result) > 0) {
                $bestPrices = [];

$bestQuery = "
SELECT product_id, MIN(price) AS min_price
FROM daily_prices
GROUP BY product_id
";

$bestResult = mysqli_query($conn, $bestQuery);

while ($bp = mysqli_fetch_assoc($bestResult)) {
    $bestPrices[$bp['product_id']] = $bp['min_price'];
}
                while ($row = mysqli_fetch_assoc($result)) {

                    $trend = "<span class='stable'>⏺ Stable</span>";

                    if ($row['yesterday_price'] !== null) {
                        if ($row['today_price'] > $row['yesterday_price']) {
                            $trend = "<span class='up'>🔺 Increased</span>";
                        } elseif ($row['today_price'] < $row['yesterday_price']) {
                            $trend = "<span class='down'>🔻 Decreased</span>";
                        }
                    }

                    $isBest = ($row['today_price'] == $bestPrices[$row['product_id']]);
$trClass = $isBest ? "class='best'" : "";

echo "<tr $trClass>";
                    echo "<td>{$row['product_name']}</td>";
                    echo "<td>{$row['vendor_name']}</td>";
                    echo "<td>₹{$row['today_price']}";
if ($isBest) {
    echo "<span class='badge'>Best Price</span>";
}
echo "</td>";
                    echo "<td>" . ($row['yesterday_price'] ?? '-') . "</td>";
                    echo "<td>$trend</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No price data available</td></tr>";
            }
            ?>

        </table>

    </div>
    <!-- CARD END -->

</div>

</body>
</html>