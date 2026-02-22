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

    /* ========== Маска для телефона ========== */
    // Подключаем jQuery Mask если еще не подключен
    if (typeof $.fn.mask === "undefined") {
      $.getScript(
        "https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js",
        function () {
          initPhoneMask();
        },
      );
    } else {
      initPhoneMask();
    }

    function initPhoneMask() {
      $('input[name="phone"], .phone-mask, input[placeholder*="+7"]').mask(
        "+7 (999) 999-99-99",
        {
          placeholder: "+7 (___) ___-__-__",
          onKeyPress: function (value, event, currentField, options) {
            // Дополнительная обработка при вводе
            $(currentField).removeClass("error warning");
          },
        },
      );
    }

    /* ========== Валидация форм ========== */
    function validateForm($form) {
      let isValid = true;
      let errors = [];

      // Валидация имени
      let $name = $form.find('input[name="username"], input[name="name"]');
      if ($name.length) {
        let nameValue = $name.val().trim();
        if (nameValue === "") {
          $name.addClass("error");
          errors.push("Введите имя");
          isValid = false;
        } else if (nameValue.length < 2) {
          $name.addClass("error");
          errors.push("Имя должно содержать минимум 2 символа");
          isValid = false;
        } else if (!/^[a-zA-Zа-яА-ЯёЁ\s-]+$/.test(nameValue)) {
          $name.addClass("error");
          errors.push("Имя может содержать только буквы, пробелы и дефис");
          isValid = false;
        } else {
          $name.removeClass("error");
        }
      }

      // Валидация телефона
      let $phone = $form.find('input[name="phone"]');
      if ($phone.length) {
        let phoneValue = $phone.val().replace(/\D/g, "");
        if (phoneValue === "") {
          $phone.addClass("error");
          errors.push("Введите телефон");
          isValid = false;
        } else if (phoneValue.length < 11) {
          $phone.addClass("error");
          errors.push("Введите полный номер телефона (11 цифр)");
          isValid = false;
        } else {
          $phone.removeClass("error");
        }
      }

      // Показываем ошибки
      if (!isValid) {
        showErrors($form, errors);
      } else {
        hideErrors($form);
      }

      return isValid;
    }

    function showErrors($form, errors) {
      // Удаляем старые ошибки
      $form.find(".form-errors").remove();

      // Создаем блок с ошибками
      let $errorBlock = $('<div class="form-errors"></div>');
      $.each(errors, function (index, error) {
        $errorBlock.append('<p class="error-message">❌ ' + error + "</p>");
      });

      // Вставляем в начало формы
      $form.prepend($errorBlock);

      // Подсвечиваем форму
      $form.addClass("has-errors");

      // Автоскролл к форме
      $("html, body").animate(
        {
          scrollTop: $form.offset().top - 150,
        },
        500,
      );
    }

    function hideErrors($form) {
      $form.find(".form-errors").fadeOut(300, function () {
        $(this).remove();
      });
      $form.removeClass("has-errors");
      $form.find(".error").removeClass("error");
    }

    /* ========== Form submission ========== */
    $("#form, #call__to__action__form").on("submit", function (e) {
      e.preventDefault();

      var $form = $(this);

      // Валидация перед отправкой
      if (!validateForm($form)) {
        return false;
      }

      var $submitButton = $form.find('button[type="submit"], .button__main');
      var formData = $form.serializeArray();
      var name = formData[0] ? formData[0].value : "";
      var phone = formData[1] ? formData[1].value : "";

      // Блокируем кнопку на время отправки
      $submitButton
        .prop("disabled", true)
        .addClass("loading")
        .text("Отправка...");

      // Send data via AJAX
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

          if (response.success) {
            // Очищаем поля формы
            $form.find('input[type="text"]').val("");

            // Определяем какая форма
            if ($form.attr("id") === "form") {
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
          } else {
            alert("Ошибка: " + response.data);
          }
        },
        error: function (error) {
          console.log("Error:", error);
          alert("Произошла ошибка при отправке. Пожалуйста, попробуйте позже.");
        },
        complete: function () {
          // Разблокируем кнопку
          $submitButton
            .prop("disabled", false)
            .removeClass("loading")
            .text("ОТПРАВИТЬ");
        },
      });

      console.log("Form submitted:", {
        name: name,
        phone: phone,
      });
    });

    /* ========== Убираем ошибку при вводе ========== */
    $(document).on("input", "input", function () {
      $(this).removeClass("error warning");
    });

    /* ========== Валидация телефона при потере фокуса ========== */
    $(document).on("blur", "input[name='phone']", function () {
      let $this = $(this);
      let phoneValue = $this.val().replace(/\D/g, "");

      if (phoneValue.length > 0 && phoneValue.length < 11) {
        $this.addClass("warning");
      } else {
        $this.removeClass("warning");
      }
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
    $(".call__open__form").click(function (e) {
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
