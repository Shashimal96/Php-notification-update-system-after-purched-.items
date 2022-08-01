<?php
function pr($arr){
    echo '<pre>';
    print_r($arr);
} 

function prx($arr){
    echo '<pre>';
    print_r($arr);
    die();
}

function get_safe_value($con,$str){
    if($str!=''){
        $str=trim($str);
    return mysqli_real_escape_string($con,$str); 
}
}

function get_product($con,$limit='',$cat_id='',$product_id=''){
    $sql="select product.*,categories.categories from product,categories where product.status=1 ";  
    if($cat_id!='') {
        $sql.=" and product.category_id=$cat_id ";
    }
    if($product_id!='') {
        $sql.=" and product.id=$product_id ";
    }
    $sql.=" and product.category_id=categories.id ";
    $sql.=" order by product.id desc";
    if($limit!='') {
        $sql.=" limit $limit";
    }
    
    $res=mysqli_query($con,$sql);
    $data=array();
    while($row=mysqli_fetch_assoc($res)){
        $data[]=$row;
    }
    return $data;

}
function get_search_result($con, $type, $val){
    if($type == "keyword"){
        $sql= "SELECT product.*, categories.categories FROM Product INNER JOIN categories ON product.category_id=categories.id WHERE product.name LIKE '%".$val."%';";
        $res=mysqli_query($con,$sql);
        $data=array();
        while($row=mysqli_fetch_assoc($res)){
            $data[]=$row;
        }
        return $data;
    } else if($type == "image"){
        if($val['name'] != ''){
            $image=rand(111111111,999999999).'_'.$val['name']; 
            move_uploaded_file($_FILES['image']['tmp_name'],search_image_path.$image);
            
            // API URL
            $url = 'http://localhost:5000/';
            // Create a new cURL resource
            $ch = curl_init($url);
            $payload = json_encode(array("image_name" => $image));
            // Attach encoded JSON string to the POST fields
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            // Set the content type to application/json
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            // Return response instead of outputting
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Execute the POST request
            $result = curl_exec($ch);
            // Close cURL resource
            curl_close($ch);

            if ($result === FALSE) {
                return "Error";
            }

            $similar_img = preg_split ("/\,/", $result);
            $data=array();

            foreach ($similar_img as $img) {
                try {
                    $sql= "SELECT product.*, categories.categories FROM Product INNER JOIN categories ON product.category_id=categories.id WHERE product.image LIKE '%".$img."%';";
                    $res=mysqli_query($con,$sql);
                    while($row=mysqli_fetch_assoc($res)){
                        if (!in_array($row, $data)){
                            $data[]=$row;
                        }
                    }
                } catch(Exception $e) {
                    
                }
            }
            return $data;
         }
    }

}
?>