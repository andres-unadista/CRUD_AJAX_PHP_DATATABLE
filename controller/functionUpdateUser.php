<?php 
  function updateUser()
  {
    $userModel = new UserModel();
    $image = $_POST['image_hidden'];
    if ($_FILES['image']['name'] != '') {
      if ($image != null) {
        unlink('../assets/img/' . $image);
      }
      $image = saveImageLocal($_FILES['image']);
    } else if ($image == null){
      $image = null;
    }
    $user = [
      'name' => $_POST['name'],
      'last_name' => $_POST['last_name'],
      'phone' => $_POST['phone'],
      'image' => $image,
      'email' => $_POST['email'],
      'id_user' => $_POST['id_user'],
    ];
    $responseUser = $userModel->updateUser($user);
    if ($responseUser) {
      echo 'Registro actualizado';
    } else {
      echo 'No se actualizo el usuario';
    }
  }
  
  function getDataOneUser()
  {
    if (isset($_POST)) {
      $userModel = new UserModel();
      $user = $userModel->getDataUser($_POST['idUser']);
  
      if ($user['image'] !== null or $user['image'] != null) {
        $user['image'] = '<img src="assets/img/' . $user['image'] . '" class="img-thumbnail img-fluid" width="150" height="50" id="img-span" /><input type="hidden" name="image_hidden" value="' . $user['image'] . '"/>';
      } else {
        $user['image'] = '<input type="hidden" name="image_hidden" value="' . $user['image'] . '"/>';
      }
      echo json_encode($user);
    }
  }
  
?>