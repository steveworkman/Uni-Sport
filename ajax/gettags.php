<?php
include('../inc/picfunctions.inc.php');
include('../inc/connect.inc.php');
include('../inc/unsecure_page.inc.php');
// This is the AJAX function for getting picture tags.
$id = $_POST['pic_id'];
// Really simple, the functions do all this one for us
echo formatTags(getTags($id));
?>