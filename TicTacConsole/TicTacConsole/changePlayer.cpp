#include <iostream>

using namespace std;

char changePlayer(char currentPlayer)
{
	if (currentPlayer == 'X')
		return 'O';
	if (currentPlayer == 'O')
		return 'X';
	return 'X';
}