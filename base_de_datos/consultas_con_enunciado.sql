-- CREACIÓN DE CONSULTAS

--Se requiere de una consulta que muestre las reservas que han sido activadas(AC).
--deben mostrar el id de la reserva, si todos sus huespedes tienen su numero de documento (Check in),
--el nombre completo del titular (tanto si es empresa o es una persona), telefono del titular, fecha de llegada, 
--la cantidad de noches que se queda y los huespedes en cada una 	

SELECT r.id_reserva, r.fecha_ingreso, TIMESTAMPDIFF(DAY, r.fecha_ingreso,r.fecha_salida) dias, 
NVL(e.nombre_empresa,CONCAT_WS(" ",t.nombres_persona,t.apellidos_persona)) nombre_titular,
NVL(e.telefono_empresa,t.telefono_persona) telefono_persona,
GROUP_CONCAT(CONCAT_WS(" ",c.nombres_persona,c.apellidos_persona)) nombres_huespedes,
IF(COUNT(rc.id_registro_huesped)=SUM(NVL2(c.numero_documento,1,0)), "SI", "NO") check_in
FROM reservas r 
LEFT JOIN personas t ON r.id_titular=t.id_persona 
LEFT JOIN empresas e ON r.id_empresa=e.id_empresa 
LEFT JOIN registros_habitacion rh ON rh.id_reserva=r.id_reserva
LEFT JOIN registros_huesped rc ON rc.id_registro_habitacion=rh.id_registro_habitacion
LEFT JOIN personas c ON rc.id_huesped=c.id_persona
WHERE r.estado_reserva="AC"
GROUP BY r.id_reserva


--Se requiere de una consulta que muestre todas las habitaciones
--deben mostrase datos siempre y cuando una reserva esté asignada y haya sido recibida(RE) o activada(AC)
--las fecha 10/02/2020 debe estar dentro del rango de las fechas de las reservas (fecha_ingreso-fecha_salida)
--si la reserva fue unicamente activada, entonces solo se debe mostrar ese estado
--cada habitacion debe mostrar su numero, su tipo, los huespedes en ella, la fecha de ingreso, 
--el conteo de dias de tal manera que se muestre (0 de 1) o (2 de 5),
--el total del valor de esa habitacion,
--y si todos los huespedes están fuera de la habitacion (Check up)

SELECT h.numero_habitacion,th.nombre_tipo_habitacion, rg.estado_reserva,
CASE WHEN rg.estado_reserva="RE" THEN rg.nombres_clientes ELSE NULL END nombres_clientes,
CASE WHEN rg.estado_reserva="RE" THEN rg.fecha_ingreso ELSE NULL END fecha_ingreso, 
CASE WHEN rg.estado_reserva="RE" THEN rg.conteo ELSE NULL END conteo , rg.total,rg.full_cu
FROM habitaciones h 
LEFT JOIN (SELECT r.id_reserva, rs.id_habitacion,r.estado_reserva, 
	GROUP_CONCAT(CONCAT_WS(" ",c.nombres_persona,c.apellidos_persona)) nombres_clientes,  r.fecha_ingreso,
	CONCAT_WS(" de ",TIMESTAMPDIFF(DAY,r.fecha_ingreso,"2020-02-10"),TIMESTAMPDIFF(DAY,r.fecha_ingreso, r.fecha_salida)) conteo,
	(t.valor_ocupacion*TIMESTAMPDIFF(DAY,r.fecha_ingreso, r.fecha_salida)) total, 
	(COUNT(rh.id_registro_huesped)=SUM(rh.estado_huesped="CU")) full_cu
	FROM reservas r 
	INNER JOIN registros_habitacion rs ON rs.id_reserva=r.id_reserva 
	INNER JOIN registros_huesped rh ON rh.id_registro_habitacion=rs.id_registro_habitacion 
	INNER JOIN personas c ON rh.id_huesped=c.id_persona
	INNER JOIN tarifas t ON rs.id_tarifa=t.id_tarifa  
	WHERE r.fecha_ingreso<="2020-02-10" 
	AND r.fecha_salida >="2020-02-10" 
	AND (r.estado_reserva="RE" OR r.estado_reserva="AC") 
	GROUP BY id_habitacion) rg ON rg.id_habitacion=h.id_habitacion 
LEFT JOIN tipos_habitacion th ON h.id_tipo_habitacion=th.id_tipo_habitacion


--Se tiene un rango de fechas '09/02/2020' y '12/02/2020'
--se requiere obtener las habitaciones que esten por fuera de este rango de fecha

SELECT numero_habitacion 
FROM habitaciones h 
INNER JOIN tipos_habitacion th ON h.id_tipo_habitacion=th.id_tipo_habitacion
WHERE id_habitacion NOT IN (
	SELECT id_habitacion
	FROM registros_habitacion rh 
	INNER JOIN reservas r ON rh.id_reserva=r.id_reserva 
	WHERE (
		r.fecha_ingreso='2020-02-09'
		OR (r.fecha_ingreso>'2020-02-09' AND r.fecha_ingreso<'2020-02-12')
		OR (r.fecha_salida>'2020-02-09' AND r.fecha_salida<'2020-02-12')
        OR (r.fecha_ingreso<'2020-02-09' AND r.fecha_salida>'2020-02-12')
    ) AND (r.estado_reserva="AC" OR r.estado_reserva="RE")
)

/*
SE REQUIERE CONOCER EL CONSUMO TOTAL DE PRODUCTOS DEL TITULAR CON CÓDIGO 11 Y SUS ACOMPAÑANTES DURANTE SU ÚLTIMO HOSPEDAJE EN EL HOTEL
*/
SELECT SUM(cantidad_producto*valor_producto) minibar
            FROM reservas r INNER JOIN personas p ON p.id_persona=r.id_titular
            INNER JOIN registros_habitacion rh ON r.id_reserva=rh.id_reserva
            INNER JOIN control_diario cd ON rh.id_registro_habitacion=cd.id_registro_habitacion
            INNER JOIN peticiones pt ON cd.id_control=pt.id_control
            INNER JOIN productos pd ON pd.id_producto=pt.id_producto
            WHERE id_persona=11
            AND fecha_ingreso= (SELECT MAX(fecha_ingreso) 
                                 FROM reservas r INNER JOIN personas p ON r.id_titular=p.id_persona
                                WHERE id_persona=11);

/*
REALICE UNA CONSULTA QUE PERMITA OBSERVAR LA CANTIDAD DE HABITACIONES, VALOR UNITARIO, VALOR TOTAL Y LAS HABITACIONES QUE EL CLIENTE
CON EL CÓDIGO 11 RESERVÓ LA ÚLTIMA VEZ QUE ESTUVO EN EL HOTEL. TENGA EN CUENTA QUE LOS DATOS DEBERÁN AGRUPARSE POR LA TARIFA QUE 
PRESENTA LA HABITACIÓN EN LA RESERVA DETERMINADA
*/
SELECT COUNT(id_registro_habitacion) AS cantidad, valor_ocupacion AS valorUnitario, GROUP_CONCAT(DISTINCT(numero_habitacion) SEPARATOR ",") AS habitaciones, (valor_ocupacion*COUNT(id_registro_habitacion)) AS valor_total
                FROM reservas r INNER JOIN personas p ON p.id_persona=r.id_titular
                LEFT JOIN registros_habitacion rh ON r.id_reserva=rh.id_reserva
                LEFT JOIN tarifas tf ON tf.id_tarifa=rh.id_tarifa
                LEFT JOIN habitaciones h ON h.id_habitacion=rh.id_habitacion 
                WHERE id_persona = 11
                AND fecha_ingreso = (SELECT MAX(fecha_ingreso) 
                                     FROM reservas r INNER JOIN personas p ON r.id_titular=p.id_persona
                                    WHERE id_persona = 11)
                GROUP BY valorUnitario;
		
		
		
/*
MUESTRE EL TOTAL DE SERVICIO DE LAVANDERÍA QUE HA PAGADO EL CLIENTE CON ID 11 CUANDO SE HOSPEDA EN EL HOTEL
*/
SELECT SUM(cantidad_servicio*valor_servicio) AS valor_lavanderia
            FROM reservas r INNER JOIN personas p ON p.id_persona=r.id_titular
            INNER JOIN registros_habitacion rh ON r.id_reserva=rh.id_reserva
            INNER JOIN control_diario cd ON rh.id_registro_habitacion=cd.id_registro_habitacion
            INNER JOIN peticiones pt ON cd.id_control=pt.id_control
            INNER JOIN servicios s ON s.id_servicio=pt.id_servicio
            WHERE numero_documento=:idPerson
            AND tipo_servicio = "L";


/*
CONSULTA QUE MUESTRE LOS NOMBRES DE LOS HUÉSPEDES QUE NO HAYAN SIDO TITULARES DE SU ÚLTIMO HOSPEDAJE CUYO VALOR TOTAL FUE MENOR A $600.000
*/

SELECT CONCAT_WS(" ", nombres_persona, apellidos_persona) AS nombre
FROM personas p LEFT JOIN registros_huesped rh ON p.id_persona=rh.id_huesped
WHERE tipo_persona = 'C'
AND p.id_persona NOT IN
(SELECT id_persona
FROM personas p LEFT JOIN reservas r ON p.id_persona=r.id_titular
WHERE fecha_ingreso= (SELECT MAX(fecha_ingreso) 
                                 FROM reservas r INNER JOIN personas p ON r.id_titular=p.id_persona)
AND (SELECT CALCULATE_TOTAL_BILL(r.id_reserva)) < 600000);
	    
	    
/*
CONSULTA QUE MUESTRE EL ID HABITACION Y NUMERO DE HABITACIÓN TIPO JOLIOT DE AQUELLAS HABITACIONES CON RESERVA ACTIVA O RECIBIDA, QUE NO SE ENCUENTRAN CON RESERVA DENTRO DEL RANGO
DE FECHAS '10/02/2020' A '13/02/2020'
*/
SELECT id_habitacion,numero_habitacion 
                FROM habitaciones h 
                INNER JOIN tipos_habitacion th ON h.id_tipo_habitacion=th.id_tipo_habitacion
                WHERE STRCMP(th.nombre_tipo_habitacion,'JOLIOT') = 0
                AND id_habitacion NOT IN (
                SELECT id_habitacion
                FROM registros_habitacion rh 
                INNER JOIN reservas r ON rh.id_reserva=r.id_reserva 
                WHERE (date_format(r.fecha_ingreso,"%X-%m-%d")='10/02/2020'
                OR (date_format(r.fecha_ingreso,"%X-%m-%d")> '10/02/2020' AND date_format(r.fecha_ingreso,"%X-%m-%d")<'13/02/2020')
                OR (date_format(r.fecha_salida,"%X-%m-%d")> '10/02/2020' AND date_format(r.fecha_salida,"%X-%m-%d")<'13/02/2020')
                OR (date_format(r.fecha_ingreso,"%X-%m-%d")< '10/02/2020' AND date_format(r.fecha_salida,"%X-%m-%d")>'13/02/2020')
                ) AND (r.estado_reserva="AC" OR r.estado_reserva="RE"));
		
		
/*
CONSULTA QUE MUESTRE LOS CÓDIGOS DE LAS RESERVAS QUE NO SUPERARON UN VALOR DE FACTURACIÓN MAYOR A $800.000 DENTRO DEL RANGO DE MESES DE
FEBRERO A MAYO
*/
SELECT id_reserva
FROM reservas
WHERE (SELECT CALCULATE_TOTAL_BILL(id_reserva)) <= 800.000
AND date_format(fecha_ingreso, '%m') BETWEEN 2 AND 5;


/*
MUESTRE AQUELLAS HABITACIONES QUE SOLICITARON UN PRODUCTO DETERMINADO EN LA FECHA ACTUAL
*/
SELECT DISTINCT numero_habitacion, nombre_producto
FROM habitaciones h INNER JOIN registros_habitacion rh ON h.id_habitacion=rh.id_habitacion
INNER JOIN control_diario cd ON rh.id_registro_habitacion=cd.id_registro_habitacion
INNER JOIN peticiones p ON cd.id_control=p.id_control
INNER JOIN productos pd ON pd.id_producto = p.id_producto
WHERE cd.fecha_control = now()
