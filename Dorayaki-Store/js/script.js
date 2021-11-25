function responsiveHeader() {
    var x = document.getElementById("header");
    if (x.classList.contains("resActive")) {
      x.classList.remove("resActive");
    } else {
      x.classList.add("resActive");
    }
}

function AutoSearch() {
  var list, input, list_value;
  list = document.getElementsByClassName("col-lg-3 col-md-4 col-sm-6 col-xs-12");
  input = document.getElementById("search");
  for (let i = 0; i < list.length; i++) {
    list_value = list[i].getElementsByTagName('a')[0].getElementsByTagName('div')[0].getElementsByClassName('dorayaki-name')[0];
    if (list_value.textContent.toUpperCase().includes(input.value.toUpperCase())) {
      list[i].style.display = "";
    }
    else{
      list[i].style.display = "none";
    }
  }
}      

function increment_quantity(id) {
  var inputQuantityElement = document.getElementById("input-quantity");
  console.log(inputQuantityElement.value);
  var value = parseInt(inputQuantityElement.value) + 1;
  changeQuantity(id, value);
}

function decrement_quantity(id) {
  var inputQuantityElement = document.getElementById("input-quantity");
  console.log(inputQuantityElement);
  var value = parseInt(inputQuantityElement.value) - 1;
  changeQuantity(id, value);
}

function changeQuantity(id, value){
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    var result = JSON.parse(this.responseText);
    document.getElementById("input-quantity").value = result["value"];
    document.getElementById("total-harga").innerHTML = result["harga"];
    console.log(this.responseText);
  }
  xhttp.open("GET", "ajax-pembelian-dorayaki.php?id="+id+"&value="+value);
  xhttp.send();
}

function increment_quantity_stock(id) {
  var inputQuantityElement = document.getElementById("input-quantity");
  console.log(inputQuantityElement.value);
  var value = parseInt(inputQuantityElement.value) + 1;
  changeQuantityStock(id, value);
}

function decrement_quantity_stock(id) {
  var inputQuantityElement = document.getElementById("input-quantity");
  console.log(inputQuantityElement);
  var value = parseInt(inputQuantityElement.value) - 1;
  changeQuantityStock(id, value);
}

function changeQuantityStock(id, value){
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    var result = JSON.parse(this.responseText);
    document.getElementById("input-quantity").value = result["value"];
    document.getElementById("jumlah-stok").innerHTML = parseInt(result["value"]) + parseInt(result["stok"]);
    console.log(this.responseText);
  }
  xhttp.open("GET", "ajax-pengubahan-stok-dorayaki.php?id="+id+"&value="+value);
  xhttp.send();
}

function confirmDelete(id_dorayaki){
  if(confirm("Kamu yakin mas/mba mau menghapus dorayaki ini??")){
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "hapus-dorayaki.php", true);
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // Response
        var result = JSON.parse(this.responseText);
        if(result["success"] == 1){
          alert('Penghapusan Berhasil Dilakukan \(^v^)/');
          location.href = "dashboard.php";
        } else{
          alert('Penghapusan Tidak Berhasil Dilakukan (T_T)');
        }
      }
    };
    xhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    var data = "id=" + id_dorayaki;
    xhttp.send(data);
  }
}

// function showPreviewImage(event){
//     if(event.target.files.length > 0){
//         var src = URL.createObjectURL(event.target.files[0]);
//         console.log(event);
//         console.log(src);
//         var preview = document.getElementById("preview-img-input");
//         preview.src = src;
//         preview.style.display = "block";
//     }
// }