<?php
  function qlyfe_identity_init() {        
    add_widget_type('qlyfe_identity', 'qlyfe_identity', 'Qlyfe Identity Widget');
  }
 
  register_elgg_event_handler('init','system','qlyfe_identity_init');       
?>