<?php
    session_start();
    include('dbcon.php');
    use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

    if(isset($_POST['login_now_btn'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            $user = $auth->getUserByEmail("$email");

            $signInResult = $auth->signInWithEmailAndPassword($email, $password);
            $idTokenString = $signInResult->idToken();
            try {
                $verifiedIdToken = $auth->verifyIdToken($idTokenString);
                $uid = $verifiedIdToken->claims()->get('sub');

                $_SESSION['verified_user_id'] = $uid;
                $_SESSION['idTokenString'] = $idTokenString;

                $_SESSION['status'] = "You are Logged";
                header("Location: index.php");
                exit();
            } catch (FailedToVerifyToken $e) {
                echo 'The token is invalid: '.$e->getMessage();
            }
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            //echo $e->getMessage();
            $_SESSION['status'] = "No Email Found";
            header("Location: login.php");
            exit();
        }
    }
?>