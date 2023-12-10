<?php
if (!empty($result)) {
    foreach ($result as $row) {
        echo '<li>';
        echo '<div class="wrapper">';
        echo '<div class="card">';
        echo '<div class="poster">';
        echo '<img src="' . $row["image"] . '" alt="Location Unknown">';
        echo '</div>';
        echo '<div class="details">';
        echo '<h1>' . $row["name"] . '</h1>';
        echo '<h2>' . $row["year"] . ' • ' . $row["type"] . ' • ' . ($row["category"] ?? '') . '</h2>';
        echo '<div class="rating">';
        for ($r = 0; $r < $row["rate"]; $r++) {
            echo '<i class="fas fa-star"></i>';
        }
        for ($r = 0; $r < (5 - $row["rate"]); $r++) {
            echo '<i class="far fa-star"></i>';
        }
        echo '<span>' . $row["rate"] . '/5</span>';
        // if user type == visitor { input rate /5   save the rate on rates}
        echo '</div>';
        echo '<div class="tags">';
        echo '<span class="tag">' . $row["tag1"] . '</span>';
        echo '<span class="tag">' . $row["tag2"] . '</span>';
        echo '<span class="tag">' . $row["tag3"] . '</span>';
        echo '</div>';
        echo '<p class="desc">' . $row["description"] . '</p>';
        
        // Add "See More" button linking to eventcard.php
        echo '<a href="eventDetailsView.php?id=' . $row["id"] . '" class="see-more-button">See More</a>';
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</li>';
    }
} else {
    echo "0 results";
}
?>
