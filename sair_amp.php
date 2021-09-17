<?php
/**
 * Plugin Name: Sair do modo AMP
 * Plugin URI: https://donadeumafrigga.com.br
 * Description: Adiciona um link para sair da versão AMP do site e ver a versão full
 * Version: 0.1
 * Author: Ana Pedretti
 * Author URI: https://donadeumafrigga.com.br
 */
 
 function non_amp_func($atts) {
    if ( ! function_exists( 'is_amp_endpoint' ) || ! is_amp_endpoint() ) {
		return '';
    }
    
    $frase = 'Sair da versão mobile';
	
	return sprintf(
		'<a href="%s">%s</a>',
		add_query_arg( 'noamp', 'mobile', esc_url( remove_query_arg( 'amp', amp_get_current_url() ) ) ),
		esc_html( $frase )
	);
}

add_shortcode('non_amp_link', 'non_amp_func');


function my_content_filter($content){
  $before = do_shortcode( '[non_amp_link]' ); 
  //modify the incoming content 
  $content = $before . $content;

  return $content; 
} 

add_filter( 'the_content', 'my_content_filter' );
