<?php require_once '../core/init.php'; ?>
<?php
	$ip_add = $getFromU->getRealUserIp();
	$total = 0;
	$records = $getFromU->select_products_by_ip($ip_add);
	foreach ($records as $record) {
		$product_id = $record->p_id;
		$product_qty = $record->qty;
		$get_prices = $getFromU->viewProductByProductID($product_id);
		foreach ($get_prices as $get_price) {
			$product_price = $get_price->product_price;
			$sub_total = $product_price * $product_qty;
			$total += $sub_total;
		}
	}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <!--   <link rel="stylesheet" type="text/css" href="assets/css/normalize.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">

    <title>TQ Store</title>
  </head>
  <body>

		<div id="top"> <!-- Top Starts -->
			<div class="container"> <!-- Container Starts -->
				<div class="row"> <!-- row Starts -->
					<div class="col-md-6 offer"> <!-- col-md-6 offer Starts -->
						<a href="customer/my_account.php" class="btn btn-info btn-sm">
							<?php
								if (!isset($_SESSION['customer_email'])) {
									echo 'Welcome : Guest';
								}else {
									$customer = $getFromU->view_customer_by_email($_SESSION['customer_email']);
									$customer_name = $customer->customer_name;
									echo "Welcome <strong class='text-uppercase'>$customer_name</strong>" ;
								}
							?>
						</a>
						<?php if (isset($_SESSION['customer_email'])): ?>
							<a href="#">Tổng giá giỏ hàng (VNĐ): <?php echo $total; ?>, Tổng sản phẩm : <?php echo $getFromU->count_product_by_ip($ip_add); ?></a>
						<?php else: ?>
							<a href="#">Tổng giá giỏ hàng (VNĐ) : 0, Tổng sản phẩm : 0</a>
						<?php endif ?>
					</div> <!-- col-md-6 offer Ends -->

					<div class="col-md-6"> <!-- col-md-6 Starts -->
						<ul class="menu"> <!-- menu starts -->
							<li><a href="../customer_register.php">Đăng Ký</a></li>
							<li><a href="../checkout.php">Tài Khoản</a></li>
							<li><a href="../cart.php">Đến Giỏ Hàng</a></li>
							<li>
								<?php if (!isset($_SESSION['customer_email'])): ?>
									<a href="../login.php">Đăng Nhập</a>
								<?php else: ?>
									<a href="../logout.php">Đăng Xuất</a>
								<?php endif ?>
							</li>
						</ul> <!-- menu ends -->
					</div> <!-- col-md-6 Ends -->
				</div><!-- row ends -->


			</div> <!-- Container Ends -->
		</div> <!-- Top Ends -->