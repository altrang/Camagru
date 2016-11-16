<?php
require_once('config/startup.php');
session_start();
require_once("redirect.php");
include("header.php");
include('connection/sendmail3.php');


if (!$sql_co = startup())
	echo "ERROR";

$json = file_get_contents('php://input');

$img_id = $_GET['id'];
$user_id = $_SESSION['id'];
$_SESSION['img_id'] = $img_id;
$_SESSION['user_id'] = $user_id;
$login = $_SESSION['login'];

$req = $sql_co->prepare("SELECT * FROM likes WHERE user_id = ? AND img_id = ? ");
$req->execute(array($user_id, $img_id));
$result = $req->rowCount();

$req4 = $sql_co->prepare("SELECT * FROM likes WHERE img_id = ? ");
$req4->execute(array($img_id));
$nbrlike = $req->rowCount();

$req1 = $sql_co->prepare("SELECT comment FROM comment WHERE img_id = ?");
$req1->execute(array($img_id));
$com_res = $req1->rowCount();


$req2 = $sql_co->prepare("SELECT * from images WHERE login = ? AND id = ? ");
$req2->execute(array($login, $img_id));
$delete = $req2->rowCount();
$_SESSION['delete'] = $delete;
 ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<title></title>
	</head>
	<body>
		<div id="solo_photo">
		<?php
		$req = $sql_co->prepare('SELECT img FROM images WHERE id = "' . $_GET["id"] . '"');
		$req->execute(array());
		$photo = $req->fetch();
		echo "<img src=" . $photo[0] . ">";
		?>
		<?php if ($delete == 0){
		?>
		<br />
			<div id="delete_pic">
				<form action="delete_pic.php">
				<input type="submit" value="SUPPRIMER" style="display:none;">
			</form>
			</div>
			<br />
		<?php }
		else {
		?>
		<br />
		<div id="delete_pic">
			<form action="delete_pic.php">
			<input type="submit"  value="supprimer">
		</form>
		</div>
		<br />
		<?php } ?>
		<?php	if ($result == 0){
		?>


			<!-- <form method="POST" action=""> -->
				<div id="id" style="display:none;" value="<?php echo $login ?>" ><?php echo $result?></div>
				<div id="like">
					<input type="button" onclick="likedd(this)"  name="liked" id="liked"    style="background-color:pink;" >
				</div>
		<?php }
		else {
		?>
				<div id="id" style="display:none;" value="<?php echo $login ?>" ><?php echo $result?></div>
				<div id="unlike">
				<input type="button" onclick="likedd(this)" name="liked" id="liked"  style="background-color:green;"></div>
		<?php } ?>
			<!-- </form> -->
			<?php
			if ($com_res == 0){
			?>
			<br />
			<div> No comment , Be the first to comment this </div>
			<?php
			}
			else{
				$req1 = $sql_co->prepare("SELECT login,comment,date_creation FROM comment WHERE img_id = ?");
				$req1->execute(array($img_id));
				while ($fetch = $req1->fetch())
				{
					echo '<div id="comment">' .$fetch[0]. ':   ' . $fetch[1] . $fectch[2].'</div>';
				}
			}
			 ?>
			<div id="com_text">
				<form name="comment" method="post" action="solo.php?id=<?php echo $img_id ?>">
					<input type ="text" style="display:none;" name="aa" value="<?php echo $login ?>">
					<input type="text" name="comment">
					<input type="submit" onclick="commenti(this.id)" name="send" value="Send">
				</form>
				<br /><br />
				<g:plusone size="small"></g:plusone>
				<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical" data-via="InfoWebMaster">Tweet</a>
				<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
				<script type="text/javascript" src="http://platform.linkedin.com/in.js"></script>
				<script type="in/share" data-counter="right"></script>

			</div>
			<div>
			</div>
				<script src="js/comment.js"></script>
				<script src="js/like.js"></script>
				<script type="text/javascript" src="https://apis.google.com/js/plusone.js">

{lang: 'fr'}
</script>

</div>
	</body>
</html>
