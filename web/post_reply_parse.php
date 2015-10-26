<?php
session_start();
/*file to process the reply*/
if ($_SESSION['username']) {
	if (isset($_POST['reply_submit'])) {

		echo "Reply submit running<br>";
		
		include_once("connect.php");
		$creator = $_SESSION['username'];
		$cid = $_POST['cid'];
		$tid = $_POST['tid'];
		$reply_content = $_POST['reply_content'];
		
		
	$filetmp = $_FILES["file_img"]["tmp_name"];
    $filename = $_FILES["file_img"]["name"];
	$filetype = $_FILES["file_img"]["type"];
	$filepath = "photo/".$filename;
			
	move_uploaded_file($filetmp, $filepath);
		
		$sql = "INSERT INTO posts (category_id, topic_id, post_creator, post_content, post_date, img_name,img_path,img_type) VALUES ('".$cid."', '".$tid."', '".$creator."', '".$reply_content."', now(), '".$filename."', '".$filepath."','".$filetype."');";
			
		echo $sql;
		
			$result = mysql_query($sql);
	
	}
		$res = mysql_query($sql) or die(mysql_error());
		$sql2 = "UPDATE categories SET last_post_date=now(), last_user_posted='".$creator."' WHERE id='".$cid."' LIMIT 1";
		$res2 = mysql_query($sql2) or die(mysql_error());
		$sql3 = "UPDATE topics SET topic_reply_date=now(), topic_last_user='".$creator."' WHERE id='".$tid."' LIMIT 1";
		$res3 = mysql_query($sql3) or die(mysql_error());

		/*email sending*/

		if (($res) && ($res2) && ($res3)) {
			echo "<p>Your reply has been successfully posted. <a href='view_topic.php?cid=".$cid."&tid=".$tid."'>Click here to return to topic</a></p>";
		} else {
			echo "<p>There was a problem with posting your reply. Try again later.</p>";
		}
	} else {
	exit();
}
?>