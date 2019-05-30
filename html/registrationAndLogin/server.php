<?php
session_start();

//Includes von Funktionen
include_once($_SERVER['DOCUMENT_ROOT'] . "/KCD/html/global/functions.php");

// initializing variables
$username = "";
$email    = "";
$errors = array();
$success = array();

// connect to the database
$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  if (!nutzer_angemeldet()) {
  	// receive all input values from the form
  	$username = mysqli_real_escape_string($db, $_POST['username']);
  	$email = mysqli_real_escape_string($db, $_POST['email']);
  	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $password_master = mysqli_real_escape_string($db, $_POST['password_master']);
    $password_master_hash = md5($password_master);

	// form validation: ensure that the form is correctly filled ...
  	// by adding (array_push()) corresponding error unto $errors array
  	if (empty($username)) { array_push($errors, "Nutzername wurde nicht angegeben. Bitte geben Sie einen Nutzername an."); }
  	if (empty($email)) { array_push($errors, "E-mail wurde nicht angegeben. Bitte geben Sie eine E-Mail an."); }
  	if (empty($password_1)) { array_push($errors, "Bitte geben Sie ein passwort an."); }
    if (empty($password_master_hash)) { array_push($errors, "Bitte geben Sie ein Master-Passwort ein."); }
  	if ($password_1 != $password_2) {
		array_push($errors, "Die Passwörter stimmen nicht überein.");
  	}

    //Master-Passwort Checken
    $queue_get_master = "SELECT * FROM Variables WHERE Name = 'MasterPass' AND currentvalue = '". $password_master_hash . "';";
    $result_get_master = mysqli_query($db, $queue_get_master);
    $key_found = mysqli_fetch_assoc($result_get_master);

    if (!($key_found)) { // key ist nicht richtig
        array_push($errors, "Das Master-Passwort ist nicht gültig. Registrierung nicht möglich");
    }

  	// first check the database to make sure
  	// a user does not already exist with the same username and/or email
  	$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  	$result = mysqli_query($db, $user_check_query);
  	$user = mysqli_fetch_assoc($result);

	if ($user) { // if user exists
    		if ($user['username'] === $username) {
      			array_push($errors, "Nutzername existiert schon. Bitte wählen Sie einen anderen.");
    	}

    	if ($user['email'] === $email) {
      		array_push($errors, "E-Mail schon registriert. Bitte überprüfen Sie Ihre eingaben oder melden Sie sich an.");
    	}
	}


  	// Finally, register user if there are no errors in the form
  	if (count($errors) == 0) {
  		$password = md5($password_1);//encrypt the password before saving in the database

  		$query = "INSERT INTO users (username, email, password)
  			  VALUES('$username', '$email', '$password')";
  		mysqli_query($db, $query);
  		$_SESSION['username'] = $username;
  		$_SESSION['success'] = "Sie sind nun erfolgreich registriert und eingeloggt.";
  		header('location: /KCD/index.php');
  	}
  } else {
	array_push($errors, "Sie sind schon angemeldet. Eine Registrierung ist nicht möglich");
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Bitte geben Sie einen Nutzernamen an.");
  }
  if (empty($password)) {
  	array_push($errors, "Bitte geben Sie ein Passwort an");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "Sie sind nun eingeloggt";
  	  header('location: /KCD/index.php');
  	}else {
  		array_push($errors, "Die eingegebenen Daten sind nicht korrekt.");
  	}
  }
}

//Logout USER
if (isset($_POST['logout_user'])) {
    session_start();
    session_unset();
    session_destroy();
    header('location: /KCD/html/registrationAndLogin/login.php');
}

//Change User Informations
// REGISTER USER
if (isset($_POST['change_user'])) {
    if (nutzer_angemeldet()) {
        // receive all input values from the form
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_0 = mysqli_real_escape_string($db, $_POST['password_0']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

        //Gucken, ob der Nutzer das richtige alte Passwort eingegeben hat
      	$password_0_hash = md5($password_0);
      	$query = "SELECT * FROM users WHERE username='" . $_SESSION['username'] . "' AND password='$password_0_hash'";
      	$results = mysqli_query($db, $query);
  	    if (mysqli_num_rows($results) == 0) {
            array_push($errors, "Das alte Passwort ist nicht korrekt");
        }

        $change_pass = (!(!isset($_POST['password_1']) || trim($_POST['password_1']) == ''));
        $change_name = (!(!isset($_POST['username']) || trim($_POST['username']) == ''));
        $change_mail = (!(!isset($_POST['email']) || trim($_POST['email']) == ''));

        if (($password_1 != $password_2) && $change_pass) {
		    array_push($errors, "Die Passwörter stimmen nicht überein.");
  	    }
        echo $change_name;
        if (!($change_name))
        {
            //Wenn der Name nicht geändert werden soll muss er aus der DB eingelesen werden
            $username = $_SESSION['username'];
            echo "gfkjdslf";
        }
        if (!($change_mail))
        {
            echo "fjdskl";
            //Wenn die Mail nicht geändert werden soll muss er aus der DB eingelesen werden
            $email = get_email_by_userid(get_userid_by_username($_SESSION['username']));
        }
        // form validation: ensure that the form is correctly fill OR email='$email' LIMIT 1";
      	$user_check_query = "SELECT * FROM users WHERE username='" . $username . "' OR email='$email' LIMIT 1";
      	$result = mysqli_query($db, $user_check_query);
      	$user = mysqli_fetch_assoc($result);

        if (!($user)) { // if user exists
            if (($user['username'] === $username) && $change_name) {
          			array_push($errors, "Nutzername existiert schon. Bitte wählen Sie einen anderen.");
            }
            if (($user['email'] === $email) && $change_mail) {
          		array_push($errors, "E-Mail schon registriert. Bitte überprüfen Sie Ihre eingaben oder melden Sie sich an.");
            }
        } else {
            //Nutzer exestiert garnicht
            //Das ist gut, da neue Daten gesetzt werden
        }

        // Finally, update user if there are no errors in the form
        if (count($errors) == 0) {
            if ($change_pass)
            {
                $password = md5($password_1);//encrypt the password before saving in the database
            } else {
                $password = $password_0_hash;
            }

	        $query = "UPDATE users SET username = '". $username . "', email = '" . $email. "', password = '" . $password . "' WHERE username='". $_SESSION['username'] . "';";
	        mysqli_query($db, $query);
	        $_SESSION['username'] = $username;
	        $_SESSION['success'] = "Nutzerdaten erfolgreich angepasst";
	        array_push($success,"Änderungen erfolgreich übernommen");
        }
      } else {
	    array_push($errors, "Sie sind nicht angemeldet. Eine Änderung der Daten ist nicht möglich");
      }
}

//Change User Informations
// REGISTER USER
if (isset($_POST['change_master'])) {
    if (nutzer_angemeldet()) {
        if(checkAdminPermissions(get_userid_by_username($_SESSION['username']),$db) == true)
        {
            //Rechte sind da, der Nutzer ist angemeldet
            if (isset($_POST['password_old']) && isset($_POST['password_new_0']) && isset($_POST['password_new_0']) ) {
                $pass_old = mysqli_real_escape_string($db, $_POST['password_old']);
                $pass_old_hash = md5($pass_old);
                $pass_new_1 = mysqli_real_escape_string($db, $_POST['password_new_1']);
                $pass_new_1_hash = md5($pass_new_1);
                $pass_new_0 = mysqli_real_escape_string($db, $_POST['password_new_0']);
                $pass_new_0_hash = md5($pass_new_0);

                if ($pass_new_1 == $pass_new_0) {
                    $queue_get_master = "SELECT * FROM Variables WHERE Name = 'MasterPass' AND currentvalue = '". $pass_old_hash . "';";
                    $result = mysqli_query($db, $queue_get_master);
      	            $key = mysqli_fetch_assoc($result);

                    if ($key) { // key ist richtig
                        if ( $pass_new_1_hash == $pass_new_0_hash)
                        {
                            $queue_update_master = "UPDATE Variables SET currentvalue = '" . $pass_new_1_hash . "' WHERE Name = 'MasterPass'";
                            if (mysqli_query($db, $queue_update_master)== 1)
                            {
                                array_push($success, "Änderungen erfolgreich übernommen");
                            } else {
                                array_push($errors, "Technischer Fehler");
                            }
                        } else {
                            //Komischer Fehler (SQL-Injection??)
                            array_push($errors, "Bitte geben Sie valide Zeichen ein");
                        }
                    } else {
                        array_push($errors, "Das eingegebene Master-Passwort ist falsch");
                    }
                } else {
                    array_push($errors, "Die beiden angegebenen Passwörter stimmen nicht überein.");
                }
            } else {
                array_push($errors, "Sie haben nicht alle benötigten Werte angegeben.");
            }
        } else {
            array_push($errors, "Sie haben nicht die erforderlichen Rechte um diese Akion auszuführen!");
        }
    } else {
        array_push($errors, "Sie sind nicht angemeldet. Eine Änderung der Daten ist nicht möglich");
    }
}

//change User password
if (isset($_POST['change_user_pass'])) {
    if (nutzer_angemeldet()) {
        if(checkAdminPermissions(get_userid_by_username($_SESSION['username']),$db) == true)
        {
            //Rechte sind da, der Nutzer ist angemeldet
            $user_id = mysqli_real_escape_string($db, $_POST['selected_user']);
            $password_0 = mysqli_real_escape_string($db, $_POST['password_new_0']);
            $password_1 = mysqli_real_escape_string($db, $_POST['password_new_1']);
            $password_m = mysqli_real_escape_string($db, $_POST['password_master']);
            $password_m_hash = md5($password_m);
            $password_0_hash = md5($password_0);
            if ($user_id != "nothingSelected") {
                if ((!empty($password_0)) || (!empty($password_1)) || (!empty($password_m)) || (!empty($user_id))) {
                    if ($password_0 == $password_1) {
                        $queue_get_master = "SELECT * FROM Variables WHERE Name = 'MasterPass' AND currentvalue = '". $password_m_hash . "';";
                        $result = mysqli_query($db, $queue_get_master);
          	            $key = mysqli_fetch_assoc($result);

                        if ($key) { // key ist richtig
                            //Alles bis auf den Nutzer getestet
                          	$user_check_query = "SELECT * FROM users WHERE id='" . $user_id . "'";
                            $result = mysqli_query($db, $user_check_query);
                            $user = mysqli_fetch_assoc($result);
                            if ($user) { // if user exists
                                if(checkAdminPermissions($user_id,$db) == false) {
                                    $queue_update_pass = "UPDATE users SET password = '" . $password_0_hash . "' WHERE id = '" . $user_id . "';";
                                    if (mysqli_query($db, $queue_update_pass) == 1) {
                                        array_push($success, "Daten erfolgreich aktualisiert!");
                                    } else {
                                        array_push($errors, "Fehler bei einer Datenbankabfrage");
                                    }
                                } else {
                                    array_push($errors, "Dieser Nutzer ist ein Administrator. Das Passwort von Administratoren kann nicht zurückgesetzt werden.");
                                }
                            } else {
                                array_push($errors, "Technischer Fehler. Zugehöriger Nutzer konnte nicht ermittelt werden. Bitte laden Sie die Seite neu.");
                            }
                        } else {
                            array_push($errors, "Master-Passwort ist nicht richtig");
                        }
                    } else {
                        array_push($errors, "Die Passwörter stimmen nicht überein");
                    }
                } else {
                    array_push($errors, "Bitte geben Sie alle nötigen Daten an!");
                }
            } else {
                array_push($errors, "Bitte suchen sie sich einen Nutzer aus");
            }
        } else {
            array_push($errors, "Sie haben nicht die erforderlichen Rechte um diese Akion auszuführen!");
        }
    } else {
        array_push($errors, "Sie sind nicht angemeldet. Eine Änderung der Daten ist nicht möglich");
    }
}

?>
