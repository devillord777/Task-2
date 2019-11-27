<?php
require_once 'function.php';

switch($_SERVER['REQUEST_METHOD']){
  case 'GET':
    $user = new User;
    $response = $user->getUser($_GET['id']);
    echo json_encode($response);
  break;

  case 'POST':

    $user = new User;
    $response = $user->createUser($_POST['email'],$_POST['password']);
    echo json_encode($response);
    
  break;

  case 'DELETE':
    $putdata = file_get_contents('php://input');
    $exploded = explode('&', $putdata);

    foreach($exploded as $pair) { 
      $item = explode('=', $pair); 
      if(count($item) == 2) { 
        $_DELETE[urldecode($item[0])] = urldecode($item[1]); 
      } 
    }
    $user = new User;
    $response = $user->deleteUser($_DELETE['id']);
    echo json_encode($response);

  break;
}




?>