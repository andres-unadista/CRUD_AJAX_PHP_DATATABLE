<?php
$dataUsers = array();

function validatePostDatatable(): string
{
  $query = "SELECT * FROM users ";

  if (isset($_POST['search']['value'])) {
    $query .= 'WHERE name LIKE "%' . $_POST['search']['value'] . '%" ';
    $query .= 'OR last_name LIKE "%' . $_POST['search']['value'] . '%" ';
  }

  if (isset(($_POST['order']))) {
    $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
  } else {
    $query .= 'ORDER BY idusers DESC ';
  }

  if ($_POST['length'] != -1) {
    $query .= 'LIMIT ' . $_POST['start'] . ',' . $_POST['length'];
  }

  return $query;
}


function changeDateUser(string $dateUser)
{
  $newFormatDate = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $dateUser)));
  $year = date('Y', strtotime(str_replace('-', '/', $dateUser)));
  $week = date('w', strtotime(str_replace('-', '/', $dateUser)));
  $day = date('d', strtotime(str_replace('-', '/', $dateUser)));
  $month = date('n', strtotime(str_replace('-', '/', $dateUser)));

  $diassemana = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
  $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

  $newFormateDate = $diassemana[$week] . " " . $day . " de " . $meses[$month - 1] . " del " . $year;

  //Salida: Miercoles 05 de Septiembre del 2016
  return $newFormateDate;
}

function fillDataArrayUsers($users)
{
  foreach ($users as $user) {
    $pathImage = 'not_find.png';
    if (!empty($user['image'])) {
      $pathImage = $user['image'];
    }
    $image = '<img src="assets/img/' . $pathImage . '" class="img-thumbnail" width="90" height="50" />';

    $sub_array = [];
    $sub_array[] = $user['idusers'];
    $sub_array[] = $user['name'];
    $sub_array[] = $user['last_name'];
    $sub_array[] = $user['phone'];
    $sub_array[] = $user['email'];
    $sub_array[] = $image;
    $sub_array[] = changeDateUser($user['created_at']);
    $sub_array[] = '<button type"button" name ="edit" id="edit' . $user['idusers'] . '" class ="btn btn-warning btn-xs edit" title="editar"><i class="fas fa-edit"></i></button>';
    $sub_array[] = '<button type"button" name ="delete" id="delete' . $user['idusers'] . '" class ="btn btn-delete btn-xs delete" title="eliminar"><i class="fas fa-trash-alt text-dark"></i></button>';
    array_push($GLOBALS["dataUsers"], $sub_array);
  }
                        
}

function getUsers()
{
  $userModel = new UserModel();
  $output = [];

  $query = validatePostDatatable();

  $stmt = $userModel->getRegisters($query);
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $filtered_rows = $stmt->rowCount();

  fillDataArrayUsers($users);

  $output = [
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $filtered_rows,
    "recordsFiltered" => $userModel->getAllUsers(),
    "data" => $GLOBALS["dataUsers"],
  ];

  header('Content-type: application/json');
  echo json_encode($output);
}
