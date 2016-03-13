/*
 * Sincronizare datatable cu elementele de interfatare UI
 */
; var ComptechDatatableSyncronize = function( options )
{
	$.extend( this, options);

	this.getOrder = function()
	{
		var order          = this.grid.order();
		if( order[1] == undefined )
		{
			order = order[0];
		}
		var result = {
			'column'         : order[0],
			'direction'      : order[1],
			'next_direction' : order[1] == 'asc' ? 'desc' : 'asc'
		};
		return result;
	}

	this.syncOrder = function()
	{
		var current_order = this.getOrder();
		var list_item = $(this.btn_group_order + " li a.datatable-sort-by[data-column='" + current_order.column + "']");
		list_item.data('direction', current_order.next_direction);
		list_item.find('span.direction')
			.removeClass('direction-' + current_order.direction)
			.addClass('direction-' + current_order.next_direction)
			.html( this.lang[current_order.next_direction] );
	}

	this.syncRecordCount = function()
	{
		$('#' + this.id + '_wrapper #record-count').html(this.grid.page.info().recordsTotal);
	}
}