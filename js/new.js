$(document).ready(function () {
  const $body = $("body");

  // Lazy-load images that use data-src + .lazyload
  (function initLazyLoad() {
    const loadImg = (img) => {
      const el = img instanceof jQuery ? img[0] : img;
      if (!el) return;
      const dataSrc = el.getAttribute("data-src");
      if (!dataSrc) return;
      el.src = dataSrc;
      el.removeAttribute("data-src");
      el.classList.remove("lazyload");
      el.setAttribute("loading", "lazy");
    };

    const imgs = Array.from(document.querySelectorAll("img.lazyload[data-src]"));
    if (!imgs.length) return;

    if ("IntersectionObserver" in window) {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            loadImg(entry.target);
            observer.unobserve(entry.target);
          }
        });
      }, { rootMargin: "200px 0px" });

      imgs.forEach((img) => observer.observe(img));
    } else {
      // Fallback: load all immediately
      imgs.forEach(loadImg);
    }
  })();

  // Mobile sidebar toggle
  $("#mobile_menu").on("click", function () {
    $("#sidebar_menu, #mobile_menu").toggleClass("active");
    $("#sidebar_menu_bg").addClass("active");
    $("#search-toggle, #search, #header").removeClass("active");
    $body.toggleClass("body-hidden");
  });

  $(".toggle-sidebar, #sidebar_menu_bg").on("click", function () {
    $(
      "#sidebar_menu, #mobile_menu, #sidebar_menu_bg, #search-toggle, #search, #header"
    ).removeClass("active");
    $body.removeClass("body-hidden");
  });

  $("#mobile_search").on("click", function () {
    $("#mobile_search, #search").toggleClass("active");
  });

  // Sidebar genre "More" toggle
  $(".nav-more .nav-link").on("click", function (e) {
    e.preventDefault();
    $("#sidebar_menu .sidebar_menu-list > .nav-item .nav").toggleClass(
      "active"
    );
  });

  // Genre box expand/collapse (search page)
  $(".cbox-genres .btn-showmore").each(function () {
    const $btn = $(this);
    // const setLabel = () =>
    //   $btn.text(
    //     $btn.closest(".cbox-genres").hasClass("active")
    //       ? "Show less"
    //       : "Show more"
    //   );

    // setLabel();

    $btn.on("click", function (e) {
      e.preventDefault();
      const $wrap = $btn.closest(".cbox-genres");
      $wrap.toggleClass("active");
      // setLabel();
    });
  });

  // Auth modal tab switches
  const switchAuthTab = (targetId) => {
    const $tabs = $("#modallogin .tab-pane");
    if (!$tabs.length) return;
    $tabs.removeClass("active show");
    $(targetId).addClass("active show");
  };

  $(".register-tab-link").on("click", function (e) {
    e.preventDefault();
    switchAuthTab("#modal-tab-register");
  });

  $(".verify-tab-link").on("click", function (e) {
    e.preventDefault();
    switchAuthTab("#modal-tab-verify");
  });

  $(".forgot-tab-link").on("click", function (e) {
    e.preventDefault();
    switchAuthTab("#modal-tab-forgot");
  });

  $(".login-tab-link").on("click", function (e) {
    e.preventDefault();
    switchAuthTab("#modal-tab-login");
  });

  // Search suggest (header search box)
  const $searchSuggest = $("#search-suggest");
  if ($searchSuggest.length) {
    let allowHide = true;
    let suggestTimer = null;
    const $searchLoading = $("#search-loading");
    const $searchResult = $searchSuggest.find(".result");

    $searchSuggest
      .on("mouseenter", function () {
        allowHide = false;
      })
      .on("mouseleave", function () {
        allowHide = true;
      });

    $(".search-input").on("blur", function () {
      if (allowHide) $searchSuggest.slideUp("fast");
    });

    $(".search-input").on("focus", function () {
      $searchSuggest.slideDown("fast");
    });
  }

  // Film description read more/less toggle
  const $filmTexts = $(".film-description .text");
  if ($filmTexts.length) {
    $filmTexts.each(function () {
      const $el = $(this);
      const original = $el.html();
      if (!original || original.length <= 300) return;

      const truncated =
        original.substring(0, 300) +
        '...<span class="btn-more-desc more">+ More</span>';

      $el.data("full-text", original);
      $el.data("truncated-text", truncated);
      $el.html(truncated);
    });

    $(document).on("click", ".btn-more-desc", function (e) {
      e.preventDefault();
      const $btn = $(this);
      const $text = $btn.closest(".text");
      const original = $text.data("full-text");
      const truncated = $text.data("truncated-text");

      if (!original || !truncated) return;

      if ($btn.hasClass("more")) {
        $text.html(original + '<span class="btn-more-desc less">- Less</span>');
      } else {
        $text.html(truncated);
      }
    });
  }

  // Header pin + back-to-top
  const $header = $("#header");
  const $toTop = $("#totop");

  $(window).on("scroll", function () {
    const scrollTop = $(window).scrollTop();

    if ($header.length) {
      scrollTop >= 10
        ? $header.addClass("fixed")
        : $header.removeClass("fixed");
    }

    if ($toTop.length) {
      scrollTop >= 100
        ? $toTop.addClass("active")
        : $toTop.removeClass("active");
    }
  });

  $toTop.on("click", function (e) {
    e.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "slow");
  }),
    0 < $("#slider").length &&
      new Swiper("#slider", {
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        pagination: { el: "#slider .swiper-pagination", clickable: !0 },
        loop: !0,
        autoplay: { delay: 3e3 },
      }),
    0 < $("#trending-home .swiper-container").length &&
      ((e = new Swiper("#trending-home .swiper-container", {
        slidesPerView: 6,
        spaceBetween: 30,
        navigation: {
          nextEl: ".trending-navi .navi-next",
          prevEl: ".trending-navi .navi-prev",
        },
        breakpoints: {
          320: { slidesPerView: 3, spaceBetween: 2 },
          480: { slidesPerView: 3, spaceBetween: 15 },
          900: { slidesPerView: 4, spaceBetween: 20 },
          1320: { slidesPerView: 6, spaceBetween: 20 },
          1880: { slidesPerView: 8, spaceBetween: 20 },
        },
        autoplay: 2e3,
      })),
      $("#trending-home").fadeIn(),
      e.update());
});
