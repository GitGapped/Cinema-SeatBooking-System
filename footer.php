<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Your Page Title</title>
    <!-- Bootstrap CSS with dark theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Remove underline on hover for links in the footer */
        .footer-links a:hover {
            text-decoration: none;
        }
    </style>
</head>
<body class="bg-dark text-light">

<footer class="bg-dark text-light mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>Contact Us</h4>
                <p>Email: info@example.com</p>
                <p>Phone: +1 123-456-7890</p>
            </div>
            <div class="col-md-4">
                <h4>Quick Links</h4>
                <ul class="list-unstyled footer-links">
                    <li><a href="privacy_policy.php">Privacy Policy</a></li>
                    <li><a href="terms_of_service.php">Terms of Service</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>Follow Us</h4>
                <ul class="list-inline footer-links">
                    <li class="list-inline-item"><a href="#" target="_blank">Facebook</a></li>
                    <li class="list-inline-item"><a href="#" target="_blank">Twitter</a></li>
                    <li class="list-inline-item"><a href="#" target="_blank">Instagram</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <p>&copy; <?php echo date("Y"); ?> Your Brand. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Bootstrap JS and Popper.js (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- JavaScript to adjust footer position -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        function adjustFooterPosition() {
            var body = document.body;
            var html = document.documentElement;

            var height = Math.max(
                body.scrollHeight,
                body.offsetHeight,
                html.clientHeight,
                html.scrollHeight,
                html.offsetHeight
            );

            var viewportHeight = window.innerHeight;

            if (height < viewportHeight) {
                document.querySelector("body").style.minHeight = "100%";
                document.querySelector("footer").style.position = "fixed";
                document.querySelector("footer").style.bottom = "0";
                document.querySelector("footer").style.width = "100%";
            } else {
                document.querySelector("body").style.minHeight = "auto";
                document.querySelector("footer").style.position = "static";
            }
        }

        // Initial adjustment on page load
        adjustFooterPosition();

        // Adjust the footer position on window resize
        window.addEventListener("resize", adjustFooterPosition);
    });
</script>

</body>
</html>
