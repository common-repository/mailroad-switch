jQuery(document).ready(function ($) {
    // noinspection JSUnresolvedVariable
    let formWrapper = $('tr.' + MAILROAD_SWITCH_LOCAL.wrapper_class);
    if( formWrapper.length > 0 ){
        $(formWrapper).each(function (_index,_formWrapper){
            let adminEmail = $('input[id*="admin_email"]');
            if( adminEmail.length > 0 ){
                adminEmail = $(adminEmail).parent('td');
                if( adminEmail.length > 0 ){
                    adminEmail = $(adminEmail).parent('tr');
                    if( adminEmail.length > 0 ){
                        $(_formWrapper).insertAfter( $(adminEmail) );
                        $(_formWrapper).slideDown();
                    }
                }
            }
        });
    }
});