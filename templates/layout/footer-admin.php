<?php
if (defined('_INCODE') != 1) {
    die('Access Denied');
}

?>
<!-- Footer -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const header = document.getElementById('header');
            const mainContent = document.getElementById('mainContent');
            const footer = document.getElementById('footer');

            sidebar.classList.toggle('collapsed');
            header.classList.toggle('collapsed');
            mainContent.classList.toggle('collapsed');
            if (footer) {
                footer.classList.toggle('collapsed');
            }
        }

        // Accordion functionality
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="user_manager\templates\js\bootrap.min.js"></script>
<script type="text/javascript" src="user_manager\templates\js\custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl1xI7L4rx0Vn2GMblWlD37x5rH1u5hFozW90QF" crossorigin="anonymous"></script>
</body>

</html>