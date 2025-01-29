<?php 
include 'database.php';
class Client{

    function tableList($db){
        $query = "SELECT id,name,phone,email,CONCAT(t1.address,', ',t2.state_name, ', ',t3.district_name, ', ',pincode) AS address 
        FROM client_master as t1 
        LEFT JOIN ms_state_master AS t2 ON t1.state = t2.state_id 
        LEFT JOIN ms_district_master as t3 ON t1.city = t3.district_id";
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
                $html .= '<td>' . $value['address'] . '</td>';
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
        $state = $formData['state'];
        $city = $formData['city'];
        $pincode = $formData['pincode'];
        $address = $formData['address'];
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

        if (empty($pincode)) {
            $err[] = "PinCode number cannot be empty.";
        }

        
       
        if (!empty($err)) {
            foreach ($err as $message) {
                return array("success"=>false,"message"=>$message);
                break;
            }
        }

        $query =  "";
        if (empty($id)) {
            $query = "INSERT INTO client_master (name, email, phone, state, city, pincode, address) 
            VALUES ('$name', '$email', '$phone', '$state', '$city', '$pincode', '$address')";
          
        } else {
            $query = "UPDATE client_master 
            SET name = '$name', email = '$email', phone = '$phone',state = '$state', city = '$city', pincode = '$pincode', address = '$address'
            WHERE id = '$id'";
        }

        $db_resp = $db->runQuery($query);
        if($db_resp){
            return array("success"=>true,"message"=>"Client saved successfully");
        }else{
            return array("success"=>false,"message"=>"Failed to save");
        }


    }

    function getFormDetails($db,$id){
        $query = "SELECT * FROM client_master WHERE id = ".$id;
        $data  = $db->getEditRecord($query);
        if($data['success'] == true ){
            return array("success"=>true,"data" =>$data['data']);

        }else{
            return array("success"=>true,"data" =>array());
        }
    }

    function deleteClient($db,$id){
        $query = " DELETE FROM client_master WHERE id = ".$id;
        $data  = $db->runQuery($query);

        if($data){
            return array("success"=>true,"message" =>"Record deleted successfully");
        }else{
            return array("success"=>false,"message" => "Failed to delete");
        }
    }

    function stateList($db){
        $query = "SELECT state_id,state_name FROM ms_state_master";
        $result = $db->getData($query);
        
        $selectOption = '';  
    
        if($result['success'] == true){
            foreach($result['data'] as $value){
                $selectOption .= '<option value="' . $value['state_id'] . '">' . $value['state_name'] . '</option>';
            }
        }
    
        return $selectOption;
    }

    function cityList($db,$id){
        $query = "SELECT district_id,district_name FROM ms_district_master WHERE state_id = ".$id;
        $result = $db->getData($query);
        
        $selectOption = '';  
    
        if($result['success'] == true){
            foreach($result['data'] as $value){
                $selectOption .= '<option value="' . $value['district_id'] . '">' . $value['district_name'] . '</option>';
            }
        }
    
        return $selectOption;
    }

}


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['type'])) {
        $type = strtoupper($_POST['type']);
        $Client = new Client();
        $db = new Database();
        unset($_POST['type']);

        if(!empty($type) && $type == 'LIST'){
            echo  $Client->tableList($db);
        }else if($type == "ADD_EDIT"){
            $response = $Client->addUpdate($db,$_POST);
            echo json_encode($response);
        }else if($type == "GET_RECORD"){
            $response = $Client->getFormDetails($db,$_POST['id']);
            echo json_encode($response); 
        }else if($type == "DELETE_RECORD"){
            $response = $Client->deleteClient($db,$_POST['id']);
            echo json_encode($response);
        }else if($type == "STATE_LIST"){
            echo  $Client->stateList($db);
        }
        else if($type == "CITY_LIST"){
            echo  $Client->cityList($db,$_POST['state_id']);
        }
    } else {
        // Handle the case where the "type" key is not present in the $_POST array
        echo "Error: Missing 'type' parameter in the request.";
    }
}
?>