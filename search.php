<?php 
require ('top.php');

if((!isset($_POST['keyword']) && !isset($_FILES['image'])) || ($_POST['keyword'] == '' && $_FILES['image'] == '')){
    #echo "<script>window.location.href='index.php';</script>";
    $get_product = array();
} else {
    if(isset($_POST['keyword']) && $_POST['keyword'] != ''){
        $get_product=get_search_result($con, 'keyword', $_POST['keyword']);
    } else if(isset($_FILES['image']) && $_FILES['image'] != ''){
        $get_product=get_search_result($con, 'image', $_FILES['image']);
    }
}
?>
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Search</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Grid -->
        <section class="htc__product__grid bg__white ptb--100">
            <div class="container">
                <div class="row">
                <form method="POST" action="#" style="float:right;" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td colspan='2'><input type="text" name="keyword" id="keyword" <?php if(isset($_POST['keyword'])){ echo 'value="'.$_POST['keyword'].'"';}?>></input></td>
                        </tr>
                        <tr>
                            <td>
                                <label for="search_file_select" class="fv-btn" style="display:block; margin-top:1.8vh; margin-right:3px; padding-top:2vh; cursor: pointer;">Choose File</label>
                                <input id="search_file_select" type="file" name="image" accept="image/png, image/jpeg, image/jpg" onchange="clear_keyword();" style="display: none;"></input>
                            </td>
                            <td><input type="submit" class="fv-btn" value="Search" style="margin-top:1vh;"></input></td>
                        </tr>
                    </table>
                </form>
                  <?php if (count($get_product) > 0){ ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="htc__product__rightidebar">
                            <div class="htc__grid__top">
                                <div class="htc__select__option">
                                    <select class="ht__select">
                                        <option>Default softing</option>
                                        <option>Sort by popularity</option>
                                        <option>Sort by average rating</option>
                                        <option>Sort by newness</option>
                                    </select>
                                </div>
                                
                            </div>
                            <!-- Start Product View -->
                            <div class="row">
                                <div class="shop__grid__view__wrap">
                                    <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                       <?php
                                            foreach($get_product as $list){
                                            ?>
                                            <!-- Start Single Category -->
                                            <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                                                <div class="category">
                                                    <div class="ht__cat__thumb">
                                                        <a href="product.php?id=<?php echo $list['id']?>">
                                                            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']?>" alt="product images">
                                                        </a>
                                                    </div>
                                                    <div class="fr__product__inner">
                                                        <h4><a href="product-details.html"><?php echo $list['name']?></a></h4>
                                                        <ul class="fr__pro__prize">
                                                            <li class="old__prize"><?php echo $list['mrp']?></li>
                                                            <li><?php echo $list['price']?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                            <!-- End Single Category -->
                            <?php }  ?>   
                                    </div>                                    
                                </div>
                            </div>
                            <!-- End Product View -->
                        </div>  
                    </div>
                    <?php } else {
                        echo "data not found";
                    } ?>                    
                </div>
            </div>
        </section>
        <!-- End Product Grid -->
        
        <script>
            function clear_keyword(){
                document.getElementById("keyword").value = "";
            };
        </script>

        <!-- End Banner Area -->
<?php require ('footer.php')?>