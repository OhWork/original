<!DOCTYPE html>
<?php
          require_once  "database/db_tools.php";
?>
<html>
    <head>
		<title>Original</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
       <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark col-md-12">
		<a class="navbar-brand brandedit" href="#"><h4>Original</h4></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto"></ul>
				<div class="form-inline">
					<a class="btn tm1 lgn"href="http://www.zoothailand.org/ewt_news.php?nid=246">
					<div style="padding-right:15px;">About us</div></a>
				</div>
				<div class="form-inline">
					<a class="btn lgn" href="login.php" title="Log-in">
						<div class="ml-1" style="float:left;">Log-in</div>
					</a>
				</div>
			</div>
	</nav>
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 showindex" >
		<div class="row">
			<?php include 'menu_main.php'; ?>
			<div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
				<?php
					//ตัวอย่าง
					$db = new db_tools();
					$db->openConnection();
					 //$db->createStement("select * from zoo where zoo_enable = :sts");
					 //$db->conditions("zoo","zoo_type = :sts")->Stement();
					 //$db->findByPK("zoo","zoo_id",":sts")->Stement();
/*
                                                                                $db->createStement("INSERT INTO zoo(zoo_name) VALUES(:name) ");
                                                                              $db->runStmSql(array(":name"=>"thai"));
                                                                                $db->closeStm();
*/
					$db->insert('zoo',array(
						'zoo_name' => "ABc",
						'zoo_type' => "xzy"
					));
					$db->closeStm();
					$db->findAll("zoo")->Stement();
						$db->runStmSql(array());
							while($cols = $db->moveNext_getRow()){
							echo $cols[1],"<br>";
							// echo $cols['zoo_name'],"<br>";
							}
					echo $db->closeConnection();
				?>
			</div>
		</div>
	</div>
<script>
        // passes on every "a" tag
        $("a").each(function() {
// 	       	console.log(this.href);
            // checks if its the same on the address bar
            if (url == (this.href)) {
// 	            console.log(1234);
                $(this).parents(0).addClass("show");
                $(this).addClass("bcmn");
				$(this).children().addClass('bcnm');
                //for making parent of submenu active
               //$(this).closest("li").parent().parent().addClass("active");
               $(this).parents(0).attr("aria-expanded", true);
//                console.log($(this).parents());
            }
        });
</script>
</html>
