
(function ($) {
 
$(document).on( 'click', '.qs-paddle-integration-buy', function () { 
  var product_id = parseInt($(this).attr('data-productid'));
  var wc_id      = parseInt( $(this).attr('data-wcid') );
    
	    Paddle.Checkout.open(
         {
             
          product      : product_id,
          allowQuantity: false,
          passthrough  : product_id,
          successCallback: function(data){
            
                    var checkoutId = data.checkout.id;
                    var account_url = data.checkout.redirect_url;
                    Paddle.Order.details(checkoutId, function(data) {
                    var completed = true;
                    var name      = data.checkout.title;
                    var email     = data.order.customer.email;
                    
                
                    $.post(
                    paddle_data.ajax_url, 
                    {
                        'action'       : 'qs_paddle_woocommerce_checkout_success',
                        'domain'       : paddle_data.domain,
                        'product_id'   : product_id,
                        'wc_product_id': wc_id,
                        'price'        : 0,
                        'name'         : name,
                        'email'        : email,
                        'completed'    : completed,
                        'status'       : 'completed',
                        'data'         : data,
                        'checkoutid'   : checkoutId
                    }, 

                    function(response) {
                            
                            if(paddle_data.thankyou_page_url!=''){
                                 window.location.href = paddle_data.thankyou_page_url; 
                            }else{
                                window.location.href = account_url; 
                            }
                            
                        
                    }
                );
                
            }); 

          },
          closeCallback: function(data){

           if(paddle_data.cancel_message !==''){
            alert(paddle_data.cancel_message);
           }
           
          }
         
       }
     );
});


})(jQuery);
