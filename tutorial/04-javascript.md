# 4. JavaScript

JavaScript adds behaviour after the page loads. This project uses `JS/script.js`.

## Array and objects: the event cards

```javascript
const clubEvents = [
  { date: "08 OCT", title: "Open Court Training", detail: "5:00 PM · Main Sports Hall" },
  { date: "15 OCT", title: "Freshers Friendly", detail: "4:30 PM · East Campus Court" }
];
```

`clubEvents` is an **array**: a list inside square brackets `[ ]`.

Each item is an **object**: related values written inside curly brackets `{ }`. The object has three properties: `date`, `title`, and `detail`.

To add an event, add another object before the final `];`:

```javascript
{ date: "01 NOV", title: "Skills Challenge", detail: "2:00 PM · HIT Court" }
```

## Looping through events

```javascript
clubEvents.forEach(function (event) {
  eventList.innerHTML += `<article>...</article>`;
});
```

`forEach` is a loop. It repeats once for every event. On each repeat, `event` refers to the current object. `${event.title}` puts the object’s title inside the HTML template.

The `if (eventList)` check prevents an error on pages that do not have an element called `event-list`.

## Form validation

```javascript
joinForm.addEventListener("submit", function (event) {
```

This is an **event listener**. It listens for the user submitting the form. The code gets the name and email values and checks them:

```javascript
if (name === "" || email === "") {
  event.preventDefault();
}
```

- `===` means “is exactly equal to”.
- `||` means OR.
- `preventDefault()` stops the form being sent to PHP when a required value is missing.

## Scroll-reveal effect

Sections with `class="reveal"` are watched by `IntersectionObserver`. When a section enters the browser window, JavaScript adds the class `visible`:

```javascript
entry.target.classList.add("visible");
```

CSS changes `.reveal.visible` from invisible/slightly lower to fully visible. This is why page sections animate as a visitor scrolls.

## Navigation scroll effect

```javascript
window.addEventListener("scroll", function () {
  document.querySelector(".site-header").classList.toggle("scrolled", window.scrollY > 30);
});
```

This checks scrolling. When the page has moved more than 30 pixels, the navigation receives the `scrolled` class and CSS adds a shadow.

## Debugging JavaScript

Open the page, press `F12`, then choose **Console**. Red error messages often tell you the filename and line number. Common causes are misspelt IDs, incorrect JavaScript file paths, or a missing bracket.
