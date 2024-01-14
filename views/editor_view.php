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
    <style>
        textarea {
            width: 100%;
            height: 300px;
            resize: none;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
        }

        textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        label {
            font-weight: bold;
            color: #555;
        }
    </style>
    </style>
</head>
<body>

<div class="container">
    <header class="blog-header py-3">
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
    <div class="mb-4">
        <h2 class="text-dark text-center">Text Editor</h2>
        <?php if(isset($article)) : ?>
        <form action="index.php?page=editor" method="POST">
            <div class="form-group mb-2">
                <label for="inputCategory">Category</label>
                <select name="category" id="inputCategory" class="form-control" required>
                    <?php foreach ($categories as $category) : ?>
                        <?php if ($category['name'] == $article['name']) : ?>
                            <option value="<?= $category['id'] ?>" selected><?= $category['name'] ?></option>
                        <?php else : ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php endif ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="title">Title:</label>
                <input name="title" class="form-control" id="title" value="<?= $article['title'] ?>" required>
            </div>

            <div class="form-group mb-2">
                <label for="editor">Editor:</label>
                <textarea name="content" class="form-control" id="editor" required><?= $article['content'] ?></textarea>
            </div>

            <div class="form-group mb-2">
                <label for="exampleFormControlSelect2">Tags</label>
                <select name="tags[]" class="form-control" id="exampleFormControlSelect2" multiple>
                    <?php foreach ($tags as $tag) : ?>
                        <?php if (in_array(strtolower($tag['name']), $tags_article)) : ?>
                        <option value="<?= $tag['id'] ?>" selected><?= $tag['name'] ?></option>
                        <?php else : ?>
                        <option value="<?= $tag['id'] ?>"><?= $tag['name'] ?></option>
                        <?php endif ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <button name="edit" type="submit" class="btn btn-secondary mb-2">Submit</button>
            <input type="hidden" name="id" value="<?= $article['id'] ?>">
        </form>
        <?php else : ?>
        <form action="index.php?page=editor" method="POST">
            <div class="form-group mb-2">
                <label for="inputCategory">Category</label>
                <select name="category" id="inputCategory" class="form-control" required>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="title">Title:</label>
                <input name="title" class="form-control" id="title" required>
            </div>

            <div class="form-group mb-2">
                <label for="editor">Editor:</label>
                <textarea name="content" class="form-control" id="editor" required></textarea>
            </div>

            <div class="form-group mb-2">
                <label for="exampleFormControlSelect2">Tags</label>
                <select name="tags[]" class="form-control" id="exampleFormControlSelect2" multiple>
                    <?php foreach ($tags as $tag) : ?>
                        <option value="<?= $tag['id'] ?>"><?= $tag['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button name="create" type="submit" class="btn btn-secondary mb-2">Submit</button>
        </form>
        <?php endif ?>
    </div>
</main>

<footer class="blog-footer">
    <p>Wiki built for <a href="https://github.com/orgs/Youcode-Classe-E-2023-2024">IT-Titans</a> by <a href="#">@mnaouer</a>.</p>
    <p><a href="#">Back to top</a></p>
</footer>
</body>
</html>
