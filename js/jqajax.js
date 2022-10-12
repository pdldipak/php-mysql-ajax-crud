$(document).ready(function () {
  // ajax request for retrieving the data from the database

  function showdata() {
    var html = '';
    $.ajax({
      url: 'retrieve.php',
      method: 'GET',
      dataType: 'json',
      success: function (data) {
        //  console.log(data);
        if (data.length > 0) {
          for (var i = 0; i < data.length; i++) {
            html +=
              '<tr><td>' +
              data[i].id +
              '</td><td>' +
              data[i].name +
              '</td><td>' +
              data[i].email +
              '</td><td>' +
              data[i].password +
              "</td><td> <button class='btn btn-warning btn-sm btn-edit' data-sid=" +
              data[i].id +
              ">Edit</button><button class='btn btn-danger btn-sm ms-2 btn-del' data-sid=" +
              data[i].id +
              '>Delete</button></td></tr>';
          }
          $('#tbody').html(html);
        } else {
          html += '<tr><td colspan="6">No data found</td></tr>';
          $('#tbody').html(html);
        }
      },
    });
  }

  showdata();

  // ajax request for insert data
  $('#btnadd').click(function (e) {
    e.preventDefault();
    let stid = $('#stuid').val();
    let nm = $('#nameid').val();
    let em = $('#emailid').val();
    let pw = $('#passwordid').val();

    mydata = { id: stid, name: nm, email: em, password: pw };

    console.log(mydata);

    $.ajax({
      url: 'insert.php',
      type: 'POST',
      data: JSON.stringify(mydata),
      success: function (data) {
        // console.log(data);
        $('#msg').html(`<div class="alert alert-dark">${data}</div>`);
        $('#myform')[0].reset();
        showdata();
      },
    });
  });
  // delete data
  $('#tbody').on('click', '.btn-del', function () {
    let id = $(this).attr('data-sid');
    mythis = $(this);
    mydata = { sid: id };
    $.ajax({
      url: 'delete.php',
      type: 'POST',
      data: JSON.stringify(mydata),
      success: function (data) {
        if (data == 1) {
          $('#msg').html(
            `<div class="alert alert-dark">Student deleted successfully</div>`
          );
          // showdata();
          mythis.closest('tr').fadeOut('500');
        } else {
          $('#msg').html(
            `<div class="alert alert-dark">Unable to delete student</div>`
          );
        }
      },
    });
  });
  // edit data
  $('#tbody').on('click', '.btn-edit', function () {
    let id = $(this).attr('data-sid');
    mydata = { sid: id };
    $.ajax({
      url: 'edit.php',
      type: 'POST',
      data: JSON.stringify(mydata),
      dataType: 'json',
      success: function (data) {
        //   console.log(data);

        $('#stuid').val(data.id);
        $('#nameid').val(data.name);
        $('#emailid').val(data.email);
        $('#passwordid').val(data.password);
      },
    });
  });
});
