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

