<?php

class paw_authors extends WP_Widget {

	public function __construct() {
		// widget actual processes
		parent::__construct(
			'paw_authors', // Base ID
			__('Authors Posts', 'text_domain'), // Name
			array( 'description' => __( 'A widget with collapsible feature which displays posts by authors. ', 'text_domain' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		// outputs the content of the widget
		 
		 global $wpdb;
		 $limit_posts = ($instance['number']>0?$instance['number']:'');
		 $html = '<nav class="add-nav widget_authors" id="paw-authors"><h2 class="widgettitle">Authors</h2>';
		 $table = $wpdb->prefix . 'users';
		 $users = $wpdb->get_results('SELECT ID FROM '.$table.' ORDER BY user_login');
		 if(!empty($users)){
			foreach($users as $results){
				
			 $id = $results->ID;
			 $user_info = get_userdata($id);
			 
			 $table = $wpdb->prefix . 'posts';
			 $result = $wpdb->get_results('SELECT * FROM '.$table.' WHERE post_author = '.$id.' AND post_status = "publish" AND post_type = "post" ORDER BY post_date DESC '.($limit_posts!=''?'LIMIT 0,'.$limit_posts:''));
			 $i = 0;
			 if(!empty($result)){
				 
			 	$html .= '<div class="paw-closed"><a class="paw-parent">'.$user_info->first_name.' '.$user_info->last_name.' <span>('.count($result).')</span></a>';
				 $html .= '<ul>';
				 foreach ($result as $numpost) {
				 $html .= '<li><a href="'.get_permalink($numpost->ID).'">'.$numpost->post_title.'</a>';
				 if($excerpt == 'true'){
				 $html .= '<p>'.$numpost->post_excerpt.'</p>';
				 }
				 $html .= '</li>';
				 $i++;
				 if($i == $show){
				 break;
				 }
				 }
				 $html .= '</ul></div>';
			 }
			
			 
			}
		 }
		 
		 $html .= '</nav>';
		 echo $html;
	
	}

 	public function form( $instance ) {
		// outputs the options form on admin
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		
		

		return $instance;
		
	}
}
if(!function_exists('paw_init')){
	function paw_init(){
		 register_widget( 'paw_authors' );
		}
	}
?>