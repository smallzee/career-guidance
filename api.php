<?php
/**
 * Created by PhpStorm.
 * User: Tech4all
 * Date: 1/27/21
 * Time: 12:36 PM
 */

header('Access-Control-Allow-Origin: *');
//header("Content-Type:application/json");
header('Access-Control-Allow-Methods: POST, GET, PUT, OPTIONS, PATCH, DELETE');
require_once 'config/core.php';

$post_data = $_POST;
$data = $school_data = array();


if (isset($_POST['guidance'])){
    $sql = $db->query("SELECT * FROM ".DB_PREFIX."schools ORDER BY name");
    if ($sql->rowCount() == 0){
        $data['error'] = 1;
        $data['msg'] = "Error";
    }else{
        $data['error'] = 1;
        while ($rs = $sql->fetch(PDO::FETCH_ASSOC)){
           $school_data[] = array(
               'id'=>$rs['id'],
               'name'=>ucwords($rs['name']),
               'description'=>$rs['description']
           );
        }

        if (is_array($school_data) && count($school_data) > 0){
            for ($i =0; $i < count($school_data); $i++){
                $school_id = $school_data[$i]['id'];

                $sql2 = $db->query("SELECT * FROM ".DB_PREFIX."departments WHERE school_id='$school_id' ORDER BY name");
                while ($rs2 = $sql2->fetch(PDO::FETCH_ASSOC)){
                    $school_data[$i]['department'][] = array(
                        'id'=>$rs2['id'],
                        'name'=>ucwords($rs2['name'])
                    );
                }

            }
        }
    }

    $info = array('data'=>$data,'school_data'=>$school_data);
    echo json_encode($info);
    exit();
}