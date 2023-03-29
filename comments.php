
<?php comment_form(array(
    'comment_notes_before' => '',
    'comment_notes_after'  => '',
    'id_form'              => 'commentform',
    'id_submit'            => 'submit',
    'title_reply'          => __( 'Leave a Reply' ),
    'title_reply_to'       => __( 'Leave a Reply to %s' ),
    'cancel_reply_link'    => __( 'Cancel Reply' ),
    'label_submit'         => __( 'Post Comment' ),
    'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br /><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
    'fields'               => array(
        'author' => '<p class="comment-form-author"><label for="author">' . __( 'Name', 'domainreference' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<br /><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . ' /></p>',

        'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<br /><input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . ' /></p>',
        
        'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'domainreference' ) . '</label><br /><input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p>',
    ),
)); ?>



<?php wp_list_comments();?>