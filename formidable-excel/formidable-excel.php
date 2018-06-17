<?php
/*
* Plugin Name: Formidable excel
* Plugin URI: https://www.github.com/oxisrock
* Description: Plugin formidable excel
* Version: 1.1
* Author: Francisco Aular
* Author URI: https://www.github.com/oxisrock
* License: GPL2
*/
add_action('frm_registered_form_actions', 'register_my_action');
function register_my_action( $actions ) {
  $actions['my_action_name'] = 'MyActionClassName';

  include_once( dirname( dirname( __FILE__ ) ) . '/formidable-excel/MyActionClassName.php');

  return $actions;
}
add_action('frm_trigger_my_action_name_create_action', 'my_create_action_trigger', 10, 3);
function my_create_action_trigger($action, $entry, $form) {
  $data = $entry->metas;
  $fc_fname = $data[67];
  $fc_address = $data[68];
  $fc_city = $data[71];
  $fc_state = $data[72];
  $fc_zip = $data[73];
  $fc_tel = $data[74];
  $fc_lic = $data[83];
  $fc_iss = $data[84];
  $fc_md = $data[75];
  $fc_do = $data[76];
  $fc_pa = $data[77];
  $fc_cr = $data[78];
  $fc_an = $data[79];
  $fc_op = $data[80];
  $fc_nregister = $data[82];
  $ch = curl_init('http://localhost/scripts/form.php');
  //especificamos el POST (tambien podemos hacer peticiones enviando datos por GET
  curl_setopt ($ch, CURLOPT_POST, 1);
  //le decimos qué paramáetros enviamos (pares nombre/valor, también acepta un array)
  curl_setopt ($ch, CURLOPT_POSTFIELDS, "fname=".$fc_fname."&address=".$fc_address."&city=".$fc_city."&state=".$fc_state."&zip=".$fc_zip."&tel=".$fc_tel."&lic=".$fc_lic."&iss=".$fc_iss."&md=".$fc_md."&do=".$fc_do."&pa=".$fc_pa."&cr=".$fc_cr."&an=".$fc_an."&op=".$fc_op."&nregister=".$fc_nregister);
  //le decimos que queremos recoger una respuesta (si no esperas respuesta, ponlo a false)
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
  //recogemos la respuesta
  $respuesta = curl_exec ($ch);
  //o el error, por si falla
  $error = curl_error($ch);

  //y finalmente cerramos curl
  curl_close ($ch);
}
add_action('frm_trigger_my_action_name_update_action', 'my_update_action_trigger', 10, 3);
function my_update_action_trigger($action, $entry, $form) {
  // Do some magic
}
add_action('frm_trigger_my_action_name_delete_action', 'my_delete_action_trigger', 10, 3);
function my_delete_action_trigger($action, $entry, $form) {
  // Do some magic
}
add_action('frm_trigger_my_action_name_action', 'trigger_my_action', 10, 4);
function trigger_my_action( $action, $entry, $form, $event ) {
  $settings = $action->post_content;
  // Do your magic here
}
 ?>
