----------------------------------------
----------------------------------------
-- PROYECTO: Facturación e inventario --
-- FECHA: 27/05/17 					  --
-- FECHA ULTIMA REVISION: 27/05/19 	  --
-- EMPRESA: AMPERA 					  --
-- CREACIÓN DE TABLAS				  --
----------------------------------------
----------------------------------------

------------------
-- BORAR TABLAS --
------------------

-----------------
-- TABLAS (16) --
-----------------

DROP TABLE tab_garantias;
DROP TABLE tab_ventas;
DROP TABLE tab_compras;
DROP TABLE tab_personas;
DROP TABLE tab_baterias_r;
DROP TABLE tab_baterias_c;
DROP TABLE tab_baterias_n;
DROP TABLE tab_referencias;
DROP TABLE tab_modelos;
DROP TABLE tab_marcas;
DROP TABLE tab_tipo_pers;
DROP TABLE tab_usuarios;
DROP TABLE tab_parametros;
DROP TABLE tab_ciudades;
DROP TABLE tab_departamentos;
DROP TABLE tab_paises;


-----------------
-- FIN TABLAS (16) --
-----------------

------------------------
-- CREACIÓN DE TABLAS --
------------------------

-----------------
-- TABLAS (17) --
-----------------

------------------------------ TAB_PAISES: Tabla de paises ---------------------------------
CREATE TABLE tab_paises
(
	id_consec			BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_pais				INTEGER						NOT NULL,				-- Identificador del país
	nom_pais			VARCHAR(50)					NOT NULL,				-- Nombre del país
	usr_insert		    VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update			VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update			TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_pais)
);
---------------------------------------------------------------------------------------------------------

------------------------------ TAB_DEPARTAMENTO: Tabla de departamentos ---------------------------------
CREATE TABLE tab_departamentos
(
	id_consec			BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_pais				INTEGER						NOT NULL,				-- Identificador del país
	id_departamento		INTEGER						NOT NULL,				-- Identificador del departamento
	nom_departamento	VARCHAR(50)					NOT NULL,				-- Nombre del departamento
	usr_insert		    VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update			VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update			TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_pais,id_departamento),
	FOREIGN KEY (id_pais) REFERENCES tab_paises (id_pais)
);
---------------------------------------------------------------------------------------------------------

------------------------------ TAB_CIUDADES: Tabla de ciudades ------------------------------------------
CREATE TABLE tab_ciudades 
(
	id_consec			BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_pais				INTEGER						NOT NULL,				-- Identificador del país
	id_departamento		INTEGER						NOT NULL,				-- Identificador del departamento
	id_ciudad			INTEGER						NOT NULL,				-- Identificador del ciudad
	nom_ciudad			VARCHAR(50)					NOT NULL,				-- Nombre del ciudad
	usr_insert		    VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update			VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update			TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_pais,id_departamento,id_ciudad),
	FOREIGN KEY (id_pais) REFERENCES tab_paises (id_pais),
	FOREIGN KEY (id_pais,id_departamento) REFERENCES tab_departamentos (id_pais,id_departamento)
);
---------------------------------------------------------------------------------------------------------
--------------------- TAB_PARÁMETROS: Todos los parámetros que utilizamos -------------------------------
CREATE TABLE tab_parametros 
(
	id_consec			BIGINT			NOT NULL,		-- Consecutivo de la tabla
	ano					DECIMAL(4,0)	NOT NULL,		-- Año 
	id_pais				INTEGER			NOT NULL,		-- Identificador del país
	id_departamento		INTEGER			NOT NULL,		-- Identificador del departamento
	id_ciudad			INTEGER			NOT NULL,		-- Identificador del ciudad
	nit_local			VARCHAR(12)		NOT NULL,		-- Nit de la empresa
	dir_local			VARCHAR(150)	NOT NULL,		-- Dirección de la empresa
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
	PRIMARY KEY (ano),
	FOREIGN KEY (id_pais) REFERENCES tab_paises (id_pais),
	FOREIGN KEY (id_pais,id_departamento) REFERENCES tab_departamentos (id_pais,id_departamento),
	FOREIGN KEY (id_pais,id_departamento,id_ciudad) REFERENCES tab_ciudades (id_pais,id_departamento,id_ciudad)
);
---------------------------------------------------------------------------------------------------------
------------------------------ TAB_USUARIOS: Tabla de usuarios ------------------------------------------
CREATE TABLE tab_usuarios 
(
	id_consec			BIGINT						NOT NULL,				-- Consecutivo de la tabla
	val_pass			VARCHAR(12)					NOT NULL,				-- Valor de la contraseña (Minimo 7 - Máximo 12 digitos)
	nom_usuario			VARCHAR(50)					NOT NULL,				-- Nombre de usuario
	tel_usuario			DECIMAL(10,0)				NOT NULL,				-- Teléfono del usuario
	dir_usuario			VARCHAR(50)					NOT NULL,				-- Dirección del usuario
	usr_insert		    VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update			VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update			TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (val_pass)
);
---------------------------------------------------------------------------------------------------------

----------- TAB_TIPO_PERS: Tabla de tipo de clientes y distribuidores (Personas/Empresas) ---------------
CREATE TABLE tab_tipo_pers 
(
	id_consec			BIGINT						NOT NULL,				-- Consecutivo de la tabla
	ab_tipo_persona		VARCHAR						NOT NULL,				-- Abreviatura tipo persona (Es el id)
	nom_tipo_pers		VARCHAR						NOT NULL,				-- Nombre tipo persona(Ej: Cliente Ocasional)
	val_tipo_pers		DECIMAL(1,0)				NOT NULL,				-- Valor de veces de compra de una persona
	usr_insert		    VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update			VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update			TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (ab_tipo_persona)
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
	id_modelo	DECIMAL(2,0)				NOT NULL, 				-- Consecutivo de la tabla modelos (Ej: Gold plus, Silver plus)
	nom_modelo	VARCHAR(50)					NOT NULL,				-- Nombre del modelo de la batería
	val_garant	DECIMAL(2,0)				NOT NULL,				-- Duración de la garantía
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
	nom_referencia	VARCHAR(50)					NOT NULL,				-- Nombre del referencia de la batería
	ind_polo_posi	BOOLEAN						NOT NULL,				-- Indicador de polo positivo (TRUE = Derecha, FALSE = Izquierda)
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
	cant_baterias_n			DECIMAL(3,0)				NOT NULL,				-- Cantidad de baterías nuevas
	usr_insert		    	VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    	TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update				VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update				TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_marca,id_modelo,id_referencia),
	FOREIGN KEY (id_marca) REFERENCES tab_marcas(id_marca),
	FOREIGN KEY (id_modelo,id_marca) REFERENCES tab_modelos(id_modelo,id_marca),
	FOREIGN KEY (id_marca,id_modelo,id_referencia) REFERENCES tab_referencias(id_marca,id_modelo,id_referencia)
);
---------------------------------------------------------------------------------------------------------

--------------------- TAB_BATERÍAS_C: Todas las baterías chatarras que ingresan ----------------------------
CREATE TABLE tab_baterias_c
(
	id_consec				BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_marca				DECIMAL(2,0)				NOT NULL,				-- Consecutivo marca de la batería
	id_modelo				DECIMAL(2,0)				NOT NULL, 				-- Consecutivo de la tabla modelos
	id_referencia			DECIMAL(2,0)				NOT NULL,				-- Consecutivo referencia de la batería
	cant_baterias_c			DECIMAL(3,0)				NOT NULL,				-- Cantidad de baterías chatarras
	usr_insert		    	VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    	TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update				VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update				TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_marca,id_modelo,id_referencia),
	FOREIGN KEY (id_marca) REFERENCES tab_marcas(id_marca),
	FOREIGN KEY (id_modelo,id_marca) REFERENCES tab_modelos(id_modelo,id_marca),
	FOREIGN KEY (id_marca,id_modelo,id_referencia) REFERENCES tab_referencias(id_marca,id_modelo,id_referencia)
);
---------------------------------------------------------------------------------------------------------

--------------------- TAB_BATERÍAS_R: Todas las baterías regaladas --------------------------------------
CREATE TABLE tab_baterias_r
(
	id_consec				BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_marca				DECIMAL(2,0)				NOT NULL,				-- Consecutivo marca de la batería
	id_modelo				DECIMAL(2,0)				NOT NULL, 				-- Consecutivo de la tabla modelos
	id_referencia			DECIMAL(2,0)				NOT NULL,				-- Consecutivo referencia de la batería
	cant_baterias_r			DECIMAL(3,0)				NOT NULL,				-- Cantidad de baterías regaladas
	usr_insert		    	VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    	TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update				VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update				TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_marca,id_modelo,id_referencia),
	FOREIGN KEY (id_marca) REFERENCES tab_marcas(id_marca),
	FOREIGN KEY (id_modelo,id_marca) REFERENCES tab_modelos(id_modelo,id_marca),
	FOREIGN KEY (id_marca,id_modelo,id_referencia) REFERENCES tab_referencias(id_marca,id_modelo,id_referencia)
);
---------------------------------------------------------------------------------------------------------

---------------- TAB_PERSONAS: Tabla de cliente y distribuidores (Personas/Empresas) --------------------
CREATE TABLE tab_personas
(
	id_consec			BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_persona			DECIMAL(15,0)				NOT NULL,				-- Identificación del cliente o distribuidor (Persona/Empresa)
	digito_v			DECIMAL(3,0)				NOT NULL,				-- Dígito de verificación del nit
	id_pais				INTEGER						NOT NULL,				-- Identificador del país
	id_departamento		INTEGER						NOT NULL,				-- Identificador del departamento
	id_ciudad			INTEGER						NOT NULL,				-- Identificador del ciudad
	nom_persona			VARCHAR(100)				NOT NULL,				-- Nombre del cliente o distribuidor(Persona/Empresa)
	dir_persona			VARCHAR(150)				NOT NULL,				-- Dirección del cliente o distribuidor(Persona/Empresa)
	cel_persona			DECIMAL(10,0),										-- Celular del cliente o distribuidor(Persona/Empresa)
	tel_persona			DECIMAL(7,0),										-- Teléfono del cliente o distribuidor(Persona/Empresa)
	email_persona		VARCHAR(100),										-- Email del cliente o distribuidor(Persona/Empresa)
	ind_persona			BOOLEAN						NOT NULL,				-- Indicador de persona (TRUE=Cliente, FALSE=Proveedor)
	ind_persona1		BOOLEAN						NOT NULL,				-- Indicador de persona (TRUE=Persona, FALSE=Empresa)
	ab_tipo_persona		VARCHAR						NOT NULL,				-- Abreviatura tipo persona (Es el id)
	usr_insert		    VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update			VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update			TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_persona,digito_v),
	FOREIGN KEY (ab_tipo_persona) REFERENCES tab_tipo_pers (ab_tipo_persona),
	FOREIGN KEY (id_pais) REFERENCES tab_paises (id_pais),
	FOREIGN KEY (id_pais,id_departamento) REFERENCES tab_departamentos (id_pais,id_departamento),
	FOREIGN KEY (id_pais,id_departamento,id_ciudad) REFERENCES tab_ciudades (id_pais,id_departamento,id_ciudad)
);
---------------------------------------------------------------------------------------------------------

------------ TAB_COMPRAS: Reporte de compras de baterías a los distribuidores --------------------------
CREATE TABLE tab_compras
(
	id_consec				BIGINT							NOT NULL,		-- Consecutivo de la tabla
	id_factura				VARCHAR(10)						NOT NULL,		-- Identificador de factura
	id_marca				DECIMAL(2,0)					NOT NULL,		-- Consecutivo marca de la batería
	id_modelo				DECIMAL(2,0)					NOT NULL, 		-- Consecutivo de la tabla modelos
	id_referencia			DECIMAL(2,0)					NOT NULL,		-- Consecutivo referencia de la batería
	id_persona				DECIMAL(15,0)					NOT NULL,		-- Identificación del cliente o distribuidor (Persona/Empresa)
	digito_v				DECIMAL(3,0)					NOT NULL,		-- Dígito de verificación del nit
	ind_nueva				BOOLEAN DEFAULT FALSE 			NOT NULL, 		-- Indicador de batería nueva
	ind_chatarra			BOOLEAN DEFAULT FALSE 			NOT NULL, 		-- Indicador de batería chatarra
	ind_regalada			BOOLEAN DEFAULT FALSE 			NOT NULL, 		-- Indicador de batería regalada
	cant_baterias 			DECIMAL(3,0)					NOT NULL,		-- Cantidad de baterías que ingresan
	fecha_ingreso			DATE							NOT NULL,		-- Fecha de ingreso de las baterías
	precio_compra			INTEGER							NOT NULL,		-- Precio de compra (Ej: La compre en $100)
	precio_venta			INTEGER							NOT NULL,		-- Precio de venta (Ej: La voy a vender en $200)
	val_total_compra		INTEGER							NOT NULL,		-- Valor total de la compra
	val_descuento			INTEGER							NOT NULL,		-- Valor del descuento de la compra
	usr_insert		    	VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    	TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update				VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update				TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY (id_factura,id_marca,id_modelo,id_referencia),
	FOREIGN KEY (id_persona,digito_v) REFERENCES tab_personas(id_persona,digito_v),
	FOREIGN KEY (id_marca) REFERENCES tab_marcas(id_marca),
	FOREIGN KEY (id_modelo,id_marca) REFERENCES tab_modelos(id_modelo,id_marca),
	FOREIGN KEY (id_marca,id_modelo,id_referencia) REFERENCES tab_referencias(id_marca,id_modelo,id_referencia)
);
---------------------------------------------------------------------------------------------------------

-------------- TAB_VENTAS: Reporte debaterías que vendemos a las personas -----------------------------
CREATE TABLE tab_ventas
(
	id_consec			BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_factura			VARCHAR(10)					NOT NULL, 				-- Identificador de factura
	id_persona			DECIMAL(15,0)				NOT NULL,				-- Identificación del cliente o distribuidor (Persona/Empresa)
	digito_v			DECIMAL(3,0)				NOT NULL,				-- Dígito de verificación del nit
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
	FOREIGN KEY (id_persona,digito_v) REFERENCES tab_personas(id_persona,digito_v),
	FOREIGN KEY (id_marca) REFERENCES tab_marcas(id_marca),
	FOREIGN KEY (id_modelo,id_marca) REFERENCES tab_modelos(id_modelo,id_marca),
	FOREIGN KEY (id_marca,id_modelo,id_referencia) REFERENCES tab_referencias(id_marca,id_modelo,id_referencia),
	FOREIGN KEY (id_marca_c) REFERENCES tab_marcas(id_marca),
	FOREIGN KEY (id_modelo_c,id_marca_c) REFERENCES tab_modelos(id_modelo,id_marca),
	FOREIGN KEY (id_referencia_c,id_modelo_c,id_marca_c) REFERENCES tab_referencias(id_marca,id_modelo,id_referencia)	
);
---------------------------------------------------------------------------------------------------------

-------------------------------------------- TAB_GARANTÍAS----------------------------------------------
CREATE TABLE tab_garantias
(
	id_consec			BIGINT						NOT NULL,				-- Consecutivo de la tabla
	id_garantia			VARCHAR						NOT NULL,				-- Número de la targeta de garantía
	fec_garantia		DATE 						NOT NULL,				-- Fecha de solicitud de garantía
	val_garant			INTEGER						NOT NULL,				-- Valor de la garantía (Ej: 12 meses)
	ind_estado			BOOLEAN						NOT NULL,				-- Estado de la garantía (TRUE = Vigente y FALSE = Vencida)
	id_marca			DECIMAL(2,0)				NOT NULL,				-- Consecutivo marca de la batería
	id_modelo			DECIMAL(2,0)				NOT NULL, 				-- Consecutivo de la tabla modelos
	id_referencia		DECIMAL(2,0)				NOT NULL,				-- Consecutivo referencia de la batería
	usr_insert		    VARCHAR(20)					NOT NULL,				-- Usuario que insertó el registro en la tabla
	fec_insert		    TIMESTAMP WITHOUT TIME ZONE	NOT NULL DEFAULT NOW(), -- Fecha de inserción del registro en la tabla
	usr_update			VARCHAR(20),										-- Usuario que actualizó el registro en la tabla
	fec_update			TIMESTAMP WITHOUT TIME ZONE,						-- Fecha de actualización del registro en la tabla
	PRIMARY KEY(id_garantia),
	FOREIGN KEY (id_marca) REFERENCES tab_marcas(id_marca),
	FOREIGN KEY (id_modelo,id_marca) REFERENCES tab_modelos(id_modelo,id_marca),
	FOREIGN KEY (id_marca,id_modelo,id_referencia) REFERENCES tab_referencias(id_marca,id_modelo,id_referencia)
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
-- FIN TABLAS (17) --
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
-- TRIGGERS (32) --
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
	BEFORE INSERT OR UPDATE ON tab_paises
	FOR EACH ROW EXECUTE PROCEDURE fun_auditoria();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_auditoria
	BEFORE INSERT OR UPDATE ON tab_departamentos
	FOR EACH ROW EXECUTE PROCEDURE fun_auditoria();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_auditoria
	BEFORE INSERT OR UPDATE ON tab_ciudades
	FOR EACH ROW EXECUTE PROCEDURE fun_auditoria();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_auditoria
	BEFORE INSERT OR UPDATE ON tab_usuarios
	FOR EACH ROW EXECUTE PROCEDURE fun_auditoria();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_auditoria
	BEFORE INSERT OR UPDATE ON tab_tipo_pers
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
	AFTER INSERT OR UPDATE OR DELETE ON tab_parametros
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_paises
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_departamentos
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_ciudades
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_usuarios
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_tipo_pers
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_marcas
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_modelos
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_referencias
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_baterias_n
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_baterias_c
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_baterias_r
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
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
	AFTER INSERT OR UPDATE OR DELETE ON tab_ventas
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------

CREATE TRIGGER tri_historial
	AFTER INSERT OR UPDATE OR DELETE ON tab_garantias
	FOR EACH ROW EXECUTE PROCEDURE fun_historial();
-----------------------------------------------------------------------------------------------------------------------------------------

-----------------------
-- FIN TRIGGERS (32) --
-----------------------