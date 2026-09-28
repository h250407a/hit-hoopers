# 6. Testing and hosting

## Test before submission

Check these items in a browser:

- Every navigation link opens the correct page.
- All 21 gallery photos display.
- The page works on a narrow/mobile-sized browser window.
- Hovering gallery photos animates them.
- The events page shows event cards.
- An empty name/email form shows the JavaScript warning.
- A filled Join form opens the PHP thank-you page on a PHP server.

## Deploying the site

Use any web host that supports PHP. A free PHP host can be sufficient for the assignment. The general process is:

1. Create a hosting account and choose a subdomain.
2. Open the host’s File Manager.
3. Open its public website folder, often named `htdocs`, `public_html`, or `www`.
4. Upload all project files and folders.
5. Keep the folder structure exactly the same.
6. Open your public URL and test the site again.

Upload these items together:

```text
index.html, about.html, events.html, gallery.html, contact.html
process-form.php
css/
JS/
images/
```

Do not upload the `tutorial` folder unless you want the notes publicly available.

## Common deployment errors

| Problem | Likely cause | Fix |
| --- | --- | --- |
| CSS is missing | `css` folder was not uploaded | Upload `css/style.css` in the correct folder |
| Gallery images are missing | `images` folder/path differs | Upload all images; do not change filenames |
| JavaScript does not run | `JS` was uploaded as `js` | Capital letters matter on most web hosts |
| PHP code appears as text | Site is on static-only hosting | Use PHP hosting |
| Form page says not found | `process-form.php` was not uploaded | Upload it into the same folder as `contact.html` |

## What to submit

Submit the public URL your host gives you. Test it using an incognito/private browser window before submitting, because that confirms it works without files stored on your own computer.
