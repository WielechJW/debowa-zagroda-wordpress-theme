/**
 * Interakcje i animacje motywu Dębowa Zagroda.
 */

document.documentElement.classList.add("has-js");

(() => {
  "use strict";

  const body = document.body;
  const header = document.querySelector("[data-site-header]");
  const menuToggle = document.querySelector(".menu-toggle");
  const navigation = document.querySelector("[data-navigation]");
  const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const updateHeader = () => {
    if (!header) return;
    header.classList.toggle("is-scrolled", window.scrollY > 28);
  };

  updateHeader();
  window.addEventListener("scroll", updateHeader, { passive: true });

  const closeNavigation = () => {
    body.classList.remove("nav-open");
    if (menuToggle) {
      menuToggle.setAttribute("aria-expanded", "false");
    }
  };

  if (menuToggle && navigation) {
    menuToggle.addEventListener("click", () => {
      const willOpen = !body.classList.contains("nav-open");
      body.classList.toggle("nav-open", willOpen);
      menuToggle.setAttribute("aria-expanded", String(willOpen));
    });

    navigation.querySelectorAll("a").forEach((link) => {
      link.addEventListener("click", closeNavigation);
    });

    window.addEventListener("resize", () => {
      if (window.innerWidth > 800) closeNavigation();
    });
  }

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && body.classList.contains("nav-open")) {
      closeNavigation();
      menuToggle?.focus();
    }
  });

  const revealTargets = document.querySelectorAll(".reveal, [data-reveal-group]");

  if (reduceMotion || !("IntersectionObserver" in window)) {
    revealTargets.forEach((element) => element.classList.add("is-visible"));
  } else {
    const revealObserver = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;
          entry.target.classList.add("is-visible");
          observer.unobserve(entry.target);
        });
      },
      {
        threshold: 0.14,
        rootMargin: "0px 0px -7% 0px",
      }
    );

    revealTargets.forEach((element) => revealObserver.observe(element));
  }

  const sections = document.querySelectorAll("main section[id]");
  const menuLinks = document.querySelectorAll('.site-navigation a[href*="#"]');

  if ("IntersectionObserver" in window && sections.length && menuLinks.length) {
    const sectionObserver = new IntersectionObserver(
      (entries) => {
        const visible = entries
          .filter((entry) => entry.isIntersecting)
          .sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];

        if (!visible) return;

        menuLinks.forEach((link) => {
          const hash = link.hash;
          link.classList.toggle("is-active", hash === `#${visible.target.id}`);
        });
      },
      {
        rootMargin: "-25% 0px -60% 0px",
        threshold: [0.05, 0.25, 0.5],
      }
    );

    sections.forEach((section) => sectionObserver.observe(section));
  }

  const parallaxImage = document.querySelector("[data-parallax] img");

  if (parallaxImage && !reduceMotion) {
    let ticking = false;

    const updateParallax = () => {
      const offset = Math.min(window.scrollY * 0.12, 72);
      parallaxImage.style.setProperty("--parallax-y", `${offset}px`);
      ticking = false;
    };

    window.addEventListener(
      "scroll",
      () => {
        if (ticking) return;
        window.requestAnimationFrame(updateParallax);
        ticking = true;
      },
      { passive: true }
    );
  }

  if (!reduceMotion && window.matchMedia("(pointer: fine)").matches) {
    document.querySelectorAll("[data-float]").forEach((element) => {
      element.addEventListener("pointermove", (event) => {
        const rect = element.getBoundingClientRect();
        const x = (event.clientX - rect.left) / rect.width - 0.5;
        const y = (event.clientY - rect.top) / rect.height - 0.5;
        element.style.translate = `${x * 7}px ${y * 7}px`;
      });

      element.addEventListener("pointerleave", () => {
        element.style.translate = "";
      });
    });
  }

  const lightbox = document.querySelector("[data-lightbox]");
  const lightboxImage = lightbox?.querySelector("img");
  const lightboxClose = lightbox?.querySelector("[data-lightbox-close]");
  let lightboxTrigger = null;

  const closeLightbox = () => {
    if (!lightbox) return;
    lightbox.classList.remove("is-open");
    lightbox.setAttribute("aria-hidden", "true");
    body.classList.remove("lightbox-open");
    lightboxImage?.removeAttribute("src");
    lightboxTrigger?.focus();
  };

  document.querySelectorAll("[data-gallery-item]").forEach((item) => {
    item.addEventListener("click", () => {
      if (!lightbox || !lightboxImage) return;
      lightboxTrigger = item;
      lightboxImage.src = item.dataset.image || "";
      lightbox.classList.add("is-open");
      lightbox.setAttribute("aria-hidden", "false");
      body.classList.add("lightbox-open");
      lightboxClose?.focus();
    });
  });

  lightboxClose?.addEventListener("click", closeLightbox);

  lightbox?.addEventListener("click", (event) => {
    if (event.target === lightbox) closeLightbox();
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && lightbox?.classList.contains("is-open")) {
      closeLightbox();
    }
  });

  document.querySelectorAll(".contact-form").forEach((form) => {
    form.addEventListener("submit", () => {
      const button = form.querySelector('button[type="submit"]');
      if (!button) return;
      button.disabled = true;
      button.firstChild.textContent = "Wysyłanie… ";
    });
  });
})();
