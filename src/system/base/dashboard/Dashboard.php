<?php
namespace QS_Paddle_Integration\system\base\dashboard;

final class Dashboard {
   
    protected $config = null;
  
    public function register() {
        
      $this->config = apply_filters( 'qs_paddle_intregration_dashboard_config', qs_paddle_intregration_dashboard_config() ) ;
      add_action( 'admin_footer', [$this,'dashboard_js_code'] ); // For back-end
      add_action( 'qs_paddle_intregration_tab_item', [ $this, 'add_tab_menu' ], 10 );
      add_filter( 'qs_paddle_intregration_tab_content', [ $this, 'add_tab_content' ], 10 );
   }

    function add_tab_menu( ) {
	    
        $dashboard_tab       = $this->config->get('dashboard_tab');
        $current_active_menu = isset($_REQUEST['nav'])?$_REQUEST['nav']:'';
        $default_id          = 'qs-paddle-intregration-dash-tab-content-default';
        $flag                = false;
        
        if( is_array( $dashboard_tab ) ){

            foreach($dashboard_tab as $item){

                $active = 'no';

                if( $flag == false && $current_active_menu == $item['menu_id']){
                   $flag = true;
                   $active = $default_id;   
              
                }elseif( $current_active_menu  == '' && isset( $item[ 'active' ] ) && $item[ 'active' ] == true ){
                    $active = $default_id;    
                }
                
                echo sprintf('<button class="qs-paddle-intregration-dash-tab-links qs-paddle-intregration-dash-link %s" data-navid="%s" id="%s">%s</button>',
                $item['attr_class'],
                $item['menu_id'],
                $active,
                $item['menu_title']

                );
               
            }
        }
       
    }

    function add_tab_content( ) {
	    
        $dashboard_tab  = $this->config->get('dashboard_tab');

        if( is_array( $dashboard_tab ) ){

            foreach($dashboard_tab as $item){
            
               echo sprintf('<div id="%s" class="qs-paddle-intregration-dash-tab-content">',$item['menu_id']); 

                if(file_exists($item['content_view_path'])){
                    include($item['content_view_path']);
                }
                    
               echo '</div>';
                
               
            } // end foreach 
        } // endif
       
    }

    public function dashboard_js_code( $handle ){
     
        $current_page  = get_current_screen();
    
        if( !isset( $current_page->base ) ){
            return;
        }
       
        if( $current_page->base != 'toplevel_page_'.QS_PADDLE_INTEGRATION_SETTING_PATH ){
          return;   
        }
       
        ?>
           <script type="text/javascript">
 
              (function() {
            
             
                var buttons = document.querySelectorAll('.qs-paddle-intregration-menu-tab .qs-paddle-intregration-dash-tab-links');

                    [].forEach.call(buttons, function(nav) {
                        nav.addEventListener('click', shop_ready_open_nav, false);
                        nav.navigation = nav.dataset.navid;
                        nav.default = nav.dataset.default;
                       
                    });

             
                if(document.getElementById('qs-paddle-intregration-dash-tab-content-default')){
                    document.getElementById('qs-paddle-intregration-dash-tab-content-default').click();
                }

                // offcanvas
                var offcanvas = document.querySelectorAll('.qs-paddle-intregration-offcanvas');
                
                [].forEach.call(offcanvas, function(woo_canvas) {
                    woo_canvas.addEventListener('click', shop_ready_offcanvas_push, false);
                });
                
                // switch enable disable
                var enable_all = document.querySelectorAll('.qs-paddle-intregration-enable-all-switch,.qs-paddle-intregration-disable-all-switch'); 

                [].forEach.call(enable_all, function(canvas_swither) {
                    canvas_swither.addEventListener('click', shop_ready_enable_all_switch, false);
                });

                // search 
                var search_all = document.querySelectorAll('input.qs-paddle-intregration-element-search'); 
                
                [].forEach.call(search_all, function(search_fld) {
                    search_fld.addEventListener('input', shop_ready_element_search_action, false);
                });

                
                // end select option
                var select_tags = document.querySelectorAll('select.qs-paddle-intregration-selectbox'); 
                [].forEach.call(select_tags, function(select_tag) {
                      var title = select_tag.dataset.title;
                      new BVSelect({
                        selector: "#"+select_tag.id,
                        width: "98%",
                        searchbox: true,
                        offset: false,
                        placeholder: "Select "+title+ ' template',
                        search_placeholder: "Search...",
                        search_autofocus: true,
                        breakpoint: 450
                    });
                });
               
                // Template Swicher 
                var templates_switcher = document.querySelectorAll('.qs-paddle-intregration-templates-swicher-wrp input'); 

                [].forEach.call(templates_switcher, function(_fld) {
                     var checked  = _fld.checked;
                     var targetee = document.querySelector( 'div[data-targetee=' + _fld.dataset.target + ']'  );
                        if(checked){
                            targetee.style.display = '';
                        }else{
                            targetee.style.display = 'none';
                        }

                    _fld.addEventListener('click', shop_ready__template_swicher_click_action, false);
                });

               
              })();
             
            function shop_ready__template_swicher_click_action(event){
               
                var checked = event.target.checked;
                var targetee = document.querySelector( 'div[data-targetee=' + this.dataset.target + ']'  );
                
                if(checked){
                    targetee.style.display = '';
                }else{
                    targetee.style.display = 'none';
                }
               
              
            }  
             // search element
            function shop_ready_element_search_action(event){
                var search_text = event.target.value.toUpperCase();
                
                var targetee = document.querySelectorAll( 'div[data-targetee=' + this.dataset.target + '] strong'  );
                [].forEach.call(targetee, function(div) {
                   
                    var txtValue =  div.innerText; 
                    
                    if (txtValue.toUpperCase().indexOf(search_text) > -1) {
                        // show
                        
                        div.closest('.qs-paddle-intregration-col').style.display = "";
                    }else{
                       
                        div.closest('.qs-paddle-intregrationy-col').style.display = "none";
                    }
                  
                }); 

            }

            function shop_ready_enable_all_switch(event) {
                  // notification
                var notice = document.getElementById("qs-paddle-intregration-admin-notification");
               
                if(this.classList.contains('qs-paddle-intregration-disable-all-switch')){

                    var targetee = document.querySelectorAll( 'div[data-targetee=' + this.dataset.target + '] '+ 'input' );
                    [].forEach.call(targetee, function(input) {
                        
                        input.checked = false;
                    });

                    notice.innerText = '<?php echo esc_html__("Disable All swicth",'shop-ready'); ?>';

                }else{

                    var targetee = document.querySelectorAll( 'div[data-targetee=' + this.dataset.target + '] '+ 'input' );
                     [].forEach.call(targetee, function(input) {
                         
                        if( input.getAttribute('readonly') == null ) {
                            input.checked = true;
                        }
                      
                       
                    });
                    notice.innerText = '<?php echo esc_html__('Enable All swicth','qs-paddle-intregration'); ?>';
                }
               
                notice.className = "show";
                setTimeout(function(){ notice.className = notice.className.replace("show", ""); }, 3000);

            }
           
         

            function shop_ready_offcanvas_push(event){
               
                 var element = document.querySelector('.qs-paddle-intregration-menu-tab')
                 var element_content = document.querySelector('.qs-paddle-intregration-tab-content-container')
                 var hidden = element.getAttribute('hidden');
              
                if(hidden){
                    element.classList.remove('qs-paddle-intregration-sidebar-nav');
                    element.removeAttribute('hidden', 'false');
                    element_content.removeAttribute('style');
                }else{
                    element.classList.add('qs-paddle-intregration-sidebar-nav');
                    element.setAttribute('hidden', 'true');
                    element_content.style.width = "100%";
                }
         
            }  
 
            function shop_ready_open_nav(evt) {
                
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("qs-paddle-intregration-dash-tab-content");
                for (i = 0; i < tabcontent.length; i++) {
                  
                    tabcontent[i].style.display = "none";
                }

                tablinks = document.getElementsByClassName("qs-paddle-intregration-dash-tab-links");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }

                document.getElementById(evt.currentTarget.navigation).style.display = "block";
                evt.currentTarget.className += " active";

            }

            </script>
        <?php
    }



    
}    