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
		<h1 class="text-center">Hỗ trợ, điều trị Covid - 19</h1>
		<p class="lead"><a class="text-decoration-none" href="tel:02086262728">1. Tổng đài tư vấn, hướng dẫn theo dõi sức khỏe F0 tại nhà: <b>02086262728</b></a></p>
		<p class="lead"><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-tagVideo="https://www.youtube.com/embed/m5Y-ySYVDq4" data-bs-target="#videoModal">2. Video khuyến cáo với F0 điều trị tại nhà</a></p>
		<p class="lead"><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-tagVideo="https://www.youtube.com/embed/gc__cgqQZt8" data-bs-target="#videoModal">3. Video hướng dẫn test nhanh Coivd-19 tại nhà cho người dân</a></p>
		<p class="lead"><a class="text-decoration-none" href="<?php echo site_url('covid/pdfviewer?file=') ?>../uploads/files/Huong_dan_cham_soc_F0_tai_nha_C-ThaiNguyen_OK.pdf
		">4. Hướng dẫn thực hiện quản lý, chăm sóc và điều trị người nhiễm COVID-19 (F0) tại nhà/nơi lưu trú</a></p>
		<p class="lead">5. Tổ công tác hỗ trợ, điều trị COVID-19 tại cộng đồng</p>
		<div class="row mb-3">
			<div class="col-12">
				<div class="list-group">
					<?php foreach ($officials as $key => $official) : ?>
						<a href="<?php echo site_url('covid/detail/' . $official->id) ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
							<div class="d-flex gap-2 w-100 justify-content-between">
								<div>
									<h6 class="mb-0"><?php echo $official->name ?></h6>
									<!-- <?php if ($official->hotline) : ?><p class="mb-0 opacity-75"><i class="fa-solid fa-square-phone"></i> <?php echo $official->hotline ?></p><?php endif; ?> -->
								</div>
								<small class="opacity-50 text-nowrap"><?php echo $official->count_children ?? 0 ?></small>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="videoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Video khuyến cáo với F0 điều trị tại nhà</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="ratio ratio-16x9">
						<iframe src="" allow="autoplay;" allowfullscreen></iframe>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="<?php echo base_url() ?>/js/covid.js"></script>
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