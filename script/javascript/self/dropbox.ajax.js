$(document).ready(function() {
  $('#witel').change(function(event) {
    $('#datel').empty();
    $.ajax({
      url: 'http://telkom.com/index.php/json/datel/'+this.value,
      type: 'GET',
      dataType: 'JSON'
    })
    .done(function(value) {
      $('#datel').append("<option>Pilih Datel</option>");
      jQuery.each(value, function(index, el) {
        $('#datel').append("<option value='"+el.id+"'>"+el.datel+"</option>");
      });
    });
  });

  $('#subreward').change(function(event) {
    if ($(this).val() == 'BEST INFRASTRUCTURE') {
      $('.rw-in-file').show('fast');
    } else {
      $('.rw-in-file').hide('slow/400/fast'); 
    }
  });

  $('.btn-hapus').click(function(event) {
    event.preventDefault();
    var locationGo = $(this).attr("href");
    $.confirm({
      title: 'Hapus Users?',
      content: 'Ingin Menghapus users ini?',
      autoClose: 'cancelAction|8000',
      buttons: {
          deleteUser: {
              text: 'delete user',
              action: function () {
                  $(location).attr('href', locationGo);
              }
          },
          cancelAction: function () {
              $.alert('Users batal dihapus');
          }
      }
    });
  });
});
