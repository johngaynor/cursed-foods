<?php
// include the header and database
include 'includes/header.php';
include 'includes/database.php';

?>

    <section class="contact-form">
        <h1>Get in Touch!</h1>
        <form action="index.php">
            <div class="contact-holder">
                <i class="fa-solid fa-user user-icon"></i>
                <input type="text" placeholder="Full Name" required>
            </div>
            <div class="contact-holder">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" placeholder="Email" required>
            </div>
            <div class="contact-holder">
                <i class="fa-solid fa-phone"></i>
                <input type="text" placeholder="Phone Number" required>
            </div>
            <div class="comment-holder">
                <i class="fa-solid fa-comment"></i>
                <textarea placeholder="Comment" required></textarea>
            </div>
            <div class="prod-button-wrapper">
                <button class="item-submit">Submit</button>
                <button class="item-cancel" type="button" onclick="window.location.href='index.php'">Cancel</button>
            </div>
        </form>
    </section>
<?php
include 'includes/footer.php';