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


function filterEnterprise(){
    var input = document.getElementById("inputEnterprise").value;
    if(input != ""){
        searchEnterprise(input)
    }else{
        searchEnterprise("");
    }
}