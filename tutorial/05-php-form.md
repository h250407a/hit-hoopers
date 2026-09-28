# 5. PHP form processing

PHP runs on the web server, not inside the browser. That is why double-clicking `contact.html` can show the form but cannot run `process-form.php`.

## How the form connects to PHP

In `contact.html`:

```html
<form action="process-form.php" method="post">
```

When the student clicks Submit, the browser sends all inputs that have a `name` attribute to `process-form.php`.

## Reading submitted values

At the top of `process-form.php`:

```php
<?php
$name = htmlspecialchars($_POST['full_name'] ?? 'Student');
$email = htmlspecialchars($_POST['email'] ?? '');
?>
```

- `$_POST` contains data sent with `method="post"`.
- `full_name` and `email` match the input `name` values in `contact.html`.
- `$name` and `$email` are PHP variables; PHP variables start with `$`.
- `??` means “use this fallback if the value is missing”.
- `htmlspecialchars()` is a security measure. It changes characters such as `<` into safe text so submitted text cannot become HTML code.

## Displaying a PHP variable inside HTML

```php
<h1>Welcome, <span><?php echo $name; ?></span>!</h1>
```

`<?php ... ?>` opens and closes PHP inside an HTML page. `echo` prints a value onto the page.

## Current limitation

The form currently displays a response but does **not** save applications. This meets the basic “process the form and display an appropriate response” requirement.

If your class covers databases, you can later use MySQL and an `INSERT` query to save name, email, student ID and message. Do not add a database unless you have learned it or your lecturer requires it.

## Testing PHP locally

Install a local PHP server such as XAMPP. Place this project in XAMPP’s `htdocs` folder, start Apache, and open a URL like:

```text
http://localhost/Html/contact.html
```

Do not test PHP by opening `file:///.../contact.html`; it has no server.
