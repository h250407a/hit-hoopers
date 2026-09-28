# 2. HTML pages

HTML creates the content and structure of a website. It is not responsible for the colours, animation or layout; CSS does that.

## Standard page skeleton

Every page starts with this pattern:

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HIT Hoopers | Home</title>
</head>
<body>
  <!-- visible page content goes here -->
</body>
</html>
```

- `<!DOCTYPE html>` tells the browser to use modern HTML.
- `<html lang="en">` says the page language is English.
- `<head>` holds invisible setup information.
- `<meta charset="UTF-8">` allows special characters such as `©`.
- `viewport` helps the site fit mobile screens.
- `<title>` appears on the browser tab.
- `<body>` contains everything the visitor sees.

## Semantic layout tags

Use meaningful tags where possible:

```html
<header> ... navigation ... </header>
<main>
  <section> ... a major page part ... </section>
</main>
<footer> ... copyright ... </footer>
```

`<header>` is the top area, `<main>` is the most important page content, `<section>` groups related content, and `<footer>` is the bottom area.

## Classes and IDs

A **class** is a reusable label:

```html
<section class="page-banner">
<a class="button" href="contact.html">Join</a>
```

Many elements can have `class="button"`. CSS selects it with `.button`.

An **id** identifies one unique element:

```html
<div id="event-list"></div>
```

Only one element should use `id="event-list"`. JavaScript finds it with `document.getElementById("event-list")`.

## What each page does

### `index.html` — Home

Contains the hero area, title, introduction, Join button, motivational club mantra, and welcome section. The orange basketball is made with CSS instead of an image.

### `about.html` — About Us

Contains the club story, Mission, Vision and Objectives. Objectives are an unordered list:

```html
<ul>
  <li>Hold regular training sessions.</li>
  <li>Promote fitness and sportsmanship.</li>
</ul>
```

It also includes a committee table. Tables use rows (`<tr>`), headings (`<th>`) and cells (`<td>`):

```html
<table>
  <thead><tr><th>Name</th><th>Position</th></tr></thead>
  <tbody><tr><td>Student Name</td><td>President</td></tr></tbody>
</table>
```

### `events.html` — Events

Has an empty `<div id="event-list">`. JavaScript fills this with cards from the `clubEvents` array. This proves the page uses dynamic content rather than typing every event directly in HTML.

### `gallery.html` — Gallery

Each photo is inside a `<figure>`:

```html
<figure class="gallery-item">
  <img src="images/campus-hoops-slam-dunk.jpeg" alt="Basketball slam dunk">
</figure>
```

`src` is the image location. `alt` is a short description shown if an image cannot load and read aloud by screen readers. Always use useful `alt` text.

### `contact.html` — Join form

The form sends its data to PHP:

```html
<form action="process-form.php" method="post" id="join-form">
```

- `action` says where to send data.
- `method="post"` sends information privately in the request body.
- `id` lets JavaScript validate the form.

Every input has a `label`, `id`, and `name`:

```html
<label for="email">Email address</label>
<input id="email" name="email" type="email">
```

`for` matches the input `id`, so clicking the label focuses the input. PHP receives the value by its `name`, for example `$_POST['email']`.
