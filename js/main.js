
jQuery(document).ready(function(){
    jQuery("select").change(function(){
        jQuery(this).find("option:selected").each(function(){
            var optionValue = jQuery(this).attr("value");
            if(optionValue){
                jQuery(".box").not("." + optionValue).hide();
                jQuery("." + optionValue).show();
            } else{
                jQuery(".box").hide();
            }
        });
    }).change();
});
