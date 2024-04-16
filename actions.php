<?php
include 'config/session.php';

// redirection 
if(isset($_GET['return'])){
    $return = $_GET['return'];
} else {
    $return = 'index.php';
}


if (isset($_POST['submit'])) {
    $fullName = htmlspecialchars($_POST['full_name']);
    $companyName = htmlspecialchars($_POST['comp_name']);
    $compEmail = htmlspecialchars($_POST['email']);
    $phoneNumber = htmlspecialchars($_POST['phone_number']);
    $type = htmlspecialchars($_POST['sectype']);
    $agree = htmlspecialchars($_POST['agree']);

    $key = md5(2418*2 .''.$fullName);
    $addKey = substr(md5(uniqid(rand(),1)),3,10);
    $key = $key . $addKey;

    $passwordType = 'set';

    $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d") + 1, date("Y"));
    $expDate = date("Y-m-d H:i:s",$expFormat);

    if(!$agree){
        $_SESSION['error'] = "agree to terms and conditions please";
    } else {
        $check_email = Is_email($compEmail);

        if($check_email){
            $sql = "SELECT * FROM business WHERE bizEmail = :email";
            if($stmt = $conn->prepare($sql)){
                $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                $param_email = $compEmail;

                if($stmt->execute()){
                    if($stmt->rowCount() == 1){
                        $_SESSION['error'] = "User already exist";
                    } else {
                        unset($stmt);
                        $insert = "INSERT INTO business (fullname, bizEmail, companyName,phoneNumber, securityType) VALUES (:fullname, :bizEmail, :bizName, :phone, :sec)";
                        
                        if($ins = $conn->prepare($insert)){
                            $ins->bindParam(":fullname", $param_fullname, PDO::PARAM_STR);
                            $ins->bindParam(":bizName", $param_bizName, PDO::PARAM_STR);
                            $ins->bindParam(":bizEmail", $param_bizEmail, PDO::PARAM_STR);
                            $ins->bindParam(":phone", $param_phone, PDO::PARAM_STR);
                            $ins->bindParam(":sec", $param_sec, PDO::PARAM_STR);

                            $param_fullname = $fullName;
                            $param_bizName = $companyName;
                            $param_bizEmail = $compEmail;
                            $param_phone = $phoneNumber;
                            $param_sec = $type;

                            if ($ins->execute()) {
                                $last_id = $conn->lastInsertId();
                                $passwordCreate = "INSERT INTO createPassword (BusId, token, expiryTime, type) 
                                VALUES (:bus, :token, :expire, :types)"; 
                                if($stmt = $conn->prepare($passwordCreate)){
                                    
                                    $stmt->bindParam(":bus", $param_lastId, PDO::PARAM_STR);
                                    $stmt->bindParam(":token", $param_token, PDO::PARAM_STR);
                                    $stmt->bindParam(":expire", $param_expire, PDO::PARAM_STR);
                                    $stmt->bindParam(":types", $param_type, PDO::PARAM_STR);
                                    
                                    $param_lastId = $last_id;
                                    $param_token = $key;
                                    $param_expire = $expDate;
                                    $param_type = $passwordType;

                                    if($stmt->execute()){
                                        if(ResetPassword($fullName, $key, $compEmail, $passwordType)){
                                            $_SESSION['success'] = "Please check your email for further instructions  ";
                                            return header("location:success.php");
                                        } else {
                                            $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
                                        }

                                    } else {
                                        $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
                                    }

                                } else {
                                    $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
                                }
                        
                            } else{
                                $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
                            }
                            
                            unset($ins);
                        } else {
                            $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
                        }
                    }
                }
            }

        } else {
            $_SESSION['error'] = "Invalid Email";
        }
    }

} elseif (isset($_GET["key"]) && isset($_GET["email"])  && isset($_GET["action"])) {
    
    
    $key = $_GET["key"];
    $email = $_GET["email"];
    $type = $_GET['action'];

    $resetsql = "SELECT * FROM createPassword WHERE token = '$key'";
    $reset = $conn->query($resetsql);
    if ($reset->rowCount() == 1) {
        $resetRow = $reset->fetch();

        $expDate = $resetRow['expiryTime'];
        
        if($expDate >= $today){
            $findUser = "SELECT * FROM business WHERE bizEmail = '$email'";
            $user = $conn->query($findUser);
            
            if($user->rowCount() == 1){
                $row = $user->fetch();
                $userId = $row['bizId'];

                $_SESSION['action'] = $type;
                $_SESSION['setpassword'] = $userId;
                return header("location:setpass.php");

            } else {
                $_SESSION['error'] = "Oops! Authention expired.";
            }

        } else {
            $_SESSION['resendemail'] = $email;
            return header("location:error.php");
        }
    
    }

} elseif (isset($_POST['newpassword'])) {

    $user = htmlspecialchars($_POST['bus']);
    $password = htmlspecialchars($_POST['password']);
    $ConfirmPassword = htmlspecialchars($_POST['confirm-password']);

    $action = $_POST['action'];

    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    $users = $conn->query("SELECT * FROM business WHERE bizId = '$user'");

    if($password != $ConfirmPassword){
        $_SESSION['setpassword'] = $user;
        $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
    } else {
        if ($users->rowCount() == 1) {
            
            $updatestaff = "UPDATE business SET password = :pass WHERE bizId = :id";
            $staffupdate = $conn->prepare($updatestaff);
            
            $staffupdate->bindParam(":pass", $param_sub, PDO::PARAM_STR);
            $staffupdate->bindParam(":id", $param_id, PDO::PARAM_STR);
                
            $param_sub = $hashedpassword;
            $param_id =  $user;

            if ($staffupdate->execute()) {
                $delete = "DELETE FROM  createPassword WHERE BusId = :dmail AND type = :actions";
                $prepare = $conn->prepare($delete);

                $prepare->bindParam(":dmail", $param_id, PDO::PARAM_STR);
                $prepare->bindParam(":actions", $param_act, PDO::PARAM_STR);
                
                $param_id = $user;
                $param_id = $action;

                if ($prepare->execute()) {
                    $_SESSION['success'] = 'Good job, Your password has been set, Please login to continue';
                    return header('location:login.php');    
                } else {
                    $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
                }
            } else {
                $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
            }


        }
        
    }
    
} elseif (isset($_POST['sigin'])) {
    $accessCode = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $check_email = Is_email($accessCode);

    if($check_email){
        $sql = $conn->query("SELECT * FROM business WHERE bizEmail = '$accessCode'");
        if(!$sql->rowCount()){
            $_SESSION['error'] = "This User does not exist";
        } else {
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                $_SESSION['user'] = $row['bizId'];
                return header('location:dashboard.php');
            } else {
                $_SESSION['error'] = "Incorrect Password, Please Try Again";
            }
        }
    }

} elseif (isset($_POST['forgotPass'])) {
    
    $action = 'reset'; 
    $email = htmlspecialchars($_POST['email']);

    $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
    $expDate = date("Y-m-d H:i:s",$expFormat);

    $check_email = Is_email($email); 

    
    if($check_email){
        $key = md5(2418*2 .''.$email);
        $addKey = substr(md5(uniqid(rand(),1)),3,10);
        $key = $key . $addKey;

        $users = "SELECT * FROM business WHERE bizId = '$email";
        $a = $conn->query($adminsql);
        if ($admin->rowCount() == 1) {
            $row = $admin->fetch();
            $id = $row['bizId'];
            $name = $row['fullname'];

            $passwordCreate = "INSERT INTO createPassword (BusId, token, expiryTime, type) VALUES (:bus, :token, :expire, :types)";
            if($stmt = $conn->prepare($insert)){
                
                $stmt->bindParam(":token", $param_hash, PDO::PARAM_STR);
                $stmt->bindParam(":bus", $param_bizId, PDO::PARAM_STR);
                $stmt->bindParam(":expire", $param_date, PDO::PARAM_STR);
                $stmt->bindParam(":types", $param_type, PDO::PARAM_STR);

                $param_hash = $key;
                $param_date = $expDate;
                $param_bizId = $id;
                $param_type = $action;

                if($stmt->execute()){
                    if (ResetPassword($name,$key,$email,$action)) {
                        $_SESSION['success'] = "Please check your email for further instructions  ";
                        return header("location:success.php");

                    } else {
                        $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
                    }
                } else{
                    $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
                }
                
                // Close statement
                unset($stmt);
    
            } else {
                $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
            
            }
        } else{
            $_SESSION['error'] = "Oops! User doesn't exist.";
        }
    } else{
        $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
    }


} elseif (isset($_POST['resetPassword'])) {

    $user = htmlspecialchars($_POST['bus']);
    $password = htmlspecialchars($_POST['password']);
    $ConfirmPassword = htmlspecialchars($_POST['confirm-password']);

    $action = $_POST['action'];

    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    $users = $conn->query("SELECT * FROM business WHERE bizId = '$user'");

    if($password != $ConfirmPassword){
        $_SESSION['reaetPassword'] = $user;
        $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
    } else {
        if ($users->rowCount() == 1) {
            
            $updatestaff = "UPDATE business SET password = :pass WHERE bizId = :id";

            $staffupdate->bindParam(":pass", $param_sub, PDO::PARAM_STR);
            $staffupdate->bindParam(":id", $param_id, PDO::PARAM_STR);
                
            $param_sub = $hashedpassword;
            $param_id =  $user;

            if ($staffupdate->execute()) {
                $delete = "DELETE FROM  createPassword WHERE BusId = :dmail AND type = :actions";
                $prepare = $conn->prepare($delete);

                $prepare->bindParam(":dmail", $param_id, PDO::PARAM_STR);
                $prepare->bindParam(":actions", $param_act, PDO::PARAM_STR);
                
                $param_id = $user;
                $param_id = $action;

                if ($prepare->execute()) {
                    $_SESSION['success'] = 'Good job, Your password has been reset, Please login to continue';
                    return header('location:login.php');    
                } else {
                    $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
                }
            } else {
                $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
            }

        }
        
    }

} elseif (isset($_POST['addSite'])){
    $site = htmlspecialchars($_POST['site']);

    $insert = "INSERT INTO websites(website, bizId) VALUES (:web, :user)";
    if($ins = $conn->prepare($insert)){
        $ins->bindParam(":web", $param_webName, PDO::PARAM_STR);
        $ins->bindParam(":user", $param_user, PDO::PARAM_STR);


        $param_webName = $site;
        $param_user = $bizId;

        if($ins->execute()){
            $_SESSION['success'] = " Record created successfuly";
        } else {
            $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
        }
    }

} elseif (isset($_POST['addDNS'])) {
    
    $siteId = htmlspecialchars($_POST['website']);
    $DNS1 = htmlspecialchars($_POST['dns-1']);
    $DNS2 = htmlspecialchars($_POST['dns-2']);
    $DNS3 = htmlspecialchars($_POST['dns-3']);

    $DNSID = htmlspecialchars($_POST['DNS']);

    if ($DNSID) {
        $updateDNS = "UPDATE webDNS SET DNS1 = :dns1, DNS2 = :dns2, DNS3 = :dns3 WHERE dnsId = :id";
        $DNSUpdate = $conn->prepare($updateDNS);

        $DNSUpdate->bindParam(":dns1", $param_dns1, PDO::PARAM_STR);
        $DNSUpdate->bindParam(":dns2", $param_dns2, PDO::PARAM_STR);
        $DNSUpdate->bindParam(":dns3", $param_dns3, PDO::PARAM_STR);
        $DNSUpdate->bindParam(":id", $param_id, PDO::PARAM_STR);
        
        $param_dns1 = $DNS1;
        $param_dns2 = $DNS2;
        $param_dns3 = $DNS3;
        $param_id = $DNSID;

        if($DNSUpdate->execute()){
            $_SESSION['success'] = " Record created successfuly";
        } else {
            $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
        }

    } else {

        $addDns = "INSERT INTO webDNS(DNS1, DNS2, DNS3, webId, addBy) VALUES(:dns1, :dns2, :dns3, :web, :addby)";
    
        if($insert = $conn->prepare($addDns)){
    
            $insert->bindParam(":dns1", $param_dns1, PDO::PARAM_STR);
            $insert->bindParam(":dns2", $param_dns2, PDO::PARAM_STR);
            $insert->bindParam(":dns3", $param_dns3, PDO::PARAM_STR);
            $insert->bindParam(":web", $param_web, PDO::PARAM_STR);
            $insert->bindParam(":addby", $param_addBy, PDO::PARAM_STR);
    
            $param_dns1 = $DNS1;
            $param_dns2 = $DNS2;
            $param_dns3 = $DNS3;
            $param_web = $siteId;
            $param_addBy = $bizId;
    
            if($insert->execute()){
                $_SESSION['success'] = " Record created successfuly";
            } else {
                $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
            }
    
        } else {
            $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
        }
        
    }

} elseif (isset($_POST['deleteSite'])) {
    
    $siteId = htmlspecialchars($_POST['website']);
    $DNSID = htmlspecialchars($_POST['DNS']);
    
    if($DNSID){
        $sqlDNS = "DELETE FROM  webDNS WHERE dnsId = :id";
        $DNSstmt = $conn->prepare($sqlDNS);

        $DNSstmt->bindParam(":id", $param_id, PDO::PARAM_STR);
        $param_id = $DNSID;
        
        $DNSstmt->execute();

    } 

    $sql = "DELETE FROM  websites WHERE webId = :id";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);
    $param_id = $siteId;
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Record Deleted successfully";
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again later.";
    }

} elseif (isset($_POST['profilepic'])) {
   
    $img = $_FILES['file']['name'];
    $photo = $today.$regnum.$img;

    $target_dir = "upload/profile/";

    if (!empty($img)) {
        $target_file = $target_dir .basename($photo);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        $check = getimagesize($_FILES['file']['tmp_name']);

        if ($check !== false) {
            
            if (file_exists($target_file)) {
                $_SESSION['error'] = "Sorry, This File Already Exist";
            } else {
                
                if ($_FILES["file"]["size"] > 5000000) {
                    $_SESSION['error'] = "Sorry, This File is too Large";
                }  else {
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imagefiletype != 'pdf'){
                        $_SESSION['error'] = "Sorry, Only PNG, JPG, JPEG and GIF allowed!";
                    } else {

                        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                            
                            $sql = "UPDATE hospitals SET hosImage = :picture WHERE hospitalId = :id";
                            $stmt = $conn->prepare($sql);
                            
                            $stmt->bindParam(":picture", $param_name, PDO::PARAM_STR);
                            $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);

                            $param_name = $photo;
                            $param_id = $hospital;

                            if ($stmt->execute()) {
                                $_SESSION['success'] = "Image Upload Successful";
                            } else {
                                $_SESSION['error'] = "Something went wrong. Please try again later.";
                            }
                        } else {
                            $_SESSION['error'] = 'Something went wrong. Please try again';
                        }
                    }
                }
            }

        } else {
            $_SESSION['error'] = "Sorry, The file You tried to upload is not an image";
        }
        

    } else {
        $_SESSION['error'] = "Sorry, The file You tried to upload is not an image";
    }
} else {
    $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
}

$conn = null;
header('location:' .$return);
?>