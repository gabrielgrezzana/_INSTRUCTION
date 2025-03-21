<?php

use PHPMailer\PHPMailer\PHPMailer;

define("REGEX_USERNAME", "/^[A-Za-z0-9_\$%@#]*\$/");
define("REGEX_PASSWORD", "/^([a-zA-Z0-9]+)\$/");
define("REGEX_PIN", "/^([0-9]+)\$/");
define("TABLE_RFACCOUNT", "tbl_rfaccount");

function antiject($str)
{
	$escape = "/([\x00\n\r\,\'\"\x1a])/ig";
	// $str = preg_replace($escape, '', $str);
	$str = stripslashes($str);
	$str = htmlspecialchars($str);
	$str = trim($str);
	$str = preg_replace("/'/", "''", $str);
	$str = preg_replace('/"/', '""', $str);
	$str = str_replace("`", "", $str);
	$str = preg_replace("/;$/", "", $str);
	$str = preg_replace("/\\\\/", "", $str);

	return $str;
}

$base_url = get_url();

function sendEmail($mail, $to_email, $subject, $message)
{
	global $config;

	try {
		$message = preg_replace("/\\\\/", '', $message);

		$mail->IsSMTP();
		$mail->SMTPDebug = false;
		$mail->SMTPAuth = true; // enable SMTP authentication

		$mail->SMTPAutoTLS = true;
		$mail->SMTPOptions = array(
								'ssl' => array(
										'verify_peer' => false,
										'verify_peer_name' => false,
										'allow_self_signed' => true
									)
								);

		if ($config['email_smtp_port'] == 465) {
			$mail->SMTPSecure = "ssl";
			// smtp.gmail.com. Port: 465
		} elseif ($config['email_smtp_port'] == 587) {
			$mail->SMTPSecure = "tls";
			// smtp.gmail.com. Port: 587
		} else {
			$mail->SMTPAutoTLS = false; 
		}

		$mail->Host = $config['email_smtp_server'];
		$mail->Port = $config['email_smtp_port'];

		$mail->Username = $config['email_smtp_username'];
		$mail->Password = $config['email_smtp_password'];

		$mail->setFrom($config['email_smtp_username'], $config['website_title']);

		$mail->Subject = $subject;

		$mail->Body = $message;
		$mail->AltBody = $message;
		$mail->IsHTML(true);

		$mail->AddAddress($to_email);

		return $mail->Send();

	} catch (Exception $e) {
		die($e->getMessage());
		return false;
	}
}

$action		= isset($_POST['action']) ? $_POST['action'] : null;
$_getKey	= isset($_GET['key']) ? $_GET['key'] : null;
$out		= null;
$outsuccess	= null;
$_showForm	= true;
	
// $DB_HOST    = '51.79.163.54';
// $DB_USER    = 'ex_access#tUqmi7';
// $DB_PASS    = '5P22{KfT9m!jW3D3';
// $DB_RFUSER  = 'RF_User';


if ($action == 'sendmail') {

	$success = true;
	
	$_regkey		= isset($_POST['resetkey']) ? antiject(trim($_POST['resetkey'])) : null;
	$email			= isset($_POST['email']) ? antiject(trim($_POST['email'])) : null;

	$user_ip		= (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR'];

	if ($email == '') {
		$success = false;
		$out .= "<li>Email field were left blank. Field must be filled</li>";
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$success = false;
		$out .= "<li>Invalid e-mail address provided. Please make sure you enter a valid and working, email address</li>";
	}

	if ($success) {
		$SQL = mssql_connect( $DB_HOST, $DB_USER, $DB_PASS );
		if (!$SQL) {
			
			$out .= "<li>Couldn't connect to database</li>";
		} else {
			// mssql storing procedure into cache file
			mssql_select_db( $DB_RFUSER, $SQL );
			
			$usercheck = "SELECT convert(varchar, id) AS id, Email FROM " . TABLE_RFACCOUNT . " WHERE Email = '$email' ";
			$username_check = mssql_query($usercheck);

			if (mssql_num_rows($username_check) > 0) {
				$user = mssql_fetch_array($username_check);
				$username = antiject($user['id']);

				$userconfirmcheck = "SELECT email, reset_key, request_date, getdate() as now_date FROM [EX_DB].[dbo].[gamecp_reset_password_request] WHERE email = '$email' ORDER BY id DESC";
				$userconfirm_check = mssql_query($userconfirmcheck);
				if (mssql_num_rows($userconfirm_check) > 0) {

					$checkKey = mssql_fetch_array($userconfirm_check);

					$nextReset = strtotime($checkKey['request_date'] . " + 1 hours");
					$nowDate = strtotime($checkKey['now_date']);

					if (empty($checkKey) OR $nextReset > $nowDate) {
						$success = false;
						$nextResetTime = round(($nextReset - $nowDate)/60);
						$out .= "<li>The request has been sent, please try again in $nextResetTime minutes.</li>";
					}
				}

				if ($success) {
			
					# Generate confirmation key
					$reset_key = md5($user_ip . uniqid(rand(), true));
			
					# Begin user registration
					$insert_sql = "INSERT INTO [EX_DB].[dbo].[gamecp_reset_password_request] (username, email, reset_key) VALUES ('$username', '$email', '$reset_key')";
					if (!($insert_result = mssql_query($insert_sql))) {
						$success = false;
						$out .= "<li>Failed to insert your data into the database. Contact an administrator.</li>";
					} else {
						# Send a confirmation email to the user
						include __DIR__ . "/Mail/PHPMailer.php";
						include __DIR__ . "/Mail/Exception.php";
						include __DIR__ . "/Mail/SMTP.php";
			
						# Confirm url
						$confirm_url = "{$base_url}/index.php?do=resetpassword&key={$reset_key}";
			
						$loadTemplateMessage = file_get_contents(__DIR__ . "/Mail_Template/email_resetpass.html");
			
						$email_subject = "[{$config['website_title']}] Reset Password";
			
						# Format subject and message
						$email_message = str_replace("{{SERVER_NAME}}", $config['website_title'], $loadTemplateMessage);
						$email_message = str_replace("{{USER_REGISTERED}}", $username, $email_message);
						$email_message = str_replace("{{CONFIRMATION_LINK}}", $confirm_url, $email_message);
						$email_message = str_replace("{{SUPPORT_EMAIL}}", $config['email_smtp_username'], $email_message);
			
			
						$Mailator = new PHPMailer();
						$sendMail = sendEmail($Mailator, $email, $email_subject, $email_message);
			
						if (!$sendMail) {
							$out .= "<li>Attempt to send a confirmation e-mail has failed. Registration process has been aborted.</li>";;
			
							# Delete users registration data
							$delete_sql = "DELETE FROM [EX_DB].[dbo].[gamecp_reset_password_request] WHERE username = '$username' AND email = '$email'";
							$delete = mssql_query($delete_sql);
						} else {
							$outsuccess .= "<div class='alert alert-dismissible alert-success'>
												<button type='button' class='close' data-dismiss='alert'>&times;</button>
												An e-mail has been sent to your account with a link to confirm your account. Please click the link to finish your registration and choose a password.
											</div>";
							# clean
							ob_end_clean();
						}
					}
				}
			} else {
				$out .= "<li>No account registered with this email address.</li>";
			}
		}
	}
} elseif ($action == 'resetpassword') {

	$success = true;
	
	$_regkey		= isset($_POST['resetkey']) ? antiject(trim($_POST['resetkey'])) : null;
	$password		= isset($_POST['password']) ? antiject(trim($_POST['password'])) : null;
	$password2nd	= isset($_POST['password2nd']) ? antiject(trim($_POST['password2nd'])) : null;

	$user_ip		= (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR'];

	if ($_regkey == '') {
		$success = false;
		$out .= "<li>Missing reset password key.</li>";
	}

	if ($password == '' OR $password2nd == '') {
		$success = false;
		$out .= "<li>Some fields were left blank. All fields must be filled</li>";
	} elseif ($password != $password2nd) {
		$success = false;
		$out .= "<li>Confirmation password does not match. Please check for typos.</li>";
	} elseif (!preg_match(REGEX_PASSWORD, $password)) {
		$success = false;
		$out .= "<li>Invalid password provided. Password can only contain letters and numbers.</li>";
	}

	if (strlen($password) < 4 OR strlen($password) > 12) {
		$success = false;
		$out .= "<li>Password must be between 4 to 12 characters in length.</li>";
	}

	if ($success) {
		$SQL = mssql_connect( $DB_HOST, $DB_USER, $DB_PASS );
		if (!$SQL) {
			$out .= "<li>Couldn't connect to database</li>";
		} else {
			// mssql storing procedure into cache file
			mssql_select_db( $DB_RFUSER, $SQL );

			$userconfirmcheck = "SELECT TOP 1 username, request_date, getdate() as now_date FROM [EX_DB].[dbo].[gamecp_reset_password_request] WHERE reset_key = '$_regkey' AND request_status = 0 ORDER BY id DESC";
			$userconfirm_check = mssql_query($userconfirmcheck);
			if (mssql_num_rows($userconfirm_check) > 0) {

				$checkKey = mssql_fetch_array($userconfirm_check);

				$ExpireTime = strtotime($checkKey['request_date'] . " + 1 days");
				$nowDate = strtotime($checkKey['now_date']);

				if (empty($checkKey) OR $ExpireTime < $nowDate) {
					$success = false;
					$out .= "<li>Reset key expired.</li>";
					$_showForm = false;
				}

				if ($success) {
					$update_pass = mssql_query("UPDATE " . TABLE_RFACCOUNT . " SET password = convert(binary, '{$password}') WHERE id = convert(binary, '{$checkKey['username']}')");

					if (!$update_pass) {
						$out .= "<li>Failed update password. Contact an administrator.</li>";
					} else {

						$update_status = mssql_query("UPDATE [EX_DB].[dbo].[gamecp_reset_password_request] SET request_status = 1 WHERE reset_key = '$_regkey'");

						if ($update_status) {
							$outsuccess .= "<div class='alert alert-dismissible alert-success'>
												<button type='button' class='close' data-dismiss='alert'>&times;</button>
												<strong>Reset Password Success!</strong> Enjoy your adventure!</a>.
											</div>";
						} else {
							$outsuccess .= "<div class='alert alert-dismissible alert-danger'>
												<button type='button' class='close' data-dismiss='alert'>&times;</button>
												<strong>Reset Password Failed!</strong> Unable procced your reset request [database error]!</a>.
											</div>";
						}

						$_showForm = false;
					}
				}

			} else {
				$_showForm = false;
				$out .= "<li>Reset key invalid.</li>";
			}
		}
	}
}
?>

<div class="col-9 row pr-0">
	<div class="box-shadow style-right position-relative block-right-page content-block d-block c-block container p-3">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
		<h5 class="heading">RESET PASSWORD</h5>
		
		<?php
		if (!empty($out)) {
			echo "<div class='card border-danger mb-3'>
						<div class='card-header bg-danger'>Request Failed!</div>
						<div class='card-body'>
							<ul class='m-0'>
								$out
							</ul>
						</div>
					</div>";
		}

		if (!empty($outsuccess)) echo $outsuccess;

		if ($_showForm) {
			if (!empty($_getKey)) {

				$SQL = mssql_connect( $DB_HOST, $DB_USER, $DB_PASS );
				if (!$SQL) {
					echo "<li>Couldn't connect to database</li>";
				} else {
					
					mssql_select_db( $DB_RFUSER, $SQL );
	
					$keyCheck = "SELECT TOP 1 reset_key FROM [EX_DB].[dbo].[gamecp_reset_password_request] WHERE reset_key = '$_getKey' AND request_status = 0 ORDER BY id DESC";
					$key_check = mssql_query($keyCheck);
	
					if (mssql_num_rows($key_check) > 0) {
						$resP = mssql_fetch_array($key_check);

						echo "<div class='card border-info mb-3'>
									<div class='card-header bg-info'>Passwor Requirements!</div>
									<div class='card-body'>
										<ul class='m-0'>
											<li>Password can only contain letters and numbers.</li>
											<li>Password must be between 4 to 12 characters in length.</li>
										</ul>
									</div>
								</div>";
	
						echo "<form class='reg-form mx-0 exdeus-form' action='' method='POST'>
								<input type='hidden' name='resetkey' value='{$_getKey}'>
								<div class='form-row mx-auto text-center' style='max-width: 400px;'>
									<div class='form-group pass first-pass col-12'>
										<label for='register-password'>New Password</label>
										<div class='input-group'>
											<div class='input-group-prepend'>
												<span class='input-group-text' id='basic-prepend-password'><i class='fa fa-key' aria-hidden='true'></i></span>
											</div>
											<input type='password' name='password' id='register-password' min='4' max='12' class='form-control' pattern='[a-zA-Z0-9]+' minlength='4' maxlength='12' autocomplete='off' placeholder='New Password' required=''>
										</div>
									</div>
									<div class='form-group pass col-12'>
										<label for='register-password2nd'>Confirm password</label>
										<div class='input-group'>
											<div class='input-group-prepend'>
												<span class='input-group-text' id='basic-prepend-password2nd'><i class='fa fa-key' aria-hidden='true'></i></span>
											</div>
											<input type='password' name='password2nd' id='register-password2nd' min='4' max='12' class='form-control' pattern='[a-zA-Z0-9]+' minlength='4' maxlength='12' autocomplete='off' placeholder='Confirm password' required=''>
										</div>
									</div>
								</div>
								<div class='reg-buttons'>
									<div class='text-center'>
										<button id='action-newaccount-register' name='action' value='resetpassword' class='btn btn-success mx-1'>Change Password</button>
										<button type='reset' class='btn btn-outline-danger mx-1'>Reset Form</button>
									</div>
								</div>
							</form>";
					} else {
						echo "<div class='card border-danger mb-3'>
								<div class='card-header bg-danger'>Invalid Key!</div>
								<div class='card-body'>
									Invalid key.
								</div>
							</div>";
					}
	
				}
	
			} else {
	
				echo "<p class='text-center'>
						Please enter your email address. You will receive an instruction and link on how to reset your password.
					</p>
					<form class='reg-form mx-0 exdeus-form mx-auto' action='' method='POST' style='max-width: 400px;'>
						<div class='form-group input-group has-success'>
							<label for='register-email' class='mx-auto'>E-mail Address:</label>
							<div class='input-group'>
								<div class='input-group-prepend'>
									<span class='input-group-text' id='basic-prepend-email'>@</span>
								</div>
								<input type='email' name='email' id='register-email' class='form-control' autocomplete='off' placeholder='E-mail' required=''>
							</div>
							<div id='email-check'></div>
						</div>
						<div class='reg-buttons'>
							<div class='text-center'>
								<button id='action-newaccount-register' name='action' value='sendmail' class='btn btn-info mx-1'>Send Email</button>
								<button type='reset' class='btn btn-outline-danger mx-1'>Reset Form</button>
							</div>
						</div>
					</form>";
			}
		}

		?>
	</div>
</div>