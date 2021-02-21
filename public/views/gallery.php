<section id="gallery_section">
   <div class="images_area">
       <h2>Gallery</h2>
       <?php /** @var array $images */
       if(count($images)>0): ?>
         <?php foreach ($images as $image): ?>
           <div class="image_container">
               <div class="image_area">
                    <img src="<?=$image['url']?>" alt="">
               </div>
               <div class="colors_box">
                   <?php foreach ($image['colors'] as $color): ?>
                   <div class="one_color">
                       <div class="color_element" style="background-color: rgb(<?=$color['color']?>);
                       <?php if($color['is_dark']) echo 'color:white' ?>">
                           <span><?=$color['percent']."%"?></span>
                       </div>
                       <div class="color_info">
                           <?php $rgb = explode(',',$color['color'])?>
                           <span class="rgb_span r"><?='r: '.$rgb[0]?></span>
                           <span class="rgb_span g"><?='g: '.$rgb[1]?></span>
                           <span class="rgb_span b"><?='b: '.$rgb[2]?></span>
                       </div>
                   </div>
                   <?php endforeach; ?>

               </div>
           </div>
         <?php endforeach; ?>
       <?php else: ?>


       <?php endif; ?>
   </div>
</section>
