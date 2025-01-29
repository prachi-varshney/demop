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
                $html .= '<td>' . $value['phone'] . '</td>';
                $html .= '<td>
                             <button class="btn btn-sm btn-dark" onclick="getFromData(' . $value['id'] . ')">edit</button>
                             <button class="btn btn-sm btn-danger delete-btn" onclick="deleteRecords(' . $value['id'] . ')">delete</button>
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
        $phone = $formData['phone'];
        $password = $formData['password'];
        $id = !empty($formData['id'])?$formData['id']:0;

        $err = array();
        if (empty($name)) {
            $err[] = "Name cannot be empty.";
        }

        if (empty($email)) {
            $err[] = "Email cannot be empty.";
        }

        if (empty($phone)) {
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
            $query = "INSERT INTO user_master (name, email, phone, password)
            VALUES ('$name', '$email', '$phone', '$password')";
        } else {
            $query = "UPDATE user_master 
            SET name = '$name', email = '$email', phone = '$phone', password = '$password' 
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

    function deleteUser($db,$id){
        $query = " DELETE FROM user_master WHERE id = ".$id;
        $data  = $db->runQuery($query);

        if($data){
            return array("success"=>true,"message" =>"Record deleted successfully");
        }else{
            return array("success"=>false,"message" => "Failed to delete");
        }
    }
}


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['type'])) {
        $type = strtoupper($_POST['type']);
        $user = new User();
        $db = new Database();
        unset($_POST['type']);

        if(!empty($type) && $type == 'LIST'){
            echo  $user->tableList($db);
        }else if($type == "ADD_EDIT"){
            $response = $user->addUpdate($db,$_POST);
            echo json_encode($response);
        }else if($type == "GET_RECORD"){
            $response = $user->getFormDetails($db,$_POST['id']);
            echo json_encode($response); 
        }else if($type == "DELETE_RECORD"){
            $response = $user->deleteUser($db,$_POST['id']);
            echo json_encode($response);
        }
    } else {
        // Handle the case where the "type" key is not present in the $_POST array
        echo "Error: Missing 'type' parameter in the request.";
    }
}
?>