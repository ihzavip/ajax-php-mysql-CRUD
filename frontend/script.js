// Wait for the document to finish loading
$(document).ready(function () {
  loadData();
  // Listen for a click event on the button with ID "loadDataBtn"
  $("#loadDataBtn").click(function () {
    loadData();
  });

  /*******************HANDLE FORM DELETE********************/
  $(document).on("click", "#deleteBtn", function () {
    const customer_id = $(this).data("id");
    console.log(customer_id);
    $.ajax({
      url: "http://localhost/wilsonTest/backend/delete.php",
      type: "POST",
      data: { customer_id: customer_id },
      dataType: "json",
      success: function (data) {
        console.log("Deleted row with ID: " + customer_id);
        loadData();
      },
      error: function (xhr, status, error) {
        console.log("Error deleting row: " + data.message);
      },
    });
  });

  /*******************UPDATE BUTTON ROUTING********************/
  $(document).on("click", "#updateBtn", function () {
    const customer_idUrl = $(this).data("id");
    window.location.href =
      "http://localhost/wilsonTest/frontend/update.html?customer_id=" +
      customer_idUrl;
  });

 
  /*******************HANDLE FORM INSERT********************/
  $(document).on("submit", "#myForm", function () {
    const perusahaan = $("#perusahaan").val();
    const jenis_barang = $("#jenis_barang").val();
    const tanggal_masuk = $("#tanggal_masuk").val();
    const tanggal_keluar = $("#tanggal_keluar").val();
    const kuantiti = $("#kuantiti").val();

    const formData = {
      perusahaan: perusahaan,
      jenis_barang: jenis_barang,
      tanggal_masuk: tanggal_masuk,
      tanggal_keluar: tanggal_keluar,
      kuantiti: kuantiti,
    };

    $.ajax({
      url: "http://localhost/wilsonTest/backend/insert.php",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (data) {
        console.log("sukses lek");
        $("#myForm")[0].reset();
        loadData();
      },
      error: function (xhr, status, error) {
        console.log("error: " + error);
      },
    });
    return false;
  });
});

// Function to load and display the table data
function loadData() {
  $.ajax({
    url: "http://localhost/wilsonTest/backend/",

    // Use the HTTP method "GET" to retrieve data
    type: "GET",

    // Expect the data returned to be in JSON format
    dataType: "json",

    // If the server returns a successful response, run this function
    success: function (data) {
      // console.log(data);
      const keyname = Object.keys(data[0]);
      // console.log(keyname);

      // Initialize an empty string variable to store the HTML code to display on the web page
      let output = "";

      // Loop through each object in the data array
      for (let i in data) {
        // Concatenate a new HTML paragraph element to the output variable for each object
        // The paragraph element contains the values of the "perusahaan" and "jenis_barang" properties of the current object
        // output += "<p>" + data[i].perusahaan + ' ' + data[i].jenis_barang + data[i].kuantiti + "</p>";
        output += `
              <tr>
                <td>${data[i].perusahaan}</td>
                <td>${data[i].jenis_barang}</td>
                <td>${data[i].tanggal_masuk}</td>
                <td>${data[i].tanggal_keluar}</td>
                <td>${data[i].kuantiti}</td>
                <td>
                <button id='deleteBtn' data-id=${data[i].customer_id} type="button" class="btn btn-danger btn-block mb-5">
                  delete
                </button>  
<button id='updateBtn' data-id=${data[i].customer_id} type="button" class="btn btn-info btn-block mb-5">
                  update
                </button>
                </td>
              </tr>
            `;
      }

      $("#data").html(`
            <table class="table">
              <thead>
                <tr>
                  <th>Perusahaan</th>
                  <th>Jenis Barang</th>
                  <th>Tanggal Masuk</th>
                  <th>Tanggal Keluar</th>
                  <th>Kuantiti</th>
                </tr>
              </thead>
              <tbody>
                ${output}
              </tbody>
            </table>
          `);
    },

    // If the server returns an error response, run this function
    error: function (xhr, status, error) {
      // Log the error message to the console
      console.log("Error: " + error);
    },
  });
}
