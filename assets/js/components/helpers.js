(function() {

    em.helper = {};

    em.helper.init = function() {
        em.helper.resizeVideos();
        em.helper.jumpTo();
        em.helper.hashCheck();
        em.helper.goToNext();
        em.helper.externalLinks();
    };

    em.helper.debounce = function(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    /**
     * Automatically sets all external links to open in a new tab. Also includes
     * protection from the target=_blank + window.location vulnerability. For
     * cross-browser compatibility, we need to include noopener and noreferrer.
     *
     * For more info read https://mathiasbynens.github.io/rel-noopener/
     */
    em.helper.externalLinks = function() {
        var anchors = document.querySelectorAll('a');

        if (anchors.length > 0) {
            for (var i = 0; i < anchors.length; ++i) {
                var a = new RegExp('/' + window.location.host + '/');
                var b = new RegExp(/mailto:/); // prevent target blank on mailto links

                if(!a.test(anchors[i].href) && !b.test(anchors[i].href)) {
                    anchors[i].setAttribute("target", "_blank");
                    anchors[i].setAttribute("rel", "noopener noreferrer");
                }
            }
        }
    };

    em.helper.hashCheck = function() {
        if(window.location.hash) {
            var $el = $('[data-jump="'+window.location.hash.substring(1)+'"]').eq(0);

            if($el.length==1) {
               var target = $el.offset();

               setTimeout(function() {
                    $('html,body').stop(true, true).animate({
                        scrollTop: target.top
                     }, 400, function() {
                   });
                }, 1000);

            }
        }
    };

    em.helper.goToNext = function() {
        $(".js-go-to-next").on("click", function(e) {
            e.preventDefault();
            var $el = $(this);
            var $next = $el.closest("section").next();

            var target = $next.offset();

            $('html,body').stop(true, true).animate({
                scrollTop: target.top
                }, 400, function(){
                    //window.location.hash = id;
            });
        });
    };

    em.helper.resizeVideos  = function() {
        $("iframe").each(function(){
            var $el = $(this);
            if(!$el.attr("data-original-width")){
                $el.attr("data-original-width", $el.attr("width"));
                $el.attr("data-original-height", $el.attr("height"));
            }

            $el.attr("width", "100%");
            var height = $el.attr("data-original-height") * $el.width() /  $el.attr("data-original-width");
            $el.attr("height", height);
        });
    };

    em.helper.jumpTo = function() {
        $("body").on("click", ".jump", function() {
            var id = $(this).attr('href');
            if($(id).length===0) { return false; }

            var target = $(id).offset();

            $('html,body').stop(true, true).animate({
                scrollTop: target.top
                }, 300, function() {
                    window.location.hash = id;
            });

            return false;
        });
    };

    em.helper.inViewPort = function(el) {
        // only accepts native JS element DOM object (not jQuery object) for more efficiency

        /*
            http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
            - Now most browsers support getBoundingClientRect method, which has become the best practice. Using an old answer is very slow, not accurate and has several bugs.
            - IE8 supports it fully, IE7 is not perfect, however it works better than the old answer.
        */

        // modified from stackoverflow: take into consideration the element's dimensions

        var rect = el.getBoundingClientRect();
        return (
            rect.top >= -el.offsetHeight &&
            rect.left >= -el.offsetWidth &&
            rect.bottom <= el.offsetHeight+(window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= el.offsetWidth+(window.innerWidth || document.documentElement.clientWidth)
        );
    };

    em.helper.clickable = function() {
        // make a whole area clickable while not breaking nested links
        // usage: <div class="c-my-component js-clickable h-clickable" data-url="http://km.em87.io">Kilometer race! by <a href="http://www.evermade.fi">Evermade</a></div>
        $(document).on('click', '.js-clickable', function(e) {
            var $el = $(this);

            //if an node clicked within is an achor lets allow to bubble up and do its thing, else go to link
            if (e.target.tagName.toLowerCase()=="a") {
                return true;
            } else {
                var url = $el.attr("data-url");
                var target = $el.attr('target');

                if (url) {

                    if (!target) {
                        // externalize this js-clickable if it's pointed to another domain
                        var a = new RegExp('/' + window.location.host + '/');
                        if (!a.test(url)) {
                            target = '_blank';
                        }
                    }

                    if (typeof target !== typeof undefined && target !== false) {
                        var win = window.open(url, target);
                        win.focus();
                    } else {
                        window.location.href = url;
                    }
                }
            }
        });
    };

})();
