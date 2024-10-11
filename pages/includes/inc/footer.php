<footer class="row">
    <p class="text-center mb-5">
        &copy; 2018 - <?php echo ' ' . date('Y'); ?> Jason Vision
        Technologies
    </p>
</footer>

</div>
<!--/.fluid-container-->
<?php include 'includes/modals/logout.php' ?>
<!-- external javascript -->
<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>
<script src="js/bootstrap.min.js"></script>
<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>
<script src='js/dataTables.bootstrap.min.js'></script>
<script src="js/dataTables/dataTables.buttons.min.js"></script>
<script src="js/dataTables/buttons.print.min.js"></script>

<!-- plugin for gallery image view -->
<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- library for making tables responsive -->
<script src="bower_components/responsive-tables/responsive-tables.js"></script>

<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<script src="js/toastr.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>
<script src="js/sweetalert.js"></script>
<script src="js/invoice.js"></script>
<script src="js/main.js"></script>
<script>
toastr.options = {
    showMethod: "slideDown",
    hideMethod: "slideUp",
    preventDuplicates: true,
    hideDuration: 300
};
</script>
<?php if (Session::exists('success')): ?>
<script>
toastr.success("<?= Session::flash('success') ?>");
</script>
<?php elseif (Session::exists('error')): ?>
<script>
toastr.error("<?= Session::flash('error') ?>");
</script>
<?php endif ?>

</body>

</html>