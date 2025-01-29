<?php 
include 'database.php';
class item{

    function tableList($db){
        $query = "SELECT * FROM item_master";
        $result = $db->getData($query);
        
        $html = '';  
    
        if($result['success'] == true){
            $sno =0;
            foreach($result['data'] as $value){
                $sno++;
                $html .= '<tr>';
                $html .= '<td>' . $sno . '</td>';
                $html .= '<td>' . $value['id'] . '</td>';
                $html .= '<td>' . $value['item_name'] . '</td>';
                $html .= '<td>' . $value['item_description'] . '</td>';
                $html .= '<td>' . $value['price'] . '</td>';
                $html .= '<td>' . $value['path'] . '</td>';
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
        $item_name = $formData['itemname'];
        $item_description = $formData['itemdescription'];
        $price = $formData['itemprice'];
        $path = $formData['itemimage'];
        $id = !empty($formData['id'])?$formData['id']:0;


    //      // Handle the file input
    // $path = '';
    // if (isset($_FILES['itemimage'])) {
    //     $file = $_FILES['itemimage'];
    //     $path = $this->uploadFile($file);
    // }


        $err = array();
        if (empty($item_name)) {
            $err[] = "item_name cannot be empty.";
        }

        if (empty($item_description)) {
            $err[] = "item_description cannot be empty.";
        }

        if (empty($price)) {
            $err[] = "price number cannot be empty.";
        }

        
        if (empty($path)) {
            $err[] = "path number cannot be empty.";
        }
        if (!empty($err)) {
            foreach ($err as $message) {
                return array("success"=>false,"message"=>$message);
                break;
            }
        }

        $query =  "";
        if (empty($id)) {
            $query = "INSERT INTO item_master (item_name, item_description, price, path)
            VALUES ('$item_name', '$item_description', '$price', '$path')";
        } else {
            $query = "UPDATE item_master 
            SET item_name = '$item_name', item_description = '$item_description', price = '$price', path = '$path' 
            WHERE id = '$id'";
        }

        $db_resp = $db->runQuery($query);
        if($db_resp){
            return array("success"=>true,"message"=>"item saved successfully");
        }else{
            return array("success"=>false,"message"=>"Failed to save");
        }


    }


    // function uploadFile($file) {
    //     $target_dir = 'uploads/';
    //     $target_file = $target_dir . basename($file['name']);
    //     if (move_uploaded_file($file['tmp_name'], $target_file)) {
    //         return $target_file;
    //     } else {
    //         return '';
    //     }
    // }


    function getFormDetails($db,$id){
        $query = "SELECT * FROM item_master WHERE id = ".$id;
        $data  = $db->getEditRecord($query);
        if($data['success'] == true ){
            return array("success"=>true,"data" =>$data['data']);

        }else{
            return array("success"=>true,"data" =>array());
        }
    }

      function deleteItem($db,$id){
        $query = " DELETE FROM item_master WHERE id = ".$id;
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
        $item = new item();
        $db = new Database();
        unset($_POST['type']);

       if(!empty($type) && $type == 'LIST'){
            echo  $item->tableList($db);
        }else if($type == "ADD_EDIT"){
            $response = $item->addUpdate($db,$_POST);
            echo json_encode($response);
        }else if($type == "GET_RECORD"){
            $response = $item->getFormDetails($db,$_POST['id']);
            echo json_encode($response); 
        }else if($type == "DELETE_RECORD"){
            $response = $item->deleteitem($db,$_POST['id']);
            echo json_encode($response);
        }
    } else {
        // Handle the case where the "type" key is not present in the $_POST array
        echo "Error: Missing 'type' parameter in the request.";
    }
}
?>
