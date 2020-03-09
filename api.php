<?php

/*
 * TicTacToe API
 * Last update: 03.03.2020
 */


class Api {
    public $lastid;

    public function sql_connect(){
        require ("config.php");
        return new PDO('mysql:host='.$conf_mysql_addr.';dbname='.$conf_mysql_data, $conf_mysql_user, $conf_mysql_pass);;
    }

    public function sql_query($query, $data = null){
        $conn = $this->sql_connect();
        $query = $conn->prepare($query);
        $query->execute($data);
        $this->lastid = $conn->lastInsertId();
        return $query;
    }

    public function generatePlayerId(){
        return rand(1000, 9999).rand(1000, 9999);
    }

    public function checkPin($pin){
        $query = $this->sql_query('SELECT * FROM users WHERE pin = ? LIMIT 1', [$pin]);
        $row = $query->fetchObject();
        if($row->id != '')
            return true;
        return false;
    }

    public function JsonResponse($success, $data = null){
        return json_encode([
            'success' => $success,
            'data' => $data,
        ]);
    }

    public function checkGame($id){
        $query = $this->sql_query('SELECT * FROM games WHERE id = ? LIMIT 1', [$id]);
        $row = $query->fetchObject();
        if($row->id != '')
            return true;
        return false;
    }

    public function checkGamefield($id){
        $query = $this->sql_query('SELECT * FROM gamefields WHERE id = ? LIMIT 1', [$id]);
        $row = $query->fetchObject();
        if($row->id != '')
            return true;
        return false;
    }

    public function getGame($id){
        $query = $this->sql_query('SELECT * FROM games WHERE id = ? LIMIT 1', [$id]);
        return $query->fetchObject();
    }

    public function getGamefield($id){
        $query = $this->sql_query('SELECT * FROM gamefields WHERE id = ? LIMIT 1', [$id]);
        return $query->fetchObject();
    }

    public function getGameFieldId($id){
        $this->checkGame($id);
        $game = $this->getGame($id);
        return $game->gamefield_id;
    }

    public function changePlayer($id){
        $game = $this->getGame($id);
        if($game->currentPlayer == 'X'){
            $this->sql_query('UPDATE games SET currentPlayer = ? WHERE id = ?', ['O', $game->id]);
        }else{
            $this->sql_query('UPDATE games SET currentPlayer = ? WHERE id = ?', ['X', $game->id]);
        }
        return true;
    }

    public function makeMove($id, $field){
        $game = $this->getGame($id);
        $gamefield = $this->getGamefield($game->gamefield_id);

        if ($field == 1){
            if($gamefield->field1 != ''){
                return false;
            }
            $this->sql_query('UPDATE gamefields SET field1 = ? WHERE id = ?', [$game->currentPlayer, $gamefield->id]);
            return true;
        }elseif ($field == 2){
            if($gamefield->field2 != ''){
                return false;
            }
            $this->sql_query('UPDATE gamefields SET field2 = ? WHERE id = ?', [$game->currentPlayer, $gamefield->id]);
            return true;
        }elseif ($field == 3){
            if($gamefield->field3 != ''){
                return false;
            }
            $this->sql_query('UPDATE gamefields SET field3 = ? WHERE id = ?', [$game->currentPlayer, $gamefield->id]);
            return true;
        }elseif ($field == 4){
            if($gamefield->field4 != ''){
                return false;
            }
            $this->sql_query('UPDATE gamefields SET field4 = ? WHERE id = ?', [$game->currentPlayer, $gamefield->id]);
            return true;
        }elseif ($field == 5){
            if($gamefield->field5 != ''){
                return false;
            }
            $this->sql_query('UPDATE gamefields SET field5 = ? WHERE id = ?', [$game->currentPlayer, $gamefield->id]);
            return true;
        }elseif ($field == 6){
            if($gamefield->field6 != ''){
                return false;
            }
            $this->sql_query('UPDATE gamefields SET field6 = ? WHERE id = ?', [$game->currentPlayer, $gamefield->id]);
            return true;
        }elseif ($field == 7){
            if($gamefield->field7 != ''){
                return false;
            }
            $this->sql_query('UPDATE gamefields SET field7 = ? WHERE id = ?', [$game->currentPlayer, $gamefield->id]);
            return true;
        }elseif ($field == 8){
            if($gamefield->field8 != ''){
                return false;
            }
            $this->sql_query('UPDATE gamefields SET field8 = ? WHERE id = ?', [$game->currentPlayer, $gamefield->id]);
            return true;
        }elseif ($field == 9){
            if($gamefield->field9 != ''){
                return false;
            }
            $this->sql_query('UPDATE gamefields SET field9 = ? WHERE id = ?', [$game->currentPlayer, $gamefield->id]);
            return true;
        }else{
            return false;
        }
    }

    public function checkWin($game_id){
        $game = $this->getGame($game_id);
        $gamefield = $this->getGamefield($game->gamefield_id);
		
		if($gamefield->field1 != "" && $gamefield->field2 != "" && $gamefield->field3 != ""){
			if($gamefield->field1 == $gamefield->field2 && $gamefield->field2 == $gamefield->field3){
				return $game->currentPlayer;
			}
		}
		if($gamefield->field4 != "" && $gamefield->field5 != "" && $gamefield->field6 != ""){
			if($gamefield->field4 == $gamefield->field5 && $gamefield->field5 == $gamefield->field6){
				return $game->currentPlayer;
			}
		}
		if($gamefield->field7 != "" && $gamefield->field8 != "" && $gamefield->field9 != ""){
			if($gamefield->field7 == $gamefield->field8 && $gamefield->field8 == $gamefield->field9){
				return $game->currentPlayer;
			}
		}
		if($gamefield->field1 != "" && $gamefield->field4 != "" && $gamefield->field7 != ""){
			if($gamefield->field1 == $gamefield->field4 && $gamefield->field4 == $gamefield->field7){
				return $game->currentPlayer;
			}
		}
		if($gamefield->field2 != "" && $gamefield->field5 != "" && $gamefield->field8 != ""){
			if($gamefield->field2 == $gamefield->field5 && $gamefield->field5 == $gamefield->field8){
				return $game->currentPlayer;
			}
		}
		if($gamefield->field3 != "" && $gamefield->field6 != "" && $gamefield->field9 != ""){
			if($gamefield->field3 == $gamefield->field6 && $gamefield->field6 == $gamefield->field9){
				return $game->currentPlayer;
			}
		}
		if($gamefield->field1 != "" && $gamefield->field5 != "" && $gamefield->field9 != ""){
			if($gamefield->field1 == $gamefield->field5 && $gamefield->field5 == $gamefield->field9){
				return $game->currentPlayer;
			}
		}
		if($gamefield->field3 != "" && $gamefield->field5 != "" && $gamefield->field7 != ""){
			if($gamefield->field3 == $gamefield->field5 && $gamefield->field5 == $gamefield->field7){
				return $game->currentPlayer;
			}
		}
		
		if($gamefield->field1 != "" && $gamefield->field2 != "" && $gamefield->field3 != ""
		   && $gamefield->field4 != "" && $gamefield->field5 != "" && $gamefield->field6 != ""
		   && $gamefield->field7 != "" && $gamefield->field8 != "" && $gamefield->field9 != ""){
			return 'N';
		}

        return false;
    }
}
