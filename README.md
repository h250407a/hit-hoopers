# HIT Hoopers — Harare Institute of Technology Basketball Club Website

**Course:** ICS 2102: Web Development Mini Project  
**Author / Student ID:** `h250407a`  
**Live Website URL:** [http://hit-hoopers.rf.gd/](http://hit-hoopers.rf.gd/)  
**GitHub Repository:** [https://github.com/h250407a/hit-hoopers](https://github.com/h250407a/hit-hoopers)

---

## 🏀 Project Overview
HIT Hoopers is a modern, responsive, full-featured web application designed for the Harare Institute of Technology (HIT) student basketball team. The platform features an interconnected multi-page architecture, dynamic client-side filtering, photo lightbox gallery, seamless light/dark theme switching, robust client & server-side form validation, and database-backed membership management.

---

## 🌟 Key Features

1. **Multi-Page Interconnected Architecture**:
   - `index.html` — Homepage featuring team highlights, upcoming matches, and call-to-actions.
   - `about.html` — Club history, coaching staff, mission, core values, and court rules.
   - `events.html` — Dynamic events schedule with interactive category filter buttons.
   - `gallery.html` — High-definition match & training gallery with full-screen lightbox modal.
   - `contact.html` — Membership registration and inquiry form with dual validation.
   - `members.php` — Live registered players & fans roster with real-time search filtering.

2. **Automatic Browser Theme Detection & Manual Switcher**:
   - Automatically detects system/browser color scheme (`prefers-color-scheme: dark` or `light`).
   - Circular animated toggle button with Sun / Moon SVG icons.
   - Remembers user choice across pages and sessions using `localStorage`.
   - Zero-flicker (anti-FOUT) inline head loader.

3. **Client-Side & Server-Side Form Validation**:
   - Interactive real-time validation for student ID format, email pattern, and required fields.
   - Secure server-side validation and sanitization using PHP `htmlspecialchars` and filter inputs in `process-form.php`.

4. **Database Storage & Retrieval**:
   - Robust Dual PDO backend (`db.php`) supporting both MySQL and self-contained SQLite with automatic schema creation.
   - Live roster table in `members.php` querying the database directly.

---

## 🛠️ Technology Stack
- **Frontend:** HTML5 (Semantic Layout), CSS3 (Custom Properties, Grid, Flexbox, Animations), JavaScript (ES6+, DOM manipulation, Event listeners)
- **Backend:** PHP 8.2+
- **Database:** SQLite 3 (fallback / self-contained) & MySQL / MariaDB via PHP PDO
- **Hosting:** Apache on InfinityFree (`http://hit-hoopers.rf.gd/`)

---

## 🚀 Running Locally

### Option 1: Built-in PHP Server (Fastest)
```bash
# Clone the repository
git clone https://github.com/h250407a/hit-hoopers.git
cd hit-hoopers

# Start local server
php -S 127.0.0.1:8000
```
Open **`http://localhost:8000`** in any web browser.

### Option 2: Apache / XAMPP
1. Move or symlink the project folder into `/opt/lampp/htdocs/` (Linux) or `C:\xampp\htdocs\` (Windows).
2. Start Apache and MySQL in the XAMPP Control Panel.
3. Import `database.sql` via phpMyAdmin (optional — SQLite fallback operates automatically if MySQL is not configured).
4. Access via **`http://localhost/hit-hoopers/`**.

---

## 📋 Course Requirements Compliance Matrix

| Requirement | Implementation Detail | Source File(s) |
|---|---|---|
| **5+ Interconnected Pages** | Home, About, Events, Gallery, Join Us, Members Roster | `index.html`, `about.html`, `events.html`, `gallery.html`, `contact.html`, `members.php` |
| **HTML Semantic Tags** | `<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`, tables, forms | All `.html` / `.php` files |
| **CSS Box Model & Styling** | CSS Grid, Flexbox, custom variables, gradients, responsive breakpoints | `css/style.css` |
| **Theme Switching** | Browser color-scheme listener + interactive Sun/Moon toggle + persistence | `css/style.css`, `JS/script.js` |
| **JS Validation** | Regex validation for student ID, email, real-time error feedback | `JS/script.js` |
| **JS Interactivity** | Category event filter, photo lightbox modal, instant search filter | `JS/script.js` |
| **PHP Form Handling** | Data sanitization, input validation, confirmation receipt | `process-form.php` |
| **Database Integration** | Dual PDO (SQLite + MySQL), table auto-creation, live member retrieval | `db.php`, `database.sql`, `members.php` |
