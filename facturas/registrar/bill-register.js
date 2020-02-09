var typeBill = 0;

/**
* Función encargada de buscar a la persona titular de la reserva, con el fin de generar una nueva factura
**/
function searchTitular(input){
    $.ajax({
        type: 'post',
        url: '/includes/get.php',
        data: 'entity=searchTitular&idTitular='+input.value,
        
        success:function(ans){
            var data=ans.split(";");
            if(data.length>=8){
                
                var searchs=document.getElementsByClassName("card-search");
                var search;
                
                for (var i = 0; i < searchs.length; i++) {
                    if(searchs[i].getElementsByTagName("input")[2]==input){
                        search=searchs[i];
                    }     
                }
                
                
                var body= search.parentElement.getElementsByClassName("infos")[0];
                body.getElementsByTagName("input")[2].value = "";
                
                
                var valueLabels = body.getElementsByTagName("label");
                valueLabels[4].innerHTML = data[0]+" "+data[1];
                valueLabels[5].innerHTML = data[6];
                valueLabels[6].innerHTML = data[3];
                valueLabels[7].innerHTML = data[2];
                valueLabels[8].innerHTML = data[7];
                valueLabels[9].innerHTML = data[4];
                valueLabels[10].innerHTML = data[5];
                
                
                var body= search.parentElement.getElementsByClassName("col-12")[3];
                document.getElementById("myTable").innerHTML = "";

                var count = 0;
                var classTable = "";
                var resultRow = "";
                for(var i = 9; i<data.length-1; i++){
                    if(count==3)
                        classTable = "class = totals";
                    else
                        classTable = 'class = ""';
                    resultRow += "<td "+classTable+">"+data[i]+"</td>";
                    count++;
                    if(count==4){
                        var myRow = document.createElement("tr");
                        myRow.innerHTML = resultRow;
                        document.getElementById("myTable").appendChild(myRow);
                        count = 0;
                        resultRow = "";
                    }
                }
                
                var valueTotals = document.getElementsByClassName("totals");
                var totalBill = 0;

                for(var i = 0; i<valueTotals.length; i++){
                    totalBill += parseInt(valueTotals[i].innerHTML.replace('.', ''));
                }
                
                document.getElementById("valueTotal").innerHTML=totalBill;
                
                
                buttonBill = document.getElementById("generateBill");
                
                buttonBill.onclick = function(){location.href='../../reportes/facturas?id='+data[8]+"&typeBill="+typeBill;};
                
                showAlert("alert-s","Se encontró al cliente con el número de documento ingresado");
            }else{
                showAlert("alert-i","No se encontró ningun cliente con ese número de documento");
                alert("No se encontró ningun cliente con ese número de documento");
            }
        }
    });             
}

/**
* Elimina los datos de una tabla determinada
**/
function remove(t){
        var td = t.parentNode;
        var tr = td.parentNode;
        var table = tr.parentNode;
        table.removeChild(tr);
}

/**
* Valida que en un campo únicamente se pueden ingresar valores numéricos
**/
function validateNumericValue(event){
	if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;  
}

/**
* Obtiene el valor del RadioButton que es seleccionado
**/
function getRadioButtonSelectedValue(ctrl){
    for(i=0;i<ctrl.length;i++)
        if(ctrl[i].checked) return ctrl[i].value;
}


function changeSelect(){
    var select = document.getElementById("selectType"); 
    var index = select.options[select.selectedIndex].index; 
    var serieBill = document.getElementById("serieBill");
    var serieOrder = document.getElementById("serieOrder");
    typeBill = index;
    if(index==0){
        serieOrder.style.display = "none";
        serieBill.style.display = "inline";
    }else{
        serieBill.style.display = "none";
        serieOrder.style.display = "inline";
    }
}