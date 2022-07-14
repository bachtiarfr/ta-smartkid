(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();

    // reordering table (highest W to lower)
    var div = $('#v-hasil');
    var listitems = $(".item-list").get();
    listitems.sort(function (a, b) {
        return (+$(a).attr('data-value') > +$(b).attr('data-value')) ?
        -1 : (+$(a).attr('data-value') < +$(b).attr('data-value')) ? 
        1 : 0;
    })
    $.each(listitems, function (idx, itm) { 
        div.append(itm);
    });
    
    $('#v-hasil tr:first-child .hasil').each(function() {
        $(this).text("Diterima")
    });


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.sticky-top').css('top', '0px');
        } else {
            $('.sticky-top').css('top', '-100px');
        }
    });
    
    let isi = '';
    let no = 1;
    // kondisi jika diklik dengan jquery click
    $('#btnAddPrestasi').click(function (e) { 
        e.preventDefault();
        // $('#dv_prestasi').clone().insertAfter('#dv_prestasi');

        // ambil form bagian input prestasi kemudia dicloning
        isi = `
            <div class="col-md-9 form-inline p-0" id="dv_prestasi">
                <div class="form-group d-flex mb-3">
                    <input type="text" name="prestasi${no}" id="prestasi${no}" class="form-control">
                    <div class="btn btn-danger ml-2 btnDelete">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            </div>
        `;

        no++;

        $('#group_prestasi').append( isi );
    });

    $(document).on("click", ".btnDelete", function(e) {
        e.preventDefault();
        $(this).parent().parent().remove();
    })
    
    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";
    
    $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
            function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
            }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });
        
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        items: 1,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ]
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 24,
        dots: true,
        loop: true,
        nav : false,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });
    
})(jQuery);

