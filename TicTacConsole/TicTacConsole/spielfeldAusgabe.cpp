#include <iostream>

using namespace std;

void spielfeldAusgabe(char zuege[])
{
	cout << " " << zuege[0] << " | " << zuege[1] << " | " << zuege[2] << " " << endl;
	cout << "---|---|---" << endl;
	cout << " " << zuege[3] << " | " << zuege[4] << " | " << zuege[5] << " " << endl;
	cout << "---|---|---" << endl;
	cout << " " << zuege[6] << " | " << zuege[7] << " | " << zuege[8] << " " << endl;
}