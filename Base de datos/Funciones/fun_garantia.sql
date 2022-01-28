----------------------------------------
----------------------------------------
-- PROYECTO: Facturación e inventario --
-- FECHA: 17/09/2017				  --
-- EMPRESA: AMPERA 					  --
-- FUNCIONES						  --
----------------------------------------
----------------------------------------

-- FUNCIONES --

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
