<!DOCTYPE html>
<html>
<head>
    <title>Tik Tak Toe</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.flareco.net/bootswatch/darkly/bootstrap.min.css">
    <link rel="stylesheet" href="style.php?token=<?php echo md5(time()); ?>">
	<link rel="shortcut icon" href="https://www.flareco.net/img/logo.png">
	<link rel="shortcut icon" href="https://www.flareco.net/img/logo.png" type="image/x-icon">
	<link rel="icon" href="https://www.flareco.net/img/logo.png">
</head>
<body oncontextmenu="return false;">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/ttt/">ITA91.de</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="/ttt/">Home <span class="sr-only">(current)</span></a></li>
<li><a href="#" data-toggle="modal" data-target="#myModal">Anleitung</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="/legal/datenschutz">Datenschutzerklärung</a></li>
<li><a href="/legal/contact-us">Kontakt</a></li>
</ul>
			</div>
		</div>
	</nav>
    <div class="container-fluid">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel panel-heading text-center" id="room">Tik Tak Toe</div>
					<div class="panel panel-body">
						<div class="menu">
							<div class="text-center">
								<center>
									<button class="btn btn-success" onclick="createGameBtn();">Raum erstellen!</button>
									<hr></hr>
									<div class="form-group has-success">
										<label class="control-label">Raum ID:</label>
										<input type="text" id="game_id" class="form-control" style="width: 200px;" placeholder="Raum ID">
									</div>
								</center>
								<br>
								<button class="btn btn-info" onclick="joinGame();">Raum beitreten!</button>

							</div>
						</div>

						<div class="mainGame hidden">
							<div class="game-board">
								<div class="box" id="field1" onclick="makeMove(1);"></div>
								<div class="box" id="field2" onclick="makeMove(2);"></div>
								<div class="box" id="field3" onclick="makeMove(3);"></div>
								<div class="box" id="field4" onclick="makeMove(4);"></div>
								<div class="box" id="field5" onclick="makeMove(5);"></div>
								<div class="box" id="field6" onclick="makeMove(6);"></div>
								<div class="box" id="field7" onclick="makeMove(7);"></div>
								<div class="box" id="field8" onclick="makeMove(8);"></div>
								<div class="box" id="field9" onclick="makeMove(9);"></div>
							</div>
							<br>
							<center>
								<button class="btn btn-danger" onclick="reset();">Neues Spiel!</button>
							</center>
						</div>
					</div>
					<div class="panel panel-footer"><center><code id="message"></code></center></div>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> <h4 class="modal-title" id="myModalLabel">Anleitung</h4> </div> <div class="modal-body">Es spielen zwei Spieler gegen einander, wobei sie abwechselnd ein leeres Feld mit ihrem Zeichen markieren. Der eine Spieler benutzt Kreuze als Markierung und der andere Spieler benutzt Kreise. Der erste Spieler, der es schafft, drei seiner Symbole ohne Unterbrechung in einer Reihe zu haben, gewinnt das Spiel augenblicklich. <strong>Als Reihe gelten waagerechte, senkrechte oder diagonale Reihen</strong>.</div> <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button></div> </div> </div> </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="bot.js"></script>

    <script>
        let gameId, Pin, playerId, botId;
        Pin = 123456;
		gameId = "L33T";
		displayMSG("Kannst du gewinnen?");
		
		
        function createGameBtn(){

			createGame();
			$('.menu').addClass('hidden');
			$('.mainGame').removeClass('hidden');
			console.log('started');
        }
		
        function joinGame(){

            gameId = $('#game_id').val();
            $.ajax({
                type: 'POST',
                url: `https://ita91.de/ttt/endpoint.php`,
                data: {
                    'req': 'getGame',
                    'pin': Pin,
                    'game_id': gameId
                },
                success: function(res){
                    if(!res.success){

                        updateGameField(res.data.field);
                    } else {
                        playerId = res.data.game.playerO_id;
                        $('#room').text(`Tik Tak Toe (#${res.data.game.id})`);
                        $('.menu').addClass('hidden');
                        $('.mainGame').removeClass('hidden');
                    }
                }
            });
        }

        function createGame(){
            $.ajax({
                type: 'POST',
                url: `https://ita91.de/ttt/endpoint.php`,
                data: {
                    'req': 'newGame',
                    'pin': Pin
                },
                success: function(res){
                    playerId = res.data.game.playerX_id;
                    botId = res.data.game.playerO_id;
					gameId = res.data.game.id;
					$('#room').text(`Tik Tak Toe (#${gameId})`);
                    if(res.data.msg !== undefined){
                        displayMSG(res.data.msg);
						return true; 
                    } else {
						return false; 
					}
                }
            });
        }

        function makeMove(field){
            $.ajax({
                type: 'POST',
                url: `https://ita91.de/ttt/endpoint.php`,
                data: {
                    'req': 'makeMove',
                    'pin': Pin,
                    'game_id': gameId,
                    'player_id': playerId,
                    'field': field
                },
                success: function(res){
                    console.log(res);
                    if(res.success){
                        updateGameField(res.data.field);
                        setTimeout(() => {
                            botMakeMove(Pin, gameId);
                        }, 500);
                    }
                    if(res.success == false){
                        displayMSG(res.data.msg);
                    }
                }
            });
        }

        function getData(){
            $.ajax({
                type: 'POST',
                url: `https://ita91.de/ttt/endpoint.php`,
                data: {
                    'req': 'getGame',
                    'pin': Pin,
                    'game_id': gameId
                },
                success: function(res){
                    if(res.success){
                        updateGameField(res.data.field);
						if(res.data.game.player_won == "X"){
							gameId = "L33T";
							displayMSG("Der Spieler X hat gewonnen!");
						}
						if(res.data.game.player_won == "O"){
							gameId = "L33T";
							displayMSG("Der Spieler O hat gewonnen!");
						}
                    }
                    if(res.success == false){
                        displayMSG(res.data.msg);
                    }
                }
            });
        }

        function updateGameField(fields){
            $('#field1').text(fields.field1);
            $('#field2').text(fields.field2);
            $('#field3').text(fields.field3);
            $('#field4').text(fields.field4);
            $('#field5').text(fields.field5);
            $('#field6').text(fields.field6);
            $('#field7').text(fields.field7);
            $('#field8').text(fields.field8);
            $('#field9').text(fields.field9);
        }
		
		function reset(){
			gameId = "L33T";
			playerId = 0;
			$('.menu').removeClass('hidden');
            $('.mainGame').addClass('hidden');
			$('#room').text("Tik Tak Toe");
            console.log('RESET');
			displayMSG("Das Spiel wurde beendet.");
		}
		
        setInterval(function(){
            if(gameId !== "L33T"){
                getData();
            }
        }, 1000);
		
		function displayMSG(message){
			$('#message').text(message);
		}
		
    </script>
</body>
</html>