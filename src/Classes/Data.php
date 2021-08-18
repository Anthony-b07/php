<?php

namespace App\Classes;
use App\Classes\Connection;
use PDO;
use PDOException;
session_start();

class Data{


    public function insertData(string $title,string $overview,string $content,$date,$user_id){
        $db = new Connection();
    $conn = $db->connect();
    try {
        $querry = "INSERT INTO articles (title,overview,content,date,user_id) VALUES ('$title','$overview','$content','$date',$user_id)";        
        $conn->exec($querry);
        header("Location:../../article.php");
        }
    catch(PDOException $e)
        {
    
            echo $querry . "<br>" . $e->getMessage();
        }
    
    $conn = null;
}

public function getData(){
    $db = new Connection();
    $conn = $db->connect();
    $id=$_SESSION['id'];
    try{
        $sql="SELECT * FROM articles WHERE user_id=$id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $array=json_decode(json_encode($stmt->fetchAll(PDO::FETCH_OBJ)),true);
  
       return  $array;
      

    }
   catch(PDOException $e)
        {
    
            echo $sql . "<br>" . $e->getMessage();
        }
}

public function deleteData($articleId){
    $db = new Connection();
    $conn = $db->connect();
    try {
        $sql = "DELETE FROM articles WHERE id= $articleId";
    
        /*use exec() because no results are returned*/
        $conn->exec($sql);
        echo "Record deleted successfully";
        header("Location:../../article.php");
        exit();
        }
    catch(PDOException $e)
        {
        echo $sql . "
    " . $e->getMessage();
        }
    
    $conn = null;
}
}