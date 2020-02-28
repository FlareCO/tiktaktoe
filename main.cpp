#include <iostream>

using namespace std;

void spielfeldAusgabe(char zuege[]);
char changePlayer(char currentPlayer);
int hasWon(char zuege[]);
void makeMove(char zuege[], char currentPlayer);

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

void spielfeldAusgabe(char zuege[])
{
	cout << " " << zuege[0] << " | " << zuege[1] << " | " << zuege[2] << " " << endl;
	cout << "---|---|---" << endl;
	cout << " " << zuege[3] << " | " << zuege[4] << " | " << zuege[5] << " " << endl;
	cout << "---|---|---" << endl;
	cout << " " << zuege[6] << " | " << zuege[7] << " | " << zuege[8] << " " << endl;
}

char changePlayer(char currentPlayer)
{
	if (currentPlayer == 'X')
		return 'O';
	if (currentPlayer == 'O')
		return 'X';
	return 'X';
}

void makeMove(char zuege[], char currentPlayer){

	int feld = 0;
	int locked = 0;

	do {
		cout << "Welches Feld wollen Sie belegen? (1-9)" << endl;
		cin >> feld;
		if (feld <= 9){
			feld = feld - 1;
			if (zuege[feld] != 'X' && zuege[feld] != 'O'){
				zuege[feld] = currentPlayer;
				locked = 1;
			}
			else {
				cout << "Dieses Feld ist bereits belegt!" << endl;
			}
		}

	} while (locked = 0);

}

int hasWon(char zuege[])
{
	/*
	1 2 3
	4 5 6
	7 8 9*/
	int isWin = 0;

	if (zuege[0] == zuege[1] && zuege[1] == zuege[2])
	{
		return 1;
	}
	else if (zuege[3] == zuege[4] && zuege[4] == zuege[5])
	{
		return 1;
	}
	else if (zuege[6] == zuege[7] && zuege[7] == zuege[8])
	{
		return 1;
	}
	else if (zuege[0] == zuege[3] && zuege[3] == zuege[6])
	{
		return 1;
	}
	else if (zuege[1] == zuege[4] && zuege[4] == zuege[7])
	{
		return 1;
	}
	else if (zuege[2] == zuege[5] && zuege[5] == zuege[8])
	{
		return 1;
	}
	else if (zuege[0] == zuege[4] && zuege[4] == zuege[8])
	{
		return 1;
	}
	else if (zuege[2] == zuege[4] && zuege[4] == zuege[6])
	{
		return 1;
	}
	else
	{
		return 0;
	}

}
