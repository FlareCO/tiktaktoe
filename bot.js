function genField(){
    return Math.floor(Math.random() * 9) + 1;
}
function botMakeMove(Pin, GameId){

    let field = null;

    field1 = document.getElementById("field1").innerHTML;
    field2 = document.getElementById("field2").innerHTML;
    field3 = document.getElementById("field3").innerHTML;
    field4 = document.getElementById("field4").innerHTML;
    field5 = document.getElementById("field5").innerHTML;
    field6 = document.getElementById("field6").innerHTML;
    field7 = document.getElementById("field7").innerHTML;
    field8 = document.getElementById("field8").innerHTML;
    field9 = document.getElementById("field9").innerHTML;

    if(field1 == 'X' && field2 == 'X' && field3 != 'O'){
        /*
            - - +
            4 5 6
            7 8 9
        */
        field = 3;
    }else if(field4 == 'X' && field5 == 'X' && field6 != 'O'){
        /*
            1 2 3
            - - +
            7 8 9
        */
        field = 5;
    }else if(field7 == 'X' && field8 == 'X' && field9 != 'O'){
        /*
            1 2 3
            4 5 6
            - - +
        */
        field = 8;
    }else if(field1 == 'X' && field4 == 'X' && field7 != 'O')
    {
        /*
            - 2 3
            - 5 6
            + 8 9
        */
        field = 7;
    }else if(field2 == 'X' && field5 == 'X' && field8 != 'O'){
        /*
            1 - 3
            4 - 6
            7 + 9
        */
        field = 8;
    }else if(field3 == 'X' && field6 == 'X' && field9 != 'O'){
        /*
            1 2 -
            4 5 -
            7 8 +
        */
        field = 9;
    }else if(field1 == 'X' && field5 == 'X' && field9 != 'O'){
        /*
            - 2 3
            4 - 6
            7 8 +
        */
        field = 9;
    }else if(field3 == 'X' && field5 == 'X' && field7 != 'O'){
        /*
            1 2 -
            4 - 6
            + 8 9
        */
        field = 7;
    }else if(field1 == 'X' && field3 == 'X' && field2 != 'O'){
        /*
            - + -
            4 5 6
            7 8 9
        */
        field = 2;
    }else if(field4 == 'X' && field6 == 'X' && field5 != 'O'){
        /*
            1 2 3
            - + -
            7 8 9
        */
        field = 5;
    }else if(field7 == 'X' && field9 == 'X' && field8 != 'O'){
        /*
            1 2 3
            4 5 6
            - + -
        */
        field = 8;
    }else if(field1 == 'X' && field7 == 'X' && field4 != 'O'){
        /*
            - 2 3
            + 5 6
            - 8 9
        */
        field = 4;
    }else if(field2 == 'X' && field8 == 'X' && field5 != 'O'){
        /*
            1 - 3
            4 + 6
            7 - 9
        */
        field = 5;
    }else if(field3 == 'X' && field9 == 'X' && field6 != 'O'){
        /*
            1 2 -
            4 5 +
            7 8 -
        */
        field = 6;
    }else if(field1 == 'X' && field9 == 'X' && field5 != 'O'){
        /*
            - 2 3
            4 + 6
            7 8 -
        */
        field = 5;
    }else if(field3 == 'X' && field7 == 'X' && field5 != 'O'){
        /*
            1 2 -
            4 + 6
            - 8 9
        */
        field = 5;
    }else if(field2 == 'X' && field3 == 'X' && field1 != 'O'){
        /*
            + - -
            4 5 6
            7 8 9
        */
        field = 1;
    }else if(field5 == 'X' && field6 == 'X' && field4 != 'O'){
        /*
            1 2 3
            + - -
            7 8 9
        */
        field = 4;
    }else if(field8 == 'X' && field9 == 'X' && field7 != 'O'){
        /*
            1 2 3
            4 5 6
            + - -
        */
        field = 7;
    }else if(field9 == 'X' && field5 == 'X' && field1 != 'O'){
        /*
            + 2 3
            4 - 6
            7 8 -
        */
        field = 1;
    }else if(field7 == 'X' && field5 == 'X' && field3 != 'O'){
        /*
            1 2 +
            4 - 6
            - 8 9
        */
        field = 3;
    }else if(field4 == 'X' && field7 == 'X' && field1 != 'O'){
        /*
            + 2 3
            - 5 6
            - 8 9
        */
        field = 1;
    }else if(field8 == 'X' && field5 == 'X' && field2 != 'O'){
        /*
            1 + 3
            4 - 6
            7 - 9
        */
        field = 2;
    }else if(field6 == 'X' && field9 == 'X' && field3 != 'O'){
        /*
            1 2 +
            4 5 -
            7 8 -
        */
        field = 3;
    }else {
        let rand = genField();
        do {
            rand = genField();
        }while(document.getElementById(`field${rand}`).innerHTML != '');
        field = rand;
    }

    $.ajax({
        type: 'GET',
        url: `https://ita91.de/ttt/endpoint.php`,
        data: {
            'req': 'botMakeMove',
            'pin': Pin,
            'game_id': gameId,
            'field': field
        },
        success: function(res){
            console.log(res);
            if(res.success){
                updateGameField(res.data.field);
            }
            if(res.success == false){
                displayMSG(res.data.msg);
            }
        }
    });
}2