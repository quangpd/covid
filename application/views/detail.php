<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_title ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="py-4">
	<div class="container">
		<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo site_url('covid') ?>">Trang chủ</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo $official->name ?></li>
			</ol>
		</nav>
		<h1><?php echo $official->name ?></h1>
		<p class="lead">Tổ công tác hỗ trợ, điều trị COVID-19 tại cộng đồng</p>
		<?php if ($official->hotline) : ?>
			<p class="lead">Hotline: <a href="tel:<?php echo $official->hotline ?>" class="text-decoration-none"><?php echo $official->hotline ?></a></p>
		<?php endif; ?>
		<?php if ($official->staffs) : ?>
			<div class="row mb-3">
				<div class="col-12">
					<div class="card">
						<div class="card-header text-uppercase">Danh sách tổ viên</div>
						<div class="list-group list-group-flush">
							<?php foreach ($official->staffs as $key => $staff) : ?>
								<a href="tel:<?php echo $staff->mobile ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
									<img src="https://www.downloadclipart.net/thumb/calling-png-transparent-image.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
									<div class="d-flex gap-2 w-100 justify-content-between">
										<div>
											<h6 class="mb-0"><?php echo $staff->name ?></h6>
											<small class="mb-0 opacity-75"><?php echo $staff->title ?></small>
											<?php if ($staff->mobile) : ?>
												<p class="mb-0 text-danger"><i class="fa-solid fa-square-phone"></i> <?php echo $staff->mobile ?></p>
											<?php endif; ?>
										</div>
										<small class="opacity-50 text-nowrap"><?php echo $staff->position_string ?></small>
									</div>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="row mb-3">
			<div class="col-12">
				<?php if ($official->children) : ?>
					<div class="list-group">
						<?php foreach ($official->children as $key => $child) : ?>
							<a href="<?php echo site_url('covid/detail/' . $child->id) ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
								<div class="d-flex gap-2 w-100 justify-content-between">
									<div>
										<h6 class="mb-0"><?php echo $child->name ?></h6>
										<!-- <?php if ($child->hotline) : ?>
											<p class="mb-0 opacity-75"><i class="fa-solid fa-square-phone"></i> <?php echo $child->hotline ?></p>
										<?php endif; ?> -->
									</div>
									<?php if ($child->count_children) : ?>
										<small class="opacity-50 text-nowrap"><?php echo $child->count_children ?></small>
									<?php endif; ?>
								</div>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/gh/jquery/jquery@3.2.1/dist/jquery.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="<?php echo $theme_path ?>js/covid.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-206607877-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-206607877-1');
	</script>


</body>

</html>