<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: text/json; charset=utf-8');

/*
 * TicTacToe Backend
 * Last update: 03.03.2020
 */


require ("config.php");
require ("api.php");

$req = htmlspecialchars($_REQUEST['req']);
$pin = htmlspecialchars($_REQUEST['pin']);

$game_id = htmlspecialchars($_REQUEST['game_id']);
$player_id = htmlspecialchars($_REQUEST['player_id']);
$field = htmlspecialchars($_REQUEST['field']);

$api = new Api();

if($req == "" || $pin == ""){
    echo $api->JsonResponse(false, ['msg' => 'Anfrage abgelehnt.']);
    die();
}

if(!$api->checkPin($pin)){
    echo $api->JsonResponse(false, ['msg' => 'Es wurde kein Konto zu dieser PIN gefunden.']);
    die();
}

switch ($req){
    case 'getGame':
        getGameReq($game_id);
        break;

    case 'newGame':
        newGameReq();
        break;

    case 'makeMove':
        makeMoveReq($game_id, $player_id, $field);
        break;

    default:
        echo $api->JsonResponse(false, []);
        die();
        break;
}

function makeMoveReq($game_id, $player_id, $field){
    $api = new Api();

    checkGame($game_id);
    checkPlayer($game_id, $player_id);

    $game = $api->getGame($game_id);

    if($game->currentPlayer == 'X'){
        if($game->playerX_id != $player_id){
            echo $api->JsonResponse(false, ['msg' => 'Der andere Spieler ist am Zug.']);
            die();
        }
    }
    if($game->currentPlayer == 'O'){
        if($game->playerO_id != $player_id){
            echo $api->JsonResponse(false, ['msg' => 'Der andere Spieler ist am Zug.']);
            die();
        }
    }

    if(!$api->makeMove($game_id, $field)){
        echo $api->JsonResponse(false, ['msg' => 'Das Feld ist bereits belegt.']);
        die();
    }

    $check_win = $api->checkWin($game_id);
	if($check_win == 'N'){
		$api->JsonResponse(false, ['msg' => 'Es ist unentschieden.']);
		die();
	}
    if($check_win == 'X' || $check_win == 'O'){
        $api->sql_query('UPDATE games SET player_won = ? WHERE id = ?', [$check_win, $game->id]);
    }

    $api->changePlayer($game_id);

    echo $api->JsonResponse(true, ['game' => $api->getGame($game_id), 'field' => $api->getGamefield($game->gamefield_id)]);
    die();
}

function getGameReq($game_id){
    $api = new Api();

    checkGame($game_id, false);

    $game = $api->getGame($game_id);

    echo $api->JsonResponse(true, ['game' => $game, 'field' => $api->getGamefield($game->id)]);
    die();
}

function newGameReq(){
    $api = new Api();

    $playerX = $api->generatePlayerId();
    $playerO = $api->generatePlayerId();

    $api->sql_query('INSERT INTO gamefields () VALUES ()', []);
    $gamefield_id = $api->lastid;
    $query = $api->sql_query('INSERT INTO games (gamefield_id, currentPlayer, playerX_id, playerO_id, player_won) VALUES (?, ?, ?, ?, ?)', [$gamefield_id, 'X', $playerX, $playerO, null]);
    $game_id = $api->lastid;

    echo $api->JsonResponse(true, ['game' => $api->getGame($game_id), 'field' => $api->getGamefield($game_id)]);
    die();
}

function checkGame($game_id, $checkWin = true){
    $api = new Api();

    $game_check = $api->checkGame($game_id);
    if (!$game_check){
        echo $api->JsonResponse(false, 'Unbekannte Game ID.');
        die();
    }
    if($checkWin){
        $game = $api->getGame($game_id);
        if($game->player_won == 'X' || $game->player_won == 'O'){
            echo $api->JsonResponse(false, ['msg' => 'Der Spieler '.$game->player_won.' hat gewonnen!']);
            die();
        }
    }

    return true;
}

function checkPlayer($game_id, $player_id){
    $api = new Api();

    $game = $api->getGame($game_id);
    if ($game->playerX_id != $player_id && $game->playerO_id != $player_id){
        echo $api->JsonResponse(false, 'Unbekannte Spieler ID.');
        die();
    }

    return true;
}
