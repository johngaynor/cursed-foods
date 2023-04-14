<?php
include ('includes/header.php');
?>
    <h2 style="margin-top: 25px">Search Items by Title</h2>
    <p style="margin-bottom: 15px">Enter one or more words in item title.</p>
    <form action="searchitemresults.php" method="get">
        <input type="text" name="terms" size="40" required />&nbsp;&nbsp;
        <input type="submit" name="Submit" id="Submit" value="Search Item" class="search-back"/>
    </form>
<?php
include ('includes/footer.php');

