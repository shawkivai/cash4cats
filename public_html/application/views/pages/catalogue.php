<style type="text/css">
</style>
            <h2 class="page-title">Catalogue<small></small></h2>
            
            <?php if ($cats) : ?>
                <?php for ($i = 0; $i < count($cats); $i++) : ?>
                    <?php if ($cats[$i]['image'] == '') {
                        $image_string = base_url() . 'cat_img/no_image.jpg';
                    } else {
                        $image_string = base_url() . 'cat_img/resized_cat_images_300/' . $cats[$i]['image'];
                    }
                    ?>
            
                    <?php if ($i % 4 == 0) : ?>
            <div class="row">
            <div class="col-md-12">
                <ul class="row thumbnails">
                    <?php endif; ?>      
                    <li class="col-sm-3">
                        <div class="thumbnail">                            
                            <img src="<?php echo $image_string; ?>" />
                            <div class="caption">
                                <h4><?php echo $cats[$i]['name']; ?></h4>
                                <p>Price: <strong>$<?php echo $cats[$i]['value'] ?></strong></p>
                                <p><?php echo $cats[$i]['description']; ?></p> 
                                <a href="<?php echo site_url() . '/pages/view/edit_cat/' . $cats[$i]['id'] ?>" class="btn btn-inverse">View</a></p>
                            </div>
                        </div>
                    </li>
                    <?php if ($i % 4 == 3) : ?>
                </ul>                
            </div>
         </div>
                    <?php endif; ?>  
                <?php endfor; ?>
            <?php else : ?>
                    <span class="label label-important">No cats in this category.</span>
            <?php endif; ?>
        
        </div> 
</div> 
