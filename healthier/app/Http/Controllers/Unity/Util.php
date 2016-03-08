<?php
/**
 * Created by PhpStorm.
 * User: xinlin
 * Date: 15/12/3
 * Time: 10:52
 */
namespace App\Http\Controllers\Unity;
session_start();
class Util
{
    public static function setCurrentUserId($id){
        Util::sessionOpen();
        unset($_SESSION['id']);
        $_SESSION['id']=$id;
        $_SESSION['admin']='user';
    }

    public static function setCurrentAdminId($id){
        Util::sessionOpen();
        unset($_SESSION['admin']);
        $_SESSION['admin']=$id;
    }

    public static function sessionOpen(){
        if(!isset($_SESSION)){ session_start();};
    }
}