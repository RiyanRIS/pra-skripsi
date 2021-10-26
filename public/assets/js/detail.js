$(document).ready(function() {

  $('#table-peserta').dataTable({
      scrollX: false,
      scrollY: "300px",
      ordering: false,
      info: false,
      scrollCollapse: true,
      paging: false,
      "language": {
        "emptyTable": "Belum ada peserta.",
        "search": "Cari: "
      }
  });

  $("#theadilang").hide();

  $('#btn-tambah-tugas').click(function(e) {
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
          $('#tambah-tugas').modal('show')
        }
      },
      error: function(xhr, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    });
  });

  $('.btn-edit-tugas').click(function(e) {
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
          $('#edit-tugas').modal('show')
        }
      },
      error: function(xhr, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    });
  });

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

  $('#btn-tambah-peserta').click(function(e) {
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
          $('#pilih-peserta').select2({
            placeholder: 'Klik untuk menampilkan peserta'
          });
          $('#tambah-peserta').modal('show')
        }
      },
      error: function(xhr, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    });
  });

  $('#btn-tambah-berkas').click(function(e) {
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
          $(".dropify").dropify()
          $('#tambah-berkas').modal('show')
        }
      },
      error: function(xhr, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    });
  });

  $('#btn-detail-berkas').click(function(e) {
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
          $('#tambah-berkas').modal('show')
        }
      },
      error: function(xhr, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    });
  });

});