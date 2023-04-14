<?php
include ('includes/header.php');
?>
    <h2>Search Books by Title</h2>
    <p>Enter one or more words in book title.</p>
    <form action="searchbookresults.php" method="get">
        <input type="text" name="terms" size="40" required />&nbsp;&nbsp;
        <input type="submit" name="Submit" id="Submit" value="Search Book" />
    </form>
<?php
include ('includes/footer.php');

