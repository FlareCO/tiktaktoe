<?php
require('config.php');

class Bot{

    public $field;
    
    public function __construct($field = null){

    }

    public function setField($field){
        $this->field = $field;
    }

    public function makeMove(){

        if($this->field[0] == 'X' && $this->field[1] == 'X' && $this->field[2] != 'O'){
            if($this->field[2] != '')
                return randomField();
            return 2;
        }elseif($this->field[3] == 'X' && $this->field[4] == 'X' && $this->field[5] != 'O'){
            if($this->field[5] != '')
                return randomField();
            return 5;
        }elseif($this->field[6] == 'X' && $this->field[7] == 'X' && $this->field[8] != 'O'){
            if($this->field[8] != '')
                return randomField();
            return 8;
        }elseif($this->field[0] == 'X' && $this->field[3] == 'X' && $this->field[6] != 'O'){
            if($this->field[6] != '')
                return randomField();
            return 6;
        }elseif($this->field[1] == 'X' && $this->field[4] == 'X' && $this->field[7] != 'O'){
            if($this->field[7] != '')
                return randomField();
            return 7;
        }elseif($this->field[2] == 'X' && $this->field[5] == 'X' && $this->field[8] != 'O'){
            if($this->field[8] != '')
                return randomField();
            return 8;
        }elseif($this->field[0] == 'X' && $this->field[4] == 'X' && $this->field[8] != 'O'){
            if($this->field[8] != '')
                return randomField();
            return 8;
        }elseif($this->field[2] == 'X' && $this->field[4] == 'X' && $this->field[6] != 'O'){
            if($this->field[6] != '')
                return randomField();
            return 6;
        }else{
            return randomField();
        }

    }

    private function isFull(){
        if($this->field[0] != '' && $this->field[1] != '' && $this->field[2] != '' &&
        $this->field[3] != '' && $this->field[4] != '' && $this->field[5] != '' &&
        $this->field[6] != '' && $this->field[7] != '' && $this->field[8] != ''){
            return true;
        }else{
            return false;
        }
    }

    private function randomField(){
        do{
            $rand = rand(0,8);
        }while($this->field[$rand] != '' && $this->field[$rand] != 'O' && $this->field[$rand] != 'X');
        return $rand;
    }

}
