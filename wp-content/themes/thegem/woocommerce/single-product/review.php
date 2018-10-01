<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

?>
<div itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment-body">

		<div class="comment-inner default-background">

			<div class="comment-header clearfix">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '70' ), '' ); ?>
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<div class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting approval', 'woocommerce' ); ?></div>
					<?php else : ?>
						<div itemprop="author" class="fn title-h6"><?php comment_author(); ?></div> <?php
							if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' )
								if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) )
									echo '<span class="verified">(' . __( 'verified owner', 'woocommerce' ) . ')</span> ';
						?> <div class="comment-meta commentmetadata date-color"><time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( wc_date_format() ); ?></time></div>
					<?php endif; ?>
				</div>
				<div class="reply">
					<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>
						<div class="comment-meta commentmetadata date-color">
							<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo esc_attr(sprintf( __( 'Rated %d out of 5', 'woocommerce' ), $rating )); ?>">
								<span style="width:<?php echo ( $rating / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo $rating; ?></strong> <?php _e( 'out of 5', 'woocommerce' ); ?></span>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>

		<div class="comment-text">

			<?php do_action( 'woocommerce_review_before_comment_text', $comment ); ?>

			<div itemprop="description" class="description comment-text"><?php comment_text(); ?></div>

			<?php do_action( 'woocommerce_review_after_comment_text', $comment ); ?>

		</div>
	</div>
</div>