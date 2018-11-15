// JavaScript Document
jQuery(function($){
	//alert(user_role_report_ajax_object.ni_sales_report_user_role_ajaxurl);
	$( "#frm_user_role_report" ).submit(function( e ) {
		
		$.ajax({
			
			url:user_role_report_ajax_object.ni_sales_report_user_role_ajaxurl,
			data:$("#frm_user_role_report").serialize(),
			success:function(response) {
				//alert(JSON.stringify(response));
				//This outputs the result of the ajax request
				//console.log(data);
				//alert(data);
				$("._ajax_user_role_report_content").html(response);
			},
			error: function(errorThrown){
				console.log(errorThrown);
				//alert("e");
			}
		}); 
		
		return false;
	});
	
	$("#frm_user_role_report").trigger("submit");	
});
