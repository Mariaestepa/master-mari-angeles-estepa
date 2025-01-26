<div class="post-card"> 
     <a href="<?php the_permalink();?>" title="<?php the_permalink();?>" id="<?php the_ID();?>">
     <div class="post-name"><?php the_title();?></div>
     <div class="post-desc"><?php echo get_field( 'descripcion_corta' ); ?></div>
    </a>
</div>