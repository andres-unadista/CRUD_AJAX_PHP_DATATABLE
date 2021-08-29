export function formUser(event){
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
    if (name !== '' && last_name !== '' && email !== '') {
      $.ajax({
        url: 'controller/UserController.php?method=create_user',
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (data) {
          alert(data);
          $('#formUser')[0].reset();
          $('#modelUser').modal('hide');
          dataTable.ajax.reload();
        },
      });
    } else {
      alert('Algunos campos son requeridos');
    }
}