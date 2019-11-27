<?php

class User{
  public $servername = 'localhost';
  public $dbname = 'task2';
  public $table_name='User';
  public $username = 'root';
  public $password = '';


  function createUser($email,$pass){
    $servername=$this->servername;
    $dbname=$this->dbname;
    $username=$this->username;
    $password=$this->password;
    $table_name = $this->table_name;
    $result=[];
    if($email == '' || $pass == ''){
      $result['status'] = 'error';
      $result['errorText'] = 'Email and Password are required';
    }else{
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $query_check = "SELECT id FROM $table_name WHERE email='$email'";
      $data_check = $conn->query($query_check);
      $data_check =$data_check->fetch();
        if($data_check == ''){
          
          $query = "INSERT INTO $table_name (email, password ) VALUES ('$email','$pass'); ";
          $conn->query($query);
          $query_id = "SELECT id FROM $table_name WHERE email='$email'";
          $data_id = $conn->query($query_id);
          $data_id = $data_id->fetch();
          $result['status'] = 'OK';
          $result['user']['id']=$data_id['id'];
          $result['user']['email']=$email;
          $result['user']['password']=$pass;

        }else{
          $result['status']='error';
          $result['errorText']='User with this email already exist';
        }
      
        
      }
      catch(PDOException $e)
        {
          $result['status']='error';
          $result['errorText']="Connection failed: " . $e->getMessage();   
        }
      }
    return $result;
  }

  function getUser($id){
    $servername=$this->servername;
    $dbname=$this->dbname;
    $username=$this->username;
    $password=$this->password;
    $table_name = $this->table_name;
    $result=[];
    if($id == ''){
      $result['status'] = 'error';
      $result['errorText'] = 'ID are required';
    }else{
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $query_check = "SELECT id,email,password FROM $table_name WHERE id='$id'";
      $data_check = $conn->query($query_check);
      $data_check =$data_check->fetch();
        if($data_check == ''){

          $result['status'] = 'error';
          $result['errorText']="User with id $id is absent";


        }else{
          $result['status'] = 'OK';
          $result['user']['id']=$id;
          $result['user']['email']=$data_check['email'];
          $result['user']['password']=$data_check['password'];
        }
      
        
      }
      catch(PDOException $e)
        {
          $result['status']='error';
          $result['errorText']="Connection failed: " . $e->getMessage();   
        }
      }
    return $result;
  }

  function deleteUser($id){
    $servername=$this->servername;
    $dbname=$this->dbname;
    $username=$this->username;
    $password=$this->password;
    $table_name = $this->table_name;
    $result=[];
    if($id == ''){
      $result['status'] = 'error';
      $result['errorText'] = 'ID are required';
    }else{
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $query_check = "SELECT id FROM $table_name WHERE id='$id'";
      $data_check = $conn->query($query_check);
      $data_check =$data_check->fetch();
        if($data_check == ''){

          $result['status'] = 'error';
          $result['errorText']="User with id $id is absent";


        }else{
          $query_check = "DELETE FROM $table_name WHERE id='$id'";
          $data_check = $conn->query($query_check);
          $result['status'] = 'OK';
        }
      
        
      }
      catch(PDOException $e)
        {
          $result['status']='error';
          $result['errorText']="Connection failed: " . $e->getMessage();   
        }
      }
    return $result;
  }

}



