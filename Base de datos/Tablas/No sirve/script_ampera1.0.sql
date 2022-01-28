----------------------------------------
----------------------------------------
-- PROYECTO: Facturación e inventario --
-- FECHA: 27/05/17 					  --
-- EMPRESA: AMPERA 					  --
-- CREACIÓN DE TABLAS				  --
----------------------------------------
----------------------------------------

-----------------
-- TABLAS (11) --
-----------------

------------------
-- BORAR TABLAS --
------------------

DROP TABLE tab_garantias;
DROP TABLE tab_ventas;
DROP TABLE tab_personas;
DROP TABLE tab_compras;
DROP TABLE tab_baterias_r;
DROP TABLE tab_baterias_c;
DROP TABLE tab_baterias_n;
DROP TABLE tab_referencias;
DROP TABLE tab_modelos;
DROP TABLE tab_marcas;
DROP TABLE tab_parametros;


------------------------
-- CREACIÓN DE TABLAS --
------------------------

--------------------- TAB_PARÁMETROS: Todos los parámetros que utilizamos -------------------------------
CREATE TABLE tab_parametros 
(
	id_consec			BIGINT			NOT NULL,		-- Consecutivo de la tabla
	ano					DECIMAL(4,0)	NOT NULL,		-- Año 
	nit_local			VARCHAR(12)		NOT NULL,		-- Nit de la empresa
	dir_local			VARCHAR(150)	NOT NULL,		-- Dirección de la empresa
	ciu_local			VARCHAR(50)		NOT NULL,		-- Ciudad de la empresa
	tel_local			DECIMAL(7,0)	NOT NULL,		-- Teléfono de la empresa
	cel_local			DECIMAL(10,0)	NOT NULL,		-- Celular de la empresa
	val_iva				DECIMAL(2,0)	NOT NULL,		-- Valor iva actual		
	nom_dueno			VARCHAR(100)	NOT NULL,		-- Nombre del dueño de la empresa
	val_lema			VARCHAR(500)	NOT NULL,		-- Lema de la empresa
	val_nota			VARCHAR(500)	NOT NULL,		-- Términos y condiciones de garantía
	deta_autorizacion	VARCHAR(500)	NOT NULL,		-- Detalle de autorización legal
	ini_factura			INTEGER			NOT NULL,		-- Inicio id de factura
	fin_factura			INTEGER			NOT NULL,		-- Fin id de factura
	usr_insert		    VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update			VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update			TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (ano)
);
---------------------------------------------------------------------------------------------------------

--------------------- TAB_MARCAS: Todas las marcas de baterías que vendemos -----------------------------
CREATE TABLE tab_marcas  
(
	id_consec	BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_marca	DECIMAL(2,0)				NOT NULL,				-- Consecutivo marca de la batería
	nom_marca	VARCHAR(50)					NOT NULL,				-- Nombre de la marca de la batería
	usr_insert	VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert	TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update	VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update	TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_marca)
);
---------------------------------------------------------------------------------------------------------

--------------------- TAB_MODELOS: Todos los modelos de baterías que vendemos ---------------------------
CREATE TABLE tab_modelos
(
	id_consec	BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_marca	DECIMAL(2,0)				NOT NULL,				-- Consecutivo marca de la batería
	id_modelo	DECIMAL(2,0)				NOT NULL, 				-- Consecutivo de la tabla modelos	
	nom_modelo	VARCHAR(50)					NOT NULL,				-- Nombre del modelo de la batería
	usr_insert  VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert  TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update  VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update	TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_marca,id_modelo),
	FOREIGN KEY (id_marca) REFERENCES tab_marcas(id_marca)
);
---------------------------------------------------------------------------------------------------------

--------------- TAB_REFERENCIAS: Todas las referencias de baterías que vendemos -------------------------
CREATE TABLE tab_referencias
(
	id_consec		BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_marca		DECIMAL(2,0)				NOT NULL,				-- Consecutivo marca de la batería
	id_modelo		DECIMAL(2,0)				NOT NULL, 				-- Consecutivo de la tabla modelos
	id_referencia	DECIMAL(2,0)				NOT NULL,				-- Consecutivo referencia de la batería
	nom_referencia	VARCHAR(50)					NOT NULL,				-- Nombre de la marca de la batería
	usr_insert		VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update		VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update		TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_marca,id_modelo,id_referencia),
	FOREIGN KEY (id_marca) REFERENCES tab_marcas(id_marca),
	FOREIGN KEY (id_modelo,id_marca) REFERENCES tab_modelos(id_modelo,id_marca)
);
---------------------------------------------------------------------------------------------------------

--------------------- TAB_BATERÍAS_N: Todas las baterías nuevas que vendemos ----------------------------
CREATE TABLE tab_baterias_n
(
	id_consec				BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_marca				DECIMAL(2,0)				NOT NULL,				-- Consecutivo marca de la batería
	id_modelo				DECIMAL(2,0)				NOT NULL, 				-- Consecutivo de la tabla modelos
	id_referencia			DECIMAL(2,0)				NOT NULL,				-- Consecutivo referencia de la batería
	ind_polo_positivo		BOOLEAN	DEFAULT TRUE		NOT NULL,				-- Polo(+) (TRUE= Derecha, FALSE=Izquierda)
	cant_baterias_n			DECIMAL(3,0)				NOT NULL,				-- Cantidad de baterías nuevas
	usr_insert		    	VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    	TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update				VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update				TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_referencia,id_modelo,id_marca),
	FOREIGN KEY (id_marca) REFERENCES tab_marcas(id_marca),
	FOREIGN KEY (id_modelo,id_marca) REFERENCES tab_modelos(id_modelo,id_marca),
	FOREIGN KEY (id_referencia,id_modelo,id_marca) REFERENCES tab_referencias(id_referencia,id_modelo,id_marca)
);
---------------------------------------------------------------------------------------------------------

--------------------- TAB_BATERÍAS_C: Todas las baterías chatarras que ingresan ----------------------------
CREATE TABLE tab_baterias_c
(
	id_consec				BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_marca				DECIMAL(2,0)				NOT NULL,				-- Consecutivo marca de la batería
	id_modelo				DECIMAL(2,0)				NOT NULL, 				-- Consecutivo de la tabla modelos
	id_referencia			DECIMAL(2,0)				NOT NULL,				-- Consecutivo referencia de la batería
	ind_polo_positivo		BOOLEAN	DEFAULT TRUE		NOT NULL,				-- Polo(+) (TRUE= Derecha, FALSE=Izquierda)
	cant_baterias_c			DECIMAL(3,0)				NOT NULL,				-- Cantidad de baterías chatarras
	usr_insert		    	VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    	TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update				VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update				TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_referencia,id_modelo,id_marca),
	FOREIGN KEY (id_marca) REFERENCES tab_marcas(id_marca),
	FOREIGN KEY (id_modelo,id_marca) REFERENCES tab_modelos(id_modelo,id_marca),
	FOREIGN KEY (id_referencia,id_modelo,id_marca) REFERENCES tab_referencias(id_referencia,id_modelo,id_marca)
);
---------------------------------------------------------------------------------------------------------

--------------------- TAB_BATERÍAS_R: Todas las baterías regaladas --------------------------------------
CREATE TABLE tab_baterias_r
(
	id_consec				BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_marca				DECIMAL(2,0)				NOT NULL,				-- Consecutivo marca de la batería
	id_modelo				DECIMAL(2,0)				NOT NULL, 				-- Consecutivo de la tabla modelos
	id_referencia			DECIMAL(2,0)				NOT NULL,				-- Consecutivo referencia de la batería
	ind_polo_positivo		BOOLEAN	DEFAULT TRUE		NOT NULL,				-- Polo(+) (TRUE= Derecha, FALSE=Izquierda)
	cant_baterias_r			DECIMAL(3,0)				NOT NULL,				-- Cantidad de baterías regaladas
	usr_insert		    	VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    	TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update				VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update				TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_referencia,id_modelo,id_marca),
	FOREIGN KEY (id_marca) REFERENCES tab_marcas(id_marca),
	FOREIGN KEY (id_modelo,id_marca) REFERENCES tab_modelos(id_modelo,id_marca),
	FOREIGN KEY (id_referencia,id_modelo,id_marca) REFERENCES tab_referencias(id_referencia,id_modelo,id_marca)
);
---------------------------------------------------------------------------------------------------------

------------ TAB_COMPRAS: Reporte de compras de baterías a los distribuidores --------------------------
CREATE TABLE tab_compras
(
	id_consec				BIGINT							NOT NULL,		-- Consecutivo de la tabla
	id_marca				DECIMAL(2,0)					NOT NULL,		-- Consecutivo marca de la batería
	id_modelo				DECIMAL(2,0)					NOT NULL, 		-- Consecutivo de la tabla modelos
	id_referencia			DECIMAL(2,0)					NOT NULL,		-- Consecutivo referencia de la batería
	ind_nueva				BOOLEAN DEFAULT FALSE 			NOT NULL, 		-- Indicador de batería nueva
	ind_chatarra			BOOLEAN DEFAULT FALSE 			NOT NULL, 		-- Indicador de batería chatarra
	ind_regalada			BOOLEAN DEFAULT FALSE 			NOT NULL, 		-- Indicador de batería regalada
	ind_polo_positivo		BOOLEAN	DEFAULT TRUE			NOT NULL,		-- Polo(+) (TRUE= Derecha, FALSE=Izquierda)
	cant_baterias 			DECIMAL(3,0)					NOT NULL,		-- Cantidad de baterías que ingresan
	fecha_ingreso			DATE							NOT NULL,		-- Fecha de ingreso de las baterías
	precio_compra			INTEGER							NOT NULL,		-- Precio de compra (Ej: La compre en $100)
	precio_venta			INTEGER							NOT NULL,		-- Precio de venta (Ej: La voy a vender en $200)
	val_total_compra		INTEGER							NOT NULL,		-- Valor total de la compra 
	usr_insert		    	VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    	TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update				VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update				TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_consec),
	FOREIGN KEY (id_marca) REFERENCES tab_marcas(id_marca),
	FOREIGN KEY (id_modelo,id_marca) REFERENCES tab_modelos(id_modelo,id_marca),
	FOREIGN KEY (id_referencia,id_modelo,id_marca) REFERENCES tab_referencias(id_referencia,id_modelo,id_marca)
);
---------------------------------------------------------------------------------------------------------

---------------- TAB_PERSONAS: Tabla de cliente y distribuidores (Personas/Empresas) --------------------
CREATE TABLE tab_personas
(
	id_consec			BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_persona			VARCHAR(15)					NOT NULL,				-- Identificación del cliente o distribuidor (Persona/Empresa)
	nom_persona			VARCHAR(100)				NOT NULL,				-- Nombre del cliente o distribuidor(Persona/Empresa)
	dir_persona			VARCHAR(150)				NOT NULL,				-- Dirección del cliente o distribuidor(Persona/Empresa)
	ciu_persona			VARCHAR(50)					NOT NULL,				-- Ciudad del cliente o distribuidor(Persona/Empresa)
	cel_persona			DECIMAL(10,0)				NOT NULL,				-- Celular del cliente o distribuidor(Persona/Empresa)
	tel_persona			DECIMAL(7,0)				NOT NULL,				-- Teléfono del cliente o distribuidor(Persona/Empresa)
	email_persona		VARCHAR(100),										-- Email del cliente o distribuidor(Persona/Empresa)
	usr_insert		    VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update			VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update			TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_persona)
);
---------------------------------------------------------------------------------------------------------

-------------- TAB_VENTAS: Reporte debaterías que vendemos a las personas -----------------------------
CREATE TABLE tab_ventas
(
	id_consec			BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_factura			VARCHAR(10)					NOT NULL, 				-- Identificador de factura
	id_persona			VARCHAR(15)					NOT NULL,				-- Identificación del cliente o distribuidor (Persona/Empresa)
	id_marca			DECIMAL(2,0)				NOT NULL,				-- Consecutivo marca de la batería
	id_modelo			DECIMAL(2,0)				NOT NULL, 				-- Consecutivo de la tabla modelos
	id_referencia		DECIMAL(2,0)				NOT NULL,				-- Consecutivo referencia de la batería
	id_garantia			VARCHAR						NOT NULL,				-- Número de la targeta de garantía
	fecha_venta			DATE						NOT NULL,				-- Fecha de la factura	
	cantidad_bat		DECIMAL(3,0)				NOT NULL,				-- Cantidad de baterías vendidas
	val_unitario		INTEGER						NOT NULL,				-- Valor de la batería por unidad
	ind_bateria_c		BOOLEAN DEFAULT FALSE		NOT NULL,				-- Indicador si deja batería usada (FALSE=No deja, TRUE=Si deja)
	id_marca_c			DECIMAL(2,0)				NOT NULL,				-- Consecutivo marca de la batería
	id_modelo_c			DECIMAL(2,0)				NOT NULL, 				-- Consecutivo de la tabla modelos
	id_referencia_c		DECIMAL(2,0)				NOT NULL,				-- Consecutivo referencia de la batería
	cant_bateria_c		DECIMAL(3,0),										-- Cantidad e la batería usada que deja
	val_descuento		INTEGER						NOT NULL,				-- Valor del descuento de venta
	sub_total			INTEGER						NOT NULL,				-- Subtotal=valtotal/iva (Parámetros=19, iva=iva+100/100, Ej:sbt=360000/1,19)
	val_iva				INTEGER						NOT NULL,				-- iva=subtotal*iva/100 (Parámetro=19, Ej: iva=302521*19/100)
	val_total 			INTEGER						NOT NULL,				-- Valor total de la venta
	usr_insert		    VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update			VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update			TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_factura),
	FOREIGN KEY (id_persona) REFERENCES tab_personas(id_persona),
	FOREIGN KEY (id_marca) REFERENCES tab_marcas(id_marca),
	FOREIGN KEY (id_modelo,id_marca) REFERENCES tab_modelos(id_modelo,id_marca),
	FOREIGN KEY (id_referencia,id_modelo,id_marca) REFERENCES tab_referencias(id_referencia,id_modelo,id_marca),
	FOREIGN KEY (id_marca_c) REFERENCES tab_marcas(id_marca),
	FOREIGN KEY (id_modelo_c,id_marca_c) REFERENCES tab_modelos(id_modelo,id_marca),
	FOREIGN KEY (id_referencia_c,id_modelo_c,id_marca_c) REFERENCES tab_referencias(id_referencia,id_modelo,id_marca)	
);
---------------------------------------------------------------------------------------------------------

-------------------------------------------- TAB_HISTORIAL ----------------------------------------------
CREATE TABLE tab_garantias
(
	id_consec			BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_garantia			VARCHAR						NOT NULL,				-- Número de la targeta de garantía
	fec_garantia		DATE 						NOT NULL,				-- Fecha de solicitud de garantía
	ind_nueva			BOOLEAN DEFAULT FALSE 		NOT NULL, 				-- Indicador de batería nueva
	ind_chatarra		BOOLEAN DEFAULT FALSE 		NOT NULL, 				-- Indicador de batería chatarra
	ref_bateria 		VARCHAR						NOT NULL,				-- Referencia de la batería
	usr_insert		    VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update			VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update			TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY(id_garantia)
);
---------------------------------------------------------------------------------------------------------

-------------------------------------------- TAB_HISTORIAL ----------------------------------------------
CREATE TABLE tab_historial
(
 	id_consec	BIGINT						NOT NULL,
 	nom_tabla	VARCHAR(50)					NOT NULL,
 	val_datos	VARCHAR(256)				NOT NULL,
 	val_evento	VARCHAR(12)					NOT NULL,
 	usr_evento	VARCHAR(12)					NOT NULL,
 	fec_evento	TIMESTAMP WITHOUT TIME ZONE	NOT NULL,
 	PRIMARY KEY(id_consec)
);
---------------------------------------------------------------------------------------------------------

---------------------
-- FIN TABLAS (11) --
---------------------

-------------------
-- FUNCIONES (2) --
-------------------

----------------------------------------------------------------------------------------------------
---------- Función para gestionar la auditoria de inserción y actualización en la misma tabla ------
----------------------------------------------------------------------------------------------------
DROP FUNCTION fun_auditoria() CASCADE;

CREATE OR REPLACE FUNCTION fun_auditoria() 
	RETURNS "trigger" 
	AS $$
	BEGIN
		IF TG_OP = 'INSERT' THEN
			NEW.usr_insert = CURRENT_USER;
			NEW.fec_insert = CURRENT_TIMESTAMP;
		END IF;
		IF TG_OP = 'UPDATE' THEN
			NEW.usr_update = CURRENT_USER;
			NEW.fec_update = CURRENT_TIMESTAMP;
		END IF;
		RETURN NEW;
	END;
$$ LANGUAGE plpgsql;
----------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------
---------- Función para gestionar la auditoria de inserción y actualización en la misma tabla ------
----------------------------------------------------------------------------------------------------

DROP FUNCTION fun_historial() CASCADE;

CREATE OR REPLACE FUNCTION fun_historial() 
	RETURNS "trigger" 
	AS $$
	DECLARE wconsec		tab_historial.id_consec%TYPE;
	BEGIN
		wconsec = 0;
		SELECT MAX(id_consec) INTO wconsec FROM tab_historial;
		IF wconsec IS NULL THEN
   			wconsec = 1;
		ELSE
   			wconsec = wconsec + 1;
		END IF;
		INSERT INTO tab_historial VALUES(wconsec,TG_RELNAME,'Consecutivo de la fila: '||NEW.id_consec,TG_OP,CURRENT_USER,CURRENT_TIMESTAMP);
		RETURN NEW;
	END;
$$ LANGUAGE PLPGSQL;

-----------------------
-- FIN FUNCIONES (2) --
-----------------------

-------------------
-- TRIGGERS (20) --
-------------------

-----------------------------------------------------------------------------------------------------------------------------------------
------------------------------------- Trigger de auditoría ------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------

CREATE TRIGGER tri_auditoria
	BEFORE INSERT OR UPDATE ON tab_parametros
	FOR EACH ROW EXECUTE PROCEDURE fun_auditoria();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_auditoria
	BEFORE INSERT OR UPDATE ON tab_marcas
	FOR EACH ROW EXECUTE PROCEDURE fun_auditoria();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_auditoria
	BEFORE INSERT OR UPDATE ON tab_modelos
	FOR EACH ROW EXECUTE PROCEDURE fun_auditoria();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_auditoria
	BEFORE INSERT OR UPDATE ON tab_referencias
	FOR EACH ROW EXECUTE PROCEDURE fun_auditoria();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_auditoria
	BEFORE INSERT OR UPDATE ON tab_baterias_n
	FOR EACH ROW EXECUTE PROCEDURE fun_auditoria();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_auditoria
	BEFORE INSERT OR UPDATE ON tab_baterias_c
	FOR EACH ROW EXECUTE PROCEDURE fun_auditoria();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_auditoria
	BEFORE INSERT OR UPDATE ON tab_baterias_r
	FOR EACH ROW EXECUTE PROCEDURE fun_auditoria();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_auditoria
	BEFORE INSERT OR UPDATE ON tab_compras
	FOR EACH ROW EXECUTE PROCEDURE fun_auditoria();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_auditoria
	BEFORE INSERT OR UPDATE ON tab_personas
	FOR EACH ROW EXECUTE PROCEDURE fun_auditoria();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_auditoria
	BEFORE INSERT OR UPDATE ON tab_ventas
	FOR EACH ROW EXECUTE PROCEDURE fun_auditoria();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_auditoria
	BEFORE INSERT OR UPDATE ON tab_garantias
	FOR EACH ROW EXECUTE PROCEDURE fun_auditoria();
-----------------------------------------------------------------------------------------------------------------------------------------

-----------------------------------------------------------------------------------------------------------------------------------------
------------------------------------- Trigger del historial -----------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_personas
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_compras
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_baterias_r
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_baterias_c
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_baterias_n
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_referencias
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_modelos
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_ventas
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_marcas
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_parametros
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_garantias
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------

-----------------------
-- FIN TRIGGERS (20) --
-----------------------