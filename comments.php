<?php
if ( post_password_required() ) {
    return;
}

$comments_number = get_comments_number();
$list_comments_args = array(
	'style' => 'div',
	'callback' => 'codebean_list_comments_open',
	'end-callback' => 'codebean_list_comments_close'
);

?>
<?php if (comments_open() || get_comments_number()) : ?>
    <?php if ( have_comments() ) : ?>
        <div id="comments" class="comments">
            
            <div class="comment-section-title">
                <h3><?php echo sprintf( _n( '1 Comment', '%d Comments', $comments_number, 'onliestwp' ), $comments_number ); ?></h3>
                <p><?php $comments_number > 0 ? esc_html_e( 'Join the discussion and tell us your opinion.', 'onliestwp' ) : esc_html_e( 'Be the first to comment on this article.', 'onliestwp' ); ?></p>
            </div>

            <div class="comments-list">
                <?php 
                    // Comments List
                    wp_list_comments($list_comments_args);
                ?>
            </div>
            <?php 
                // Comments pagination
                if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
                    
                    echo '<div class="pagination-container">' . paginate_comments_links( array(
                        'prev_text' => sprintf( esc_html__( '%s Previous', 'onliestwp' ), '<i class="fa fa-angle-left"></i>' ),
                        'next_text' => sprintf( esc_html__( 'Next %s', 'onliestwp' ), '<i class="fa fa-angle-right"></i>' ),
                        'type'      => 'list',
                        'echo'		=> false
                    ) ) . '</div>';
        
                endif;
            ?>
        </div>
    <?php endif; ?>

    <?php if ( comments_open() ) : ?>
        <?php codebean_comment_form(); ?>
    <?php endif; ?>
<?php endif; ?>