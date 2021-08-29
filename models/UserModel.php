<?php
class UserModel
{
  public function saveImage($imageFile):string
  {
    $extension = explode('.', $imageFile['name']);
    $newFile = time() .'.'. $extension[1];
    $location = '../assets/img/' . $newFile;
    move_uploaded_file($imageFile['tmp_name'], $location);
    return $newFile;
  }

  public function getImage($idUser)
  {
    $obDB = new ConnectionDB();
    $db = $obDB->connect();
    $stmt = $db->prepare('SELECT * FROM users WHERE idusers = :idUser');
    $stmt->bindParam(':idUser', $idUser);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user['image'];
  }

  public function getAllUsers()
  {
    $obDB = new ConnectionDB();
    $db = $obDB->connect();
    $stmt = $db->prepare('SELECT * FROM users');
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $stmt->rowCount();
  }

  public function getDataUser($idusers)
  {
    $obDB = new ConnectionDB();
    $db = $obDB->connect();
    $stmt = $db->prepare('SELECT * FROM users WHERE idusers=:idusers');
    $stmt->execute([
      ':idusers' => $idusers
    ]);
    $users = $stmt->fetch(PDO::FETCH_ASSOC);
    return $users;
  }

  public function getRegisters(string $query)
  {
    $obDB = new ConnectionDB();
    $db = $obDB->connect();
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmtResponse = $stmt;
    return $stmtResponse;
  }

  public function saveUser(array $user)
  {
    $obDB = new ConnectionDB();
    $db = $obDB->connect();
    $query = 'INSERT INTO `users`(`name`, `last_name`, `phone`, `email`, `image`) VALUES (:name, :last_name,:phone, :email, :image)';
    $stmt = $db->prepare($query);
    $response = $stmt->execute([
      ':name' => $user['name'],
      ':last_name' => $user['last_name'],
      ':phone' => $user['phone'],
      ':email' => $user['email'],
      ':image' => $user['image'],
    ]);
    return $response;
  }

  public function updateUser(array $user)
  {
    $obDB = new ConnectionDB();
    $db = $obDB->connect();
    $query = 'UPDATE `users` SET `name` = :name, `last_name` = :last_name, `phone` = :phone, `email` = :email, `image`=:image WHERE idusers = :idusers';
    $stmt = $db->prepare($query);
    $response = $stmt->execute([
      ':name' => $user['name'],
      ':last_name' => $user['last_name'],
      ':phone' => $user['phone'],
      ':email' => $user['email'],
      ':image' => $user['image'],
      ':idusers' => $user['id_user'],
    ]);
    return $response;
  }

  public function deleteUser(int $idUser)
  {
    $obDB = new ConnectionDB();
    $db = $obDB->connect();
    $query = 'DELETE FROM `users` WHERE idusers = :idusers';
    $stmt = $db->prepare($query);
    $response = $stmt->execute([
      ':idusers' => $idUser,
    ]);
    return $response;
  }
}
