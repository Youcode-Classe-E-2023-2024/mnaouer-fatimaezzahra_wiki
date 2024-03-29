<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="./assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="./assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet"/>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="./assets/css/style.css" rel="stylesheet">
</head>

<body>
<div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner"
         class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light">
            <a href="index.php?page=admin" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>ADMIN</h3>
            </a>
            <div class="navbar-nav w-100">
                <a href="index.php?page=admin" class="nav-item nav-link active"><i
                            class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            </div>

            <div class="navbar-nav w-100">
                <a href="index.php?page=moderation" class="nav-item nav-link"><i class="fa-solid fa-newspaper"></i>Moderation</a>
            </div>

            <div class="navbar-nav w-100">
                <a href="index.php?page=category" class="nav-item nav-link"><i class="fa-solid fa-list"></i>Category</a>
            </div>

            <div class="navbar-nav w-100">
                <a href="index.php?page=tag" class="nav-item nav-link"><i class="fa-solid fa-tag"></i>Tags</a>
            </div>

        </nav>
    </div>
    <!-- Sidebar End -->


    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>

            <div class="navbar-nav align-items-center ms-auto">
                <a href="index.php?page=home" class="nav-link">
                    <i class="fa fa-home me-lg-2"></i>
                </a>

                <a href="index.php?page=profile" class="nav-link">
                    <i class="fa fa-person me-lg-2"></i>
                </a>
            </div>
        </nav>
        <!-- Navbar End -->

        <div class="p-4">
            <div class="">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Tags</h6>
                        <a href="index.php?page=admin">Show All</a>
                    </div>

                    <div>
                        <form class="d-flex mb-2" action="index.php?page=tag" method="post">
                            <input name="name" class="form-control bg-transparent" type="text"
                                   placeholder="Enter Category">
                            <button name="create" type="submit" class="btn btn-primary ms-2">Add</button>
                        </form>
                    </div>


                    <div class="d-flex align-items-center border-bottom py-2">
                        <div class="w-100 ms-3">
                            <?php foreach ($tags as $tag) { ?>
                                <div class="d-flex flex-column w-100 justify-content-between">
                                    <div class="d-flex w-100 justify-content-between">
                                        <span><?php echo $tag['name'] ?></span>
                                        <div class="align-item-end">
                                            <form action="index.php?page=tag" method="Post">
                                                <a class="btn btn-sm" onclick="openModal(<?= $tag['id'] ?>, '<?= $tag['name'] ?>')"><i class="fa-solid fa-pen"></i></a>
                                                <input name="id" type="hidden" value="<?php echo $tag['id'] ?>">
                                                <button type="submit" name="delete" class="btn btn-sm"><i class="fa fa-times"></i></button
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded-top p-4">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-start">
                        <p class="mt-5 mb-3 text-muted">&copy; WIKI/2023–2024</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
    </div>
    <!-- Content End -->

    <dialog id="myModal">
        <form action="index.php?page=category" method="post">
            <div class="mb-3">
                <label for="nameInput" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="nameInput" placeholder="Enter new name..">
            </div>
            <input type="hidden" id="inputIdValue">
            <button class="btn btn-primary" type="submit" name="edit">Edit</button>
        </form>
    </dialog>
    <script>
        function openModal(id, name) {
            var modal = document.getElementById('myModal');
            var inputId = document.getElementById('inputIdValue');
            var inputName = document.getElementById('nameInput');

            inputId.value = id;
            inputName.value = name;

            modal.showModal();

            // Add an event listener to close the modal when clicking outside of it
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeModal();
                }
            });
        }

        function closeModal() {
            var modal = document.getElementById('myModal');
            modal.close();
        }
    </script>
    <!-- Modal End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/lib/chart/chart.min.js"></script>
<script src="assets/lib/easing/easing.min.js"></script>
<script src="assets/lib/waypoints/waypoints.min.js"></script>
<script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="assets/lib/tempusdominus/js/moment.min.js"></script>
<script src="assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="assets/js/main.js"></script>
<script src="assets/js/modal.js"></script>
</body>

</html>
