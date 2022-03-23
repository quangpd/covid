<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_title ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body class="py-4">
	<div class="container">
		<h1 class="text-center">DANH SÁCH</h1>
		<p class="lead">Tổ công tác hỗ trợ, điều trị COVID-19 tại cộng đồng</p>
		<div class="row mb-3">
			<div class="col-12">
				<div class="list-group">
					<?php foreach ($officials as $key => $official) : ?>
						<a href="<?php echo site_url('covid/official/' . $official->id) ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
							<div class="d-flex gap-2 w-100 justify-content-between">
								<div>
									<h6 class="mb-0"><?php echo $official->name ?></h6>
									<?php if ($official->hotline) : ?>
										<p class="mb-0 opacity-75">Hotline: <?php echo $official->hotline ?></p>
									<?php endif; ?>
								</div>
								<small class="opacity-50 text-nowrap"><?php echo $official->count_children ?? 0 ?></small>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="<?php echo $theme_path ?>js/covid.js"></script>
</body>

</html>