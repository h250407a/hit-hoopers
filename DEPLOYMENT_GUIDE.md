# ICS 2102: Web Development Mini Project - Deployment & Setup Guide

This guide explains how to run the project locally with either PHP or XAMPP, and how to deploy it online to obtain a working public URL for submission.

---

## 1. Running Locally (Two Methods)

### Method A: Instant Local Server (No Root/Password Required)
A standalone PHP 8.5 environment with SQLite and PDO support is already configured on your machine.
Run:
```bash
./School/Html/start-server.sh
```
Or directly from the folder:
```bash
cd ~/School/Html
php -S 127.0.0.1:8000
```
Open **[http://localhost:8000](http://localhost:8000)** in your browser. All pages, interactive filters, form submissions, and database operations work immediately!

---

### Method B: Installing & Running XAMPP (Apache + MariaDB/MySQL)
The XAMPP installer (`xampp-linux-x64-8.2.12-0-installer.run`) is located inside `School/Html/`. Because XAMPP installs system-wide to `/opt/lampp`, Linux requires root (`sudo`):

1. **Run the installer script:**
   ```bash
   ~/School/Html/run-xampp-installer.sh
   ```
   *(Or run `sudo ~/School/Html/xampp-linux-x64-8.2.12-0-installer.run` and follow the graphical setup wizard).*

2. **Start XAMPP:**
   ```bash
   sudo /opt/lampp/lampp start
   ```

3. **Link your project into XAMPP's web directory:**
   ```bash
   sudo ln -s /home/anesu/School/Html /opt/lampp/htdocs/hit-hoopers
   ```

4. **Import Database in phpMyAdmin:**
   - Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
   - Click **Import** > **Choose File** > select [`School/Html/database.sql`](database.sql) > click **Import**.

5. Open your site at: **[http://localhost/hit-hoopers/](http://localhost/hit-hoopers/)**.

---

## 2. Deploying Online for Free (Working Public URL)

To submit the assignment, you need a public URL. Here are the two best free platforms:

### Option 1: InfinityFree (Recommended for PHP + MySQL)
InfinityFree provides 100% free Apache + PHP + MySQL hosting with a free subdomain.

1. **Sign up**: Go to [infinityfree.com](https://www.infinityfree.com/) and create a free account.
2. **Create an Account / Domain**:
   - Choose **Create Account**.
   - Select a free subdomain (e.g. `hithoopers.infinityfreeapp.com` or `hithoopers.rf.gd`).
3. **Upload Your Files**:
   - In the InfinityFree Control Panel, click **File Manager** (or connect via FileZilla FTP using the provided FTP credentials).
   - Open the `htdocs/` folder.
   - Upload all files from `/home/anesu/School/Html/` into `htdocs/` (including `index.html`, `about.html`, `events.html`, `gallery.html`, `contact.html`, `members.php`, `process-form.php`, `db.php`, `css/`, `JS/`, and `images/`).
4. **Set Up MySQL (Optional / Recommended)**:
   - In your Control Panel, click **MySQL Databases** and create database `hit_hoopers`.
   - Click **phpMyAdmin** and import `database.sql`.
   - Update `db.php` credentials or let it automatically use SQLite.
5. **Test Your Live URL**:
   - Visit `https://your-chosen-subdomain.infinityfreeapp.com`
   - Test form submission and the members page.
   - Copy this URL for your assignment submission.

---

### Option 2: Render.com (Container Web Service)
Render offers free cloud application hosting.

1. Push your `School/Html` repository to your GitHub account.
2. Sign in to [render.com](https://render.com/).
3. Click **New +** > **Web Service**.
4. Connect your GitHub repository.
5. Select **Docker** as the Runtime (the included [`Dockerfile`](Dockerfile) is already configured).
6. Click **Deploy**. Render will generate a live HTTPS URL (e.g., `https://hit-hoopers.onrender.com`).

---

## 3. Assignment Requirements Compliance Matrix

| Requirement | Implementation Detail | Location |
|---|---|---|
| **5+ Interconnected Pages** | Home, About, Events, Gallery, Join Us, and Members Roster | `index.html`, `about.html`, `events.html`, `gallery.html`, `contact.html`, `members.php` |
| **HTML Tags & Semantic Layout** | Headings, paragraphs, links, images, tables, unordered lists, ordered lists, semantic tags | Across all HTML templates |
| **CSS Box Model & Design** | External CSS file, CSS Grid, Flexbox, box-sizing, positioning, gradients, hover states | `css/style.css` |
| **JS Validation** | Name, email regex, student ID format, dropdown validation, inline error feedback | `JS/script.js` |
| **JS Interactive Features** | 1. Category Filter Buttons for Events<br>2. Full-screen Photo Lightbox Modal<br>3. Real-time Members Search | `JS/script.js`, `events.html`, `gallery.html` |
| **JS Events (`onclick`, `onload`, `mouseover`, `mouseout`)** | Explicitly bound and demonstrated | `JS/script.js` |
| **PHP Form Handling** | Sanitization (`htmlspecialchars`, filter_input), validation, and confirmation receipt | `process-form.php` |
| **Database Storage & Retrieval** | Dual PDO database connection (MySQL + SQLite fallback), table auto-creation, data insertion & live roster query | `db.php`, `database.sql`, `members.php` |
| **Deployment Ready** | Apache `.htaccess`, `Dockerfile`, and step-by-step free hosting instructions | `.htaccess`, `Dockerfile`, `DEPLOYMENT_GUIDE.md` |
