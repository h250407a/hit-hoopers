/**
 * ============================================================================
 * ICS 2102: Web Development Mini Project - HIT Hoopers
 * JavaScript Implementation: Script.js
 * 
 * Demonstrates:
 * 1. Variables (const, let), Operators (comparison, logical, arithmetic), Conditionals (if, else if, else)
 * 2. Loops (forEach, for...of, filter) and Modular Functions
 * 3. Arrays and Objects: Array of event objects, club information object
 * 4. Events:
 *    - onload: Page initialisation and dynamic welcome status bar
 *    - onclick: Dynamic event category filtering, gallery modal open/close
 *    - mouseover & mouseout: Dynamic card highlight and interactive tooltips
 *    - onsubmit & oninput: Real-time form validation
 * ============================================================================
 */

// Enable JS styling enhancements
document.documentElement.classList.add("js-enabled");

// ----------------------------------------------------------------------------
// Part 1: JavaScript Objects & Arrays
// ----------------------------------------------------------------------------

// A. Club Information Object
const clubInfo = {
  name: "HIT Hoopers Basketball Club",
  institution: "Harare Institute of Technology",
  season: "2026 Semester Season",
  trainingDays: "Tuesday & Thursday at 5:00 PM",
  venue: "Main Sports Hall",
  isActive: true
};

// B. Array of Club Events Objects
const clubEvents = [
  {
    id: 1,
    date: "08 OCT",
    title: "Open Court Training",
    category: "training",
    detail: "5:00 PM · Main Sports Hall",
    description: "Introductory conditioning and ball-handling drills for all skill levels."
  },
  {
    id: 2,
    date: "15 OCT",
    title: "Freshers Friendly Match",
    category: "match",
    detail: "4:30 PM · East Campus Court",
    description: "Exciting showcase game between first-year recruits and the senior squad."
  },
  {
    id: 3,
    date: "25 OCT",
    title: "Inter-Faculty 3-on-3",
    category: "tournament",
    detail: "9:00 AM · Main Sports Hall",
    description: "Annual knockout tournament with campus trophies and medal awards."
  },
  {
    id: 4,
    date: "05 NOV",
    title: "Shooting & Tactics Clinic",
    category: "training",
    detail: "5:00 PM · Main Sports Hall",
    description: "Specialized shooting form, perimeter defence and transition offense drills."
  },
  {
    id: 5,
    date: "19 NOV",
    title: "Varsity Derby vs UZ",
    category: "match",
    detail: "3:00 PM · HIT Arena",
    description: "Top-tier inter-varsity showdown featuring Harare's best collegiate teams."
  },
  {
    id: 6,
    date: "03 DEC",
    title: "Semester Championship Cup",
    category: "tournament",
    detail: "10:00 AM · City Sports Centre",
    description: "Grand semester finale championship and awards banquet."
  }
];

// ----------------------------------------------------------------------------
// Part 2: Functions & Dynamic Rendering
// ----------------------------------------------------------------------------

/**
 * Renders event cards into the DOM.
 * Demonstrates loops (forEach) and template strings.
 */
function renderEvents(eventsToRender) {
  const eventList = document.getElementById("event-list");
  if (!eventList) return;

  eventList.innerHTML = "";

  if (eventsToRender.length === 0) {
    eventList.innerHTML = `<p style="grid-column: 1/-1; text-align: center; color: #aaa; padding: 40px;">No events found in this category.</p>`;
    return;
  }

  eventsToRender.forEach(function (event) {
    const card = document.createElement("article");
    card.className = "event-card";
    card.setAttribute("data-id", event.id);

    // Demonstrate mouseover and mouseout event listeners
    card.addEventListener("mouseover", handleCardMouseOver);
    card.addEventListener("mouseout", handleCardMouseOut);

    card.innerHTML = `
      <p class="event-date">${event.date} <span class="badge" style="font-size: 0.7rem; text-transform: uppercase; background: rgba(244, 122, 32, 0.15); padding: 2px 8px; border-radius: 4px; margin-left: 8px;">${event.category}</span></p>
      <h2>${event.title}</h2>
      <p>${event.detail}</p>
      <p style="font-size: 0.85rem; color: #aaa; margin-top: -15px; margin-bottom: 20px;">${event.description}</p>
      <a href="contact.html">Register →</a>
    `;

    eventList.appendChild(card);
  });
}

/**
 * Filter events by category.
 * Demonstrates conditionals, operators, array filtering, and is called via onclick.
 */
function filterEvents(selectedCategory) {
  // Update button active states
  const buttons = document.querySelectorAll(".filter-btn");
  buttons.forEach(function (btn) {
    if (btn.getAttribute("data-category") === selectedCategory) {
      btn.classList.add("active");
    } else {
      btn.classList.remove("active");
    }
  });

  // Filter array using conditional logic
  let filtered = [];
  if (selectedCategory === "all") {
    filtered = clubEvents;
  } else {
    filtered = clubEvents.filter(function (item) {
      return item.category.toLowerCase() === selectedCategory.toLowerCase();
    });
  }

  renderEvents(filtered);
}

// ----------------------------------------------------------------------------
// Part 3: Event Listeners (onload, mouseover, mouseout, onclick)
// ----------------------------------------------------------------------------

/**
 * Demonstrates mouseover event
 */
function handleCardMouseOver(e) {
  this.style.borderColor = "#ff974a";
  this.style.boxShadow = "0 10px 25px rgba(244, 122, 32, 0.25)";
}

/**
 * Demonstrates mouseout event
 */
function handleCardMouseOut(e) {
  this.style.borderColor = "";
  this.style.boxShadow = "";
}

/**
 * Demonstrates onload event:
 * Initializes calendar, adds modal elements, sets up observers and greeting.
 */
window.addEventListener("load", function () {
  console.log(`[${clubInfo.name}] Initialized for ${clubInfo.season}`);

  // 1. Initialise events list if on events page
  const eventList = document.getElementById("event-list");
  if (eventList) {
    renderEvents(clubEvents);
  }

  // 2. Set up gallery modal interactions
  setupGalleryModal();

  // 3. Set up member table live search
  setupMemberSearch();

  // 4. Set up interactive committee table hover effects
  setupCommitteeTableHover();

  // 5. Set up celebratory basketball interaction on confirmation screen
  setupCongratsBasketball();
});

// ----------------------------------------------------------------------------
// Part 4: Interactive Feature 1 - Gallery Lightbox Modal
// ----------------------------------------------------------------------------

function setupGalleryModal() {
  const galleryItems = document.querySelectorAll(".gallery-item");
  if (galleryItems.length === 0) return;

  // Create modal element if not already present
  let modal = document.getElementById("gallery-modal");
  if (!modal) {
    modal = document.createElement("div");
    modal.id = "gallery-modal";
    modal.className = "gallery-modal";
    modal.innerHTML = `
      <div class="gallery-modal-content">
        <span class="gallery-modal-close" onclick="closeModal()">&times;</span>
        <img id="gallery-modal-img" src="" alt="Enlarged club view">
        <p id="gallery-modal-caption" style="color: #ded8d0; margin-top: 15px; font-weight: bold;"></p>
      </div>
    `;
    document.body.appendChild(modal);

    // Close on backdrop click (demonstrates onclick)
    modal.addEventListener("click", function (e) {
      if (e.target === modal) {
        closeModal();
      }
    });

    // Close on Escape key press
    window.addEventListener("keydown", function (e) {
      if (e.key === "Escape") {
        closeModal();
      }
    });
  }

  // Attach onclick to each gallery figure
  galleryItems.forEach(function (item) {
    item.style.cursor = "pointer";
    item.addEventListener("click", function () {
      const img = this.querySelector("img");
      if (img) {
        openModal(img.src, img.alt);
      }
    });
  });
}

function openModal(src, caption) {
  const modal = document.getElementById("gallery-modal");
  const modalImg = document.getElementById("gallery-modal-img");
  const modalCaption = document.getElementById("gallery-modal-caption");
  if (modal && modalImg) {
    modalImg.src = src;
    modalCaption.textContent = caption || "HIT Hoopers Photo";
    modal.classList.add("open");
  }
}

function closeModal() {
  const modal = document.getElementById("gallery-modal");
  if (modal) {
    modal.classList.remove("open");
  }
}

// ----------------------------------------------------------------------------
// Part 5: Interactive Feature 2 - Members Table Search
// ----------------------------------------------------------------------------

function setupMemberSearch() {
  const searchInput = document.getElementById("member-search");
  const table = document.getElementById("members-table");
  if (!searchInput || !table) return;

  searchInput.addEventListener("input", function () {
    const query = this.value.toLowerCase().trim();
    const rows = table.querySelectorAll("tbody tr");

    for (const row of rows) {
      const text = row.textContent.toLowerCase();
      if (text.indexOf(query) > -1) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    }
  });
}

// ----------------------------------------------------------------------------
// Part 6: Mouseover / Mouseout on Committee Table
// ----------------------------------------------------------------------------

function setupCommitteeTableHover() {
  const tableRows = document.querySelectorAll(".committee-section table tbody tr");
  tableRows.forEach(function (row) {
    row.addEventListener("mouseover", function () {
      this.style.backgroundColor = "rgba(244, 122, 32, 0.12)";
    });
    row.addEventListener("mouseout", function () {
      this.style.backgroundColor = "";
    });
  });
}

// ----------------------------------------------------------------------------
// Part 7: Form Validation (Join/Contact Form)
// ----------------------------------------------------------------------------

const joinForm = document.getElementById("join-form");
if (joinForm) {
  const nameInput = document.getElementById("full-name");
  const emailInput = document.getElementById("email");
  const studentIdInput = document.getElementById("student-id");
  const positionSelect = document.getElementById("position");
  const formMessage = document.getElementById("form-message");

  // Real-time input validation to clear error states
  const allInputs = [nameInput, emailInput, studentIdInput, positionSelect].filter(Boolean);
  allInputs.forEach(function (input) {
    input.addEventListener("input", function () {
      if (formMessage) {
        formMessage.textContent = "";
      }
      this.style.borderColor = "#555";
    });
  });

  joinForm.addEventListener("submit", function (event) {
    let isValid = true;
    let errorMessage = "";

    const name = nameInput ? nameInput.value.trim() : "";
    const email = emailInput ? emailInput.value.trim() : "";
    const studentId = studentIdInput ? studentIdInput.value.trim() : "";
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // 1. Validate full name
    if (name.length < 2) {
      isValid = false;
      errorMessage = "Please enter your full name (at least 2 letters).";
      if (nameInput) nameInput.style.borderColor = "#ef4444";
    }
    // 2. Validate email address
    else if (!emailPattern.test(email)) {
      isValid = false;
      errorMessage = "Please enter a valid email address (e.g. name@hit.ac.zw).";
      if (emailInput) emailInput.style.borderColor = "#ef4444";
    }
    // 3. Validate student ID
    else if (studentId.length < 3) {
      isValid = false;
      errorMessage = "Please enter a valid Student ID (e.g. H250123).";
      if (studentIdInput) studentIdInput.style.borderColor = "#ef4444";
    }

    if (!isValid) {
      event.preventDefault(); // Stop form submission
      if (formMessage) {
        formMessage.textContent = errorMessage;
        formMessage.style.color = "#ef4444";
      }
    } else {
      if (formMessage) {
        formMessage.textContent = "Processing registration...";
        formMessage.style.color = "#4ade80";
      }
    }
  });
}

// ----------------------------------------------------------------------------
// Part 8: Scroll & Reveal Animations
// ----------------------------------------------------------------------------

const revealSections = document.querySelectorAll(".reveal");
if ("IntersectionObserver" in window) {
  const revealObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });

  revealSections.forEach(function (section) {
    revealObserver.observe(section);
  });
}

window.addEventListener("scroll", function () {
  const header = document.querySelector(".site-header");
  if (header) {
    header.classList.toggle("scrolled", window.scrollY > 30);
  }
});

// ----------------------------------------------------------------------------
// Part 9: Celebratory Basketball Spin on Click (process-form.php)
// ----------------------------------------------------------------------------

function setupCongratsBasketball() {
  const wrapper = document.getElementById("congrats-ball-interactive");
  const ball = document.getElementById("congrats-basketball");
  if (!wrapper || !ball) return;

  wrapper.addEventListener("click", function () {
    if (ball.classList.contains("spin-active")) return;
    ball.classList.add("spin-active");
    setTimeout(function () {
      ball.classList.remove("spin-active");
    }, 850);
  });
}

