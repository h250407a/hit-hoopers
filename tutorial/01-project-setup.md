# 1. Project setup

## Create the folders and files

Create one main folder for the site. Inside it, make the folders `css`, `JS`, and `images`. Then create the six main files shown below.

```text
index.html          about.html          events.html
gallery.html        contact.html        process-form.php
css/style.css       JS/script.js
```

Keeping CSS, JavaScript and photos in their own folders is called organising your project. It makes files easier to find.

## Connect CSS to every HTML page

Put this inside the `<head>` of each HTML page:

```html
<link rel="stylesheet" href="css/style.css">
```

`href` means the location of the stylesheet. Since each HTML page is in the main folder and `style.css` is inside `css`, the path is `css/style.css`.

## Connect JavaScript only where needed

Use this on pages that use JavaScript. It is currently used on Home, About, Events, Gallery and Join pages because it provides the animation/scroll effects globally.

```html
<script src="JS/script.js" defer></script>
```

`defer` is important: it tells the browser to read the HTML first and run JavaScript afterwards. Without it, JavaScript may try to find elements before they exist.

## Links between pages

An anchor tag creates a link:

```html
<a href="contact.html">Join Us</a>
```

`<a>` means anchor. The `href` attribute gives the target file. Copy the same navigation menu to every page, then give the current page the class `active`:

```html
<a class="active" href="gallery.html">Gallery</a>
```

The CSS uses `.active` to colour the current navigation item orange.
