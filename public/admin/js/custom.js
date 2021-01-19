/*
Template: Vito - Responsive Bootstrap 4 Admin Dashboard Template
Author: iqonicthemes.in
Design and Developed by: iqonicthemes.in
NOTE: This file contains the styling for responsive Template.
*/

/*----------------------------------------------
Index Of Script
------------------------------------------------

:: Tooltip
:: Sidebar Widget
:: Magnific Popup
:: Ripple Effect
:: Page Loader
:: Ticket Booking
:: Owl Carousel
:: Select input
:: Search input
:: Scrollbar
:: Counter
:: slick
:: Progress Bar
:: Page Menu
:: Page Loader
:: Page Menu
:: Wow Animation
:: Mail Inbox
:: Chat
:: Todo
:: Form Validation
:: Sidebar Widget
:: Flatpicker
:: checkout
:: scrollup

------------------------------------------------
Index Of Script
----------------------------------------------*/

(function(jQuery) {



    "use strict";

    jQuery(document).ready(function() {

        /*---------------------------------------------------------------------
        Tooltip
        -----------------------------------------------------------------------*/
        jQuery('[data-toggle="popover"]').popover();
        jQuery('[data-toggle="tooltip"]').tooltip();

        /*---------------------------------------------------------------------
        Sidebar Widget
        -----------------------------------------------------------------------*/
        function checkClass(ele, type, className) {
            switch (type) {
                case 'addClass':
                    if (!ele.hasClass(className)) {
                        ele.addClass(className);
                    }
                    break;
                case 'removeClass':
                    if (ele.hasClass(className)) {
                        ele.removeClass(className);
                    }
                    break;
                case 'toggleClass':
                    ele.toggleClass(className);
                    break;
            }
        }
        jQuery('.iq-sidebar-menu .active').each(function(ele, index) {
            jQuery(this).find('.iq-submenu').addClass('show');
            jQuery(this).next().attr("aria-expanded","true");
        })
        
        /*---------------------------------------------------------------------
        Page Loader
        -----------------------------------------------------------------------*/
        jQuery("#load").fadeOut();
        jQuery("#loading").delay().fadeOut("");



        /*---------------------------------------------------------------------
        Search input
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', function(e) {
            let myTargetElement = e.target;
            let selector, mainElement;
            if (jQuery(myTargetElement).hasClass('search-toggle') || jQuery(myTargetElement).parent().hasClass('search-toggle') || jQuery(myTargetElement).parent().parent().hasClass('search-toggle')) {
                if (jQuery(myTargetElement).hasClass('search-toggle')) {
                    selector = jQuery(myTargetElement).parent();
                    mainElement = jQuery(myTargetElement);
                } else if (jQuery(myTargetElement).parent().hasClass('search-toggle')) {
                    selector = jQuery(myTargetElement).parent().parent();
                    mainElement = jQuery(myTargetElement).parent();
                } else if (jQuery(myTargetElement).parent().parent().hasClass('search-toggle')) {
                    selector = jQuery(myTargetElement).parent().parent().parent();
                    mainElement = jQuery(myTargetElement).parent().parent();
                }
                if (!mainElement.hasClass('active') && jQuery(".navbar-list li").find('.active')) {
                    jQuery('.navbar-list li').removeClass('iq-show');
                    jQuery('.navbar-list li .search-toggle').removeClass('active');
                }

                selector.toggleClass('iq-show');
                mainElement.toggleClass('active');

                e.preventDefault();
            } else if (jQuery(myTargetElement).is('.search-input')) {} else {
                jQuery('.navbar-list li').removeClass('iq-show');
                jQuery('.navbar-list li .search-toggle').removeClass('active');
            }
        });

        /*---------------------------------------------------------------------
        Scrollbar
        -----------------------------------------------------------------------*/
        let Scrollbar = window.Scrollbar;
        if (jQuery('#sidebar-scrollbar').length) {
            Scrollbar.init(document.querySelector('#sidebar-scrollbar'), options);
        }
        let Scrollbar1 = window.Scrollbar;
        if (jQuery('#right-sidebar-scrollbar').length) {
            Scrollbar1.init(document.querySelector('#right-sidebar-scrollbar'), options);
        }





        /*---------------------------------------------------------------------
        Progress Bar
        -----------------------------------------------------------------------*/
        jQuery('.iq-progress-bar > span').each(function() {
            let progressBar = jQuery(this);
            let width = jQuery(this).data('percent');
            progressBar.css({
                'transition': 'width 2s'
            });

            setTimeout(function() {
                progressBar.appear(function() {
                    progressBar.css('width', width + '%');
                });
            }, 100);
        });


        /*---------------------------------------------------------------------
        Page Menu
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', '.wrapper-menu', function() {
            jQuery(this).toggleClass('open');
        });

        jQuery(document).on('click', ".wrapper-menu", function() {
            jQuery("body").toggleClass("sidebar-main");
        });

        /*---------------------------------------------------------------------
        Wow Animation
        -----------------------------------------------------------------------*/
        let wow = new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: false,
            live: true
        });
        wow.init();


        /*---------------------------------------------------------------------
        Mailbox
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', 'ul.iq-email-sender-list li', function() {
            jQuery(this).next().addClass('show');
        });

        jQuery(document).on('click', '.email-app-details li h4', function() {
            jQuery('.email-app-details').removeClass('show');
        });



        /*---------------------------------------------------------------------
           Search Box Toggle
        -----------------------------------------------------------------------*/

        jQuery(document).on('click', '.searchbox .search-input', function() {
           jQuery(this).next().next().toggleClass('show-data');
        });


        /*---------------------------------------------------------------------
        Form Validation
        -----------------------------------------------------------------------*/

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);

        /*---------------------------------------------------------------------
        Sidebar Widget
        -----------------------------------------------------------------------*/
        jQuery(document).ready(function() {
            jQuery().on('click', '.todo-task-lists li', function() {
                if (jQuery(this).find('input:checkbox[name=todo-check]').is(":checked")) {

                    jQuery(this).find('input:checkbox[name=todo-check]').attr("checked", false);
                    jQuery(this).removeClass('active-task');
                } else {
                    jQuery(this).find('input:checkbox[name=todo-check]').attr("checked", true);
                    jQuery(this).addClass('active-task');
                }
                // jQuery(this).addClass('active-task');
            });
        });


        /*------------------------------------------------------------------
        Flatpicker
        * -----------------------------------------------------------------*/
        if (typeof flatpickr !== 'undefined' && jQuery.isFunction(flatpickr)) {
            jQuery(".flatpicker").flatpickr({
                inline: true
            });
        }
        if (jQuery('.date-input').hasClass('basicFlatpickr')) {
          jQuery('.basicFlatpickr').flatpickr();
          jQuery('#inputTime').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
          });
          jQuery('#inputDatetime').flatpickr({
            enableTime: true
          });
          jQuery('#inputWeek').flatpickr({            
            weekNumbers: true
          }); 
          jQuery("#inline-date").flatpickr({
              inline: true
          });         
        }

        /*---------------------------------------------------------------------
           Scroll up menu
        -----------------------------------------------------------------------*/
        var position = $(window).scrollTop();
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            //  console.log(scroll);
            
            if(scroll < position) {
                 $('.tab-menu-horizontal').addClass('menu-up');
                 $('.tab-menu-horizontal').removeClass('menu-down');
            } 
            else {
                $('.tab-menu-horizontal').addClass('menu-down');
                $('.tab-menu-horizontal').removeClass('menu-up');
            }
            if(scroll == 0)
            {
                $('.tab-menu-horizontal').removeClass('menu-up');
                $('.tab-menu-horizontal').removeClass('menu-down');
            }
            position = scroll;
        });


        

    });

})(jQuery);