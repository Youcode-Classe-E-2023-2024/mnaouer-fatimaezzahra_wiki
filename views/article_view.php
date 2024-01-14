<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - Wiki</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/css/blog.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-6 pt-1">
                    <a class="blog-header-logo text-dark" href="index.php?page=home">Wiki</a>
                </div>

                <div class="col-4 d-flex justify-content-end align-items-center">
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>
                        <a class="btn btn-sm btn-outline-secondary ms-2" href="index.php?page=admin">Admin</a>
                    <?php endif ?>

                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <a class="btn btn-sm btn-dark ms-2" href="index.php?page=editor">Create Article</a>
                        <a class="btn btn-sm btn-outline-secondary ms-2" href="index.php?page=profile">Profile</a>
                    <?php else : ?>
                        <a class="btn btn-sm btn-outline-secondary ms-2" href="index.php?page=login">Sign in</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </header>

    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            <?php foreach ($categories as $category) : ?>
                <a class="p-2 link-secondary" href="#"><?= ucfirst($category['name']) ?></a>
            <?php endforeach ?>
        </nav>
    </div>
</div>

<main class="container pt-4">
    <div class="row g-5">
        <div class="col-md-8">
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                <?= $article['name'] ?>
            </h3>

            <article class="blog-post">
                <h2 class="blog-post-title"><?= $article['title'] ?></h2>
                <p class="blog-post-meta"><?= $date ?> by <a href="#"><?= $full_name ?></a></p>

                <p><?= nl2br($article['content']) ?></p>
            </article>
        </div>

        <div class="col-md-4">
            <div class="position-sticky" style="top: 2rem;">
                <?php if (isset($_SESSION['user_id']) && $article['owner_id'] == $_SESSION['user_id']) : ?>
                <div class="p-4">
                    <form action="index.php?page=moderation" method="POST">
                        <?php if ($_SESSION['role'] == 'admin') : ?>
                            <button name="archive" class="btn btn-sm btn-outline-dark">Archive</button>
                            <input name="id" type="hidden" value="<?= $article['id'] ?>">
                        <?php endif ?>
                        <a class="btn btn-sm btn-secondary" href="index.php?page=editor&id=<?= $article['id'] ?>">Edit</a>
                        <a onclick="deleteModal.showModal();" class="btn btn-sm btn-outline-danger">Delete</a>
                    </form>
                </div>
                <?php endif ?>

                <div class="p-4 bg-light rounded">
                    <h4 class="fst-italic">Tags</h4>
                    <nav aria-label="Pagination">
                        <?php foreach ($tags as $tag) : ?>
                            <a class="btn btn-outline-primary mb-2" href="#"><?= $tag ?></a>
                        <?php endforeach; ?>
                    </nav>
                </div>

                <div class="p-4">
                    <h4 class="fst-italic">Last Articles</h4>
                    <ol class="list-unstyled mb-0">
                        <?php foreach ($last_articles as $item) : ?>
                        <li><a href="index.php?page=article&id=<?= $item['id'] ?>"><?= $item['title'] ?></a></li>
                        <?php endforeach; ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</main>

<dialog id="deleteModal">
    <p>Are you sure ?</p>
    <form action="index.php?page=article" method="POST">
        <button name="delete" type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
        <input type="hidden" name="id" value="<?= $article['id'] ?>">
        <a onclick="deleteModal.close()" class="btn btn-sm btn-secondary">Cancel</a>
    </form>
</dialog>

<footer class="blog-footer">
    <p>Wiki built for <a href="https://github.com/orgs/Youcode-Classe-E-2023-2024">IT-Titans</a> by <a href="#">@mnaouer</a>.</p>
    <p><a href="#">Back to top</a></p>
</footer>
</body>
</html>
