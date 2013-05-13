<?php include('configs.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Demo</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Le styles -->
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<style type="text/css">
  body {
    padding-top: 60px;
    padding-bottom: 40px;
  }
  .sidebar-nav {
    padding: 9px 0;
  }

  @media (max-width: 980px) {
    /* Enable use of floated navbar text */
    .navbar-text.pull-right {
      float: none;
      padding-left: 5px;
      padding-right: 5px;
    }
  }
</style>
<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
</head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">D3MO</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link">Username</a>
            </p>
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Sidebar</li>
              <li><a href="eventos.php">Eventos</a></li>
              <li><a href="#">Notícias</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        
        <div class="span9">
        	<?php
    			if(isset($_POST['sendEve'])){
    				if($_POST['evento'] != ''){
    					$f['evento'] = $_POST['evento'];

    					$sqlE = "INSERT INTO eventos (id, evento) VALUES ('', '$f[evento]')";
    					mysql_query($sqlE);
    					
        				echo '<span class="label label-success">Cadastrado com sucesso</span>';
        			}else{
        				echo '<span class="label label-important">Erro ao cadastrar no banco</span>';
        			}
        		}
    		?>
        		
        	<form name="cadEvento" action="" method="post">
		        Nome do Evento<br/><br/>
		        <input class="input-xlarge" type="text" name="evento"><br/>
		        <input type="submit" class="btn btn-primary" name="sendEve" value="Incluir">
        	</form>
	        
	        
	        <?php
	        	/* SELECIONA E EXIBE EVENTOS DO BANCO DE DADOS */
	        	
	        	$selAll = mysql_query("SELECT * FROM eventos");
	        	
	        	echo '<div class="well">';
	        		if($selAll){     		
		        		echo '<ul class="nav nav-list">';
			        		while($row = mysql_fetch_object($selAll)):
		        				echo '<li>';
		        					echo '<i class="icon-tag"></i> ID: '.$row->id.'<br/>';
		        					echo '<i class="icon-bookmark"></i> EVENTO: '.$row->evento.'';
		        					echo '<a href="eventos.php?id='.$row->id.'" class="btn btn-small" style="width:60px;">Editar</a>';
		        					echo '<a href="eventos.php?id='.$row->id.'" class="btn btn-small" style="width:60px;">Excluir</a>';
		        				echo '</li><br/>';
		        			endwhile;
		        		echo '</ul>';
	        		}else{
		        		echo 'Não há eventos cadastrados ainda...';
	        		}
	        		
	        	/* DELETA RESULTADOS DO BANCO DE DADOS */
	        	
	        	if($_GET['id']){
			        $delEve = "DELETE FROM eventos WHERE id = '$_GET[id]'";
			        $delFim = mysql_query($delEve) or die (mysql_error());
			        
			        echo '<span class="label label-important">Item deletado com sucesso!</span>';
			        echo '<meta http-equiv="refresh" content="5;url=eventos.php">';
		        }
		        
	        	echo '</div>';
	        ?>
	        
	        
            </div><!--/span-->
          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2013</p>
      </footer>

    </div><!--/.fluid-container-->
  </body>
</html>
