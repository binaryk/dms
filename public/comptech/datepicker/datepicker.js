; var ComptechDatePicker = function( options )
{
	$.extend( this, options);

	console.log(this);

	$(this.selector).datepicker({
		language  : "ro", 
		format    : "dd.mm.yyyy", 
		autoclose : true
	});
}