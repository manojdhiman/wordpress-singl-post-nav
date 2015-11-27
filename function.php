function filter_next_post_sort($sort) {
    $sort = "ORDER BY p.post_title ASC LIMIT 1";
    return $sort;
}
function filter_next_post_where($where) {
    global $post, $wpdb;
    return $wpdb->prepare("WHERE p.post_title > '%s' AND p.post_type = '". get_post_type($post)."' AND p.post_status = 'publish'",$post->post_title);
}

function filter_previous_post_sort($sort) {
    $sort = "ORDER BY p.post_title DESC LIMIT 1";
    return $sort;
}
function filter_previous_post_where($where) {
    global $post, $wpdb;
    return $wpdb->prepare("WHERE p.post_title < '%s' AND p.post_type = '". get_post_type($post)."' AND p.post_status = 'publish'",$post->post_title);
}

add_filter('get_next_post_sort',   'filter_next_post_sort');
add_filter('get_next_post_where',  'filter_next_post_where');

add_filter('get_previous_post_sort',  'filter_previous_post_sort');
add_filter('get_previous_post_where', 'filter_previous_post_where');



function next_shortcode($atts) {
    global $post;
    ob_start(); 
    next_post_link( '<div class="nav-next">%link</div>', 'Next Work <span class="arrow_carrot-right_alt2"></span>' );              
    $result = ob_get_contents();
    ob_end_clean();
    $result = (!$result ? '<div class="nav-next">&nbsp;</div>' : $result);
    return $result;
}

function prev_shortcode($atts) {
    global $post;
    ob_start();
    previous_post_link( '<div class="nav-previous">%link</div>', '<span class="arrow_carrot-left_alt2"></span> Previous Work' );              
    $result = ob_get_contents();
    ob_end_clean();
    $result = (!$result ? '<div class="nav-previous">&nbsp;</div>' : $result);
    return $result;
}
add_shortcode( 'prev_work', 'prev_shortcode' );
add_shortcode( 'next_work', 'next_shortcode' );
