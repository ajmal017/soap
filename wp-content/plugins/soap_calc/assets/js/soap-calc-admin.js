jQuery(document).ready(function(){
	
jQuery(".is_all").click(function()
{
	if(jQuery(this).val()==1)
	{
		var element = jQuery("#coin_market_api_limit");
		element.removeAttr('required');
		element.removeClass("limit_field_display").addClass("limit_field_hide");
	}
	else
	{
		var element = jQuery("#coin_market_api_limit");
		element.attr('required',true);
		element.addClass("limit_field_display").removeClass("limit_field_hide");
	}
});


/*jQuery(".coins .editinline").click(function(){	
	var coinid = jQuery(this).parent().attr("id").split("-")[2];	
	var quick_edit_html = jQuery("#forecast_analysis #inlineedit").html();
	if(!jQuery("#coin-"+coinid).next().next().hasClass("inline-edit-row"))
	{
		var hiddenhtml = '<tr class="hidden"></tr>';
		jQuery("#coin-"+coinid).after(hiddenhtml+quick_edit_html);
		jQuery("#coin-"+coinid).next().next().css("display","table-row");
	}
	
});*/

jQuery(".cancel").click(function(){
	var coinid = jQuery(this).attr("id").split("-")[1];
	jQuery("#coin-"+coinid).show();
	jQuery("#edit-"+coinid).hide();
});

jQuery(".coins .editinline").click(function(){	
	jQuery(".quick-edit-coin").hide();
	jQuery(".type-coin").show();
	var coinid = jQuery(this).parent().attr("id").split("-")[2];
	jQuery("#coin-"+coinid).css("display","none");
	jQuery("#edit-"+coinid).css("display","table-row");
});


jQuery(".coin-form").on("submit", function(){
	var coinid = jQuery(this).attr("id").split("-")[1];
	var data = {};
	data.id = coinid;
	data.indicator_analysis = jQuery("input[name='Coin_"+coinid+"[indicator_analysis]']").val();
	data.track_changes_trade_volumn = jQuery("input[name='Coin_"+coinid+"[track_changes_trade_volumn]']").val();
	data.large_order_analysis = jQuery("input[name='Coin_"+coinid+"[large_order_analysis]']").val();
	data.track_changes_large_wallet = jQuery("input[name='Coin_"+coinid+"[track_changes_large_wallet]']").val();
	data.backtesting_historical_data = jQuery("input[name='Coin_"+coinid+"[backtesting_historical_data]']").val();
	data.advanced_arbitage = jQuery("input[name='Coin_"+coinid+"[advanced_arbitage]']").val();
	data.social_signals = jQuery("input[name='Coin_"+coinid+"[social_signals]']").val();
	
	jQuery.ajax({
		url: ajaxurl,
		data:{action:'update_coin',params:data},
		type:'POST',
		beforeSend:function()
		{			
			jQuery("#spinner-"+coinid).addClass("is-active");
		},
		success:function(result)
		{
			if(result)
			{
				jQuery("#spinner-"+coinid).removeClass("is-active");
				return false;
			}
		}
	})
});

jQuery(".radio_signal").on("click",function(){
	var id= jQuery(this).attr("id").split("_")[1];
	var val = jQuery(this).val();
	var data = {id:id,val:val};
	
	jQuery.ajax({
		url: ajaxurl,
		data:{action:'update_signal',params:data},
		type:'POST',
		beforeSend:function()
		{			
			jQuery("#signal_spinner-"+id).addClass("is-active");
		},
		success:function(result)
		{
			if(result)
			{
				jQuery("#signal_spinner-"+id).removeClass("is-active");
				return false;
			}
		}
	})
	
	
});

jQuery(".radio_status").on("click",function(){
	var id= jQuery(this).attr("id").split("_")[1];
	var val = jQuery(this).val();
	var data = {id:id,val:val};
	
	jQuery.ajax({
		url: ajaxurl,
		data:{action:'update_status',params:data},
		type:'POST',
		beforeSend:function()
		{			
			jQuery("#status_spinner-"+id).addClass("is-active");
		},
		success:function(result)
		{
			if(result)
			{
				jQuery("#status_spinner-"+id).removeClass("is-active");
				return false;
			}
		}
	})
	
	
})



});



