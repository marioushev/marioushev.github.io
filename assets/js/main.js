// Scroll Animations
document.addEventListener("DOMContentLoaded", () => {
  const reveals = document.querySelectorAll(".reveal");

  const revealOnScroll = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("active");
        observer.unobserve(entry.target); // Only animate once
      }
    });
  }, {
    threshold: 0.1, // Trigger when 10% of the element is visible
    rootMargin: "0px 0px -50px 0px" // Trigger slightly before the bottom
  });

  reveals.forEach((reveal) => {
    revealOnScroll.observe(reveal);
  });
});

// page fade-out
document.addEventListener("DOMContentLoaded", () => {
  const links = document.querySelectorAll("a[data-link]");

  links.forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const href = link.getAttribute("href");

      if (href !== "#") {
        document.body.classList.add("fade-out");
        setTimeout(() => {
          window.location.href = href;
        }, 300);
      }
    });
  });
});

window.addEventListener("pageshow", (event) => {
  if (event.persisted) {
    document.body.classList.remove("fade-out");
  }
});

document.addEventListener("DOMContentLoaded", () => {
  const images = document.querySelectorAll(".intro-image");

  const lazyLoad = (image) => {
    const src = image.getAttribute("data-src");
    if (src) {
      image.src = src;
      image.removeAttribute("data-src");
    }
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        lazyLoad(entry.target);
        observer.unobserve(entry.target);
      }
    });
  });

  images.forEach((img) => {
    observer.observe(img);
  });
});
// hamburger
const hamburger = document.getElementById("hamburger");
const navMenu = document.getElementById("nav");

if (hamburger && navMenu) {
  // Add an event listener to the hamburger button
  hamburger.addEventListener("click", () => {
    // Toggle the 'active' class on the navigation menu
    navMenu.classList.toggle("active");

    // Also toggle the 'active' class on the hamburger button
    hamburger.classList.toggle("active");
  });
}


