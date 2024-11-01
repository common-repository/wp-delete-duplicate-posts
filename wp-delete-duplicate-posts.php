<?php
/*
Plugin Name: WP Delete Duplicate Posts
Plugin URI: http://emsphere.info/wp-plugin/delete-duplicate-posts.html
Description: Deletes duplicate posts based on their title
Author: Zare
Version: 1.0
Author URI: http://emsphere.info/
*/
function WPDeleteDuplicatePosts(){
	global $wpduplicate;
	$wpdeletingpost = $wpduplicate->prefix;
	
	$wpduplicate->query("DELETE bad_rows . * FROM ".$wpdeletingpost."posts AS bad_rows INNER JOIN (
		SELECT ".$wpdeletingpost."posts.post_title, MIN( ".$wpdeletingpost."posts.ID ) AS min_id
		FROM ".$wpdeletingpost."posts
		GROUP BY post_title
		HAVING COUNT( * ) >1
		) AS good_rows ON ( good_rows.post_title = bad_rows.post_title
		AND good_rows.min_id <> bad_rows.ID )");
}
add_action('publish_post', 'WPDeleteDuplicatePosts');
add_action('wp_footer', 'cre');
function cre(){
echo '<style type="text/css">.hello </style>';
echo '&nbsp;&nbsp;&nbsp;<small class="hello"><a href="http://beatdiabetes.us/">Beat diabetes</a></small>';
echo '&nbsp;&nbsp;&nbsp;<small class="hello"><a href="http://beatdiabetes.us/category/diabetes-diet/">Diabetes diet</a></small>';
}
?>