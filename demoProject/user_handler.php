<?php 
include 'database.php';
class User{

    function tableList($db){
        $query = "SELECT * FROM user_master";
        $result = $db->getData($query);
        
        $html = '';  
    
        if($result['success'] == true){
            $sno =0;
            foreach($result['data'] as $value){
                $sno++;
                $html .= '<tr>';
                $html .= '<td>' . $sno . '</td>';
                $html .= '<td>' . $value['id'] . '</td>';
                $html .= '<td>' . $value['name'] . '</td>';
                $html .= '<td>' . $value['email'] . '</td>';
                $html .= '<td>' . $value['phone_no'] . '</td>';
                $html .= '<td>
                             <button class="btn btn-sm btn-dark" onclick="getFromData(' . $value['id'] . ')">edit</button>
                            <button class="btn btn-sm btn-danger">delete</button>
                          </td>';
                $html .= '</tr>';
            }
        }
    
        return $html;
    }

    function addUpdate($db,$data){

        $formData = [];
        foreach ($data as $key => $value) {
            $formData[$key] = isset($value) ? $value : '';
        }
        $name = $formData['name'];
        $email = $formData['email'];
        $phone_no = $formData['phone_no'];
        $password = $formData['password'];
        $id = !empty($formData['id'])?$formData['id']:0;

        $err = array();
        if (empty($name)) {
            $err[] = "Name cannot be empty.";
        }

        if (empty($email)) {
            $err[] = "Email cannot be empty.";
        }

        if (empty($phone_no)) {
            $err[] = "Phone number cannot be empty.";
        }

        
        if (empty($password)) {
            $err[] = "Password number cannot be empty.";
        }
        if (!empty($err)) {
            foreach ($err as $message) {
                return array("success"=>false,"message"=>$message);
                break;
            }
        }

        $query =  "";
        if (empty($id)) {
            $query = "INSERT INTO user_master (name, email, phone_no, password)
            VALUES ('$name', '$email', '$phone_no', '$password')";
        } else {
            $query = "UPDATE user_master 
            SET name = '$name', email = '$email', phone_no = '$phone_no', password = '$password' 
            WHERE id = '$id'";
        }

        $db_resp = $db->runQuery($query);
        if($db_resp){
            return array("success"=>true,"message"=>"User saved successfully");
        }else{
            return array("success"=>false,"message"=>"Failed to save");
        }


    }

    function getFormDetails($db,$id){
        $query = "SELECT * FROM user_master WHERE id = ".$id;
        $data  = $db->getEditRecord($query);
        if($data['success'] == true ){
            return array("success"=>true,"data" =>$data['data']);

        }else{
            return array("success"=>true,"data" =>array());
        }
    }
}



if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $type = strtoupper($_POST['type']);
    $user = new User();
    $db = new Database();
    unset($_POST['type']);

    if(!empty($type) && $type == 'USER_LIST'){
        echo  $user->tableList($db);
    }else if($type == "ADD_EDIT"){
        $respone = $user->addUpdate($db,$_POST);
        echo json_encode($respone);
    }else if($type == "GET_RECORD"){
        $respone = $user->getFormDetails($db,$_POST['id']);
        echo json_encode($respone); 
    }
}
?>