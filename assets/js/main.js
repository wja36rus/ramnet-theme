/**
 * Main JavaScript file for RAM.NET theme
 *
 * @package RAMNET
 */

(function ($) {
  "use strict";

  // DOM Ready
  $(document).ready(function () {
    /* ========== Header scroll effect ========== */
    $(window).on("scroll", function () {
      var scrollTop = $(this).scrollTop();

      if (scrollTop >= 500) {
        $(".header").css("height", "50px");
        $(".logo__image").css("width", "50%");
      } else {
        $(".header").css("height", "100px");
        $(".logo__image").css("width", "100%");
      }
    });

    /* ========== Jobs section tabs ========== */
    $(".jobs__items").click(function (e) {
      e.preventDefault();
      const attr = $(this).attr("data-attribute");

      $(".jobs__items").removeClass("active");
      $(this).addClass("active");
      $(".jobs__item__card").removeClass("active");
      $(`#jobs${attr}`).addClass("active");
    });

    /* ========== Show all testimonials ========== */
    $("#show__people").click(function (e) {
      e.preventDefault();
      $(".people__card__wrapper").toggleClass("active");

      // Change button text
      var $this = $(this);
      if ($(".people__card__wrapper").hasClass("active")) {
        $this.find(".button__text").text("СКРЫТЬ ОТЗЫВЫ");
      } else {
        $this.find(".button__text").text("ЧИТАТЬ ВСЕ ОТЗЫВЫ");
      }
    });

    /* ========== FAQ Accordion ========== */
    $(".quietion__card").click(function (e) {
      e.preventDefault();
      $(this).find(".quietion__answer").toggleClass("active");

      // Rotate cross icon
      var $cross = $(this).find("img");
      if ($(this).find(".quietion__answer").hasClass("active")) {
        $cross.css("transform", "rotate(45deg)");
      } else {
        $cross.css("transform", "rotate(0deg)");
      }
    });

    /* ========== Form submission ========== */
    $("#form__submit, #call__to__action__submit").click(function (e) {
      e.preventDefault();

      // Get form data
      var $form;
      if ($(this).attr("id") === "form__submit") {
        $form = $("#form");
      } else {
        $form = $("#call__to__action__form");
      }

      var formData = $form.serializeArray();
      var name = formData[0] ? formData[0].value : "";
      var phone = formData[1] ? formData[1].value : "";

      // Show success message
      if ($(this).attr("id") === "form__submit") {
        // For main form
        $(".call__to__action").addClass("active");
        $("#call__to__action__form").addClass("active");
        $(".call__to__action__form__success").addClass("active");

        setTimeout(function () {
          $(".call__to__action").removeClass("active");
          $("#call__to__action__form").removeClass("active");
          $(".call__to__action__form__success").removeClass("active");
        }, 3000);
      } else {
        // For call to action form
        $(".call__to__action__form__inset").removeClass("active");
        $(".call__to__action__form__success").addClass("active");

        setTimeout(function () {
          $("#call__to__action__form").removeClass("active");
          $(".call__to__action__form__success").removeClass("active");
        }, 3000);
      }

      // Send data via AJAX (if needed)
      $.ajax({
        url: ramnet_ajax.ajax_url,
        type: "POST",
        data: {
          action: "ramnet_submit_form",
          name: name,
          phone: phone,
          nonce: ramnet_ajax.nonce,
        },
        success: function (response) {
          console.log("Form submitted:", response);
        },
        error: function (error) {
          console.log("Error:", error);
        },
      });

      console.log("Form submitted:", {
        name: name,
        phone: phone,
      });
    });

    /* ========== Mobile menu toggle ========== */
    $("#menu, .menu__toggle").click(function (e) {
      e.preventDefault();
      e.stopPropagation();
      $(".nav__menu").toggleClass("active");

      // Animate menu icon
      if ($(".nav__menu").hasClass("active")) {
        $(".menu__line:first-child").css(
          "transform",
          "rotate(45deg) translate(5px, 5px)",
        );
        $(".menu__line--middle").css("opacity", "0");
        $(".menu__line:last-child").css(
          "transform",
          "rotate(-45deg) translate(5px, -5px)",
        );
      } else {
        $(".menu__line:first-child").css(
          "transform",
          "rotate(0) translate(0, 0)",
        );
        $(".menu__line--middle").css("opacity", "1");
        $(".menu__line:last-child").css(
          "transform",
          "rotate(0) translate(0, 0)",
        );
      }
    });

    // Close menu when clicking outside
    $(document).click(function (e) {
      if (!$(e.target).closest(".menu").length) {
        $(".nav__menu").removeClass("active");
        $(".menu__line:first-child").css(
          "transform",
          "rotate(0) translate(0, 0)",
        );
        $(".menu__line--middle").css("opacity", "1");
        $(".menu__line:last-child").css(
          "transform",
          "rotate(0) translate(0, 0)",
        );
      }
    });

    /* ========== Smooth scroll for anchor links ========== */
    var headerHeight = $("header").outerHeight();

    $('a[href^="#"]').on("click", function (event) {
      event.preventDefault();

      var target = $(this.hash);

      if (target.length) {
        $("html, body").animate(
          {
            scrollTop: target.offset().top - headerHeight + 50,
          },
          1000,
          "swing",
          function () {
            window.location.hash = target.selector;
          },
        );
      }
    });

    /* ========== Call to action form ========== */
    $(".call__to__action__button").click(function (e) {
      e.preventDefault();
      $("#call__to__action__form").addClass("active");
      $(".call__to__action__form__inset").addClass("active");
    });

    $(".call__to__action__close").click(function (e) {
      e.preventDefault();
      $("#call__to__action__form").removeClass("active");
      $(".call__to__action__form__inset").removeClass("active");
    });

    /* ========== Telegram button ========== */
    $(".telegramm__to__go").click(function (e) {
      e.preventDefault();

      var telegramUrl = ramnet_ajax.telegram_url || "https://t.me/ramnet";
      window.open(telegramUrl, "_blank");
    });

    /* ========== Initialize any sliders or carousels ========== */
    // Можно добавить инициализацию слайдеров если понадобятся

    /* ========== Add active class to current menu item ========== */
    var currentLocation = window.location.href;
    $(".nav__menu a").each(function () {
      if ($(this).attr("href") === currentLocation) {
        $(this).addClass("active");
      }
    });

    /* ========== Lazy loading images ========== */
    if ("IntersectionObserver" in window) {
      const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const img = entry.target;
            img.src = img.dataset.src;
            img.classList.remove("lazy");
            imageObserver.unobserve(img);
          }
        });
      });

      const lazyImages = document.querySelectorAll("img.lazy");
      lazyImages.forEach((img) => imageObserver.observe(img));
    }
  });

  // Window load
  $(window).on("load", function () {
    // Скрываем прелоадер если есть
    $("body").addClass("loaded");
  });
})(jQuery);
