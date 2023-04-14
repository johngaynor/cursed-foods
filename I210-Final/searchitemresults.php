<?php
// include header and database
include 'includes/header.php';
include 'includes/database.php';

// retrieve keywords from GET, if none exist throw an error message
if (filter_has_var(INPUT_GET, "terms")) {
    $user_terms = filter_input(INPUT_GET, 'terms', FILTER_UNSAFE_RAW);
} else {
    echo "Error: no search terms were found.";
    include ('includes/footer.php');
    exit;
}

// $delimiter denotes what to separate a string by, explode returns an array of values separated by the delimiter
$delimiter = ' ';
$terms = explode($delimiter, $user_terms);

// defining the query
$sql = "
SELECT i.item_id, i.item_name, i.item_price, i.image, i.description, c.category_name 
FROM items as i
INNER JOIN categories as c
ON i.category_id = c.category_id
WHERE i.item_id>0
";
foreach ($terms as $term) {
    $sql .= " AND item_name LIKE '%$term%'";
}

//execute the query
$query = $conn->query($sql);

//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg.";
    $conn->close();
    include ('includes/footer.php');
    exit;
}

    //display results in a table
    if ($query->num_rows == 0)
    echo "<p style='font-size:30px; padding:25px'>Your search <strong>'$user_terms'</strong> did not match any items in our inventory.</p><br>
    <a href='searchitems.php' style='margin:25px' class='search-back'>Go Back</a>
";
    else {
    ?>
        <h1 id="menuHeader">Results for <strong>"<?= $user_terms ?>"</strong>:</h1>
        <section class="menu-display">
            <div class="food-wrapper">
        <?php
        //insert a food item for each row in the query
            while (($row = $query->fetch_assoc()) !== null) {
                $item_name = $row['item_name'];
//                $highlighted_chars = [];

                // looping through each term
//                foreach($terms as $term) {
//                    $start_pos = 0;
//                    $term_len = strlen($term);
//                    $term_ranges = [];

                    // getting the ranges for all instances of the term
//                    while ($start_pos <= strlen($item_name)) {
//                        $string_pos = stripos($item_name, $term, $start_pos);
//                        if ($start_pos >= $string_pos and $string_pos != "") {
//                            $string_end_pos = $string_pos + $term_len - 1;
//                            $string_range = ($string_pos . ":" . $string_end_pos);
//                            array_push($term_ranges, $string_range);
//                        }
//                        $start_pos += 1;
//                    }
//
//
//                    $term_char_positions = [];

                    // going through and getting the range values from $term_ranges and putting them into an array
//                    foreach($term_ranges as $range_str) {
//                        $range_vals = explode(":", $range_str);
//                        $start_val = $range_vals[0];
//                        $end_val = $range_vals[1];
//                        $range = range($start_val, $end_val);
//
//                        foreach ($range as $val){
//                            array_push($term_char_positions, $val);
//                        }
//                    }
//
                    // putting the range values into a larger array, only if the position isn't already highlighted
//                    foreach($term_char_positions as $char_position) {
//                        if (!in_array($char_position, $highlighted_chars)) {
//                            array_push($highlighted_chars, $char_position);
//                        }
//                    }
//                }
//
                // creating the new term with the highlighed background for the proper character
//                $term_str = str_split($item_name);
//                $new_name = '';
//                foreach($term_str as $key=>$term_char) {
//                    if (in_array($key, $highlighted_chars)) {
//                        $new_name .= "<span class='search-highlight'>$term_char</span>";
//                    } else {
//                        $new_name .= $term_char;
//                    }
//                }

                $term_char_string = str_replace(" ", '', $user_terms);
                $term_chars = str_split($term_char_string);

                $new_name = '';

                $item_name_chars = str_split($item_name);
                foreach($item_name_chars as $item_char) {
                    if (false !== (stripos($term_char_string, $item_char))) {
                        $new_name .= "<span class='search-highlight'>$item_char</span>";
                    } else {
                        $new_name .= $item_char;
                    }
                }


                echo "<div class='food'>";
                echo "<img src='images/", $row['image'], "' alt='' />";
                echo "<div class='food-text'>";
                echo "<h2>";
                echo $new_name;
                echo "</h2>";
                echo "<h4>", $row['category_name'], "</h4>";
                echo "<p>", $row['description'], "</p>";
                echo "</div>";
                echo "<a href='menu-details.php?id=", $row['item_id'], "'>View Details</a>";
                echo "</div>";
            }
        ?>
            </div>
        </section>
<?php
}

// clean up results and close the connection
$query->close();
$conn->close();
include 'includes/footer.php';
