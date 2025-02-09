<div class="post-card"> 
     <img  height ="180px" width="300px" src="<?php the_field( 'imagen_post' ); ?>" />
     <a href="<?php the_permalink();?>" title="<?php the_permalink();?>" id="<?php the_ID();?>">
     <div class="post-name"><?php the_title();?></div>
     <div class="post-desc"><?php echo get_field( 'descripcion_corta' ); ?></div>
     </a>
</div>