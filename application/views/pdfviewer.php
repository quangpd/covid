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
                <!-- <li class="breadcrumb-item active" aria-current="page"><?php echo $pdf_file ?></li> -->
            </ol>
        </nav>
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center text-dark p-3">
                    <a href="javascript:void(0);" class="btn btn-default" id="prev_page" title="previous page" data-bs-toggle="tooltip" data-bs-placement="bottom"><i class="fa fa-chevron-left"></i></a>
                    <input type="number" id="current_page" value="1" class="form-control text-center" />
                    <a href="javascript:void(0);" class="btn btn-default" id="next_page" data-bs-toggle="tooltip" data-bs-placement="bottom" title="next page"><i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
            <div class="col-12 text-center">
                <!-- page 1 of 5 -->
                Page
                <span id="page_num"></span>
                of
                <span id="page_count"></span>
            </div>

            <!-- canvas to place the PDF -->
            <canvas id="canvas" class="d-flex flex-column justify-content-center align-items-center mx-auto"></canvas>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/jquery/jquery@3.2.1/dist/jquery.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.10.377/build/pdf.min.js"></script>
    <script>
        const pdf = "<?php echo $pdf_file ?>";

        const pageNum = document.querySelector("#page_num");
        const pageCount = document.querySelector("#page_count");
        const currentPage = document.querySelector("#current_page");
        const previousPage = document.querySelector("#prev_page");
        const nextPage = document.querySelector("#next_page");
        const zoomIn = document.querySelector("#zoom_in");
        const zoomOut = document.querySelector("#zoom_out");

        const initialState = {
            pdfDoc: null,
            currentPage: 1,
            pageCount: 0,
            zoom: 1,
        };

        // Render the page
        const renderPage = () => {
            // load the first page
            initialState.pdfDoc.getPage(initialState.currentPage).then((page) => {
                console.log("page", page);

                const canvas = document.querySelector("#canvas");
                const ctx = canvas.getContext("2d");
                const viewport = page.getViewport({
                    scale: initialState.zoom
                });

                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                const renderCtx = {
                    canvasContext: ctx,
                    viewport: viewport,
                };

                page.render(renderCtx);

                pageNum.textContent = initialState.currentPage;
            });
        };

        // Load the Document
        pdfjsLib
            .getDocument(pdf)
            .promise.then((data) => {
                initialState.pdfDoc = data;
                console.log("pdfDocument", initialState.pdfDoc);

                pageCount.textContent = initialState.pdfDoc.numPages;

                renderPage();
            })
            .catch((err) => {
                alert(err.message);
            });

        const showPrevPage = () => {
            if (initialState.pdfDoc === null || initialState.currentPage <= 1) return;
            initialState.currentPage--;
            // render the current page
            currentPage.value = initialState.currentPage;
            renderPage();
        };

        const showNextPage = () => {
            if (
                initialState.pdfDoc === null ||
                initialState.currentPage >= initialState.pdfDoc._pdfInfo.numPages
            )
                return;

            initialState.currentPage++;
            currentPage.value = initialState.currentPage;
            renderPage();
        };

        // Button Events
        previousPage.addEventListener("click", showPrevPage);
        nextPage.addEventListener("click", showNextPage);

        // Keypress Event
        currentPage.addEventListener("keypress", (event) => {
            if (initialState.pdfDoc === null) return;
            // get the key code
            const keycode = event.keyCode ? event.keyCode : event.which;

            if (keycode === 13) {
                // get the new page number and render it
                let desiredPage = currentPage.valueAsNumber;
                initialState.currentPage = Math.min(
                    Math.max(desiredPage, 1),
                    initialState.pdfDoc._pdfInfo.numPages
                );

                currentPage.value = initialState.currentPage;
                renderPage();
            }
        });

        // Zoom Events
        zoomIn.addEventListener("click", () => {
            if (initialState.pdfDoc === null) return;
            initialState.zoom *= 4 / 3;
            renderPage();
        });

        zoomOut.addEventListener("click", () => {
            if (initialState.pdfDoc === null) return;
            initialState.zoom *= 2 / 3;
            renderPage();
        });

        // Tooltip

        const tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        const tooltipList = tooltipTriggerList.map((tooltipTriggerEl) => {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
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