(function() {

    em.pageNavigation = {};

    em.pageNavigation.init = function() {
        $('.c-mobile-toggle').on('click', function() {
            $('body').toggleClass('js-navigation-open');
            return false;
        });
    };

})();