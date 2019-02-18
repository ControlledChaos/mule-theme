<?php
/**
 * Post comments template
 *
 * @package    WordPress
 * @subpackage Poker_Face
 * @since 3.0.0
 */

if ( post_password_required() ) {
	return;
}

?>

<section class="comments-section">

<?php if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
		die ( 'Please do not load this page directly.' );

	if ( post_password_required() ) {
		echo '<p>This post is password protected. Enter the password to view comments.</p>';

		return;
	}

$commenter = wp_get_current_commenter();
$req       = get_option( 'require_name_email' );
$aria_req  = ( $req ? " aria-required='true'" : '' );
$fields    =  array(
	'author' => '<p class="comment-form-author"><label for="author">' . __( 'Name', 'mule-theme' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></p>',
	'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'mule-theme' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></p>',
	'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'mule-theme' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></p>',
);

$comments_args = array(
	'id_form'              => 'comment-form',
	'id_submit'            => 'submit',
	'class_submit'         => 'submit',
	'name_submit'          => 'submit',
	'title_reply'          => __( 'Comments', 'mule-theme' ),
	'title_reply_to'       => __( 'Reply to %s', 'mule-theme' ),
	'cancel_reply_link'    => __( 'Cancel reply', 'mule-theme' ),
	'label_submit'         => __( 'Submit', 'mule-theme' ),
	'format'               => 'html5',
	'comment_field'        =>  '<p class="comment-form-comment"><label for="comment">' . __( 'Leave a comment:', 'mule-theme' ) . '</label><br /><textarea id="comment" name="comment" aria-required="true">' . '</textarea></p>',
	'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'mule-theme' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
	'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'mule-theme' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', 'mule-theme' ) . '</p>',
	'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
);

comment_form( $comments_args );

if ( have_comments() ) : mule_comments_nav(); ?>

	<h3 class="comments-title">
		<?php
			$comments_number = get_comments_number();
			if ( 1 === $comments_number ) {
				printf( _x( 'One comment on %s', 'comments title', 'mule-theme' ), get_the_title() );
			} else {
				printf(
					_nx(
						'%1$s Comment on %2$s',
						'%1$s Comments on %2$s',
						$comments_number,
						'comments title',
						'mule-theme'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
		?>
	</h3>

	<div id="comments" class="comments">

		<ol class="comment-list">
			<?php wp_list_comments(); ?>
		</ol>

	</div><!-- comments -->

	<?php mule_comments_nav(); ?>

<?php else : ?>

	<?php if ( comments_open() ) : echo '<p><em>Be the first to comment!</em></p>';

		else : echo '<p>Comments are closed for this post.</p>';

	endif;

endif; ?>
</section><!-- comments-section -->
