<style type="text/css">
</style>
            <h2 class="page-title">Catalogue<small></small></h2>
            
            <?php if ($cats) : ?>
                <?php for ($i = 0; $i < count($cats); $i++) : ?>
                    <?php 
                        $final_price = $cats[$i]['final_price'] == 0 ?  $cats[$i]['value'] : round($cats[$i]['final_price'] + ($cats[$i]['final_price'] * .10), 2);
                    
                    if ($cats[$i]['image'] == '') {
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
                                <p>Price: <strong>$<?php echo $final_price ?></strong></p>
                                <p><?php echo $cats[$i]['description']; ?></p> 
                                <a href="<?php echo site_url() . '/pages/view/edit_cat/' . $cats[$i]['id'] ?>" class="btn btn-inverse">View</a>
                                <?php 
                                    echo '<button class="btn btn-success inv-button" data-toggle="modal" data-target="#myModal_'. $cats[$i]['id'];
                                    echo '" style="background-color:#f31a1a; float:right">
                                    Delete</button>';

                                    echo '</td>';

                                    echo '<div id="myModal_'. $cats[$i]['id'];
                                    echo '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <div class="modal-header">
                                            <button type="button" 
                                            class="close"
                                            data-dismiss="modal" 
                                            aria-hidden="true">×</button>
                                            <h4 class="modal-title" 
                                            id="myModalLabel">
                                            Are you sure you want to delete this Cat?
                                            </h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" 
                                                class="btn btn-default"
                                                data-dismiss="modal">No</button>';
                                        echo '<a href="';
                                        echo (site_url() .'/cats/delete_product/' . $cats[$i]['id'] . '/' . $cats[$i]['category_id'] );
                                        echo '"<button type="button" class="btn btn-primary" style="margin-left:20px">Yes</button></a>
                                        </div>"'
                                ?></p>
                                






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
                    <span class="label label-important">
                        No cats in this category.
                    </span>
            <?php endif; ?>
        
        </div> 
</div> 
