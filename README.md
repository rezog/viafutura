# viafutura
a php-console script that creates a csv file. The csv file is a template containing a list of meeting dates that can be used for planning. The script requests for input:

A start date from which the planning should be created
An interval in days that should be respected
An end date

The csv  contains the number of the meeting and the date.

The script generates the file with all meeting dates from the start date till the end date.

The meeting dates should be on each n-th day, based on the given interval
A meeting can’t be in the weekend
Saturday and Sunday are not counted as days
A meeting can’t be on the 25/12 or 1/1
A meeting can’t be on the 5th of 15th of each month
