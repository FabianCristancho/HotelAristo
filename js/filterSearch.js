function filterEnterprise(){
    var input = document.getElementById("inputEnterprise").value;
    if(input != ""){
        searchEnterprise(input)
    }else{
        searchEnterprise("");
    }
}

function searchEnterprise(valueInput){
    $.ajax({
        type: 'post',
        url: '../includes/filterTable.php',
        data: 'entity=enterprise&id='+valueInput,
        success: function (ans) {
            var data=ans.split(";");
            showAlert(data[0],data[1]);
        },
        error: function (ans) {
            showAlert('alert-d','No se pudo conectar con la base de datos');
        }
    })
    .done(function(res){
        $("#dataEnterprise").html(res);
    });
}

function filterUser(){
    var input = document.getElementById("inputUser").value;
    if(input != ""){
        searchUser(input)
    }else{
        searchUser("");
    }
}

function searchUser(valueInput){
    $.ajax({
        type: 'post',
        url: '../includes/filterTable.php',
        data: 'entity=user&id='+valueInput,
        success: function (ans) {
            var data=ans.split(";");
            showAlert(data[0],data[1]);
        },
        error: function (ans) {
            showAlert('alert-d','No se pudo conectar con la base de datos');
        }
    })
    .done(function(res){
        $("#dataUser").html(res);
    });
}

function filterCustomer(){
    var input = document.getElementById("inputCustomer").value;
    if(input != ""){
        searchCustomer(input)
    }else{
        searchCustomer("");
    }
}

function searchCustomer(valueInput){
    $.ajax({
        type: 'post',
        url: '../includes/filterTable.php',
        data: 'entity=customer&id='+valueInput,
        success: function (ans) {
            var data=ans.split(";");
            showAlert(data[0],data[1]);
        },
        error: function (ans) {
            showAlert('alert-d','No se pudo conectar con la base de datos');
        }
    })
    .done(function(res){
        $("#dataCustomer").html(res);
    });
}

function validateChar(e){
    var key = e.keyCode;
    var input = document.getElementsByTagName("input")[0];
    if(key == 39){
        input.value = input.value.substring(0, input.value.length - 1);
    }   
}

function filterBill(){
    var input = document.getElementById("inputBill").value;
    if(input != ""){
        searchBill(input)
    }else{
        searchBill("");
    }
}

function searchBill(valueInput){
    $.ajax({
        type: 'post',
        url: '../includes/filterTable.php',
        data: 'entity=bill&id='+valueInput,
        success: function (ans) {
            var data=ans.split(";");
            showAlert(data[0],data[1]);
        },
        error: function (ans) {
            showAlert('alert-d','No se pudo conectar con la base de datos');
        }
    })
    .done(function(res){
        $("#dataBill").html(res);
    });
}

