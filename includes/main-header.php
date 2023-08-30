<?php

if (isset($_Get['action'])) {
	if (!empty($_SESSION['cart'])) {
		foreach ($_POST['quantity'] as $key => $val) {
			if ($val == 0) {
				unset($_SESSION['cart'][$key]);
			} else {
				$_SESSION['cart'][$key]['quantity'] = $val;
			}
		}
	}
}
?>
<div class="main-header">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
				<!-- ============================================================= LOGO ============================================================= -->
				<div class="logo">
					<a href="index.php">

						<h2 style="color: #ee4d2d; font-size:50px">Shoppun</h2>

					</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 top-search-holder">
				<div class="search-area">
					<form name="search" method="post" action="search-result.php">
						<div class="control-group">
							<input class="search-field" placeholder="Search here..." name="product" required="required" />
							<button class="search-button" type="submit" name="search"></button>
						</div>
					</form>
				</div><!-- /.search-area --><!-- /.search-area -->
				<!-- ============================================================= SEARCH AREA : END ============================================================= -->
			</div><!-- /.top-search-holder -->

			<div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
				<!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
				<?php
				if (!empty($_SESSION['cart'])) {
				?>
					<div class="dropdown dropdown-cart" style="padding-top: 20px; color:black">
						<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown"style="border:1px solid black">
							<div class="items-cart-inner" style="color:black">
								<div class="total-price-basket">
									<span class="lbl">cart - Check your stuff here</span>

								</div>
								<div class="basket">
									<i class="glyphicon glyphicon-shopping-cart"></i>
								</div>
								<div class="basket-item-count"><span class="count"><?php echo $_SESSION['qnty']; ?></span></div>

							</div>
						</a>
						<ul class="dropdown-menu">

							<?php
							$sql = "SELECT * FROM products WHERE id IN(";
							foreach ($_SESSION['cart'] as $id => $value) {
								$sql .= $id . ",";
							}
							$sql = substr($sql, 0, -1) . ") ORDER BY id ASC";
							$query = mysqli_query($con, $sql);
							$totalprice = 0;
							$totalqunty = 0;
							if (!empty($query)) {
								while ($row = mysqli_fetch_array($query)) {
									$quantity = $_SESSION['cart'][$row['id']]['quantity'];
									$subtotal = $_SESSION['cart'][$row['id']]['quantity'] * $row['productPrice'];
									$totalprice += $subtotal;
									$_SESSION['qnty'] = $totalqunty += $quantity;

							?>


									<li>
										<div class="cart-item product-summary">
											<div class="row">
												<div class="col-xs-4">
													<div class="image">
														<a href="product-details.php?pid=<?php echo $row['id']; ?>"><img src="admin/productimages/<?php echo $row['id']; ?>/<?php echo $row['productImage1']; ?>" width="30" height="50" alt=""></a>
													</div>
												</div>
												<div class="col">

													<h3 class="name"><a href="product-details.php?pid=<?php echo $row['id']; ?>"><?php echo $row['productName']; ?></a></h3>
													<div class="price">
														<?php echo number_format($row['productPrice'], 0, '.', '.'); ?> Vnd * <?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>
													</div>


												</div>

											</div>
										</div><!-- /.cart-item -->

								<?php }
							} ?>
								<div class="clearfix"></div>
								<hr>

								<div class="clearfix cart-total">
									<div class="pull-right">

										<span class="text">Total :</span><span class='price'><?php echo number_format($totalprice, 0, '.', '.'); ?> Vnd</span>
										</br><span style="color: red;">Price does not include shipping fee, please check my cart to see full detail</span>


									</div>

									<div class="clearfix"></div>

									<a href="my-cart.php" class="btn btn-upper btn-primary btn-block m-t-20">My Cart</a>
								</div><!-- /.cart-total-->


									</li>
						</ul><!-- /.dropdown-menu-->
					</div><!-- /.dropdown-cart -->
				<?php } else { ?>
					<div class="dropdown dropdown-cart">
						<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
							<div class="items-cart-inner">
								<div class="total-price-basket">
									<span class="lbl">cart -</span>
									<span class="total-price">
										<span class="value"></span>
										<span class="sign">Vnd</span>
									</span>
								</div>
								<div class="basket">
									<i class="glyphicon glyphicon-shopping-cart"></i>
								</div>
								<div class="basket-item-count"><span class="count">0</span></div>

							</div>
						</a>
						<ul class="dropdown-menu">




							<li>
								<div class="cart-item product-summary">
									<div class="row">
										<div class="col-xs-12">
											Your Shopping Cart is Empty.
										</div>


									</div>
								</div><!-- /.cart-item -->


								<hr>

								<div class="clearfix cart-total">

									<div class="clearfix"></div>

									<a href="index.php" class="btn btn-upper btn-primary btn-block m-t-20">Continue Shooping</a>
								</div><!-- /.cart-total-->


							</li>
						</ul><!-- /.dropdown-menu-->
					</div>
				<?php } ?>




				<!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
			</div><!-- /.top-cart-row -->
		</div><!-- /.row -->

	</div><!-- /.container -->

</div>