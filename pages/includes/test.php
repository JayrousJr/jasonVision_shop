<?php
include 'dbh.php';
echo "<pre>";
$my = new mysqli;
print_r($my);

?>
<script>
	//highlight current / active link
    $('ul.main-menu li a').each(function () {
        if ($($(this))[0].href == String(window.location))
            $(this).parent().addClass('juma');
    });
</script>