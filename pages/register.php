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

$confirm_email_required = true;

$action		= isset($_POST['action']) ? $_POST['action'] : null;
$account	= isset($_GET['account']) ? $_GET['account'] : null;
$out		= null;
$outsuccess	= null;
	
$DB_HOST    = '51.79.163.54';
$DB_USER    = 'ex_access#tUqmi7';
$DB_PASS    = '5P22{KfT9m!jW3D3';
$DB_RFUSER  = 'RF_User';

$DB_HOST    = '127.0.0.1';
$DB_USER    = 'sa';
$DB_PASS    = 'xzxz';
$DB_RFUSER  = 'RF_User';


if ($action == 'register') {

	$success = true;
	
	$_regkey		= isset($_POST['gamekey']) ? antiject(trim($_POST['gamekey'])) : null;
	$username		= isset($_POST['username']) ? antiject(trim($_POST['username'])) : null;
	$password		= isset($_POST['password']) ? antiject(trim($_POST['password'])) : null;
	$password2nd	= isset($_POST['password2nd']) ? antiject(trim($_POST['password2nd'])) : null;
	$email			= isset($_POST['email']) ? antiject(trim($_POST['email'])) : null;
	$pin			= isset($_POST['pin']) ? antiject(trim($_POST['pin'])) : null;

	$user_ip		= (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR'];

	if ($username == '' OR $email == '') {
		$success = false;
		$out .= "<li>Some fields were left blank. All fields must be filled</li>";
	}

	if (!preg_match(REGEX_USERNAME, $username)) {
		$success = false;
		$out .= "<li>Invalid username provided. Username can only contain letters and numbers.</li>";
	}

	if (strlen($username) < 4 OR strlen($username) > 12) {
		$success = false;
		$out .= "<li>Username must be between 4 to 12 characters in length.</li>";
	}

	if (!$confirm_email_required) {
	
		if ($password == '' OR $pin == '') {
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

		if (strlen($pin) !== 6) {
			$success = false;
			$out .= "<li>Pin must be 6 numbers in length.</li>";
		} elseif (!preg_match(REGEX_PIN, $pin)) {
			$success = false;
			$out .= "<li>Invalid pin provided. Pin can only contain numbers.</li>";
		}
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$success = false;
		$out .= "<li>Invalid e-mail address provided. Please make sure you enter a valid and working, email address</li>";
	}
	
	
	if ($success) {
		$SQL = @mssql_connect( $DB_HOST, $DB_USER, $DB_PASS );
		if (!$SQL) {
			$out .= "<li>Couldn't connect to database</li>";
		} else {
			// mssql storing procedure into cache file
			mssql_select_db( $DB_RFUSER, $SQL );

			$usercheck = "SELECT id, Email FROM " . TABLE_RFACCOUNT . " WHERE id = CONVERT(binary,'$username') OR Email = '$email' ";
			$username_check = mssql_query($usercheck);
			if (mssql_num_rows($username_check) > 0) {
				$out .= "<li>Sorry, the username/email you choose has already been taken. Please choose another.</li>";
			} else {
				
				if ($confirm_email_required) {

					$userconfirmcheck = "SELECT username, email, confirm_key FROM [EX_DB].[dbo].[gamecp_confirm_email] WHERE username = '$username' OR email ='$email' ";
					$userconfirm_check = mssql_query($userconfirmcheck);
					if (mssql_num_rows($userconfirm_check) > 0) {

						$checkKey = mssql_fetch_array($userconfirm_check);

						if (!empty($checkKey) AND $checkKey['confirm_key'] == $_regkey AND $checkKey['email'] == $email AND $checkKey['username'] == $username) {
							$lu_sql = "INSERT INTO " . TABLE_RFACCOUNT . " (id, password, accounttype, email, birthdate, pin) VALUES ( convert(binary,'{$username}'), convert(binary,'{$password}'), '0', '{$email}', '1900-01-01', '{$pin}')";
							if (!mssql_query($lu_sql)) {
								$success = false;
								$out .= "<li>Failed to insert the RF Account data into the database. Contact an administrator.</li>";
							} else {
								$user_sql = "INSERT INTO tbl_UserAccount (id, createip) VALUES (convert(binary,'$username'), '$user_ip')";
								if (!mssql_query($user_sql)) {
									$success = false;
									$out .= "<li>Failed to insert the User Account data into the database. Contact an administrator.</li>";
									$delete_sql = "DELETE FROM  " . TABLE_RFACCOUNT . " WHERE id = convert(binary,'$username')";
									$delete = mssql_query($delete_sql);
								} else {
									
									$delete_confirm = mssql_query("DELETE FROM [EX_DB].[dbo].[gamecp_confirm_email] WHERE confirm_key = '{$checkKey['confirm_key']}'");

									if ($delete_confirm) {

										$outsuccess .= "<div class='alert alert-dismissible alert-success'>
															<button type='button' class='close' data-dismiss='alert'>&times;</button>
															<strong>Register Account Success!</strong> Congratuliation!, please login and enjoy our game! happy playing!.</a>.
														</div>";

									} else {

										$delete_user = mssql_query("DELETE FROM  " . TABLE_RFACCOUNT . " WHERE id = convert(binary,'$username')");

										$outsuccess .= "<div class='alert alert-dismissible alert-danger'>
															<button type='button' class='close' data-dismiss='alert'>&times;</button>
															<strong>Register Account Register Failed!</strong> Unable delete confirmation email data!.</a>.
														</div>";
										
									}
	
									$account = null;
								}
							}
						} else {
							$out .= "<li>Sorry, the username/email you choose has already been taken (waiting email confirmation). Please choose another.</li>";
						}
					} else {

						# Generate confirmation key
						$confirm_key = md5($user_ip . uniqid(rand(), true));

						# Begin user registration
						$insert_sql = "INSERT INTO [EX_DB].[dbo].[gamecp_confirm_email] (username, email, confirm_key) VALUES ('$username', '$email', '$confirm_key')";
						if (!($insert_result = mssql_query($insert_sql))) {
							$success = false;
							$out .= "<li>Failed to insert your data into the database. Contact an administrator.</li>";
						} else {
							# Send a confirmation email to the user
							include __DIR__ . "/Mail/PHPMailer.php";
							include __DIR__ . "/Mail/Exception.php";
							include __DIR__ . "/Mail/SMTP.php";

							# Confirm url
							$confirm_url = "{$base_url}/index.php?do=register&account=verify&key={$confirm_key}";

							$loadTemplateMessage = file_get_contents(__DIR__ . "/Mail_Template/email_register.html");

							$email_subject = "[{$config['website_title']}] Please Confirm Your Email Address";

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
								$delete_sql = "DELETE FROM [EX_DB].[dbo].[gamecp_confirm_email] WHERE username = '$username' AND email = '$email'";
								$delete = mssql_query($delete_sql);
							} else {
								$outsuccess .= "<div class='alert alert-dismissible alert-success'>
													<button type='button' class='close' data-dismiss='alert'>&times;</button>
													An e-mail has been sent to your account with a link to confirm your account. Please click the link to finish your registration and choose a password.
												</div>";
							}
						}
					}
				} else {
					$lu_sql = "INSERT INTO " . TABLE_RFACCOUNT . " (id, password, accounttype, email, birthdate, pin) VALUES ( convert(binary,'{$username}'), convert(binary,'{$password}'), '0', '{$email}', '1900-01-01', '{$pin}')";
					if (!mssql_query($lu_sql)) {
						$success = false;
						$out .= "<li>Failed to insert the RF Account data into the database. Contact an administrator.</li>";
					} else {
						$user_sql = "INSERT INTO tbl_UserAccount (id, createip) VALUES (convert(binary,'$username'), '$user_ip')";
						if (!mssql_query($user_sql)) {
							$success = false;
							$out .= "<li>Failed to insert the User Account data into the database. Contact an administrator.</li>";
							$delete_sql = "DELETE FROM  " . TABLE_RFACCOUNT . " WHERE id = convert(binary,'$username')";
							$delete = mssql_query($delete_sql);
						} else {
							$outsuccess .= "<div class='alert alert-dismissible alert-success'>
												<button type='button' class='close' data-dismiss='alert'>&times;</button>
												<strong>Register Account Success!</strong> Congratuliation!, please login and enjoy our game! happy playing!.</a>.
											</div>";
						}
					}
				}
			}
		}
	}
}
?>

<div class="col-9 row pr-0">
	<div class="box-shadow style-right position-relative block-right-page content-block d-block c-block container p-3">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
		<h5 class="heading">REGISTER ACCOUNT</h5>
		<h4 class="text-center">Information!</h4>
		<ul>
			<li>a</li>
			<li>b</li>
			<li>c</li>
			<li>d</li>
			<li>e</li>
		</ul>
		
		<?php
		if (!empty($out)) {
			echo "<div class='card border-danger mb-3'>
						<div class='card-header bg-danger'>Registration Failed!</div>
						<div class='card-body'>
							<ul class='m-0'>
								$out
							</ul>
						</div>
					</div>";
		}

		if (!empty($outsuccess)) echo $outsuccess;

		if ($account == 'verify') {

			$regkey = isset($_GET['key']) ? antiject($_GET['key']) : null;
		
			if (empty($regkey)) {
				echo "<div class='card border-danger mb-3'>
						<div class='card-header bg-danger'>Registration Failed!</div>
						<div class='card-body'>
							Key not found!
						</div>
					</div>";
			}

			
			$SQL = mssql_connect( $DB_HOST, $DB_USER, $DB_PASS );
			if (!$SQL) {
				echo "<li>Couldn't connect to database</li>";
			} else {
				$usercheck = "SELECT * FROM [EX_DB].[dbo].[gamecp_confirm_email] WHERE confirm_key = '$regkey'";
				$username_check = mssql_query($usercheck);
				if (mssql_num_rows($username_check) == 0) {
					echo "<div class='card border-danger mb-3'>
							<div class='card-header bg-danger'>Registration Failed!</div>
							<div class='card-body'>
								Sorry, the game key you used not found!.
							</div>
						</div>";
				} else {
					$data = mssql_fetch_array($username_check);
					echo "<form class='reg-form row mx-0 exdeus-form' action='' method='POST'>
						<div class='form-group has-success col-12'>
							<label for='register-gamekey'>Game Key</label>
							<div class='input-group'>
								<div class='input-group-prepend'>
									<span class='input-group-text' id='basic-prepend-gamekey'><i class='fa fa-gamepad' aria-hidden='true'></i></span>
								</div>
								<input type='text' name='gamekey' id='register-gamekey' class='form-control' autocomplete='off' minlength='4' maxlength='12' pattern='[a-z0-9]+' placeholder='Game Key' value='{$data['confirm_key']}' required readonly>
							</div>
							<div id='username-check'></div>
						</div>
							<div class='form-group has-success col-sm-6'>
								<label for='register-username'>Username</label>
								<div class='input-group'>
									<div class='input-group-prepend'>
										<span class='input-group-text' id='basic-prepend-username'><i class='fa fa-user' aria-hidden='true'></i></span>
									</div>
									<input type='text' name='username' id='register-username' class='form-control' autocomplete='off' minlength='4' maxlength='12' pattern='[a-z0-9]+' placeholder='Username' value='{$data['username']}' required readonly>
								</div>
								<div id='username-check'></div>
							</div>
							<div class='form-group input-group has-success col-sm-6'>
								<label for='register-email'>E-mail</label>
								<div class='input-group'>
									<div class='input-group-prepend'>
										<span class='input-group-text' id='basic-prepend-email'>@</span>
									</div>
									<input type='email' name='email' id='register-email' class='form-control' autocomplete='off' placeholder='E-mail' value='{$data['email']}' required readonly>
								</div>
								<div id='email-check'></div>
							</div>
							<div class='form-group pass first-pass col-sm-6'>
									<label for='register-password'>Password</label>
									<div class='input-group'>
										<div class='input-group-prepend'>
											<span class='input-group-text' id='basic-prepend-password'><i class='fa fa-key' aria-hidden='true'></i></span>
										</div>
										<input type='password' name='password' id='register-password' class='form-control' pattern='[a-zA-Z0-9]+' minlength='4' maxlength='12' autocomplete='off' placeholder='Password' required=''>
									</div>
								</div>
								<div class='form-group pass col-sm-6'>
									<label for='register-password2nd'>Confirm password</label>
									<div class='input-group'>
										<div class='input-group-prepend'>
											<span class='input-group-text' id='basic-prepend-password2nd'><i class='fa fa-key' aria-hidden='true'></i></span>
										</div>
										<input type='password' name='password2nd' id='register-password2nd' class='form-control' pattern='[a-zA-Z0-9]+' minlength='4' maxlength='12' autocomplete='off' placeholder='Confirm password' required=''>
									</div>
								</div>
								<div class='form-group col-6'>
									<label for='register-pin' class='mt-2 mb-0'>PIN</label>
									<div class='input-group'>
										<div class='input-group-prepend'>
											<span class='input-group-text' id='basic-prepend-pin'><i class='fa fa-barcode' aria-hidden='true'></i></span>
										</div>
										<input type='text' id='register-pin' name='pin' class='form-control' autocomplete='off' pattern='[0-9]{6}' maxlength='6' placeholder='PIN' required=''>
									</div>
								</div>
								<span class='col-md-12 mb-2 mt-2'>By creating an account you agree to our <a href='#'>terms of service</a></span>
								<div class='reg-buttons col-md-12'>
									<div class='text-center'>
										<button id='action-newaccount-register' name='action' value='register' class='btn btn-info mx-1'>Register</button>
										<button type='reset' class='btn btn-outline-danger mx-1'>Reset</button>
									</div>
								</div>
							</form>";
				}
			}

			

		} else {
			

			echo "<form class='reg-form row mx-0 exdeus-form' action='' method='POST'>
					<div class='form-group has-success col-12'>
						<label for='register-username'>Username</label>
						<div class='input-group'>
							<div class='input-group-prepend'>
								<span class='input-group-text' id='basic-prepend-username'><i class='fa fa-user' aria-hidden='true'></i></span>
							</div>
							<input type='text' name='username' id='register-username' class='form-control' autocomplete='off' minlength='4' maxlength='12' pattern='[a-z0-9]+' placeholder='Username' required=''>
						</div>
						<div id='username-check'></div>
					</div>
					<div class='form-group input-group has-success col-12'>
						<label for='register-email'>E-mail</label>
						<div class='input-group'>
							<div class='input-group-prepend'>
								<span class='input-group-text' id='basic-prepend-email'>@</span>
							</div>
							<input type='email' name='email' id='register-email' class='form-control' autocomplete='off' placeholder='E-mail' required=''>
						</div>
						<div id='email-check'></div>
					</div>";
			if (!$confirm_email_required) {
				echo "<div class='form-group pass first-pass col-sm-6'>
							<label for='register-password'>Password</label>
							<div class='input-group'>
								<div class='input-group-prepend'>
									<span class='input-group-text' id='basic-prepend-password'><i class='fa fa-key' aria-hidden='true'></i></span>
								</div>
								<input type='password' name='password' id='register-password' class='form-control' pattern='[a-zA-Z0-9]+' minlength='4' maxlength='12' autocomplete='off' placeholder='Password' required=''>
							</div>
						</div>
						<div class='form-group pass col-sm-6'>
							<label for='register-password2nd'>Confirm password</label>
							<div class='input-group'>
								<div class='input-group-prepend'>
									<span class='input-group-text' id='basic-prepend-password2nd'><i class='fa fa-key' aria-hidden='true'></i></span>
								</div>
								<input type='password' name='password2nd' id='register-password2nd' class='form-control' pattern='[a-zA-Z0-9]+' minlength='4' maxlength='12' autocomplete='off' placeholder='Confirm password' required=''>
							</div>
						</div>
						<div class='form-group col-6'>
							<label for='register-pin' class='mt-2 mb-0'>PIN</label>
							<div class='input-group'>
								<div class='input-group-prepend'>
									<span class='input-group-text' id='basic-prepend-pin'><i class='fa fa-barcode' aria-hidden='true'></i></span>
								</div>
								<input type='text' id='register-pin' name='pin' class='form-control' autocomplete='off' pattern='[0-9]{6}' maxlength='6' placeholder='PIN' required=''>
							</div>
						</div>";
			}

			echo "<span class='col-md-12 mb-2 mt-2'>By creating an account you agree to our <a href='#'>terms of service</a></span>
					<div class='reg-buttons col-md-12'>
						<div class='text-center'>
							<button id='action-newaccount-register' name='action' value='register' class='btn btn-info mx-1'>Register</button>
							<button type='reset' class='btn btn-outline-danger mx-1'>Reset</button>
						</div>
					</div>
				</form>";
		}

		?>
	</div>
</div>