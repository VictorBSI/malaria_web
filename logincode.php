<?php
    session_start();
    include('dbcon.php');
    if(isset($_POST['login_now_btn'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $query = "SELECT * FROM malaria.login WHERE email LIKE '$email' and pass LIKE '$pass'";
        $res = mysqli_query($conn, $query);
        $data = mysqli_fetch_array($res);

        if(isset($data[0]) ? 2 : 1 > 1){
            //echo json_encode("account already exists");
            $query = "SELECT * FROM malaria.login WHERE pass LIKE '$pass'";
            $res = mysqli_query($conn, $query);
            $data = mysqli_fetch_array($res);

            if($data[2] >= 1){
                echo json_encode("true");
                header("Location: index.php");
            }else{
                echo json_encode("false");
            }

        } else {
            echo json_encode("dont have an account");
        }
    } else{
        echo json_encode("ERRO");
    }
    /*use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

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
                header("Location: index.php");
            }
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            //echo $e->getMessage();
            $_SESSION['status'] = "No Email Found";
            header("Location: login.php");
            exit();
        }
    }*/

?>