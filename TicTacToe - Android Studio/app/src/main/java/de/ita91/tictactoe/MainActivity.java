package de.ita91.tictactoe;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import java.util.TimerTask;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {

    private Button[][] buttons = new Button[3][3];
    Handler handler = new Handler();
    Runnable runnable;
    int delay = 1*1000;

    public String dumpVar = "";
    public String baseAPI = "https://ita91.de/ttt/endpoint.php";
    public String roomID = "0";



    private boolean player1Turn = true;

    private int roundCount;

    private int player1Points;
    private int player2Points;

    private TextView textViewPlayer1;
    private TextView textViewPlayer2;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        textViewPlayer1 = findViewById(R.id.text_view_p1);
        textViewPlayer2 = findViewById(R.id.text_view_p);

        for (int i = 0; i < 3; i++) {
            for (int j = 0; j < 3; j++) {
                String buttonID = "button_" + i + j;
                int resID = getResources().getIdentifier(buttonID, "id", getPackageName());
                buttons[i][j] = findViewById(resID);
                buttons[i][j].setOnClickListener(this);
            }
        }

        Button buttonReset = findViewById(R.id.button_reset);
        buttonReset.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                resetGame();
            }
        });
    }

    @Override
    public void onClick(View v) {
        roomID = findViewById(R.id.editText).toString();
        if(!roomID.equals("0") && !roomID.equals("")){
            if (!((Button) v).getText().toString().equals("")) {
                return;
            }

            // Checking Room ID via API
            if(!checkRoomID(roomID)){
                showMSG("Room ID is invalid!");
                return;
            }

            // Trying move via API
            if(!(makeMove(findViewById(R.id.editText).toString(), v.getId()))){
                showMSG("Field is already claimed!");
                return;
            }



            roundCount++;

        } else {
            showMSG("No active game running!");
        }
    }

    // FUNCTIONS USED FOR ONLINE MULTIPLAYER

    private void showMSG(String message){
        Toast.makeText(this, message, Toast.LENGTH_LONG).show();
    }

    private boolean makeMove(String uRoomID, int fieldID){

        return true;
    }

    private boolean checkRoomID(String uRoomID){

        return true;
    }

    @Override
    protected void onResume() {

        handler.postDelayed( runnable = new Runnable() {
            public void run() {
                roomID = findViewById(R.id.editText).toString();
                if(!roomID.equals("0") && !roomID.equals("")){



                }

                handler.postDelayed(runnable, delay);
            }
        }, delay);

        super.onResume();
    }

    @Override
    protected void onPause() {
        handler.removeCallbacks(runnable);
        super.onPause();
    }

    // END FUNCTIONS FOR ONLINE MULTIPLAYER

    private boolean checkForWin() {
        String[][] field = new String[3][3];

        for (int i = 0; i < 3; i++) {
            for (int j = 0; j < 3; j++) {
                field[i][j] = buttons[i][j].getText().toString();
            }
        }

        for (int i = 0; i < 3; i++) {
            if (field[i][0].equals(field[i][1])
                    && field[i][0].equals(field[i][2])
                    && !field[i][0].equals("")) {
                return true;
            }
        }

        for (int i = 0; i < 3; i++) {
            if (field[0][i].equals(field[1][i])
                    && field[0][i].equals(field[2][i])
                    && !field[0][i].equals("")) {
                return true;
            }
        }

        if (field[0][0].equals(field[1][1])
                && field[0][0].equals(field[2][2])
                && !field[0][0].equals("")) {
            return true;
        }

        if (field[0][2].equals(field[1][1])
                && field[0][2].equals(field[2][0])
                && !field[0][2].equals("")) {
            return true;
        }

        return false;
    }

    private void player1Wins() {
        player1Points++;
        showMSG("Spieler X hat gewonnen!");
        updatePointsText();
        resetBoard();
    }

    private void player2Wins() {
        player2Points++;
        showMSG("Spieler O hat gewonnen!");
        updatePointsText();
        resetBoard();
    }

    private void draw() {
        showMSG("Keiner der Spieler hat gewonnen");
        resetBoard();
    }

    private void updatePointsText() {
        textViewPlayer1.setText("Spieler X: " + player1Points);
        textViewPlayer2.setText("Spieler O: " + player2Points);
    }

    private void resetBoard() {
        for (int i = 0; i < 3; i++) {
            for (int j = 0; j < 3; j++) {
                buttons[i][j].setText("");
            }
        }

        roundCount = 0;
        player1Turn = true;
    }

    private void resetGame() {
        player1Points = 0;
        player2Points = 0;
        updatePointsText();
        resetBoard();
    }

    @Override
    protected void onSaveInstanceState(Bundle outState) {
        super.onSaveInstanceState(outState);

        outState.putInt("roundCount", roundCount);
        outState.putInt("player1Points", player1Points);
        outState.putInt("player2Points", player2Points);
        outState.putBoolean("player1Turn", player1Turn);
    }

    @Override
    protected void onRestoreInstanceState(Bundle savedInstanceState) {
        super.onRestoreInstanceState(savedInstanceState);

        roundCount = savedInstanceState.getInt("roundCount");
        player1Points = savedInstanceState.getInt("player1Points");
        player2Points = savedInstanceState.getInt("player2Points");
        player1Turn = savedInstanceState.getBoolean("player1Turn");
    }
}
