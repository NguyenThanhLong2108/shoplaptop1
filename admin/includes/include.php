<?php
    require_once('conn.php');
    if(!isset($_SESSION['taikhoan'])){
        
    }
    
    function Pr($arr){
        echo "<pre>";
        print_r($arr);
    }

    function Prx($arr){
        echo "<pre>";
        print_r($arr);
        die();
    }

    function Check_db($sql){
        $conn = Connect();
        $res = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $res;
    }

    function Get_value($str){
        $conn = Connect();
        if($str != ""){
            return mysqli_real_escape_string($conn, $str);
        }
    }

    //kiem tra quyen hien tai voi trang co trung khop voi quyen ko
    function Check_role_in_site($role){ 
        if($_SESSION['maquyen'] != $role){
            header('location: ./index.php');
        }
        exit();
    }

    function Check_role($role){ 
        if (!isset($_SESSION['maquyen'])) {
            header('location: ../login.php');
            exit();
        }
    
        switch ($role) {
            case "NV":
                header('location: ./staff/index.php');    
                exit();
            case "KH":
                header('location: ./index.php');
                exit();
            case "AM":
                header('location: ./admin/index.php');
                exit();
            default:
                header('location: ../login.php');
                exit();
        }
    }
    
    function Check_f5($refresh){
        $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
        if($pageWasRefreshed ) {
            unset($refresh);
        }
    }
?>