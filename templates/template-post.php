<?php
$previous_url = wp_get_referer();
$type = $_GET["page"];
echo '<a href="' . admin_url('post-new.php?post_type=my_custom_css_js&type='.$type) . '">Add new '.$type.'</a>';
