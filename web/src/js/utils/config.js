const Config = {

    breakpointXS: getComputedStyle(document.documentElement).getPropertyValue('--breakpoint-xs'),
    breakpointSm: getComputedStyle(document.documentElement).getPropertyValue('--breakpoint-sm'),
    breakpointMd: getComputedStyle(document.documentElement).getPropertyValue('--breakpoint-md'),
    breakpointLg: getComputedStyle(document.documentElement).getPropertyValue('--breakpoint-lg'),
    breakpointXl: getComputedStyle(document.documentElement).getPropertyValue('--breakpoint-xl'),

    ColorBlack: getComputedStyle(document.documentElement).getPropertyValue('--secondary'),
    ColorWhite: getComputedStyle(document.documentElement).getPropertyValue('--primary'),
    ColorLightgrey: getComputedStyle(document.documentElement).getPropertyValue('--primary_grey'),
    ColorHalfgrey: getComputedStyle(document.documentElement).getPropertyValue('--half_grey'),
    ColorDarkgrey: getComputedStyle(document.documentElement).getPropertyValue('--secondary_grey'),
    ColorBrandprimary: getComputedStyle(document.documentElement).getPropertyValue('--brand_primary'),
    ColorBrandsecondary: getComputedStyle(document.documentElement).getPropertyValue('--brand_secondary'),

    /*
    |
    | Constants
    |-----------
    */
    $window: $(window),
    $html: $('html'),
    $body: $('body'),

    $preloader: $('#preloader'),
    $burger: $('.burger'),
    $header: $('#header'),
    $menu: $('#header-fullscreen'),

    /*
    |
    | Calcul
    |-----------
    */
    $viewportW: window.innerWidth,
    $viewportH: window.innerHeight

}

export default Config