export default {
    init: (app, gsap, ScrollTrigger) => {

        /*
        |
        | Constants
        |------------
        */
        const
            $window = $(window),
            $progress = $('#progress-line'),
            $trigger = $('#trigger-share'),
            $shareContainer = $('.share-container')
            ;


        /*
        |
        | Progress bar
        |------------
        */
        gsap.to($progress, {
            width: '100%',
            paused: true,
            scrollTrigger: { scrub: 0.1 }
        })


        /*
        |
        | Share container
        |------------
        */
        $window.on('load', function () {

            var $endmarker = $trigger.height() - 120

            ScrollTrigger.matchMedia({
                "(min-width: 48rem)": function () {

                    gsap.to($shareContainer, {
                        scrollTrigger: {
                            trigger: $shareContainer,
                            pin: true,
                            pinSpacing: false,
                            start: "top 120",
                            end: () => "+=" + $endmarker,
                            scrub: 1,
                        }
                    })
                }
            })
        })
    }
}