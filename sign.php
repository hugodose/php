<?php
// use google\appengine\api\users\User;
// use google\appengine\api\users\UserService;

// $user = UserService::getCurrentUser();

$db = null;
if (isset($_SERVER['SERVER_SOFTWARE']) &&
strpos($_SERVER['SERVER_SOFTWARE'],'Google App Engine') !== false) {
  // Connect from App Engine.
  try{
     $db = new pdo('mysql:unix_socket=/cloudsql/hazel-proxy-88217:jogo;dbname=MinhaDB', 'root', '');
  }catch(PDOException $ex){
      die(json_encode(
          array('outcome' => false, 'message' => 'Unable to connect.')
          )
      );
  }
} else {
  // Connect from a development environment.
  try{
     $db = new pdo('mysql:host=127.0.0.1:3306;dbname=MinhaDB', 'root', '');
  }catch(PDOException $ex){
      die(json_encode(
          array('outcome' => false, 'message' => 'Unable to connect')
          )
      );
  }
}
try {
  if (array_key_exists('content', $_POST)) {
    $stmt = $db->prepare('INSERT INTO person (FNAME, LNAME) VALUES (:name, :content)');
    $stmt->execute(array(':name' => htmlspecialchars($_POST['name']), ':content' => htmlspecialchars($_POST['content'])));
    $affected_rows = $stmt->rowCount();
    // Log $affected_rows.
  }
} catch (PDOException $ex) {
  // Log error.
}
$db = null;
header('Location: '."/");
?>
