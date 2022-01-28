<?php
	include("../../php/conexion.php");

	$pass = $_POST['password'];

	$val_pass = "SELECT * FROM tab_usuarios WHERE val_pass = '$pass'";
	$ejec_pass = pg_query($val_pass);
	$rows_pass = pg_num_rows($ejec_pass);
	if($rows_pass==1){
		session_start();
  		$_SESSION['oportunidades'] = NULL;
  		$_SESSION['autenticado'] = 'si';
  		$_SESSION['passwd'] = $pass;
  		session_set_cookie_params(0, "/", $_SERVER["HTTP_HOST"], 0); 
        header('Location: ../../index.php');
  	} else {
  		session_start();
    	echo "<script>
        	    alert('FALLOOOOOO');
          	</script>";
        session_set_cookie_params(0, "/", $_SERVER["HTTP_HOST"], 0); 
        header('Location: ../index.php');
		if($_SESSION['oportunidades']==NULL){
			$_SESSION['oportunidades']=1;
		}	elseif ($_SESSION['oportunidades']==1) {
					$_SESSION['oportunidades']=2;
				}	elseif ($_SESSION['oportunidades']==2) {
							$_SESSION['oportunidades']=3;
					}
  }

?>