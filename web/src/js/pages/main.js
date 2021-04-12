export default {
    init: (app, Config, gsap, Plyr, ScrollTrigger, CustomEase, imagesLoaded) => {

        /*
        |
        | Constants
        |-----------
        */
        const
            $bodyOffset = Config.$body.offset(),
            $scrollTo = $('.scrollto'),
            $scrollUp = $('.scrollup'),
            $img = $('.img-lazy')
        ;

        /*
        |
        | Easings
        |----------
        */
        //CustomEase.create("easeCustom", "M0,0 C0.4,0 0.2,1 1,1")
        //CustomEase.create("easeSmooth", "M0,0 C0.19,1 0.22,1 1,1")


        /*
        |
        | PreloadImage
        |----------
        */
        const preloadImages = new Promise((resolve, reject) => {
//            imagesLoaded(document.querySelectorAll(".img-lazy"), { background: true }, resolve);
            var imgLoad = imagesLoaded($img, { background: false }, resolve);

            imgLoad.on( 'progress', function( instance, image ) {
                var result = image.isLoaded ? 'loaded' : 'broken';
                console.log( 'image is ' + result + ' for ' + image.img.src );
                var lazyContainer = image.img.closest(".lazy-ctr");
                lazyContainer.classList.add("is-load");
            });

        });

        /*
        |
        | Loader
        |---------
        */
        if (sessionStorage.getItem('loaded_once') === null) {
            sessionStorage.setItem('loaded_once', 'loaded_once');

            Config.$preloader.find('.preloader-full').addClass('active')

            Config.$window.on('load', function () {
                gsap.to(Config.$preloader, .2, {
                    opacity: 0, ease: 'Linear.easeNone',
                    delay: 2.4,
                    onComplete: function(){
                        Config.$preloader.remove();
                        app.dispachEvent( Config.$body, 'loaderEnd');
                    } 
                })
            })

        } else {


            Config.$window.on('load', function () {
                console.log('load');
                gsap.to(Config.$preloader, .2, {
                    opacity: 0, ease: 'Linear.easeNone',
                    onComplete: function(){
                        Config.$preloader.remove();
                        app.dispachEvent( Config.$body, 'loaderEnd');
                    }
                })
            })

        }


        /*
        |
        | On Window Loaded
        |-----------------
        */
        Config.$body.on('loaderEnd', () => {

            console.log('loaderEnd');

            /*
            |
            | LazyLoad
            |-----------------
            function lazyParent(el) {
                const lazyContainer = el.closest(".lazy-container")
                lazyContainer.classList.add("is-load")
            }

            window.lazy = new LazyLoad({
                unobserve_entered: true,
                callback_loaded: lazyParent
            })

            */
            //let allDone = [fontOpen,fontPlayfair,preloadImages]
            let allDone = [preloadImages];

            Promise.all(allDone).then(()=>{
                console.log('Toutes les promises sont DONE');
            });



            /*
            |
            | Burger Menu
            |-----------------
            */
            Config.$burger.on('click', function () {
                Config.$menu.toggleClass('is-menu');
                Config.$header.toggleClass('is-menu');
                Config.$body.toggleClass('--no-scroll');
            })

            function checkDevice() {
                if ("matchMedia" in window) {
                    if (window.matchMedia("(min-width:48rem)").matches) {
                         Config.$menu.removeClass('is-menu')
                    }
                }
            }
            window.addEventListener('resize', checkDevice, false);


            /*
            |
            | Header on Scroll
            |
            */
            const showAnim = gsap.from(Config.$header, {
                yPercent: -100,
                paused: true,
                duration: 0.2
            }).progress(1)

            ScrollTrigger.matchMedia({

                "(min-width: 48rem)": function () {

                    ScrollTrigger.create({
                        start: 'top -40',
                        end: 99999,
                        onUpdate: (self) => {
                            self.direction === -1 ? showAnim.play() : showAnim.reverse()
                        },
                        toggleClass: { className: 'is-scrolled', targets: Config.$header }
                    });

                },
                "(max-width: 47rem)": function () {
                    showAnim.play()
                }
            })


            /*
            |
            | Scrollto
            |-----------------
            */
            $scrollTo.on('click', function () {
                gsap.to(window, { duration: .8, ease: "easeCustom", scrollTo: Config.$window.height() })
            })


        })


    }
}