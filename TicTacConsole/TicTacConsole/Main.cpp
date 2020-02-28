#include <iostream>
#include "makeMove.h"
#include "changePlayer.h"
#include "hasWon.h"
#include "spielfeldAusgabe.h"

using namespace std;

int main()
{
	char zuege[9] = { '1', '2', '3', '4', '5', '6', '7', '8', '9' };
	int win = 0;
	char currentPlayer = 'X';

	do{
		system("cls");

		spielfeldAusgabe(zuege);

		makeMove(zuege, currentPlayer);
		win = hasWon(zuege);
		currentPlayer = changePlayer(currentPlayer);

		if (win == 1){
			system("cls");
			spielfeldAusgabe(zuege);
		}

	} while (win == 0);

	cout << endl << "Der Spieler " << changePlayer(currentPlayer) << " hat gewonnen!" << endl << endl;
}