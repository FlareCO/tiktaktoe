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
