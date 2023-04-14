<?php

// if sort_by cannot be found, terminate script.
if (!filter_has_var(INPUT_POST, 'sort_by')) {
    $error = "Filter not found. Operation cannot proceed.<br><br>";
    header("Location: error.php?m=$error");
    die();
}

