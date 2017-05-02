<?php
require_once "inc/page_setup.php";
$db = new Database();
$pgTitle = "Home";
include ('inc/header.php');
include ('inc/nav.php');
?>

</head>

<!-- Start contents of main page here. -->

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Edit Comment</h1>
		</div>
	</div>
	<div class ="row">
		<div class="col-xs-3"></div>
		<div class="col-xs-6" align="center">
      <?php if(isset($_POST['id'])){
        $new_id = $_POST['id'];
        $new_comment = $_POST['comment'];
        $new_ingid = $_POST['ing_id'];
        $new_userid = $_POST['user_id'];
        $new_timestamp = $_POST['timestamp'];
        $new_oip = $_POST['originating_ip'];
        /*echo "POST['id'] is set to $new_id!! ";
        echo "POST['comment'] is set to $new_comment!! ";
        echo "POST['ing_id'] is set to $new_ingid!! ";
        echo "POST['user_id'] is set to $new_userid!! ";
        echo "POST['timestamp'] is set to $new_timestamp!! ";
        echo "POST['originating_ip'] is set to $new_oip!! ";*/
        $comment = new Comment();
        $comment->id = $new_id;
        $comment->ing_id = $new_ingid;
        $comment->comment_text = $new_comment;
        $comment->user_id = $new_userid;
        $comment->timestamp = $new_timestamp;
        $comment->originating_ip = $new_oip;
        $result = $db->updateComment($comment);
        if($result){
          echo '<div class="bg-success" style="padding:12px; margin-bottom:20px;">';
          echo '<h4>Comment Updated</h4>';
          echo '</div>';
        }
      }else{
        $comment = $db->getCommentDetails($_GET['id']);
        //echo '#comment [';
        //print_r($comment);
        // echo ']'
        ?>

        <form class="form-horizontal" method="post">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="rank">Comment</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="comment" id="comment"
								value="<?php echo $comment['comment_text'] ?>" />
						</div>
					</div>

					<input type="hidden" name="id" value="<?php echo $comment['id']; ?>" />
          <input type="hidden" name="ing_id" value="<?php echo $comment['ing_id']; ?>" />
          <input type="hidden" name="user_id" value="<?php echo $comment['user_id']; ?>" />
          <input type="hidden" name="timestamp" value="<?php echo $comment['timestamp']; ?>" />
          <input type="hidden" name="originating_ip" value="<?php echo $comment['originating_ip']; ?>" />
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default">Save</button>
						</div>
					</div>
				</form>

      <?php } ?>
		</div>
		<div class="col-xs-3"></div>
	</div>
</div>


<!-- End of contents -->
<?php include('inc/footer.php'); ?>