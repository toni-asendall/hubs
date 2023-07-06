<?php get_header(); ?>

	<main role="main">
	<?php include_once "bloques_comunes.php"; ?>
	<!-- section -->
	<?php if( get_field('modelo') == 'focus' ):?><?php else:?><?php endif;?>
	<section class="<?php echo $tipo = get_field("modelo");?>">

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			
			<div class="post-cabecera">
				<?php if( get_field('modelo') == 'focus' ):?>

				<!-- post thumbnail -->
				<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
					
						<?php the_post_thumbnail(); // Fullsize image for the single post ?>
					
				<?php endif; ?>

				
				<!-- /post thumbnail -->


				<?php else:?><?php endif;?>
				<!-- post title -->
				<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
				<p><?php _e( 'Categorised in: ', 'html5blank' ); the_category(' '); // Separated by commas ?></p>
				
				<!-- /post title -->
			</div>
			
			<!-- post details -->
			<!--<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
			<span class="author"><?php _e( 'Published by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></span>
			<span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'html5blank' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?></span>-->
			<!-- /post details -->

			<div class="contenedor-contenido">
			<div class="bloque-texto">
			<h1>
				<?php the_title(); ?>
			</h1>
			<?php the_content(); // Dynamic Content ?>


			<?php if( have_rows('elemento_destacado_manual') ): ?>
			    
			    <?php while( have_rows('elemento_destacado_manual') ): the_row(); ?>
			    		<div class="objeto">
				        	<div class="move">
				        	<?php if( get_sub_field('enlace') ) :?>
				        		<a href="<?php echo get_sub_field("enlace");?>">
					        	<?php endif; ?> 
					        	<?php echo get_sub_field("nombre");?><br/>
					        	<?php echo get_sub_field("descripcion");?><br/> 
					        	<?php if( get_sub_field('enlace') ) :?>
				        		</a>
				        		<?php endif; ?> 
        					</div>
			            <?php $image3 = get_sub_field('imagen');
							if( !empty( $image3 ) ): ?>
								<img src="<?php echo esc_url($image3['url']); ?>" class="move" title="" alt="" />
							<?php endif; ?>  
			            
			        
			    </div>
			        
			    <?php endwhile; ?>
			
			<?php endif; ?>


			<?php $featured_posts = get_field('elemento_destacado'); ?>
			<?php if( $featured_posts ): ?>
			    
			    <?php foreach( $featured_posts as $post ): 

			        // Setup this post for WP functions (variable must be named $post).
			        setup_postdata($post); ?>
					<?php if( get_field('card_activa') ) :?>
										<div class="objeto">
								        	
								        		<div>

								        		<?php if( get_field('enlace') ) :?>
								        		<a href="<?php echo get_field("enlace");?>">
								        		<?php endif; ?> 
								        			<?php echo get_field("nombre");?><br/>
								        		<?php echo get_field("descripcion");?><br/> 
								        		<?php if( get_field('enlace') ) :?>
								        		</a>
								        		<?php endif; ?> 								        		
								        		
								        		</div>
												<?php $image2 = get_field('imagen');
												if( !empty( $image2 ) ): ?>
												<img src="<?php echo esc_url($image2['url']); ?>" class="move" title="" alt="" />
												<?php endif; ?>         	
								        	
							            
							        	</div>
						
					<?php else:; ?>
										<div class="objeto">
								        	<div>
								            	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								        	</div>
							            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full');?>" class="imagen move" />
							        	</div>
					<?php endif; ?>
			        		
			    <?php endforeach; ?>
			    
			    <?php 
			    // Reset the global post object so that the rest of the page works correctly.
			    wp_reset_postdata(); ?>
			<?php endif; ?>

			<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="return_feed" title="Volver a las noticias"><?php _e("< Volver a las noticias", "html5blank"); ?></a>


			</div>

			<div class="lateral">

				<div class="sticky">

				<!--<?php the_tags( __( 'Tags: ', 'html5blank' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>-->

				<!--<p><?php _e( 'Categorised in: ', 'html5blank' ); the_category(' '); // Separated by commas ?></p>-->

				<!--<p><?php _e( 'This post was written by ', 'html5blank' ); the_author(); ?></p>-->

				<?php //edit_post_link(); // Always handy to have Edit Post Links available ?>

				<?php //comments_template(); ?>


				<?php if( get_field('modelo') == 'focus' ):?>
				<?php else:?>
				<!-- post thumbnail -->
				<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
						<div class="imagen_container">
						<?php the_post_thumbnail(); // Fullsize image for the single post ?>
						</div>
				<?php endif; ?>
				<!-- /post thumbnail -->
				<?php endif;?>
				

				<aside>



				<div class="cruzada">
					<h3>Más artículos</h3>
					<?php $prev_post = get_previous_post();?>
					<?php $next_post = get_next_post();?>
					<?php if (!empty( $prev_post )): ?>
					<div class="anterior medio <?php if (empty( $next_post )): ?> unico <?php endif ;?>">
					
					<span class="date"><?php echo mysql2date('d F Y', $prev_post->post_date, true) ?></span>
					<a href="<?php echo $prev_post->guid ?>" title="<?php echo $prev_post->post_title ?>" class="imagen">
					<?php if ( get_the_post_thumbnail($prev_post->ID) ) {?>
						<h4>[Artículo anterior]</h4>
					<?php echo get_the_post_thumbnail($prev_post->ID, "medium");?>
					<?php } else{?><!--<img src="<?php echo get_template_directory_uri();?>/defualt.png" />--><?php }?></a>
					<!--<p><?php echo __( 'previous post:', 'twentyseventeen' ) ?></p>-->
					
					<!--<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>-->
					<a href="<?php echo $prev_post->guid ?>" title="<?php echo $prev_post->post_title ?>" class="enlace"><?php echo $prev_post->post_title ?></a>
					
					<?php if (empty( $next_post )): ?><p class="resto"> <?php echo wp_trim_words($prev_post->post_content, 20) ?></p><?php endif ;?>
					
					</div>
					<?php endif ;?>
					<?php wp_reset_postdata(); ?>
					<?php if (!empty( $next_post )): ?>
					<div class="siguiente medio <?php if (empty( $prev_post )): ?> unico <?php endif ;?>">
					
					<span class="date"><?php echo mysql2date('d F Y', $next_post->post_date, true) ?></span>
					<a href="<?php echo $next_post->guid ?>" title="<?php echo $next_post->post_title ?>" class="imagen">
					<?php if ( get_the_post_thumbnail($next_post->ID) ) {?>
					<h4>[Artículo siguiente]</h4>
					<?php echo get_the_post_thumbnail($next_post->ID, "medium");?>
					<?php } else{?><!--<img src="<?php echo get_template_directory_uri();?>/defualt.png" />--><?php }?></a>
					<!--<p><?php echo __( 'Next post:', 'twentyseventeen' ) ?></p>-->
					
					<!--<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>-->
					<a href="<?php echo $next_post->guid ?>" title="<?php echo $next_post->post_title ?>" class="enlace"><?php echo $next_post->post_title ?></a>
					<?php if (empty( $prev_post )): ?><p class="resto"> <?php echo wp_trim_words($next_post->post_content, 20) ?></p><?php endif ;?>
					
					</div>
					<?php endif; ?>

				
				</div>	

				<div class="relatives">
<h2><?php _e("Entradas recientes", "html5blank"); ?></h2>
<?php 
// the query
$the_query = new WP_Query( array(
//'category_name' => 'news',
'posts_per_page' => 3,
'post__not_in' => array( $post->ID ),
)); 
?>

<?php if ( $the_query->have_posts() ) : ?>
<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<div class="recientes">

<h4><span><?php the_date(); ?></span></h4>
<h3><a href="<?php echo get_permalink();?>"><?php the_title(); ?></a></h3>
<p class="resto">
<?php echo wp_trim_words(get_the_content(), 20) ?>							
</p>
</div>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php else : ?>
<p><?php __('No News'); ?></p>
<?php endif; ?>
</div>

				</aside>
			</div>

			</div>

		</div>

		</article>


		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>



	</section>
	<!-- /section -->
	</main>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>