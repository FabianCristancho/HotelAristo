<?php
    /**
    * Archivo que contiene un formulario para el registro de una nueva reserva
    * @package   reservas.registrar
    * @author    Andrés Felipe Chaparro Rosas - Fabian Alejandro Cristancho Rincón
    * @copyright Todos los derechos reservados. 2020.
    * @since     Versión 1.0
    * @version   1.0
    */

    /**
    * Incluye la implementación de las clases requeridas para el buen funcionamiento de la aplicación
    */
	require_once '../../includes/classes.php';
    $consult=new Consult();
	$userSession = new UserSession();
    $user = new User();
    if(isset($_SESSION['user'])){
    	$user->updateDBUser($userSession->getSession());
    }else{
    	header('location: /login');
    }
?>

<html>
    <!--Importación de librerias css y javascript -->
	<head>
		<link rel="shortcut icon" href="/res/img/famicon.png" />
		<title>Nueva reserva | Hotel Aristo</title>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="/css/main.css">
		<link rel="stylesheet" type="text/css" href="/css/form.css">
		<link rel="stylesheet" type="text/css" href="/css/alerts.css">
		<link rel="stylesheet" type="text/css" href="/css/modal.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="/js/moment.js"></script>
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="/js/dynamic.js"></script>
		<script type="text/javascript" src="/js/hotel-db.js"></script>
	</head>

    <!--Construcción de la vista-->
	<body onload ="getDate(0,'start-date'); getDate(1,'finish-date'); initPage();">

      <?php
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../../objects/menu.php"; 
        ?>
        
        <script type="text/javascript">
            /**
            * Implementa el método setCurrentPage() pasando como parámetro la cadena de texto "registrar"
            */
            setCurrentPage("registrar");
        </script>
        
        <!--Contiene el formulario de registro correspondiente para una empresa-->
		<div class="content col-12 padd">
			<div class="wrap-main wrap-main-big col-10 wrap-10 padd">
				<div class="content-header">
                    <h2 class="title-form">REGISTRAR RESERVA</h2>
                </div>
				<div id="main-row" class="row">
					<div class="col-12 padd row-simple">
						<div class="card card-prime col-12">
							<div class="card-header">
								<strong class="card-title">Información primaria</strong>
							</div>
							<div class="card-preview">
								<div class="row">
									<div class="form-group col-4">
										<strong>Fecha de llegada :</strong>
										<label></label>
									</div>
									<div class="form-group col-4">
										<strong>Cantidad de noches :</strong>
										<label></label>
									</div>		
									<div class="form-group col-4">
										<strong>Cantidad de habitaciones :</strong>
										<label></label>
									</div>
								</div>
							</div>
							<form onsubmit="reducePrimeInfoCard(); return false;">
							<div class="card-body">
								<div class="row">
									<div class="form-group in-row">
										<label class="form-control-label">Fecha de llegada</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-calendar"></i>
											</div>
											<input id="start-date" type="date" class="form-control" onchange="getDays();" name="start-date" required>
										</div>
										<small class="form-text text-muted">ej. 01/01/2020</small>
									</div>
									<div class="form-group in-row">
										<label class="form-control-label">Fecha de salida</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-calendar"></i>
											</div>
											<input id="finish-date" type="date" class="form-control" onchange="getDays();" name="finish-date" required>
										</div>
										<small class="form-text text-muted">ej. 02/01/2020</small>
									</div>
									<div class="form-group in-row">
										<label class="form-control-label">Cantidad de noches</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-moon-o"></i>
											</div>
											<input id="count-nights" type="number" class="form-control" min="1" value="1" name="count-nights" required>
										</div>
										<small class="form-text text-muted">ej. 1</small>
									</div>
									<div class="form-group in-row">
										<label class="form-control-label">Cantidad de habitaciones</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-bed"></i>
											</div>
											<input id="rooms-quantity" type="number" class="form-control rooms-quantity" min="1" max="10" value="1" onchange="updateRoom(this);" name="rooms-quantity" required>
										</div>
										<small class="form-text text-muted">ej. 1</small>
									</div>
								</div>
							</div>
							<button class="btn btn-done btn-block">Listo</button>
							</form>
						</div>
					</div>
				</div>
				<div>
					<button class="btn btn-block btn-register">
						<i class="fa fa-check"></i>
						<span>Registrar reserva</span>
					</button>
				</div>
			</div>
		</div>
		<div id="add-bizz" class="modal" onclick="touchOutside(this);">
			<div class="modal-content">
                <div class="modal-header">
                    <span onclick="hideModal('add-bizz');" class="close">&times;</span>
                    <h2>Agregar empresa</h2>
                </div>
                <div class="modal-body">
                	<?php include "../../objects/input-enterprise.php"; ?>
                	<div>
						<button class="btn btn-block btn-register"  onclick="updateEnterprise();">
							<i class="fa fa-check"></i>
							<span>Registrar empresa</span>
						</button>
					</div>
                </div>
            </div>
		</div>
		<div id="add-prof" class="modal" onclick="touchOutside(this);";>
			<div class="modal-content">
                <div class="modal-header">
                    <span onclick="hideModal('add-prof');" class="close">&times;</span>
                    <h2>Agregar profesión</h2>
                </div>
                <div class="modal-body">
                	<?php include "../../objects/input-profession.php"; ?>
                	<div>
						<button class="btn btn-block btn-register" onclick="updateProfession();">
							<i class="fa fa-check"></i>
							<span>Registrar profesión</span>
						</button>
					</div>
                </div>
            </div>
		</div>
		<?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../../objects/footer.php";
            include "../../objects/alerts.php"; 
        ?>
        <div style="display: none;">
        	<div id="room-group" class="room-group col-12">
        		<div class="col-12 padd row-simple">
        			<?php 
        				include "../../objects/input-room.php";
        			?>
        		</div>
        		<div class="col-12 padd row-simple client-cards">
        			<?php 
        				include "../../objects/input-client.php";
        			?>
        			</div>
        		</div>
        	</div>
	</body>

	<script type="text/javascript">
		function initPage(){
			updateRoom(document.getElementById("rooms-quantity"));
		}
		function updateRoom(input){
			if(input.value>10)
				input.value=10;
			else if(input.value<1)
				input.value=1;

			var content=document.getElementById("main-row");
			var groups=content.getElementsByClassName('room-group');
			var res=input.value-groups.length;
			if(res>0){
				var base=document.getElementById("room-group");
				var group;
				for (var i = 0; i < res; i++) {
					group = document.createElement("div");
					group.classList=base.classList;
					group.innerHTML=base.innerHTML;
					content.appendChild(group);
				}
			}else{
				var length= groups.length;
				for (var i = length - 1; i >= res+length; i--) {
					content.removeChild(groups[i]);
				}
			}
			assignAttributes();
		}

		function updateGuest(index,input){
			var content=document.getElementsByClassName('room-group')[index].getElementsByClassName("client-cards")[0];
			var cards=content.getElementsByClassName("card-client");

			var res=input.value-cards.length;
			if(res>0){
				var base=document.getElementById("room-group").getElementsByClassName("card-client")[0];
				var card;
				for (var i = 0; i < res; i++) {
					card = document.createElement("div");
					card.classList=base.classList;
					card.innerHTML=base.innerHTML;
					content.appendChild(card);
				}
			}else{
				var length= cards.length;
				for (var i = length - 1; i >= res+length; i--) {
					content.removeChild(cards[i]);
				}
			}
			assignAttributesToClients(index);
		}

		function assignAttributes(){
			var groups=document.getElementsByClassName('room-group');
			for (var i = 0; i < groups.length; i++) {
				assignAttributesToGroup(i);
			}
		}

		function assignAttributesToGroup(i){
			var group=document.getElementsByClassName('room-group')[i].getElementsByClassName('card-room')[0];
			var title=group.getElementsByClassName("card-header")[0].getElementsByTagName("strong")[0];
			title.innerHTML="Habitación "+(1+i);
			var selects=group.getElementsByTagName('select');
			selects[1].setAttribute('onchange','updateRooms('+i+');');
			selects[2].setAttribute('onchange','updateGuest('+i+',this);');
			document.getElementsByClassName('room-group')[i].getElementsByTagName("form")[0].setAttribute("onsubmit","reduceRoomCard("+i+"); return false;");
			
			assignAttributesToClients(i);
		}

		function assignAttributesToClients(index){
			var clientCards=document.getElementsByClassName('room-group')[index].getElementsByClassName('client-cards')[0];
			var cards=clientCards.getElementsByClassName("card-client");
			var chkButtons=clientCards.getElementsByClassName("btn-check-in");
			var forms=clientCards.getElementsByTagName("form");
			var title;
			
			for (var i = 0; i < cards.length; i++) {
				title= cards[i].getElementsByClassName("card-header")[0].getElementsByTagName("strong")[0];
				title.innerHTML="Información personal "+(1+index)+"."+(1+i);
				forms[i].setAttribute("onsubmit","reduceClientCard("+index+","+i+"); return false;");
				chkButtons[i].setAttribute("onClick","showAllInputs("+index+","+i+");");
			}
		}

		function reducePrimeInfoCard(){
			var card=document.getElementsByClassName("card-prime")[0];
			changeStateCard(card.getElementsByClassName("btn-done")[0].innerHTML=="Editar",card);
			setPrimePreviewValue(card);
		}

		function reduceRoomCard(index){
			var card=document.getElementsByClassName("card-room")[index];
			changeStateCard(card.getElementsByClassName("btn-done")[0].innerHTML=="Editar",card);
			setRoomPreviewValue(card);
		}

		function reduceClientCard(index,value){
			var card=document.getElementsByClassName('room-group')[index].getElementsByClassName("card-client")[value];
			var state=card.getElementsByClassName("btn-done")[0].innerHTML=="Editar";
			var chkLabel=card.getElementsByClassName("card-header")[0].getElementsByTagName("label")[0];
			changeStateCard(state,card);
			reduceCard(state,card,3);
			
			if(card.getElementsByClassName("row")[1].style.display == "flex")
				chkLabel.innerHTML="Check in";
			else
				chkLabel.innerHTML="Sin Check in";
			setClientPreviewValue(card);
			if(state){
				card.getElementsByClassName("btn-check-in")[0].style.display="inline-block";
				chkLabel.style.display="none";
			}else{
				card.getElementsByClassName("btn-check-in")[0].style.display="none";
				chkLabel.style.display="inline-block";
			}
		}

		function setClientPreviewValue(card){
			var inputs=card.getElementsByClassName("card-body")[0].getElementsByTagName("input");
			var formGroups=card.getElementsByClassName("card-preview")[0].getElementsByClassName("form-group");
			formGroups[0].getElementsByTagName("label")[0].innerHTML=inputs[0].value+" "+inputs[1].value;

			formGroups[1].getElementsByTagName("label")[0].innerHTML=inputs[4].value;
			if(inputs[5].value!="")
				formGroups[2].getElementsByTagName("label")[0].innerHTML=inputs[5].value;
			else
				formGroups[2].style.display="none";
		}

		function setPrimePreviewValue(card){
			var inputs=card.getElementsByClassName("card-body")[0].getElementsByTagName("input");
			var formGroups=card.getElementsByClassName("card-preview")[0].getElementsByClassName("form-group");
			formGroups[0].getElementsByTagName("label")[0].innerHTML=inputs[0].value;
			formGroups[1].getElementsByTagName("label")[0].innerHTML=inputs[2].value;
			formGroups[2].getElementsByTagName("label")[0].innerHTML=inputs[3].value;
		}


		function setRoomPreviewValue(card){
			var input=card.getElementsByClassName("card-body")[0].getElementsByTagName("input")[0];
			var selects=card.getElementsByClassName("card-body")[0].getElementsByTagName("select");
			var formGroups=card.getElementsByClassName("card-preview")[0].getElementsByClassName("form-group");
			formGroups[0].getElementsByTagName("label")[0].innerHTML=selects[0].value;
			formGroups[1].getElementsByTagName("label")[0].innerHTML=selects[1].value;
			formGroups[2].getElementsByTagName("label")[0].innerHTML=input.value;
			formGroups[3].getElementsByTagName("label")[0].innerHTML=selects[2].value;
		}
		function showAllInputs(index,value){
			var rows=document.getElementsByClassName('room-group')[index].getElementsByClassName("card-client")[value].getElementsByClassName("row");
			if(rows[1].style.display == "flex"){
				rows[1].style.display="none";
				rows[2].style.display="none";
				rows[4].style.display="none";
				rows[5].getElementsByClassName("form-group")[0].style.display="none";
				rows[5].getElementsByClassName("form-group")[2].style.display="none";
			}else{
				rows[1].style.display="flex";
				rows[2].style.display="flex";
				rows[4].style.display="flex";
				rows[5].getElementsByClassName("form-group")[0].style.display="initial";
				rows[5].getElementsByClassName("form-group")[2].style.display="initial";
			}
		}
	</script>

</html>