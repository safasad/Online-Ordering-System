<?php
    include 'init.php';
    include $tpl.'header.php'; 
?>

<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg overlay">
    <h3>Menu</h3>
</div>
<!-- bradcam_area_end -->

<!-- Search Box -->
<div class="container">
    <br/>
<div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
                <div class="card-body row no-gutters align-items-center">
                    
                    <div class="col">
                        <input class="form-control form-control-lg form-control-borderless" type="search" id="search_text" placeholder="Search For Food">
                    </div>
                    <!--end of col-->
                    <div class="col-auto">
                        <button class="btn btn-lg btn-success" onclick="Filter_Products()"  type="submit">Search</button>
                    </div>
                    <!--end of col-->
                </div>
        </div>
        <!--end of col-->
    </div>
</div>

<!-- best_burgers_area_start  -->
<div class="best_burgers_area" style="margin-top: -90px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section_title text-center mb-80">
                    <span>Burger Menu</span>
                    <h3>Best Ever Burgers</h3>
                </div>
            </div>
        </div>

        <div class="row" id = "products_table">
        <!-- Products Here --> 
        <?php
            $admin = new Admin();
            $products = $admin->getAllProducts();
            
            if(!empty($products))
            {
                //loop the data 
                foreach($products as $row)
                {
                    //to skip Special products (Larg Photo)
                    if($row['Special'] == 1 )
                    {
                        continue;
                    }

                    //to skip not avaliable products 
                    if($row['Pro_Statue'] == 0 )
                    {
                        continue;
                    }
            ?>
            <div class="col-xl-6 col-md-6 col-lg-6" >
                <div class="single_delicious d-flex align-items-center">
                    <div class="thumb">
                        <!--  Product Img Here  -->
                        <img src="<?= $uploaded.$row['Pro_Img']?>">
                    </div>
                    <div class="info">
                        <!-- Product Data Here -->
                        <h3><?=$row['Pro_Name'] ?></h3>
                        <p><?=$row['Pro_Desc'] ?></p>
                        <span><?=$row['Pro_Price'] ?> $</span>
                        <a href="<?= "user/Cart_Process.php?id=".$row['Pro_Id'] ?>" class="boxed-btn3">Order Now</a>
                    </div>
                </div>
            </div>

            <?php  
                }
            }else
            {   
            ?>
                <div class="section_title text-center mb-80" style="margin-left: 450px">
                    <span>No Products Yet</h3></span>
                </div>
           <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- best_burgers_area_end  -->

<!-- Specical_room_startt -->
<div class="Burger_President_area">
    <div class="Burger_President_here">
        <?php
            foreach($products as $row)
            {
                if($row['Special'] == 1)
                {
                    //to skip not avaliable products 
                    if($row['Pro_Statue'] == 0 )
                    {
                        continue;
                    }
        ?>
        <div class="single_Burger_President">
            <div class="room_thumb">
            <img src="<?= $uploaded.$row['Pro_Img']?>">
                <div class="room_heading d-flex justify-content-between align-items-center">
                    <div class="room_heading_inner">
                        <span><?=$row['Pro_Price'] ?> $</span>
                        <h3><?=$row['Pro_Name'] ?></h3>
                        <p><?=$row['Pro_Desc'] ?></p>
                        <a href="<?= "user/Cart_Process.php?id=".$row['Pro_Id'] ?>" class="boxed-btn3">Order Now</a>
                    </div>
                    
                </div>
            </div>
        </div>  
        <?php
                }//if end here
            }//foreach loop end here
        ?>
    </div>
</div>
    <!-- features_room_end -->

    <!-- instragram_area_start -->
<div class="instragram_area" style="margin-top: 20px;margin-bottom: -100px">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-6">
                <div class="single_instagram">
                    <img src="<?= $img ?>instragram/1.png" alt="">
                    <div class="ovrelay">
                        <a>
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single_instagram">
                    <img src="<?= $img ?>instragram/2.png" alt="">
                    <div class="ovrelay">
                        <a >
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single_instagram">
                    <img src="<?= $img ?>instragram/3.png" alt="">
                    <div class="ovrelay">
                        <a >
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single_instagram">
                    <img src="<?= $img ?>instragram/4.png" alt="">
                    <div class="ovrelay">
                        <a>
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<!-- instragram_area_end -->
    
    <!-- Include Footer -->
    <?php include $tpl."footer.php"; ?>

<!-- JS HERE   -->
<!-- Search Products -->

</script>
 <!-- Filter Products -->
    <script >
        function Filter_Products()
        {
            var key = document.getElementById("search_text").value

            if(key != '')
            {
                $.ajax({
                    url:"user/Filter_Products.php",
                    method:"POST",
                    data:{search:key},
                    
                    success:function(data)
                    {
                        $('#products_table').html(data);
                    }

                });
            }else
            {
                alert("Please Enter Somthing To Search For");
            }
        }

    </script>