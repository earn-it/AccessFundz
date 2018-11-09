<?php include("adminheader.php"); error_reporting(0);

if(isset($_REQUEST["edit"])){
	$q = mysqli_query($conn,"select * from info where id='$_REQUEST[edit]'");
	$i = mysqli_fetch_assoc($q);
	
	$_SESSION["d"] = $i["id"];
	
}
?>
 <div id="page-wrapper" >
 <div id="page-inner">
 <div class="row">
  <div class="col-md-12">
     <?php if(!isset($_POST['submit'])){ ?>
     <h2>Post Information to Access Fundz Office</h2> 
     <?php } ?>  
    </div>
  </div> 
 <?php if(!isset($_POST['submit'])){ ?>
 <div class="col-md-10">
<form ENCTYPE="multipart/form-data" action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method='post' accept-charset='UTF-8'>
<table width='300' height='auto' cellspacing="20" align="right" class="table table-hover" >
<tr>
<td>Info Topic: <input type='text' value='<?php echo$i["topic"]; ?>' name='topic' class="form-control" value='' size='90'/></td>
</tr>
<tr>
<td>Info Text: <br />
<textarea id="trump" rows='30' cols='80' class="form-control" name='text'><?php echo$i["text"]; ?></textarea></td>
</tr>


<tr>
<td align='center'>
<input type='submit' name='submit' class="btn btn-danger" value='PUBLISH NOW' />
</td>
</tr>

</table>
</td>
</tr>
</table>
</form>
</div>
<?php }

if(isset($_POST['submit']))
{
	
	if($_POST['topic'] != "" && $_POST['text'] !="")
	{	//save data to database
		include("../temp/database.php");
	
		
		
		//create table
						
		$sql= "	Create Table if not exists info (id VARCHAR(50),
				topic VARCHAR( 253 ) NOT NULL,
				link VARCHAR( 253 ),
				text TEXT,
				imageurl VARCHAR(100),
				date VARCHAR (200),
				PRIMARY KEY ( id )
				)";
		// Execute query
		if (!mysqli_query($conn,$sql)) {
					echo "Error creating table: " . mysqli_error($conn);
		}
		else
		{
		// escaping variables for security
			date_default_timezone_set('GMT');
			$id = time();
			$text = mysqli_real_escape_string($conn,$_POST['text']);
			$topic = ucwords(mysqli_real_escape_string($conn,$_POST['topic']));
			$topic2 = preg_replace('/[^a-z]+/i', '', $topic);
			$current_date = date('jS \of F, Y');
			
		$tobedeleted = $topic2;
		$deleted = unlink("../".$tobedeleted.".php");
		$delquery = mysqli_query($conn,"DELETE from info where `topic`='$topic' and link='$topic2'");
					
			if(!$conn)
			{
			  die('Could not connect:' . mysqli_error());
			}
			
			$file_upload="true";
			$file_up_size=$_FILES['file_up'][size];
			if ($_FILES['image']['size']>25000000){$msg=$msg."Your uploaded file size is more than 2500KB
	 		so please reduce the file size and then upload.<BR>";
			$file_upload="false";}
			$type = end(explode('.', strtolower($_FILES[image][name])));
			$allowtype = array("jpg","png","gif","jpeg");
			if (in_array($type, $allowtype))
			{
				$add = "upload/$id/$id".".$type";
			}
			else
			{$msg=$msg."BUT NO PICTURE WAS UPLOADED<BR>";
			$file_upload="false";}
			if($file_upload=="true")
			{
				if(!is_dir("upload")){  mkdir("upload"); }
				if(!is_dir("upload/$id")){ mkdir("upload/$id"); }
				if(move_uploaded_file ($_FILES[image][tmp_name], $add)){
					echo "<span class='data-reg'><br/> <center><img src='$add' style='text-align: center' height='auto' width='500'></center>";
				// do your coding here to give a thanks message or any other thing.
				}
				else{echo "Failed to upload file Contact Site admin to fix the problem";}
			}
			else{echo $msg;}
			$time = $id;
			for($key = 0;$key < count($_FILES['images']['name']); $key++)
			{
				
				$file_upload="true";
				if ($_FILES[image][size][$key]>2500000){$msg=$msg."Your uploaded file size is more than 2500KB
 				so please reduce the file size and then upload.<BR>";
				$file_upload="false";}
				$time++;
				$type = end(explode('.', strtolower($_FILES[images][name][$key])));
				$allowtype = array("jpg","png","gif","jpeg","mp4","3gp","mp3","pdf");
				if (in_array($type, $allowtype))
				{
					$add = "upload/$id/$time".".$type";
					echo $add; echo "<br> <br> ";
				}
				else
				{
					echo $type;
					$msg=$msg."Your uploaded file must be of JPG,png or GIF. Other file types are not allowed<BR>";
					$file_upload="false";
				}
				if($file_upload=="true")
				{
					if(move_uploaded_file ($_FILES[images][tmp_name][$key], $add)){
						echo "<span class='data-reg'>Picture Uploaded --> $add!--> \n <br> <br>";
					// do your coding here to give a thanks message or any other thing.
					}
					else{echo "err?error  Failed to upload file Contact Site admin to fix the problem";}
				}
				else{echo $msg;}
		
			}
		
			$sql = "INSERT INTO `info` (id, topic, link, text, imageurl, date) values ('$id', '$topic', '$topic2', '$text', 'admin/$add', '$current_date')";
		
			$retval = mysqli_query($conn,$sql);
			if(! $retval )
			{
			  die("<span class='data-reg'>Failed to insert into Database $topic");
			}
			echo "<br clear='all'><br><span class='btn btn-success form-control'>Post has been sent to the blog successfully!!<br>";
				
			if(! $conn )
			{
			  die('Could not connect:' . mysqli_error());
			}
	
		$head = "";
		$body = "<?php error_reporting(0);
        include(\"database.php\");
        \$query = \"SELECT * FROM info where id='$id'\";
		\$result = mysqli_query(\$query); 
		if(!\$result){
			(\"Could not download data\");
		}
		\$blog = mysqli_fetch_array(\$result);
		
		\$query = \"SELECT * FROM comments where `id`='$id' ORDER BY time DESC\";
		\$result1 = mysqli_query(\$query); 
		\$result2 = mysqli_query(\$query); 
		\$result3 = mysqli_query(\$query);
		\$comments2 = mysqli_fetch_array(\$result3);
		\$com_row = mysqli_num_rows(\$result1);
	     	
?>

<!DOCTYPE html>
<html lang=\"en\">
  <head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"description\" content=\"Developed By M Abdur Rokib Promy\">
    <meta name=\"author\" content=\"cosmic\">
    <meta name=\"keywords\" content=\"Bootstrap 3, Template, Theme, Responsive, Corporate, Business\">
    <link rel=\"shortcut icon\" href=\"img/favicon.png\">

    <title>Blog | <?php echo \$blog[\"topic\"]; ?></title>


<?php include(\"header.php\"); ?>

<div class=\"breadcrumbs\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-lg-4 col-sm-4\">
                    <h1 style='text-trasform: Capitalize !important;'><?php echo \$blog[\"topic\"]; ?></h1>
                </div>
                <div class=\"col-lg-8 col-sm-8\">
                    <ol class=\"breadcrumb pull-right\">
                        <li><a href=\"#\">Home</a></li>
                        <li><a href=\"#\">Blog</a></li>
                        
                    </ol>
                </div>
            </div>
        </div>
    </div>


	
	<div class=\"container\">
      <div class=\"row\">
	   <div class=\"col-lg-9\">
          <div class=\"blog-item\">
            <div class=\"row\">
              <div class=\"col-lg-2 col-sm-2\">
                <div class=\"date-wrap\">
                  <span class=\"date\">
                   <?php echo date(\"d\", \$blog[\"id\"]); ?>
                  </span>
                  <span class=\"month\">
                   <?php echo date(\"F\", \$blog[\"id\"]); ?>
                  </span>
                </div>

              </div>
              <div class=\"col-lg-10 col-sm-10\">


                <div class=\"blog-img gs\">
                  <?php echo\"<img src='\$blog[imageurl]' alt='image'/>\"; ?>
                </div>

              </div>
            </div>
            <div class=\"row\">
              <div class=\"col-lg-2 col-sm-2 text-right\">
                <div class=\"author\">
                  By
                  <a href=\"#\">
                    Apex
                  </a>
                </div>
                <ul class=\"list-unstyled\">
                  <li>
                    <a href=\"javascript:;\">
                      <em>
                        <?php echo date(\"jS\", \$blog[\"id\"]); ?>
                      </em>
                    </a>
                  </li>
                  <li>
                    <a href=\"javascript:;\">
                      <em>
                       <?php echo date(\"\of F\", \$blog[\"id\"]); ?>
                      </em>
                    </a>
                  </li>
                  <li>
                    <a href=\"javascript:;\">
                      <em>
                        <?php echo date(\"Y\", \$blog[\"id\"]); ?>
                      </em>
                    </a>
                  </li>
                  <li>
                    <a href=\"javascript:;\">
                      <em>
                        <?php echo date(\"h:i a\", \$blog[\"id\"]); ?>
                      </em>
                    </a>
                  </li>
                </ul>
                <div class=\"st-view\">
                  <ul class=\"list-unstyled\">
                   
                    <li>
                      <a href=\"javascript:;\">
                        <?php echo \$com_row; ?> comments
                      </a>
                    </li>

                  </ul>
                </div>
              </div>
              <div class=\"col-lg-10 col-sm-10\">
                <h1>
                  <a href=\"blog_detail.html\">
                    <?php echo \"\$blog[topic]\"; ?>
                  </a>
                </h1>
                <div class=\"textstyle\">
				<p>
				<?php echo \"\$blog[text]\"; ?>
                </p>
                </div>
                <div class=\"media\">
                  <h2 class=\"background\">
                    Comments
                  </h2>
                
                </div>
				<?php
			\$msg = '';
			if(\$_REQUEST[\"err\"])
			{
				switch(\$_REQUEST[\"err\"])
				{
					case \"success\":
					{ \$msg = \"<div class='alert alert-success'>Your comment was posted successfully! <button class='close' data-dismiss='alert'>X</button></div>\";
					break; 
					}
					case \"error\":
					{ \$msg = \"<div class='success-upload'>Comment Not Posted!</div>\";
					break; 
					}
				}
			}
			echo \$msg;
?>	
				<hr>
				<?php 
				
				while(\$comments = mysqli_fetch_array(\$result1)) {
				
				?>
                <div class=\"media\">
                  <a class=\"pull-left\" href=\"javascript:;\">
                    
					<?php
						\$imagesDir = 'avatars/';

						\$images = glob(\$imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

						\$randomImage = \$images[array_rand(\$images)];

						echo \"<img src='\$randomImage'  class='media-object' style='border: 1px solid rgba(0,0,0,0.2); border-radius: 5px; padding: 4px; display: inline-block;  max-width: 50px; max-height: 50px; ' />\";
						
						?>
                  </a>
                  <div class=\"media-body\">
                    <h4 class=\"media-heading\" style=\"font-size: 12px; font-weight: bold;\">
                      <?php \$nameupper = ucwords(strtolower(\$comments['name'])); echo \"\$nameupper\"; ?>
                      <span>
                        |
                      </span>
                      <span>
                        <?php echo date(\"d-M-y, h:i a\", \$comments[\"id\"]); ?>
                      </span>
                    </h4>
                    <p style=\"font-size: 12px;\">
                      <?php echo \"\$comments[comments]\"; ?>
                    </p>
                   
                  </div>
                </div>
				<hr>
				<?php } ?>
                <div class=\"post-comment\">
                  <h3 class=\"skills\">
                    Post Comments
                  </h3>
                   <form  class=\"contact-form\" name=\"contact-form\" method=\"post\" action=\"admin/cprocess.php\" role=\"form\">
                                <div class=\"row\">
                                    <div class=\"col-sm-5\">
                                        <div class=\"form-group\">
                                            <label>Name *</label>
                                            <input type=\"text\" name=\"name\" style='color: #000; border-color: rgba(0,0,0,0.3);' class=\"form-control\" required=\"required\">
                                        </div>
                                        <div class=\"form-group\">
                                            <label>Email *</label>
                                            <input type=\"email\" name=\"email\" style='color: #000; border-color: rgba(0,0,0,0.3);'  class=\"form-control\" required=\"required\">
                                        </div>
                                   <input type='hidden' name='id' value='$id'/>  
									<input type='hidden' name='topic' value='$topic' /> 								   
                                    </div>
                                    <div class=\"col-sm-7\">                        
                                        <div class=\"form-group\">
                                            <label>Comment *</label>
                                            <textarea name=\"comment\" id=\"message\" style='color: #000; border-color: rgba(0,0,0,0.3);' required=\"required\" class=\"form-control\" rows=\"8\"></textarea>
                                        </div>                        
                                        <div class=\"form-group\">
                                            <button type=\"submit\" name=\"comment_submit\"class=\"btn btn-primary btn-lg\" required=\"required\">Submit Message</button>
                                        </div>
                                    </div>
                                </div>
                </form> 
                </div>

              </div>
            </div>
          </div>

        </div>
		
		    <div class=\"col-lg-3\">
          <div class=\"blog-side-item\">
            <div class=\"search-row\">
              <input type=\"text\" class=\"form-control\" placeholder=\"Search here\">
            </div>
            
			<?php \$latest = mysqli_query(\"select * from info where id!='\$blog[id]' and text LIKE '%\$blog[text]' order by id DESC limit 15\"); 
					
			?>
            <div class=\"blog-post\">
              <h3>
                Similar Blog Posts
              </h3>
			  <hr>
			  <?php while(\$post = mysqli_fetch_assoc(\$latest)){  ?>
                <div class=\"media\">
                <a class=\"pull-left gs\" href=\"<?php echo\"./\$post[link].php\"; ?>\">
                  <?php echo\"<img src='\$post[imageurl]' height='auto' width='50' alt='image'/>\"; ?> 
                </a>
                <div class=\"media-body\">
                  <h5 class=\"media-heading\">
                    <a href=\"<?php echo\"./\$post[link].php\"; ?>\" style='font-size: 10px;'>
                      <?php echo date(\"D m Y, h:i a\", \$post[\"id\"]); ?>
                    </a>
                  </h5>
				  <a href=\"<?php echo\"./\$post[link].php\"; ?>\" style=\"font-weight: bold;\">
                  <p>
                    <?php \$sub = \$post[\"topic\"]; echo\"\$sub\";?>
                  </p>
				  </a>
				
                  </p>
                </div>
              </div>
			  <hr>
			  <?php } ?>
             


          </div>
        </div>
		
	</div>
	</div>
	
	<!------------------------------------------------------------------------------------------------------------------------>
   

   </div><!--/.blog-->";
				$foot = "<?php include(\"footer.php\"); ?>";
					
					$file = "../".$topic2.".php";
					
					if(!file_exists($file))
					{
						$fh = fopen($file,"w");
						fwrite($fh,"$head\n");
						fwrite($fh,"$body\n");
						fwrite($fh,"$foot\n");
						fclose($fh);
					}
				
		
		
		
		}
		
	}
}



?>
 </div>
 </div>
			
			
			



<?php include("adminfooter.php"); ?>





