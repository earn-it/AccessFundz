<?php $body="<?php error_reporting(0);
        include(\"database.php\");
        \$query = \"SELECT * FROM info where id='$id'\";
		\$result = mysql_query(\$query); 
		if(!\$result){
			(\"Could not download data\");
		}
		\$blog = mysql_fetch_array(\$result);
		
		\$query = \"SELECT * FROM comments where `id`='$id' ORDER BY time DESC\";
		\$result1 = mysql_query(\$query); 
		\$result2 = mysql_query(\$query); 
		\$result3 = mysql_query(\$query);
		\$comments2 = mysql_fetch_array(\$result3);
		\$com_row = mysql_num_rows(\$result1);
	     	
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
				
				while(\$comments = mysql_fetch_array(\$result1)) {
				
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
            
			<?php \$latest = mysql_query(\"select * from info where id!='\$blog[id]' order by id DESC limit 15\"); 
					
			?>
            <div class=\"blog-post\">
              <h3>
                Latest Blog Posts
              </h3>
			  <hr>
			  <?php while(\$post = mysql_fetch_assoc(\$latest)){  ?>
              <div class=\"media\">
                <a class=\"pull-left gs\" href=\"javascript:;\">
                  <?php echo\"<img src='\$post[imageurl]' height='50' width='50' alt='image'/>\"; ?> 
                </a>
                <div class=\"media-body\">
                  <h5 class=\"media-heading\">
                    <a href=\"javascript:;\" style='font-size: 10px;'>
                      <?php echo date(\"D m Y, h:i a\", \$post[\"id\"]); ?>
                    </a>
                  </h5>
                  <p>
                    <?php \$sub = substr(\$post[\"text\"], 0, 30); echo\"\$sub...\";?>
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
   

   </div><!--/.blog-->
   ";?>