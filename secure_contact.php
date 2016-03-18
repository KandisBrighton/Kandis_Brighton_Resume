<?php
//session_start();  Add back later??????
/* Kandis Brighton
  * This php program creates a contact form to add people to a secure database and send an email to my account
 */
ini_set('display_errors',1); // turn on error reporting
error_reporting(E_ALL);
require '../../kresume_db_connection.php';  // require the connection file
?>

     <?php
       $id = NULL;
	   $name = "";
	   $mail = "";
	   $message = "";
	   $email_message = "";
	   $valid = true;
	
       if (isset($_POST['submit']))
	   {
		   $valid=true;
		   
		  // validate name
		  if (!empty($_POST['name']))
		  {
			   $name = $_POST['name'];
			   $name = htmlentities($name);
			 //  echo "in name validation ". $name;
		  }
		  else
		  {
			   echo "<p>Please enter your name.</p>";
         	   $valid = false;
		  }
	 		 
		   // validate name
		  if (!empty($_POST['message']))
		  {
			   $message = $_POST['message'];
			   $message = htmlentities($message);
			//   echo "in message validation " . $message;
		  }
		
		
		  
		  if (!empty($_POST['mail'])) {    //isset($_POST['mail'])) {
			  if (filter_var(($_POST['mail']), FILTER_VALIDATE_EMAIL))
			  {
				  $mail = $_POST['mail'];
				  $mail = htmlentities($mail);
				//  echo "in mail validation " . $mail;
			  }
			  else
			  {
				  echo "<p>Please enter an email.</p>";
				  $valid = false;
			  }	
		  } else {
			  echo "<p>Please enter an email.</p>";
			  $valid = false;
		  }
		  

			
	     //Verify that username and password are valid, and then:
  
				  
		 //Make sure we came from our own server
		 if(!strstr($_SERVER['HTTP_REFERER'], "kbrighton.greenrivertech.net"))
			  die("Invalid Server Request");
		
		 // echo "valid = ". $valid;
		  if ($valid)
		  {
				  // send information by email
				   $to = 'kandisbrighton@gmail.com'; 
				   $subject = 'Message from Resume Contact Form';
				   
				                  
				   $email_message .= $name . "\r\n";
				   $email_message .= $mail . "\r\n";
				   $email_message .= $message . "\r\n";
				   $email_message = wordwrap($email_message, 70);  
				   
				   mail($to, $subject, $email_message); //, "From: " . $mail);

		  	      // Prevent SQL Injection  -- DO THIS!!!!!!!!!! Escapes anything that might cause a problem
				   $name = mysqli_real_escape_string($cnxn,$name);
				   $mail = mysqli_real_escape_string($cnxn,$mail);
				   $message = mysqli_real_escape_string($cnxn,$message);
				   $sql = "INSERT INTO Contact_DB (name, mail, message) VALUES ('$name','$mail', '$message')";
				  
				   $result = @mysqli_query($cnxn, $sql);
				 
				   if (!$result) {
					  echo "<p>Error: ". mysqli_error($cnxn) . "</p>";
					} else {
					   ?>
					      <script>alert("Thank you for contacting me!");</script>
					   <?php
					  // return;
					}
		  
		  } else {
			?>
			<script>alert("Contact form incomplete, please try again.");</script>
			<?php
		  }	
	   }
    ?>
	                     <!--Contact form HTML-->
                         <div class="contact_form">

                            <form method="post" class="contact-form" name="contact_form" action=""> <!--contact_form.php">-->
                              <div class="row">
                                <div class="col-md-5">
                                  <div class="form_input">
                                    <i class="fa fa-user"></i>
                                    <input type="text" name="name" class="name" placeholder="Your Name"
										    <?php 	if (!empty($_POST['name']))  { echo 'value="'. htmlentities($_POST['name']) . '"'; } ?>
										   > 
                                  </div>
                                  <div class="form_input">
                                    <i class="fa fa-envelope"></i>
				
									<!--  <label for="email">email</label>-->
                                      <input type="email" name="mail" class="mail" placeholder="Email"  
									    <?php 	if (!empty($_POST['mail']))  { echo 'value="'. htmlentities($_POST['mail']) . '"'; } ?>
										>  
                                  </div>

								</div>
                                <div class="col-md-7">
                                  <div class="form_input">
                                    <i class="fa fa-comment"></i>
                                    <textarea placeholder="Message" name="message" class="message">
									     <?php 	if (!empty($_POST['message']))  { echo htmlentities($_POST['message']); } ?>
                                    </textarea>
                                  </div>
                                  <input type="submit" name="submit" id="submit" value="submit">
                                </div>
                              </div>
                            </form>

                          </div>
                          <!-- // Contact Form -->	
	
<?php
  //mysqli_close($cnxn);
 ?>