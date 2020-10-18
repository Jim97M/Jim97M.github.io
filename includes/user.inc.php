<?php

class USER extends SESSION

{
    private $url = '';
    private $emailAPIKey = 'A2220B22E29D5685CF56188AD2AAAD01E955B99406DD4A8BCDA5070081A572D2950BD40312CD9D87F061F64C62089778';
    
    public function getuserbyid($id)
    {
        $sql= "SELECT * from user where user_id = ?;";
        $data = $this->query_1($sql, $id);
        return $data;
    }
    //checks if the email address entered alredy exists in the db
    public function getuserbyEmail($email)
    {
        $sql = ("SELECT user_email FROM user WHERE user_email = ?");
        
        if ($stmt = $this->conn()->prepare($sql)) {
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function getAllUsers()
    {
        $sql = ("SELECT *  FROM user  ORDER BY user_id DESC ");
        $data = $this->queryNone($sql);
        return $data;
    }

    public function count($field, $table)
    {
        $sql = "SELECT count($field) as id from $table";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute();
        $row =$stmt->fetch();
        return $row;
    }

    public function countSpecific($field, $table, $condition)
    {
        $sql = "SELECT count($field) as id from $table where $field = '$condition';";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute();
        $row =$stmt->fetch();
        return $row;
    }

    public function countTwoSpecific($field, $field2 , $table, $condition, $conditon2 )
    {
        $sql = "SELECT count($field) as id from $table where $field = '$condition' and $field2 = '$conditon2';";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute();
        $row =$stmt->fetch();
        return $row;
    }


    //Gets all records of the  privided email
    public function getUserDataByEmail($email)
    {
        $sql = ("SELECT * FROM user WHERE user_email = ?");
        return $data= $this->query_1($sql, $email);
    }


    //gets all the admin records
    public function getAdmins()
    {
        $sql = "SELECT user_id,user_email,user_fname,user_lname,user_phobeNo,admin_registered_by from user 
        inner join admin on user_id = admin_fk_user_id;";
        $data = $this->queryNone($sql);
        return $data;
    }

    //check of the user request is approved to post add is approved
  
    public function checkRequest($id)
    {
        $sql = "SELECT * from unverified_seller where user_user_id = $id";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return false;
        } else {

            return true;
        }
    }

    public function getUnapproved(){
        $sql = "SELECT * from unverified_seller inner join user on user_id = user_user_id ";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return false;
        } else {

            return $data;
        }
    }

    public function getapproved(){
        $sql = "SELECT * from shop inner join user on user_id = shop_fk_user_id ";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return false;
        } else {

            return $data;
        }
    }

    public function welcomeEmail($subject, $bodyHTML, $to){
        $url = 'https://api.elasticemail.com/v2/email/send';

        try{
                $post = array('from' => 'noreply@madukaonline.co.ke',
                'fromName' => 'MADUKA ONLINE',
                'apikey' => $this->emailAPIKey,
                'subject' => $subject,
                'to' => $to,
                'bodyHtml' => $bodyHTML,
                // 'bodyText' => $textBody,
                'isTransactional' => true);
                
                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_URL => $url,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $post,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HEADER => false,
                    CURLOPT_SSL_VERIFYPEER => false
                ));
                
                $result=curl_exec ($ch);
                curl_close ($ch);
               	
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }
    }
    
    public function createNotification($message, $type, $userid){
        $sql = "INSERT INTO notifications (notification, type, user_id) VALUES ('$message','$type', '$userid');";
        $this->queryInsert($sql);
    }

    public function getNewUserNotification($userid){
        $sql = "SELECT * from notifications where user_id = $userid AND status = 0;";
        return $this->queryNone($sql);
    }

    public function getAdmNotification($userid){
        $sql = "SELECT * from notifications where type = 'admin';";
        return $this->queryNone($sql);
    }

    public function updateNotification($userid){
        $sql = "UPDATE notifications SET status = '1' WHERE (notification_id = '$userid');";
        $this->queryInsert($sql);
    }
    
}