var utils = (function () {
  return {
    wasInside: true,
    init: function init() {
      this.tecladoValue = "";
      utils.configModal(); // this.initValueScroll();

      //jQuery(window).on("scroll", utils.scrollHeader);
      jQuery("#searchTerm").focus(utils.searchFocus);
      jQuery("#searchTerm").focusout(utils.searchOutFocus);
      //$("select").selectpicker();
      utils.tooltip("button");
    },
    // FunciÃ³n que agrega contador de carÃ¡cteres a textarea
    countCharacter: function countCharacter(idTextArea, maxCharacters) {
      var text = document.getElementById(idTextArea);
      var wrapper = document.createElement("div");
      var c_wrap = document.createElement("div");
      var count = document.createElement("span");
      var message = document.createElement("span");
      wrapper.className = "div-character";
      wrapper.id = "div" + idTextArea;
      c_wrap.innerHTML = "";
      c_wrap.className = "div-count-character"; // Mensaje de advertencia

      message.className = "hidden span-message-character";
      message.id = "message" + idTextArea;
      message.innerText = "AlcanzÃ³ el mÃ¡ximo de carÃ¡cteres permitidos"; // Contador de carÃ¡cteres

      count.className = "float-right pr-3 span-count-character";
      count.id = "count" + idTextArea;
      text.parentNode.appendChild(wrapper);
      wrapper.appendChild(text);
      c_wrap.appendChild(message);
      c_wrap.appendChild(count);
      wrapper.appendChild(c_wrap);

      function _set() {
        count.innerHTML = maxCharacters - this.value.length || 0;
        var countCharacters = maxCharacters - this.value.length;
        var elementMessage = jQuery(
          "#div" + idTextArea + " #message" + idTextArea
        );
        var elementCount = jQuery("#div" + idTextArea + " #count" + idTextArea);

        if (countCharacters <= 0) {
          elementMessage.removeClass("hidden");
          elementCount.css("color", "red");
        } else if (elementMessage.hasClass("hidden") == false) {
          elementMessage.addClass("hidden");
          elementCount.css("color", "#0B457F");
        }

        count.innerHTML = countCharacters || 0;
      }

      text.addEventListener("input", _set);

      _set.call(text);
    },
    // FunciÃ³n que valida si sale del sitio
    leaveSite: function leaveSite(url) {
      var message =
        "Con esta acciÃ³n abrirÃ¡s una nueva pestaÃ±a. Â¡Te esperamos pronto!";
      var opcAction = [
        {
          text: "Cancelar",
          action: "utils.hideModal('alert-modal')",
          class: "btn-middle",
        },
        {
          text: "Continuar",
          action: "utils.modalGoTo('" + url + "', 'alert-modal')",
          class: "btn-high",
        },
      ];
      utils.callModalAlert(
        "warning",
        "EstÃ¡s saliendo de GOV.CO",
        message,
        opcAction
      );
    },
    examplesAlerts: function examplesAlerts(tipo) {
      var opcAction = [
        {
          text: "Cancelar",
          action: "utils.hideModal('alert-modal')",
          class: "btn-middle",
        },
      ];
      utils.callModalAlert(
        tipo,
        "Modal tipo " + tipo,
        "InformaciÃ³n de detalle al cierre de la acciÃ³n",
        opcAction
      );
    },
    // FunciÃ³n obtiene modal de mantenimiento
    maintenanceSite: function maintenanceSite() {
      var message =
        "Esta pÃ¡gina esta en mantenimiento en breve estaremos de vuelta.<br><br>";
      message +=
        "Puedes escribirnos a soporteccc@mintic.gov.co.<br>LlÃ¡manos gratis: 01 8000 910742 y en BogotÃ¡: 3 90 79 51";
      var opcAction = [];
      utils.callModalAlert(
        "maintenance",
        "En mantenimiento",
        message,
        opcAction
      );
    },
    // FunciÃ³n obtiene modal de error de sitio
    errorSite: function errorSite() {
      var message =
        "Puedes escribirnos a soporteccc@mintic.gov.co.<br>LlÃ¡manos gratis: 01 8000 910742 y en BogotÃ¡: 3 90 79 51";
      var opcAction = [
        {
          text: "Regresar",
          action: "utils.hideModal('alert-modal')",
          class: "btn-high",
        },
      ];
      utils.callModalAlert(
        "error-site",
        "Ha ocurrido un error",
        message,
        opcAction
      );
    },
    // Funcion que inicializa
    initAccesibilidad: function initAccesibilidad() {
      var letterMin = document.querySelector(".min-fontsize");
      var letterMax = document.querySelector(".max-fontsize");
      var mood = 1;
      var size = parseInt(getComputedStyle(document.documentElement).fontSize); //Contraste

      document
        .querySelector(".contrast-ref")
        .addEventListener("click", function (e) {
          if (mood == 1) {
            document.body.classList.add("all");
            mood++;
          } else {
            document.body.classList.remove("all");
            mood--;
          }
          e.preventDefault();
        }); //reducir letra

      letterMin.addEventListener("click", function (e) {
        if (size > 13) {
          size--;
          var font = size.toString();
          document.querySelector("html").style.fontSize = font + "px";
        }
        e.preventDefault();
      }); //Aumentar Letra

      letterMax.addEventListener("click", function (e) {
        if (size < 19) {
          size++;
          var font = size.toString();
          document.querySelector("html").style.fontSize = font + "px";
        }
        e.preventDefault();
      });
    },
    // FunciÃ³n que abre otra ventana del navegador con Url de parametro
    goTo: function goTo(url) {
      if (url.length > 0 && url != "undefined") {
        window.open(url, "_blank");
      }
    },
    // FunciÃ³n que ajusta posiciÃ³n de modal sobre main y backdrop
    configModal: function configModal() {
      // Copy modals outher main
      jQuery("#modals-content").append(jQuery(".modal"));
      jQuery(".modal").on("shown.bs.modal", function () {
        //Make sure the modal and backdrop are siblings (changes the DOM)
        jQuery(this).before(jQuery(".modal-backdrop")); //Make sure the z-index is higher than the backdrop

        jQuery(this).css(
          "z-index",
          parseInt(jQuery(".modal-backdrop").css("z-index")) + 1
        );
      });
    },
    // FunciÃ³n que ajusta posiciÃ³n de un modal especifico sobre main y backdrop
    configBackDrop: function configBackDrop(idModal) {
      jQuery("#" + idModal).on("shown.bs.modal", function () {
        //Make sure the modal and backdrop are siblings (changes the DOM)
        jQuery(this).before(jQuery(".modal-backdrop")); //Make sure the z-index is higher than the backdrop

        jQuery(this).css(
          "z-index",
          parseInt(jQuery(".modal-backdrop").css("z-index")) + 1
        );
      });
    },
    // FunciÃ³n que invoca un modal de tipo alerta
    callModalAlert: function callModalAlert(typeModal, title, message, opc) {
      var iconModal = "";

      if (jQuery(".alert-govco-maintenance").hasClass("hidden") == false) {
        jQuery(".alert-govco-maintenance").addClass("hidden");
      }

      jQuery(".alert-modal .modal-header i").show();
      jQuery(
        "#modal-content-type-alert .alert-icon #govco-icon-alert"
      ).removeClass();

      switch (typeModal) {
        case "error":
          iconModal = "govco-icon govco-icon-x-cn";
          jQuery(".alert-modal .modal-header i").hide();
          break;

        case "warning":
          iconModal = "govco-icon govco-icon-exclamation-cn";
          jQuery(".alert-modal .modal-header i").hide();
          break;

        case "success":
          iconModal = "govco-icon govco-icon-circle-check-n";
          jQuery(".alert-modal .modal-header i").hide();
          break;

        case "info":
          iconModal = "govco-icon govco-icon-circle-check-n";
          break;

        case "maintenance":
          iconModal = "govco-icon govco-icon-exclamation-cn";
          jQuery(".alert-govco-maintenance").removeClass("hidden");
          break;

        case "error-site":
          iconModal = "govco-icon govco-icon-sad-face-n";
          jQuery(".alert-modal .modal-header i").hide();
          break;

        default:
          iconModal = "govco-icon govco-icon-exclamation-cn";
      }

      jQuery(
        "#modal-content-type-alert .alert-icon #govco-icon-alert"
      ).addClass(iconModal);
      jQuery("#modal-content-type-alert").removeClass();
      jQuery("#modal-content-title").removeClass();
      jQuery("#modal-content-title").addClass(
        "modal-content-title content-govco"
      );
      jQuery("#modal-content-type-alert").addClass(
        "modal-content-" + typeModal
      );
      jQuery("#modal-content-title").addClass("modal-content-" + typeModal);
      jQuery(".alert-modal .modal-footer").html(utils.createButtonsModal(opc));
      jQuery("#modal-content-title").text(title);
      jQuery("#modal-content-txt").html(message);


      jQuery(".alert-modal").modal({
        backdrop: "static",
        keyboard: false,
      });
    },
    // Call Tooltip function
    tooltip: function () {
      $('[data-toggle="tooltip"]').tooltip();
    },

    // Calendar function
    calendar: function () {
      $('.calendar').datepicker({
        locale: 'es-es',
        format: 'dd/mm/yyyy',
        uiLibrary: 'bootstrap4',
        keyboardNavigation: true,
        icons: {
          rightIcon: '<span aria-label="Abrir calendario"><i class="material-icons">date_range</i></span>'
        }
      });
    },
    // FunciÃ³n que oculta modal
    hideModal: function hideModal(idModal) {
      jQuery("." + idModal).modal("hide");
    },
    // FunciÃ³n que captura eventos de modal alert
    eventsModalAlert: function eventsModalAlert() {
      $(".alert-modal").on("hide.bs.modal", function () {
        jQuery("#modal-content-txt").text(message);
        jQuery(".alert-modal .modal-footer").html("");
      });
    },
    // FunciÃ³n que crea HTML de listado de botones
    createButtonsModal: function createButtonsModal(listOpc) {
      var footer = "";
      listOpc.forEach(function (item) {
        footer +=
          '<button type="button" class="btn btn-round btn-modal ' +
          item.class +
          '"';
        footer += 'onclick="' + item.action + '">' + item.text + "</button>";
      });
      return footer;
    },

    // Funcion para obtener la url del servidor actual 
    getServerWebUrl: function (concatStr) {
      return window.location.origin + concatStr;
    },

    // Funcion viewportLink se genera una ventana con un tamÃ¡Ã±o de 500x600
    viewportLink: function (href) {
      window.open(href, '', 'resizable=no,status=no,location=no,toolbar=no,menubar=yes,fullscreen=no,scrollbars=no,dependent=no,width=500,height=600');
    },
    //show password, using checkbox
    showPasswordCheckbox: function (inputPassID, checkboxID) {
      var inputPass = document.getElementById(inputPassID);
      var checkPass = document.getElementById(checkboxID);
      checkPass.addEventListener('change', function () {
        if (this.checked) {
          inputPass.type = "text";
        }
        else {
          inputPass.type = "password";
        }
      });
    },
    // FunciÃ³n que abre otra ventana del navegador con Url de parametro
    modalGoTo: function modalGoTo(url, idModal) {
      utils.hideModal(idModal);
      utils.goTo(url);
    },
    // Evento de clic sobre componente collapse
    collapseOnClick: function collapseOnClick(classComponent, idLoop) {
      var state = jQuery("#item-" + idLoop).attr("aria-expanded");
      jQuery("." + classComponent + " .lbl-minus").hide();
      jQuery("." + classComponent + " .icon-minus").hide();
      jQuery("." + classComponent + " #title-entity-" + idLoop).show();
      jQuery(".content-" + classComponent + " .icon-add").show(100);
      jQuery("#title-" + idLoop).show(200);

      if (state == "false") {
        jQuery("#item-" + idLoop + " .lbl-minus").show(200);
        jQuery("#item-" + idLoop + " .icon-minus").show(200);
        jQuery("#item-" + idLoop + " #icon-add-" + idLoop).hide(200);
        jQuery(
          "." +
          classComponent +
          " .title-entity-" +
          classComponent +
          ":not(#title-entity-" +
          idLoop +
          ")"
        ).hide(200, function () { });
        jQuery(
          "." + classComponent + " .collapse-title:not(#item-" + idLoop + ")"
        ).addClass("pb-2");
      } else {
        jQuery("#item-" + idLoop + " .lbl-minus").hide();
        jQuery("#item-" + idLoop + " .icon-minus").hide();
        jQuery(".title-entity-" + classComponent).show(200);
        jQuery(
          "." + classComponent + " .title-entity-" + classComponent
        ).show(200, function () { });
        jQuery("." + classComponent + " .collapse-title").removeClass("pb-2");
      }
    },
    callModal: function callModal(type) {
      jQuery(".govco-modal-" + type).modal({
        backdrop: "static",
        keyboard: false,
      });
    },
    // FunciÃ³n de evento para activar evento scroll y sus interacciones
    scrollHeader: function scrollHeader() {
      var scrollOffset = jQuery(document).scrollTop();
      var firstMenu = document.getElementsByClassName("nav-primary")[0];
      var secondMenu = document.getElementsByClassName("nav-secondary")[0];
      var itemFirstMenu = document.getElementsByClassName(
        "nav-item-primary"
      )[0];
      var searchNavbar = document.getElementsByClassName("search-navbar")[0];

      if (firstMenu != undefined && secondMenu != undefined) {
        // Valida la posiciÃ³n del scroll para activar/inactivar animaciÃ³n
        if (scrollOffset < 300) {
          utils.initValueScroll();
        } else {
          firstMenu.classList.remove("hidden-transition");
          secondMenu.classList.remove("show-transition");

          if (firstMenu.classList.contains("show-transition") === false) {
            firstMenu.classList.add("show-transition");
            itemFirstMenu.classList.remove("is-scroll");
          }

          if (secondMenu.classList.contains("hidden-transition") === false) {
            secondMenu.classList.add("hidden-transition");
          }

          if (searchNavbar.classList.contains("translation") === false) {
            searchNavbar.classList.add("translation");
            searchNavbar.classList.remove("non-translation");
          }
        }
      }
    },
    // FunciÃ³n para asignar valores iniciales a la animaciÃ³n de segundo menÃº
    initValueScroll: function initValueScroll() {
      var firstMenu = document.getElementsByClassName("nav-primary")[0];
      var secondMenu = document.getElementsByClassName("nav-secondary")[0];
      var itemFirstMenu = document.getElementsByClassName(
        "nav-item-primary"
      )[0];
      var searchNavbar = document.getElementsByClassName("search-navbar")[0];

      if (firstMenu != undefined && secondMenu != undefined) {
        if (firstMenu.classList.contains("hidden-transition") === false) {
          itemFirstMenu.classList.add("is-scroll");
          firstMenu.classList.add("hidden-transition");
          firstMenu.classList.remove("show-transition");
        }

        if (secondMenu.classList.contains("show-transition") === false) {
          secondMenu.classList.remove("hidden-transition");
          secondMenu.classList.add("show-transition");
        }

        if (searchNavbar.classList.contains("translation")) {
          searchNavbar.classList.remove("translation");
          searchNavbar.classList.add("non-translation");
        }
      }
    },
    // Header Nvl 2: FunciÃ³n para activar la animaciÃ³n de bÃºsqueda
    searchFocus: function searchFocus() {
      var searchBar = document.getElementsByClassName("form-search-bar")[0];
      searchBar.classList.add("form-search-bar-active");
    },
    // Header Nvl 2: FunciÃ³n para ocultar la animaciÃ³n de bÃºsqueda
    searchOutFocus: function searchOutFocus() {
      var searchBar = document.getElementsByClassName("form-search-bar")[0];
      searchBar.classList.remove("form-search-bar-active");
    },
    /* Funcionalidad de componente teclado */
    outInputPassword: function outInputPassword() {
      if (!this.isMobile()) {
        var kb = document.getElementById("keyboard");
        if (this.wasInside) {
          kb.classList.remove("show");
        }
        this.wasInside = false;
      }
    },

    onInputPassword: function onInputPassword() {
      if (!this.isMobile()) {
        var kb = document.getElementById("keyboard");
        kb.classList.add("show");
        this.wasInside = true;
      }
    },

    isMobile: function isMobile() {
      var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
      return isMobile;
    },

    clearTeclado: function clearTeclado() {
      var inputTeclado = document.getElementsByClassName(
        "teclado-password"
      )[0];
      inputTeclado.value = "";
    },

    initTeclado: function initTeclado() {
      var inputTeclado = document.getElementsByClassName(
        "teclado-password"
      )[0];
      inputTeclado.classList.add('pass-type');
      if (!this.isMobile()) {
        inputTeclado.setAttribute("onKeyDown", "return false");
      } else {
        inputTeclado.setAttribute("type", "tel");
      }
      var tecladoValue = "";
      $(".td-number-item")
        .unbind()
        .click(function (e) {
          var inputTeclado = document.getElementsByClassName(
            "teclado-password"
          )[0];
          inputTeclado.classList.add('pass-type');
          if (inputTeclado.value === "") {
            tecladoValue = e.target.value;
          } else {
            tecladoValue += e.target.value;
          }

          inputTeclado.value = tecladoValue;
        });
      $(".btn-delete-teclado")
        .unbind()
        .click(function (e) {
          utils.clearTeclado();
        });
    },
    getValueTeclado: function getValueTeclado() {
      this.outInputPassword();
      var inputTeclado = document.getElementsByClassName("teclado-password")[0];
      var tecladoValue = JSON.parse(JSON.stringify(inputTeclado.value));
      inputTeclado.value = "";
      return tecladoValue;
    },

    /* end uncionalidad de componente teclado */
    scrollToTopCDN: function scrollToTopCDN(div) {
      $(div).animate(
        {
          scrollTop: 0,
        },
        "fast"
      );
    },
    mergeObjects: function asignObects(objs) {
      result = objs.reduce(function (r, o) {
        Object.keys(o).forEach(function (k) {
          if (typeof o[k] !== "undefined") {
            r[k] = o[k];
            // console.log( k, o[k])
          }
        });
        return r;
      }, {});
      return result;
    },
    setConfigTable: function setConfigTable(configTable) {
      var paginator_btn = [];
      paginator_btn["previous"] =
        '\n Anterior';
      paginator_btn["next"] =
        '\n Siguiente';
      var numberOfDates = $(
        "table#".concat(configTable.idSelector, " tbody tr")
      ).length;
      var defaultConfigTable = {
        pagingType: "simple",
        responsive: true,
        pageLength: 5,
        info: false,
        lengthChange: true,
        language: {
          emptyTable: "No se encontraron registros coincidentes",
          lengthMenu: numberOfDates.toString() + " Resultados",
          search: "Resultados",
          searchPlaceholder: "BÃºsqueda",
          paginate: {
            previous: paginator_btn["previous"],
            next: paginator_btn["next"],
          },
        },
      };
      var mergeLanguage = {
        language: utils.mergeObjects([
          defaultConfigTable.language,
          configTable.language,
        ]),
      };
      var mergeConfig = utils.mergeObjects([
        defaultConfigTable,
        configTable,
        mergeLanguage,
      ]);
      console.log(mergeConfig);
      $("#".concat(configTable.idSelector)).DataTable(mergeConfig);
    },
    removeTag: function removeTag() {
      jQuery(".tag-remove").on("click", function (e) {
        jQuery(this).parent().remove();
      });
    },
    //Hide component BackToTop
    onWindowScroll: () => window.addEventListener('scroll', function(){
      var objBackTop = document.querySelector(".scroll-to-top");
      if ((window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop) > 100) {
        windowScrolled = true;
        objBackTop.classList.add("show-scrollTop");
      } else if ((this.windowScrolled && window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop) < 10) {
        objBackTop.classList.remove("show-scrollTop");
      }
    }),
    //BacktoTop
    scrollToTop: function () {
      (function smoothscroll() {
        let currentScroll = document.documentElement.scrollTop || document.body.scrollTop || window.pageYOffset;
        if (currentScroll > 0) {
          window.requestAnimationFrame(smoothscroll);
          window.scrollTo(0, currentScroll - (currentScroll / 8));
          if (currentScroll < 20) {
            window.scrollTo(0, 0);
            document.documentElement.scrollTop = 0;
            //this.windowScrolled = false;
          }
        }
      })();
      event.preventDefault();
    },
    blurredBackgroundModal: function () {
      window.document.querySelectorAll('body.modal-open .container-fluid').forEach(function (el) {
        el.style.filter = "blur(15px)";
      })
    },
    sharpenBackgroundModal: function () {
      window.document.querySelectorAll('body.modal-open .container-fluid').forEach(function (el) {
        el.style.filter = "none";
      })
    }
  };
})();

jQuery(function () {
  utils.init(); ///Evento para el input del buscador del header

  jQuery("#input-buscador-header, #input-buscador-header-mobile").on(
    "keyup",
    function (e) {
      if (e.which == 13) {
        var filtro = jQuery(this).val();
        RedirectBuscadorConFiltro(filtro);
      }
    }
  );
  jQuery("#input-buscador-header_btn-search").on("click", function (e) {
    var filtro = jQuery("#input-buscador-header").val();
    RedirectBuscadorConFiltro(filtro);
  }); //Funcionalidad back to top

  var backToTopButton = document.querySelector(".btn-up-hover-clone");

  if (backToTopButton != null) {
    window.addEventListener("scroll", function () {
      if (window.pageYOffset > 300) {
        backToTopButton.classList.add("show"); //fade in

        backToTopButton.style.display = "block";
        backToTopButton.classList.remove("hide");
      } else {
        backToTopButton.classList.add("hide"); //fade out

        backToTopButton.classList.remove("show");
      }

      backToTopButton.addEventListener("click", function () {
        window.scrollTo(0, 0);
      });
    });
  }
});

function RedirectBuscadorConFiltro(filtro) {
  if (filtro) window.location.href = "/buscador?busqueda=" + filtro;
}