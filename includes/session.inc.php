<?php

class SESSION extends DATABASE
{
    private $signed_in = false;
    private $session_id;
    private $session_email;
    private $usertype;

    
    public function __construct()
    {
        

    }
//return the session of the person who is logged in
    public function getSessionID(){
        return $_SESSION['maduka_user_id'];
    }
    function islogged(){
        if (isset($_SESSION['maduka_user_id'])) {
            return true;
        }else {
            return false;
        }
    }
    
    public function login($user,$email)
    {//sets thesession id of the user
        if ($user) {
            $_SESSION['maduka_user_id'] = $user;
            $this->signed_in = true;
            $this->session_id= $user;
            $this->session_email= $email;
        }
    }

    
    public function is_admin()
    {
        if (isset($_SESSION['user_type'])) {
            if ($_SESSION['user_type'] === "normal") {
                redirect("user.php");
            } elseif ($_SESSION['user_type'] === "admin") {
                # code...
            }
        }
    }

    public function isAdmin ($id){
        $sql = "SELECT user_user_id as adminID FROM admin where user_user_id = $id";
        $result = $this->queryNone($sql);
        if (empty($result)) {
            return false;
        } else {
            return true;
        } 
    }
    public function isSeller($id){
        $sql = "SELECT shop_fk_user_id  as shopID FROM shop where shop_fk_user_id = $id";
        $result = $this->queryNone($sql);
        if (empty($result)) {
            return false;
        } else {
            return true;
        } 
    }

    //check type of admin and return true if super and false ir normal
    public function admintypeSuper($id){
        $result = $this->isAdmin($id);
        $admintype = $result[0]['admin_type'];
        if ($admintype === 'normal') {
            return false;
        } elseif($admintype === 'super') {
            return true;
        }

    }

    
    public function redirect($location)
    {
        header("Location: {$location}");
    }
}
