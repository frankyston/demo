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

<script src="bootstrap/js/bootstrap-alert.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery.js"></script>
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
              <li><a href="noticias.php">Notícias</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
            
          
        <h1>Administração de Notícias</h1>
		<?php 
		
			if(isset($_GET['acao']) && $_GET['acao'] == 'del'){
				$sql = "DELETE FROM noticias WHERE id = '$_GET[id]'";
				$result = mysql_query($sql);
				
				if($result){
					echo '
								<div class="alert alert-success">
								<a class="close" data-dismiss="alert" href="#">&times;</a>
								  Notícia Excluído com Sucesso!
								</div>
							 ';
				}else{
					echo '
								<div class="alert alert-success">
								<a class="close" data-dismiss="alert" href="#">&times;</a>
								  Erro ao Excluir a Notícia!
								</div>
							 ';
				}
			}
		
			
			
		
       		if(isset($_POST['sendNoticia'])){
       			if($_POST['noticia'] != ''){
					$sql = "INSERT INTO noticias (noticias) VALUES ('$_POST[noticia]')";
					$result = mysql_query($sql);
					if($result){
						echo '
								<div class="alert alert-success">
								<a class="close" data-dismiss="alert" href="#">&times;</a>
								  Notícia Cadastrado com Sucesso!
								</div>
							 ';
					}else{
						echo '
								<div class="alert alert-error">
    							<a class="close" data-dismiss="alert" href="#">&times;</a>
								  Erro ao cadastrar Notícia! Favor tente novamente!
								</div>
							 ';
					}
       			}else{
       				echo '
							<div class="alert alert-error">
    						<a class="close" data-dismiss="alert" href="#">&times;</a>
								Erro ao cadastrar Notícia! Favor tente novamente!
							</div>
						 ';
       			}
       		}
       		
       		if(isset($_GET['acao']) && $_GET['acao'] == 'edit'){

				$sql = "SELECT * FROM noticias WHERE id = '$_GET[id]'";
				$result = mysql_query($sql);
				$noticia = mysql_fetch_object($result);
				echo '
              		<form name="formNoticias" method="post" action="noticias.php">
			          <input type="text" placeholder="Digite o nome da notícia" name="noticia" value="'.$noticia->noticias.'"><br/>
          			  <input type="hidden" name="id" value="'.$noticia->id.'" />
              		  <input type="hidden" name="acao" value="sendEdit" />
              		<input type="submit" name="sendEditNoticia" value="Alterar" class="btn btn-primary" />
			        </form>
              		';
       		}else{
       			echo '
              		<form name="formNoticias" method="post" action="noticias.php">
			          <input type="text" placeholder="Digite o nome da notícia" name="noticia"><br/>
			          <input type="submit" name="sendNoticia" value="Cadastrar" class="btn btn-primary" />
			        </form>
              		';
       		}
       		
       		if(isset($_POST['sendEditNoticia'])){
       			$sql = "UPDATE noticias SET noticias = '$_POST[noticia]' WHERE id = '$_POST[id]'";
       			$result = mysql_query($sql);
       			if($result){
						echo '
								<div class="alert alert-success">
								<a class="close" data-dismiss="alert" href="#">&times;</a>
								  Notícia Alterado com Sucesso!
								</div>
							 ';
					}else{
						echo '
								<div class="alert alert-error">
    							<a class="close" data-dismiss="alert" href="#">&times;</a>
								  Erro ao Alterar Notícia! Favor tente novamente!
								</div>
							 ';
					}
       		}
       	?>
       
       
          <table class="table table-striped">
          	<tr>
          		<td>#</td>
          		
          		<td>Notícia</td>
          		<td>Ações</td>
          	</tr>
          	<?php 
       	
	       	$sql = "SELECT * FROM noticias ORDER BY id DESC";
	       	$result = mysql_query($sql);
	       	while($row = mysql_fetch_object($result)):
	       	?>
            <tr>
              <td><?php echo $row->id;?></td>
              <td>
              	<a href="noticias.php?acao=view&id=<?php echo $row->id;?>"><?php echo $row->noticias;?></a>
              </td>
              <td>
                <a href="noticias.php?acao=del&id=<?php echo $row->id;?>" alt="Excluir <?php echo $row->noticias;?>" title="Excluir <?php echo $row->noticias;?>"><i class="icon-remove"></i></a>
                <a href="noticias.php?acao=edit&id=<?php echo $row->id;?>" alt="Editar <?php echo $row->noticias;?>" title="Editar <?php echo $row->noticias;?>"><i class="icon-pencil"></i></a>
              </td>
              <?php endwhile;?>
            </tr>


          </table>
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2013</p>
      </footer>

    </div><!--/.fluid-container-->
  </body>
  
  <script type="text/javascript">

  	$(document).ready(function(){
  		$('.alert a').click(function(){
			$('.alert').hide({
				opacity: 0.1,
				duration: 600
			}).hide({
				duration: 600
			}); 
  	  	})
	});
  </script>
  
</html>
