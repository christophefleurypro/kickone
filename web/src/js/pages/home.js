export default {
    init: (app, Sketch) => {

        /*
        |
        | Constants
        |------------
        */
        const
            $body = $('body')
        ;
        

        new Sketch({
            dom: document.getElementById('app-canvas')
        });

        console.log('home');
        
    }
}