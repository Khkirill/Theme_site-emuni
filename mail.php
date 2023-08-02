<?php

include 'class-phpmailer.php';
include 'class-smtp.php';
include 'config.php';

$mimetypes = ['pdf', 'doc', 'docx'];


if ((isset($_POST['first-name']) || isset($_POST['name'])) && isset($_POST['form-name']) && isset($_POST['email'])) {
	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->CharSet = 'UTF-8';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPDebug  = 0;
	$mail->SMTPAuth   = true;
	$mail->Username   = SMTP_LOGIN;
	$mail->Password   = SMTP_PASS;
	$mail->From = 'noreply@gmail.com';
	$mail->FromName = 'noreply';

	$mail->AddAddress(MESSAGE_TO);

	$mail->isHTML(true);

	$today = date("F j, Y, g:i a");

	$email = $_POST['email'];
	$broker = $_POST['broker'];
	$first_name = $_POST['first-name'] ?? $_POST['name'];
	$title = $_POST['title'] ?? 'Unknown';
	$country = $_POST['country'] ?? 'Unknown';
	$last_name = $_POST['family-name'] ?? 'Unknown';
	$phone = $_POST['phone'] ?? 'Unknown';
	$services_provider = $_POST['services-provider'] ?? 'Unknown';
	$reference_number = $_POST['reference-number'] ?? 'Unknown';
	$complaint_nature = $_POST['complaint-nature'] ?? 'Unknown';
	$comments = $_POST['comments'] ?? 'Unknown';
	$dispute_lodge = $_POST['dispute-lodge'] ?? 'Unknown';
	$entity_name = $_POST['entity-name'] ?? 'Unknown';
	$website = $_POST['website'] ?? 'Unknown';
	$position = $_POST['position'] ?? 'Unknown';
	$subject_contacts = $_POST['subject'] ?? 'Unknown';
	$message_contacts = $_POST['message'] ?? 'Unknown';


	$avatar = $_POST['file'];
	$subject = 'test from website';


	switch ($_POST['form-name']) {
		case 'membership-form':
			$subject = "Membership form from " . $first_name . ' (' . $today . ')';
			$mail->Subject = $subject;
			$mail->Body = "Entity Name: $entity_name <br> Name: $first_name <br> Phone: $phone <br> Email: $email <br> Website: $website <br> Position: $position <br>";
			break;
		case 'dispute-form':
			$subject = 'Dispute Form from ' . $first_name . ' (' . $today . ')';
			$mail->Subject = $subject;
			$mail->Body = "Dispute lodged?: $dispute_lodge <br> First Name: $first_name <br> Last Name: $last_name <br> Title: $title <br> Country: $country <br> Email: $email <br> Phone: $phone <br> Services Provider: $services_provider <br> Reference Number: $reference_number <br> Compaint Nature: $complaint_nature <br> Comments: $comments <br>";
			break;
		case 'contacts-form':
			$subject = "Contact us Form from" . $first_name . ' (' . $today . ')';
			$mail->Subject = $subject;
			$mail->Body = "Name: $first_name <br> Email: $email <br> Subject: $subject_contacts <br> Message: $message_contacts <br>";
			break;
		case 'education-form':
			$subject = "Traders Education Registration Form from " . $first_name . ' (' . $today . ')';
			$mail->Subject = $subject;
			$mail->Body = "Name: $first_name <br> Email: $email <br> Broker: $broker ";
			break;
		default:
			$subject = 'Default Form from' . $first_name . ' (' . $today . ')';
			$mail->Subject = $subject;
			$mail->Body = "Name: $first_name <br> Email: $email";
			break;
	}

	if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
		try {
			$name = $_FILES['file']['name'];
			$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			if (!in_array($extension, $mimetypes)) {
				throw new Exception("Invalid mimetype of image.");
			}
			$mail->addAttachment($_FILES['file']['tmp_name'], $name);
		} catch (Exception $e) {
			echo json_encode([
				'success' => false,
				'message' => $e->getMessage()
			]);
			exit;
		}
	}

	if (!$mail->Send()) {
		echo json_encode([
			'success' => false,
			'message' => "Server error."
		]);
	} else {
		echo json_encode([
			'success' => true,
			'message' => "Message sent."
		]);
	}
}