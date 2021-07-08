$(document).ready(function() {

  $('#btn-tambah-panitia').click(function(e) {
    e.preventDefault();
    $.ajax({
      url: $(this).attr('data-url'),
      dataType: "json",
      type: 'POST',
      data: {
        id: $(this).attr('data-id')
      },
      success: function(response) {
        if (response.data) {
          $('.viewmodal').html(response.data).show()
          $('#pilih-pengurus-tambah-panitia').select2({
            placeholder: 'Klik untuk menampilkan pengurus'
          });
          $(".icon-tambah-panitia").hide()
          $('#tambah-panitia').modal('show')
        }
      },
      error: function(xhr, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    });
  });

});