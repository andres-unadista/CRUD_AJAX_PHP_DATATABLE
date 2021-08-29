<?php 
  function deleteUser()
  {
    if (isset($_POST['idUser'])) {
      $userModel = new UserModel();
      $image = $userModel->getImage($_POST['idUser']);
      if ($image != '' && $image != null) {
        unlink('../assets/img/' . $image);
      }
      $responseUser = $userModel->deleteUser($_POST['idUser']);
      if ($responseUser) {
        echo json_encode(['msg' => 'Registro Eliminado']);
      } else {
        echo json_encode(['msg' => 'No se elimino el usuario']);
      }
    }
  }
