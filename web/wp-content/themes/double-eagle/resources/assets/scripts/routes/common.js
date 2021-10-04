import display_sort_bar from '../modules/sort-by'

export default {
  init() {
    // only applies on shop page
    display_sort_bar()

    // changes nav bar background to white when scrolled
    $(window).scroll(function () {
      window.scrollY > 50
        ? $('#primary-header').addClass('has-scrolled')
        : $('#primary-header').removeClass('has-scrolled');
    })

    // toggles navigation modal
    $('#navbar-toggler').click(function(){
      $('#navigation-modal').modal('show');
    });

    // triggers highlights on form
    $('.input-text').focus(function(){
      $(this).parent().parent().addClass('active-field');
    }).blur(function(){
      $(this).parent().parent().removeClass('active-field');
    })

    // changes search icon to times on click
    $('#collapseSearch').on('show.bs.collapse', function () {
      $(this).next().html('<i class="fas fa-times"></i>')
    })
    // changes times icon to search on click
    $('#collapseSearch').on('hidden.bs.collapse', function () {
      $(this).next().html('<i class="fas fa-search"></i>')
    })

    // add green bar to nav item on phones
    $('.navbar-toggle').on('click', function () {
      $(this).prev().toggleClass('active')
    })
    
    // deals with animation on appear
    const slideUp = {
        distance: '10%',
        origin: 'bottom',
        opacity: 0,
        delay: 800,
    };

    const slideDown = {
      distance: '10%',
      origin: 'top',
      opacity: 0,
      delay: 300,
    };

    window.ScrollReveal().reveal('.animate-up', slideUp);
    window.ScrollReveal().reveal('.animate-down', slideDown);

    // only applies on FAQ page
    $('.card-header').click(function () {
      $(this).children('i').toggleClass('active')
    })
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
