<?php

global $levitin_mla_academic_interests;

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
do_action( 'bp_before_profile_loop_content' );

?>

<div class="left">
	<div class="academic-interests">
		<h4>Academic Interests</h4>
		<?php
					$tax = get_taxonomy( 'mla_academic_interests' );
					$interests = wp_get_object_terms( bp_displayed_user_id(), 'mla_academic_interests', array( 'fields' => 'names' ) );
					$html = '<ul>';
					foreach ( $interests as $term_name ) {
						$search_url = add_query_arg( array( 's' => urlencode( $term_name ) ), bp_get_members_directory_permalink() );
						$html .= '<li><a href="' . esc_url( $search_url ) . '" rel="nofollow">' . $term_name . '</a></li>';
					}
					$html .= '</ul>';
					echo $html;
		?>
	</div>
	<div class="recent-commons-activity">
		<h4>Recent Commons Activity</h4>
		<?php if ( bp_has_activities( bp_ajax_querystring( 'activity' ) . '&max=5&scope=just-me' ) ) : ?>
			<?php while ( bp_activities() ) : bp_the_activity(); ?>
				<?php
					//levitin_activity_action();
					//bp_activity_action();
				?>
			<?php endwhile; ?>
		<?php else : ?>
			<p><?php _e( 'Sorry, there was no activity found. Please try a different filter.', 'buddypress' ); ?></p>
		<?php endif; ?>
	</div>
	<div class="commons-groups">
		<h4>Commons Groups</h4>
		<?php if ( bp_has_groups( bp_ajax_querystring( 'groups' ) ) ) : ?>
			<ul>
			<?php while ( bp_groups() ) : bp_the_group(); ?>
				<li>
					<a href="<?php bp_group_permalink(); ?>">
						<span><?php echo str_replace( ' ', '</span><span>', bp_get_group_name() ); ?></span>
					</a>
				</li>
			<?php endwhile; ?>
			</ul>
		<?php else: ?>
			<p><?php _e( 'There were no groups found.', 'buddypress' ); ?></p>
		<?php endif; ?>
	</div>
	<div class="commons-sites">
		<h4>Commons Sites</h4>
		<?php if ( bp_has_blogs( bp_ajax_querystring( 'blogs' ) ) ) : ?>
			<ul>
			<?php while ( bp_blogs() ) : bp_the_blog(); ?>
				<li>
					<a href="<?php bp_blog_permalink(); ?>">
						<span><?php echo str_replace( ' ', '</span><span>', bp_get_blog_name() ); ?></span>
					</a>
				</li>
			<?php endwhile; ?>
			</ul>
		<?php else: ?>
			<p><?php _e( 'Sorry, there were no sites found.', 'buddypress' ); ?></p>
		<?php endif; ?>
	</div>
</div>

<div class="right">
	<div class="about">
		<h4>About</h4>
		<?php bp_member_profile_data( 'field=About' ) ?>
	</div>
	<div class="education">
		<h4>Education</h4>
		<?php bp_member_profile_data( 'field=Education' ) ?>
	</div>
	<div class="publications">
		<h4>Publications</h4>
		<?php bp_member_profile_data( 'field=Publications' ) ?>
	</div>
	<div class="projects">
		<h4>Projects</h4>
		<?php bp_member_profile_data( 'field=Projects' ) ?>
	</div>
	<div class="work-shared-in-core">
		<h4>Work Shared in CORE</h4>
	</div>
	<div class="upcoming-talks-and-conferences">
		<h4>Upcoming Talks and Conferences</h4>
		<?php bp_member_profile_data( 'field=Upcoming Talks and Conferences' ) ?>
	</div>
	<div class="memberships">
		<h4>Memberships</h4>
		<?php bp_member_profile_data( 'field=Memberships' ) ?>
	</div>
</div>

<?php

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
do_action( 'bp_after_profile_loop_content' );

?>
