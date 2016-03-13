; var ComptechApp = function( options )
{
	this.init = function()
	{
		/**
		 * Initializare folosire "numeral" si "moment"
		 * pentru numere si date calendaristice in romana
		 **/
		numeral.language('ro');
		numeral.defaultFormat('(0,0.0000)');
		moment.locale('ro');
	}


	this.init();
}