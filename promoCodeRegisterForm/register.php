<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	var_dump($_POST);
	$firstName = trim(filter_input(INPUT_POST,"firstName",FILTER_SANITIZE_STRING));
	$lastName = trim(filter_input(INPUT_POST,"lastName",FILTER_SANITIZE_STRING));
	$email = trim(filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL));
	
	if ($firstName == "" || $lastName == "" || $email == "") {
		echo "Please fill in the all the fields.";
		exit;
	}
	if ($_POST["address"] != "") {
		echo "Bad form input";
		exit;
	}
	
	require("inc/PHPMailer/class.phpmailer.php");
	require("inc/PHPMailer/class.smtp.php");
	
	$mail = new PHPMailer();
	
	if (!$mail->ValidateAddress($email)) {
		echo "Invalid Email Address";
		exit;
	}
	
	

	echo "First Name: " . $firstName . "<br />";
	echo "Last Name: " . $lastName . "<br />";
	echo "Email: " . $email . "<br />";

	echo "<pre>";
	echo "\n";
	$email_body = "";
	$email_body .= "First Name: " . $firstName . "\n";
	$email_body .= "Last Name: " . $lastName . "\n";
	echo "Send email to: " . $email_body;
	echo "</pre>";

	//Send email
	$mail->isSMTP();	// Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->SMTPDebug = 2;
	$mail->Username = 'bebetterjenny@gmail.com';                 // SMTP username
	$mail->Password = 'sharlin1991821';                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to

	//To client
	$mail->setFrom('bebetterjenny@gmail', 'Jenny');
	$mail->addAddress($email, $firstName);     // Add a recipient
	$mail->addBCC('bebetterjenny@gmail.com');

	$mail->isHTML(false);                                  // Set email format to HTML

	$mail->Subject = 'NewShop Promo Code For ' . $firstName;
	$mail->Body    = $email_body . "\nThis is your promo code. Feel free to shop in NewShop.com!";
	
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		exit;
	} 
	
	//To Company
	

	header("location:register.php?status=thanks");
}


$pageTitle = "Register";

include("inc/header.php");

?>

<div>
	<h1>Register For Promo Code Here</h1>
	
	
	<?php
		if (isset($_GET["status"]) && $_GET["status"] =="thanks") {
			echo "<p>Thank you for your participation. We have sent the promo code to your email, please check!</p>";
		} else {
		?>

	
	<form method="post" action="register.php">
		<table>
			<tr>
				<th><label for="firstName">First Name</label><th>
				<td><input type="text" id="firstName" name="firstName" /></td>
			</tr>
			<tr>
				<th><label for="lastName">Last Name</label><th>
				<td><input type="text" id="lastName" name="lastName" /></td>			
			</tr>
			<tr>
				<th><label for="email">E-mail</label><th>
				<td><input type="text" id="email" name="email" /></td>			
			</tr>
			<tr style="display:none">
				<th><label for="address">Address</label><th>
				<td><input type="text" id="address" name="address" /></td>			
			</tr>
		</table>
			<input type="submit" value="Submit" />
	</form>
	<?php
		}
	?>
</div>

<?php
include("inc/footer.php");
?>