#include <iostream>

using namespace std;


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


