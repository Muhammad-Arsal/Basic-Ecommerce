<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<script>
    $(function() {

        setInterval(function() {
            $.ajax({
                type: 'post',
                url: "notification_getter.php",
                success: function(response) {
                    $(".show_number").text(response);
                    $("#menu").empty();
                    for ($i = 1; $i <= response; $i++) {
                        $("#menu").append('<a href="./orders.php"><span class="dropdown-item dropdown-header new_notification">***1 new order***</span></a>')
                    }
                }
            });
        }, 5000)

        $("#noti").focusout(function() {
            $.ajax({
                type: 'post',
                url: 'notification_delete.php',
                success: function(response) {
                    $(".show_number").text(response);
                    $("#menu").empty();
                }
            });
        });
    });
</script>