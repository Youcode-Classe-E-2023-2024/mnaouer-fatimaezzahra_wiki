# Wiki

This website endeavors to replicate the distinguished concept embodied by the renowned platform known by the name Wikipedia.

## Features
### Authentication
- [x] Login
- [x] Register
- [x] Logout
- [x] Read profile
### Security
- [x] SQL injection
- [x] XSS
- [ ] CSRF
### Back-office
- [x] Read KPI's
- [x] Archive article
- [x] Manage categories
- [x] Manage Tags
### Front-office
- [x] Manage own article
- [x] Read article
- [x] Check last categories
- [x] Check 5 last article
- [ ] Validation form

## Classes
```shell
  User
  ├── countUsers
  ├── register
  ├── login
  └── getUser
  Article
  ├── countArticles
  ├── getAll
  ├── searchArticles
  ├── getArticle
  ├── getLastArticles
  ├── getArticlesOwner
  ├── createArticle
  ├── editArticle
  ├── deleteArticle
  └── archiveArticle
  Category
  ├── countCategories
  ├── getAll
  ├── addCategory
  ├── deleteCategory
  └── editCategory
  Tag
  ├── countTags
  ├── getAll
  ├── addTag
  ├── deleteTags
  └── editTag
```

## Ajax searchbar highlight

JS side:
```js
searchInput.addEventListener('input', function (ev) {
    // Get the text from the textarea
    const text = searchInput.value;

    // Create a FormData object and append the text
    const formData = new FormData();
    formData.append('search', '');
    formData.append('text', text);

    // Make a POST request using the Fetch API
    fetch('index.php?page=home', {
        method: 'POST',
        body: formData,
    })
        .then(data => {
            data.text().then(html => {
                if (html.length > 0) {
                    content.innerHTML = html;
                } else {
                    content.innerHTML = `
                    <div class="text-center" style="height: 55vh;">
                        <p>No result found!</p>
                    </div>`;
                }
            });
            // Handle the response as needed
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle errors
        });
});
```

PHP side model:
```php
global $db;

$stmt = $db->prepare("SELECT DISTINCT a.*, c.name
    FROM (SELECT * FROM articles WHERE status != 'archived' ORDER BY create_at DESC, edit_at) a
             LEFT JOIN categories c ON a.id_category = c.id
             LEFT JOIN articles_tags at ON a.id = at.id_article
             LEFT JOIN tags t ON at.id_tag = t.id
    WHERE a.title LIKE ?
       OR c.name LIKE ?
       OR t.name LIKE ?;
");

$searchKey = '%' . $searchKey . '%';
$stmt->bindParam(1, $searchKey);
$stmt->bindParam(2, $searchKey);
$stmt->bindParam(3, $searchKey);
$stmt->execute();

return $stmt->fetchAll(PDO::FETCH_ASSOC);
```

PHP side controller:
```php
$ajax_articles = Article::searchArticles($_POST['text']);

foreach ($ajax_articles as $article) {
    ?>
    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary"><?= $article['name'] ?></strong>
                <h3 class="mb-0"><?= $article['title'] ?></h3>
                <div class="mb-1 text-muted"><?= date('M d', strtotime($article['create_at'])) ?></div>
                <p class="card-text mb-auto"><?= $article['content'] ?></p>
                <a href="index.php?page=article&id=<?= $article['id'] ?>" class="stretched-link">Continue reading</a>
            </div>
            <div class="col-auto d-none d-lg-block">
                <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
            </div>
        </div>
    </div>
    <?php
}
exit;
```

# Security highlight
## Secure XSS

```php
/**
 * Securisation d'une chaine de caractere contre la faille XSS
 * @param [type] $string
 * @return string
 */
function str_secure($string)
{
    return trim(htmlspecialchars($string));
}
```

## Secure admin dashboard

```php
function admin_secure()
{
    if ($_SESSION['role'] != 'admin') {
        header('Location: index.php?page=home');
    }
}
```

## Secure SQL injection
example:
```php
$stmt = $db->prepare("INSERT INTO articles (title, content, id_user, id_category) VALUES (?, ?, ?, ?);");

$stmt->bindParam(1, $title);
$stmt->bindParam(2, $content);
$stmt->bindParam(3, $id_user, PDO::PARAM_INT);
$stmt->bindParam(4, $id_category, PDO::PARAM_INT);
$stmt->execute();
```

## Secure password
register side:
```php
global $db;

$password_hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $db->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?);");
$stmt->bindParam(1, $first_name);
$stmt->bindParam(2, $last_name);
$stmt->bindParam(3, $email);
$stmt->bindParam(4, $password_hash);

return $stmt->execute();
```

login side:
```php
global $db;

$stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bindParam(1, $email);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    if (password_verify($password, $user['password'])) {
        $this->id = $user['id'];
        $this->first_name = $user['first_name'];
        $this->last_name = $user['last_name'];
        $this->role = $user['role'];
        return true;
    } else {
        return false;
    }
} else {
    return false;
}
```

## Conclusion
The development of this website using PHP has been immensely beneficial for my learning journey, providing a valuable hands-on experience and a profound enhancement of my skills in web development.