var dataTable = null;

$(document).ready(function () {
  
  dataTable = $('#data_user').DataTable({
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
      url: 'controller/UserController.php?method=get_users',
      type: 'POST',
    },
    columnsDefs: [
      {
        targets: [0, 3, 4],
        orderable: false,
      },
    ],
    language: {
      url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    }
  });

  $(document).on('submit', '#formUser', formUser);

  $('#btn_create').on('click', function () {
    $('#operation').val('create_user');
    cleanForm();
  });

  $('#closeModal').on('click', function () {
    cleanForm();
  });

  $(document).on('click', '.edit', getRegister);

  $(document).on('click', '.delete', deleteRegister);

});


function cleanForm(){
  $('.modal-title').text('Crear usuario');
  $('#formUser')[0].reset();
  $('#img-span').html('');
  $('#load_image').html('');
}

function formUser(event) {
  event.preventDefault();
  let name = $('#name').val();
  let last_name = $('#last_name').val();
  let phone = $('#phone').val();
  let email = $('#email').val();
  let extension = $('#image').val().split('.').pop().toLowerCase();

  if (extension != '') {
    if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
      alert('formato de imagen inválido');
      $('#image').val('');
      return false;
    }
  }
  if (name !== '' && last_name !== '' && email !== '' && phone !== '') {
    sendUser(this);
  } else {
    alert('Algunos campos son requeridos');
  }
}

function sendUser(dataForm){
  $.ajax({
    url: 'controller/UserController.php?method=form_user',
    method: 'POST',
    data: new FormData(dataForm),
    contentType: false,
    processData: false,
    success: function (data) {
      alert(data);
      $('#formUser')[0].reset();
      $('#modelUser').modal('hide');
      dataTable.ajax.reload();
    },
  });
}

function getRegister() {
  console.log('editar');
  let idUser = $(this).attr('id');
  idUser = idUser.split('edit')[1];

  $.ajax({
    url: 'controller/UserController.php?method=update_user',
    method: 'POST',
    data: { idUser },
    dataType: 'json',
    success: function (data) {
      $('#modelUser').modal('show');
      $('#name').val(data.name);
      $('#last_name').val(data.last_name);
      $('#email').val(data.email);
      $('#email').val(data.email);
      $('#phone').val(data.phone);
      $('#load_image').html(data.image);
      $('#id_user').val(data.idusers);
      $('#operation').val('update_user');
      $('.modal-title').text('Actualizar usuario');
    },
  });
}

function deleteRegister() {
  console.log('eliminar');
  let idUser = $(this).attr('id');
  idUser = idUser.split('delete')[1];
  console.log(idUser);
  $.ajax({
    url: 'controller/UserController.php?method=delete_user',
    method: 'POST',
    data: { idUser },
    dataType: 'json',
    success: function (data) {
      alert(data.msg);
      dataTable.ajax.reload();
    },
  });
}