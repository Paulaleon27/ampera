----------------------------------------
----------------------------------------
-- PROYECTO: Facturación e inventario --
-- FECHA: 27/05/17 					  --
-- EMPRESA: AMPERA 					  --
-- FUNCIONES						  --
----------------------------------------
----------------------------------------

-- FUNCIONES --



--------------------------------------------
-- Función para insertar en el inventario --
--------------------------------------------

DROP FUNCTION fun_insertar_inven() CASCADE;

CREATE OR REPLACE FUNCTION fun_insertar_inven() 
RETURNS "trigger"
AS $$
DECLARE wconsec		tab_historial.id_consec%TYPE;
DECLARE wcursor		REFCURSOR;
DECLARE wrecord		RECORD;
DECLARE wcantidad	tab_compras.cant_baterias%TYPE;
DECLARE wvariable	INTEGER;
BEGIN
	wcantidad = 0;
	RAISE NOTICE 'El valor de wcantidad es= %',wcantidad;
	IF NEW.ind_nueva = TRUE THEN
		RAISE NOTICE 'Entró al if del ind_nueva';
		OPEN wcursor FOR SELECT * FROM tab_baterias_n;
			RAISE NOTICE 'Entró al cursor';
			FETCH wcursor INTO wrecord;
			RAISE NOTICE 'El valor del wrecord1, es= %',wrecord;
			RAISE NOTICE 'Pasó el wrecord';
			IF wrecord IS NULL THEN
				RAISE NOTICE 'Entró al if del wrecord NULL';
				wconsec = 1;
				RAISE NOTICE 'El valor de wconsec es= %',wconsec;
				RAISE NOTICE 'Va a insertar en la tabla tab_baterias_n';
				INSERT INTO tab_baterias_n VALUES (wconsec,NEW.id_marca,NEW.id_modelo,NEW.id_referencia,NEW.cant_baterias);
				RAISE NOTICE 'Insertó en la tabla tab_baterias_n';
			ELSE
					RAISE NOTICE 'Entró al ELSE';
					wvariable = 0;
					RAISE NOTICE 'Variable en estado Insertar = %',wvariable;
					WHILE FOUND LOOP
						RAISE NOTICE 'Entró al while';
						IF wvariable = 0 THEN
							wvariable = 0;
						ELSE 
							wvariable = 1;
						END IF;
						IF wrecord.id_marca=NEW.id_marca AND wrecord.id_modelo=NEW.id_modelo AND wrecord.id_referencia=NEW.id_referencia THEN
							RAISE NOTICE 'Entró al if para actualizar';
							RAISE NOTICE 'El valor de wvariable es = %',wvariable;
							wvariable=1;
							RAISE NOTICE 'El valor de wvariable es = %',wvariable;
							wcantidad=wrecord.cant_baterias_n+NEW.cant_baterias;
							RAISE NOTICE 'El valor del wrecord.cant_baterias_n es= %',wrecord.cant_baterias_n;
							RAISE NOTICE 'El valor del NEW.cant_baterias es= %',NEW.cant_baterias;
							RAISE NOTICE 'El valor de la cantidad es= %',wcantidad;
							UPDATE tab_baterias_n SET cant_baterias_n = wcantidad WHERE id_marca=NEW.id_marca AND id_modelo=NEW.id_modelo AND id_referencia=NEW.id_referencia;
							RAISE NOTICE 'Actualizó';
							RAISE NOTICE 'Va a salir del if para actualizar';
						END IF;
						RAISE NOTICE 'Salió al if para actualizar';
						--wvariable= wvariable+1;
						FETCH wcursor INTO wrecord;
						RAISE NOTICE 'El valor del wrecord2, es= %',wrecord;
						RAISE NOTICE 'Va a salir del while';
					END LOOP;
		
					RAISE NOTICE 'El valor de wvariable es = %',wvariable;
					IF wvariable = 0 THEN
						wconsec = 0;
						SELECT MAX(id_consec) INTO wconsec FROM tab_baterias_n;
						RAISE NOTICE 'Ya seleccionó el MAX, es= %',wconsec;
						RAISE NOTICE 'Va a entrar al if del consecutivo';
						IF wconsec IS NULL THEN
							RAISE NOTICE 'Entró al if del consecutivo';
							wconsec = 1;
						ELSE
							RAISE NOTICE 'Entró al ELSE del consecutivo';
					   		wconsec = wconsec + 1;
					   		RAISE NOTICE 'El valor de wconsec es= %',wconsec;
					   		RAISE NOTICE 'Va a salir del if del consecutivo';
						END IF;
						RAISE NOTICE 'Salió el if del consecutivo';
						RAISE NOTICE 'Va a insertar en la tabla tab_baterias_n';
						INSERT INTO tab_baterias_n VALUES (wconsec,NEW.id_marca,NEW.id_modelo,NEW.id_referencia,NEW.cant_baterias);
						RAISE NOTICE 'Insertó en la tabla tab_baterias_n';
						RAISE NOTICE 'Va a salir del if del wrecord NULL';
					END IF;
			END IF;
			RAISE NOTICE 'Salió del if del wrecord NULL';
		CLOSE wcursor;
		RAISE NOTICE 'Salió del cursor';
		RAISE NOTICE 'Salió al while';
	ELSE 
		RAISE NOTICE 'El valor de wcantidad es= %',wcantidad;
		IF NEW.ind_regalada = TRUE THEN
			RAISE NOTICE 'Entró al if del ind_regalada';
			OPEN wcursor FOR SELECT * FROM tab_baterias_r;
				RAISE NOTICE 'Entró al cursor';
				FETCH wcursor INTO wrecord;
				RAISE NOTICE 'El valor del wrecord1, es= %',wrecord;
				RAISE NOTICE 'Pasó el wrecord';
				IF wrecord IS NULL THEN
					RAISE NOTICE 'Entró al if del wrecord NULL';
					wconsec = 1;
					RAISE NOTICE 'El valor de wconsec es= %',wconsec;
					RAISE NOTICE 'Va a insertar en la tabla tab_baterias_r';
					INSERT INTO tab_baterias_r VALUES (wconsec,NEW.id_marca,NEW.id_modelo,NEW.id_referencia,NEW.cant_baterias);
					RAISE NOTICE 'Insertó en la tabla tab_baterias_r';
				ELSE
						RAISE NOTICE 'Entró al ELSE';
						wvariable = 0;
						RAISE NOTICE 'Variable en estado Insertar = %',wvariable;
						WHILE FOUND LOOP
							RAISE NOTICE 'Entró al while';
							IF wvariable = 0 THEN
								wvariable = 0;
							ELSE 
								wvariable = 1;
							END IF;
							IF wrecord.id_marca=NEW.id_marca AND wrecord.id_modelo=NEW.id_modelo AND wrecord.id_referencia=NEW.id_referencia THEN
								RAISE NOTICE 'Entró al if para actualizar';
								RAISE NOTICE 'El valor de wvariable es = %',wvariable;
								wvariable=1;
								RAISE NOTICE 'El valor de wvariable es = %',wvariable;
								wcantidad=wrecord.cant_baterias_r+NEW.cant_baterias;
								RAISE NOTICE 'El valor del wrecord.cant_baterias_r es= %',wrecord.cant_baterias_r;
								RAISE NOTICE 'El valor del NEW.cant_baterias es= %',NEW.cant_baterias;
								RAISE NOTICE 'El valor de la cantidad es= %',wcantidad;
								UPDATE tab_baterias_r SET cant_baterias_r = wcantidad WHERE id_marca=NEW.id_marca AND id_modelo=NEW.id_modelo AND id_referencia=NEW.id_referencia;
								RAISE NOTICE 'Actualizó';
								RAISE NOTICE 'Va a salir del if para actualizar';
							END IF;
							RAISE NOTICE 'Salió al if para actualizar';
							--wvariable= wvariable+1;
							FETCH wcursor INTO wrecord;
							RAISE NOTICE 'El valor del wrecord2, es= %',wrecord;
							RAISE NOTICE 'Va a salir del while';
						END LOOP;
						RAISE NOTICE 'El valor de wvariable es = %',wvariable;
						IF wvariable = 0 THEN
							wconsec = 0;
							SELECT MAX(id_consec) INTO wconsec FROM tab_baterias_r;
							RAISE NOTICE 'Ya seleccionó el MAX, es= %',wconsec;
							RAISE NOTICE 'Va a entrar al if del consecutivo';
							IF wconsec IS NULL THEN
								RAISE NOTICE 'Entró al if del consecutivo';
								wconsec = 1;
							ELSE
								RAISE NOTICE 'Entró al ELSE del consecutivo';
					   			wconsec = wconsec + 1;
						   		RAISE NOTICE 'El valor de wconsec es= %',wconsec;
					   			RAISE NOTICE 'Va a salir del if del consecutivo';
							END IF;
							RAISE NOTICE 'Salió el if del consecutivo';
							RAISE NOTICE 'Va a insertar en la tabla tab_baterias_r';
							INSERT INTO tab_baterias_r VALUES (wconsec,NEW.id_marca,NEW.id_modelo,NEW.id_referencia,NEW.cant_baterias);
							RAISE NOTICE 'Insertó en la tabla tab_baterias_r';
							RAISE NOTICE 'Va a salir del if del wrecord NULL';
						END IF;
				END IF;
				RAISE NOTICE 'Salió del if del wrecord NULL';
			CLOSE wcursor;
			RAISE NOTICE 'Salió del cursor';
			RAISE NOTICE 'Salió al while';
		ELSE 
			RAISE NOTICE 'El valor de wcantidad es= %',wcantidad;
			IF NEW.ind_chatarra = TRUE THEN
				RAISE NOTICE 'Entró al if del ind_chatarra';
				OPEN wcursor FOR SELECT * FROM tab_baterias_c;
					RAISE NOTICE 'Entró al cursor';
					FETCH wcursor INTO wrecord;
					RAISE NOTICE 'El valor del wrecord1, es= %',wrecord;
					RAISE NOTICE 'Pasó el wrecord';
					IF wrecord IS NULL THEN
						RAISE NOTICE 'Entró al if del wrecord NULL';
						wconsec = 1;
						RAISE NOTICE 'El valor de wconsec es= %',wconsec;
						RAISE NOTICE 'Va a insertar en la tabla tab_baterias_c';
						INSERT INTO tab_baterias_c VALUES (wconsec,NEW.id_marca,NEW.id_modelo,NEW.id_referencia,NEW.cant_baterias);
						RAISE NOTICE 'Insertó en la tabla tab_baterias_c';
					ELSE
							RAISE NOTICE 'Entró al ELSE';
							wvariable = 0;
							RAISE NOTICE 'Variable en estado Insertar = %',wvariable;
							WHILE FOUND LOOP
								RAISE NOTICE 'Entró al while';
								IF wvariable = 0 THEN
									wvariable = 0 ;
								ELSE 
									wvariable = 1;
								END IF;
								IF wrecord.id_marca=NEW.id_marca AND wrecord.id_modelo=NEW.id_modelo AND wrecord.id_referencia=NEW.id_referencia THEN
									RAISE NOTICE 'Entró al if para actualizar';
									RAISE NOTICE 'El valor de wvariable es = %',wvariable;
									wvariable=1;
									RAISE NOTICE 'El valor de wvariable es = %',wvariable;
									wcantidad=wrecord.cant_baterias_c+NEW.cant_baterias;
									RAISE NOTICE 'El valor del wrecord.cant_baterias_c es= %',wrecord.cant_baterias_c;
									RAISE NOTICE 'El valor del NEW.cant_baterias es= %',NEW.cant_baterias;
									RAISE NOTICE 'El valor de la cantidad es= %',wcantidad;
									UPDATE tab_baterias_c SET cant_baterias_c = wcantidad WHERE id_marca=NEW.id_marca AND id_modelo=NEW.id_modelo AND id_referencia=NEW.id_referencia;
									RAISE NOTICE 'Actualizó';
									RAISE NOTICE 'Va a salir del if para actualizar';
								END IF;
								RAISE NOTICE 'Salió al if para actualizar';
								--wvariable= wvariable+1;
								FETCH wcursor INTO wrecord;
								RAISE NOTICE 'El valor del wrecord2, es= %',wrecord;
								RAISE NOTICE 'Va a salir del while';
							END LOOP;
							RAISE NOTICE 'El valor de wvariable es = %',wvariable;
							IF wvariable = 0 THEN
								wconsec = 0;
								SELECT MAX(id_consec) INTO wconsec FROM tab_baterias_c;
								RAISE NOTICE 'Ya seleccionó el MAX, es= %',wconsec;
								RAISE NOTICE 'Va a entrar al if del consecutivo';
								IF wconsec IS NULL THEN
									RAISE NOTICE 'Entró al if del consecutivo';
									wconsec = 1;
								ELSE
									RAISE NOTICE 'Entró al ELSE del consecutivo';
						   			wconsec = wconsec + 1;
							   		RAISE NOTICE 'El valor de wconsec es= %',wconsec;
						   			RAISE NOTICE 'Va a salir del if del consecutivo';
								END IF;
								RAISE NOTICE 'Salió el if del consecutivo';
								RAISE NOTICE 'Va a insertar en la tabla tab_baterias_c';
								INSERT INTO tab_baterias_c VALUES (wconsec,NEW.id_marca,NEW.id_modelo,NEW.id_referencia,NEW.cant_baterias);
								RAISE NOTICE 'Insertó en la tabla tab_baterias_c';
								RAISE NOTICE 'Va a salir del if del wrecord NULL';
							END IF;
					END IF;
					RAISE NOTICE 'Salió del if del wrecord NULL';
				CLOSE wcursor;
				RAISE NOTICE 'Salió del cursor';
				RAISE NOTICE 'Salió al while';
			END IF;
		END IF;
	END IF;
	RETURN NEW;
END;
$$
LANGUAGE plpgsql;

-- Trigger para la tabla compras --
CREATE TRIGGER tri_insertar_inven
AFTER INSERT ON tab_compras
FOR EACH ROW
EXECUTE PROCEDURE fun_insertar_inven();


-----------------------------------------------------
-- Función para insertar en la tabla tab_garantias --
-----------------------------------------------------

DROP FUNCTION fun_garantia(/*INTEGER,VARCHAR,VARCHAR,VARCHAR,DECIMAL,DECIMAL,VARCHAR,BOOLEAN*/);

CREATE FUNCTION fun_garantia(/*wccnit INTEGER,wnombre VARCHAR,wdireccion VARCHAR,wciudad VARCHAR,wcel DECIMAL,wtel DECIMAL,wmail VARCHAR,wind_pers BOOLEAN*/)
RETURNS TRIGGER
AS $$
DECLARE wconsec tab_garantias.id_consec%TYPE;
DECLARE wval_garantia tab_garantias.val_garant%TYPE;
BEGIN
	wconsec = 0;
	SELECT MAX(id_consec) INTO wconsec FROM tab_garantias;
	IF wconsec IS NULL THEN
			wconsec = 1;
	ELSE
			wconsec = wconsec + 1;
	END IF;
	SELECT val_garant INTO wval_garantia FROM tab_modelos;
	INSERT INTO tab_garantias VALUES(wconsec,NEW.id_garantia,NEW.fecha_venta,wval_garantia,TRUE,NEW.id_marca,NEW.id_modelo,NEW.id_referencia);
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

----------------------------------------------
-- Trigger para fun_garantia en tabla ventas--
----------------------------------------------

CREATE TRIGGER tri_garantia
AFTER INSERT ON tab_ventas
FOR EACH ROW
EXECUTE PROCEDURE fun_garantia();
