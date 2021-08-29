<?php
require_once '../config/Connection.php';
require_once '../models/UserModel.php';

require_once './functionsGetUsers.php';

function formUser()
{
  if (isset($_POST) && $_POST['operation'] === 'create_user') {
    createUser();
  } else if (isset($_POST) && $_POST['operation'] === 'update_user') {
    updateUser();
  }
}

function createUser()
{
  $userModel = new UserModel();
  $image = null;
  if ($_FILES['image']['name'] != '') {
    $image = $userModel->saveImage($_FILES['image']);
  }
  $user = [
    'name' => $_POST['name'],
    'last_name' => $_POST['last_name'],
    'phone' => $_POST['phone'],
    'image' => $image,
    'email' => $_POST['email'],
  ];
  $responseUser = $userModel->saveUser($user);
  if ($responseUser) {
    echo 'Registro creado';
  } else {
    echo 'No se creo el usuario';
  }
}

function updateUser()
{
  $userModel = new UserModel();
  $image = $_POST['image_hidden'];
  if ($_FILES['image']['name'] != '') {
    if ($image != null) {
      unlink('../assets/img/' . $image);
    }
    $image = $userModel->saveImage($_FILES['image']);
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
      echo ['msg' => 'No se elimino el usuario'];
    }
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


// validate routing
if (isset($_GET['method'])) {
  switch ($_GET['method']) {
    case 'form_user':
      formUser();
      break;
    case 'get_users':
      getUsers();
      break;
    case 'update_user':
      getDataOneUser();
      break;
    case 'delete_user':
      deleteUser();
      break;
    default:
      return false;
      break;
  }
}
