jQuery(document).ready(function(){
	jQuery('#paw-authors div a.paw-parent').click(function(){
		var ocObj = jQuery(this).parent();
		var oc = ocObj.attr('class');
		
		if(oc=='paw-closed'){
			ocObj.attr('class', 'paw-opened');
		}else{
			ocObj.attr('class', 'paw-closed');
		}
	});
	
	});