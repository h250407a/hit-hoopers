# 3. CSS design and animation

CSS controls presentation: colour, spacing, fonts, size, layout and movement. This site uses one shared stylesheet: `css/style.css`.

## CSS rule structure

```css
.button {
  background-color: #f47a20;
  color: #101010;
  padding: 14px 24px;
}
```

`.button` is the **selector**. Everything between `{ }` is a list of **properties** and **values**. This rule styles every HTML element with `class="button"`.

## The box model

Every element is a box made of:

1. content — text or image;
2. padding — space inside the border;
3. border — line around the box;
4. margin — space outside the box.

This line makes widths easier to calculate:

```css
* { box-sizing: border-box; }
```

For example, the button has padding so its orange background has space around the words.

## Main design choices

- Dark background: `#101010`
- Main orange: `#f47a20`
- Light text/background: `#f8f5ef`
- Shared font: Arial/Helvetica fallback stack

The selector `.logo span, .eyebrow, h1 span` makes highlighted words orange. In the logo, only the word inside `<span>` becomes orange.

## Flexbox and Grid

Use **Flexbox** for items in one direction, such as the navigation bar:

```css
.navigation {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
```

Use **Grid** for rows and columns, such as gallery photos:

```css
.gallery-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 18px;
}
```

`1fr` means one equal fraction of available space. This creates three equal columns.

## Images and cropping

Gallery images have different shapes. This keeps every gallery card equal while filling the card:

```css
.gallery-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
```

`object-fit: cover` may crop the outside edges slightly. Use `contain` instead if seeing the whole photo matters more than filling each card.

## Animation

The basketball moves using `@keyframes`:

```css
@keyframes float-ball {
  0%, 100% { transform: rotate(-12deg) translateY(0); }
  50% { transform: rotate(-4deg) translateY(-13px); }
}
```

The `0%` and `100%` rules describe the start/end; `50%` describes the middle. The basketball uses it like this:

```css
.basketball { animation: float-ball 3.5s ease-in-out infinite; }
```

The gallery uses a **transition** instead. It smoothly zooms when the mouse hovers:

```css
.gallery-item:hover img { transform: scale(1.12); }
```

## Phone layout

The media query changes multi-column grids into one column on smaller screens:

```css
@media (max-width: 700px) {
  .gallery-grid { grid-template-columns: 1fr; }
}
```

Always test by making the browser window narrow. This is called responsive design.
