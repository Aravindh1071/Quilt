/* 
 * Custom Jquery for this theme

 */

jQuery(function($){

    jQuery('body').on('click','.form-click',function() {
        jQuery('#contact-form #email').val('');
        jQuery('.form-box #response').html('');
        jQuery('.policy-form').addClass('form-open')
        return false;
    });
    jQuery('body').on('click','.close-icon',function() {
      jQuery('.policy-form').removeClass('form-open')
      return false;
    });
 
    jQuery('#contact-form').on('submit', function(e) {
        e.preventDefault();
        const email = $('#email').val();
        jQuery.ajax({
            type: 'POST',
            url: 'mailer.php',
            data: { email: email },
            success: function(data) {
                var response = JSON.parse(data);
               if (response.status === 'success') {
                   jQuery('#response').text(response.message);
                    setTimeout(function() {
                        jQuery('.close-icon').trigger('click');
                    }, 5000);
                } else {
                    jQuery('#response').text(response.message);
                }
                
            },
            error: function() {
               jQuery('#response').text('An error occurred. Please try again.');
            }
        });
    });

});












