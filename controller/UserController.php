<?php
require_once '../config/Connection.php';
require_once '../models/UserModel.php';

require_once './functionsGetUsers.php';
require_once './functionCreateUser.php';
require_once './functionDeleteUser.php';
require_once './functionUpdateUser.php';

function formUser()
{
  if (isset($_POST) && $_POST['operation'] === 'create_user') {
    createUser();
  } else if (isset($_POST) && $_POST['operation'] === 'update_user') {
    updateUser();
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
