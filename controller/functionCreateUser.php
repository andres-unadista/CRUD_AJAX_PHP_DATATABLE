<?php

function saveImageLocal($imageFile): string
{
  $extension = explode('.', $imageFile['name']);
  $newFile = time() . '.' . $extension[1];
  optimizeImage($imageFile, $newFile);
  return $newFile;
}

function createUser()
{
  $userModel = new UserModel();
  $image = null;
  if ($_FILES['image']['name'] != '' && $_FILES['image']['type'] == 'image/png' || $_FILES['image']['type'] == 'image/jpeg' || $_FILES['image']['type'] == 'image/gif') {
    $image = saveImageLocal($_FILES['image']);
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

function optimizeImage($image, string $nameFile)
{
  //Funciones optimizar imagenes

  //Ruta de la carpeta donde se guardarán las imagenes
  $patch = '../assets/img';

  //Parámetros optimización, resolución máxima permitida
  $max_width = 900;
  $max_height = 900;

  $measureImage = getimagesize($image['tmp_name']);

  //Si las imagenes tienen una resolución y un peso aceptable se suben tal cual
  if ($measureImage[0] < 1200 && $image['size'] < 100000) {
    move_uploaded_file($image['tmp_name'], $patch . '/' . $nameFile);
  }

  //Si no, se generan nuevas imagenes optimizadas
  else {

    //Redimensionar
    $rtOriginal = $image['tmp_name'];

    if ($image['type'] == 'image/jpeg') {
      $original = imagecreatefromjpeg($rtOriginal);
    } else if ($image['type'] == 'image/png') {
      $original = imagecreatefrompng($rtOriginal);
    } else if ($image['type'] == 'image/gif') {
      $original = imagecreatefromgif($rtOriginal);
    }

    list($width, $height) = getimagesize($rtOriginal);

    $x_ratio = $max_width / $width;
    $y_ratio = $max_height / $height;

    if (($width <= $max_width) && ($height <= $max_height)) {
      $width_final = $width;
      $height_final = $height;
    } elseif (($x_ratio * $height) < $max_height) {
      $height_final = ceil($x_ratio * $height);
      $width_final = $max_width;
    } else {
      $width_final = ceil($y_ratio * $width);
      $height_final = $max_height;
    }

    $canvas = imagecreatetruecolor($width_final, $height_final);

    imagecopyresampled($canvas, $original, 0, 0, 0, 0, $width_final, $height_final, $width, $height);

    //imagedestroy($original);

    $cal = 8;

    if ($image['type'] == 'image/jpeg') {
      imagejpeg($canvas, $patch . "/" . $nameFile);
    } else if ($image['type'] == 'image/png') {
      imagepng($canvas, $patch . "/" . $nameFile);
    } else if ($image['type'] == 'image/gif') {
      imagegif($canvas, $patch . "/" . $nameFile);
    }
  }
}
