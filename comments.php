<?php
// comments template
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( 'One comment ', '%1$s comments ', get_comments_number(),
					number_format_i18n( get_comments_number() ), '' );
			?>
		</h2>

		<ul class="commentList list-unstyled">
			<?php wp_list_comments( array( 'callback' => 'snr_comment', 'style' => 'ol' ) ); ?>
		</ul><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<div class="nav-previous"><?php previous_comments_link('&larr; Older Comments'); ?></div>
			<div class="nav-next"><?php next_comments_link('Newer Comments &rarr;'); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments">Comments are closed.</p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>
			
	<?php
	comment_form(array(
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'id_submit'         => 'comment_submit',
		'fields' => array(
			'author' =>
						'<fieldset><div class="row"><div class="col-xs-12 col-sm-6 col-md-6 form-group">' .
						'<label class="control-label" for="author">Name' . ( $req ? '<span>(Required)</span>' : '' ) . '</label> ' .
						
						'<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
						'" size="30" /></div>',
			'email' =>
						'<div class="col-xs-12 col-sm-6 col-md-6 form-group"><label class="control-label" for="email">Email' . ( $req ? '<span>(Required)</span>' : '' ) . '</label> ' .
						
						'<input class="form-control" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
						'" size="30" /></div></div>'
		),
		'comment_field' => '<div class="row"><div class="col-md-12"><div class="form-group"><label class="control-label" for="comment">' . 'Comment' . ( $req ? '<span>(Required)</span>' : '' ) .
						   '</label><textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
						   '</textarea></div></div></div></fieldset>',
		'must_log_in' => '<p class="must-log-in">' .  sprintf( 'You must be <a href="%s">logged in</a> to post a comment.', wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>'
	));
	?>

</div><!-- #comments .comments-area -->