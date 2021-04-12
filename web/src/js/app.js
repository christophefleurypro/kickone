/*
|
| Importing Libs 
|------------------
*/
import gsap from 'gsap';
import CustomEase from "@lib/gsap-pro/CustomEase";
import ScrollTrigger from 'gsap/ScrollTrigger';
import ScrollToPlugin from "gsap/ScrollToPlugin";
import Plyr from 'plyr/src/js/plyr';
//import LazyLoad from "vanilla-lazyload";
import imagesLoaded from 'imagesloaded';

gsap.registerPlugin(ScrollTrigger);
gsap.registerPlugin(CustomEase);
gsap.registerPlugin(ScrollToPlugin);


/*
|
| Importing Components
|-----------------------
*/
import CookieManager from '@components/cookies';
import CustomGoogleMap from '@components/google-map.js';
import Sketch from "@components/sketch";


/*
|
| Importing Utils
|-------------------
*/
import Config from '@utils/config.js';
import Router from '@utils/router.js';

/*
|
| Importing App files
|----------------------
*/
import * as app from '@components/global.js';
import main from '@pages/main.js';
import home from '@pages/home.js';
import news from '@pages/archive-news.js';
import article from '@pages/single-news.js';
import contact from '@pages/contact.js';


/*
|
| Routing
|----------
*/
const routes = new Router([
  {
    'file': main,
    'dependencies': [app, Config, gsap, Plyr, ScrollTrigger, CustomEase, imagesLoaded]
  },
  {
    'file': home,
    'dependencies': [app, Sketch],
    'resolve': '#page-home'
  },
  {
    'file': news,
    'dependencies': [app],
    'resolve': '#archive-news'
  },
  {
    'file': article,
    'dependencies': [app, gsap, ScrollTrigger],
    'resolve': '#single-article'
  },
  {
    'file': contact,
    'dependencies': [app, gsap],
    'resolve': '#page-contact'
  }
]);

/*
|
| Run
|------
*/
(($) => { routes.load() })(jQuery);
