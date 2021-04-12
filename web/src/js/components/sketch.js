import * as THREE from "three";
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
// import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

import fragment from "./shaders/fragment.glsl";
import vertex from "./shaders/vertex.glsl";



class Sketch {

	constructor(options) {

		this.container = options.dom;

		this.clock  = new THREE.Clock();
		this.scene  = new THREE.Scene();

        this.sizes = {
		    width: window.innerWidth,
		    height: window.innerHeight
		};

        this.cursor = {
		    x: 0,
		    y: 0
		};

		this.aspectRadio = this.sizes.width / this.sizes.height;



        this.init();
	}	


	/**
	|
	| Init
	|-------
	*/
    init() {

        this.setupCamera();
        this.initRendererScene();

        this.appendCanvas();


    	this.rendererScene();

    	this.addelt();

        this.initOrbitControls();
        this.renderloop();

        this.resize();
        this.setupResize();

	}


	 /**
	|
	| addElts test
	|-------
	*/
	appendCanvas(){
        this.container.appendChild( this.renderer.domElement );
        this.canvas = this.renderer.domElement;
	}

     /**
	|
	| addElts test
	|-------
	*/
    addelt(){

        const geometry =  new THREE.BoxGeometry(1, 1, 1, 10,10,10);
        //const material =  new THREE.MeshNormalMaterial();
        const material = new THREE.ShaderMaterial({
            extensions: {
              derivatives: "#extension GL_OES_standard_derivatives : enable"
            },
            side: THREE.DoubleSide,
            uniforms: {
              time: { value: 0 },
              resolution: { value: new THREE.Vector4() },
            },
            // wireframe: true,
            // transparent: true,
            vertexShader: vertex,
            fragmentShader: fragment
        });


        const plane = new THREE.Mesh(geometry, material);

	
		//mesh.position.set(0.7,-0.6,1);
		/*mesh.scale.set(2,0.25,0.25);

		///rotation
		mesh.rotation.reorder('YXZ');
		mesh.rotation.y = Math.PI * 0.25;
		mesh.rotation.x = Math.PI * 0.25;
	*/
		this.plane = plane;
		this.scene.add(plane);
	}	

    /**
	|
	| addObject
	|-------
	*/
    addObjects() {
        let that = this;
        this.material = new THREE.ShaderMaterial({
          extensions: {
            derivatives: "#extension GL_OES_standard_derivatives : enable"
          },
          side: THREE.DoubleSide,
          uniforms: {
            time: { value: 0 },
            resolution: { value: new THREE.Vector4() },
          },
          // wireframe: true,
          // transparent: true,
          vertexShader: vertex,
          fragmentShader: fragment
        });
    
        this.geometry = new THREE.PlaneGeometry(1, 1, 1, 1);
    
        this.plane = new THREE.Mesh(this.geometry, this.material);
        this.scene.add(this.plane);
      }

 
  

     /*
	|
	|	setup Camera
	|_____________
	|
	*/
    setupCamera(){
		const camera = new THREE.PerspectiveCamera(100, this.sizes.width / this.sizes.height);
		//const camera = new THREE.OrthographicCamera(-1 * this.aspectRadio ,1 * this.aspectRadio ,1,-1);

		//camera.position.y = 17.5;
		camera.position.z = 21;

		this.camera = camera;
		this.scene.add(this.camera);
	}

    /*
	|
	|	Init Renderer scene
	|_____________
	|
	*/
	initRendererScene(){
		const renderer = new THREE.WebGLRenderer({
			alpha: true,
		    canvas: this.canvas
		});
		this.renderer = renderer;
	}

    /*
	|
	|	Renderer scene
	|_____________
	|
	*/
	rendererScene(){
		this.renderer.setSize(this.sizes.width, this.sizes.height);
		this.renderer.render(this.scene, this.camera);
		this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
	}
    
     /*
	|
	|	setup resize
	|_____________
	|
	*/
	setupResize(){
		window.addEventListener('resize', this.resize.bind(this));
	}

     /*
	|
	|	resize
	|_____________
	|
	*/
    resize(){
        this.setSize();
        this.setCameraAspect();
        this.rendererScene();
    }

    /*
	|
	|	Update camera
	|_____________
	|
	*/
	setCameraAspect(){
		// Update camera
	    this.camera.aspect = this.sizes.width / this.sizes.height;
	    this.camera.updateProjectionMatrix();

	}

    /*
	|
	|	Update Sizes windows
	|_____________
	|
	*/
	setSize(){
		this.sizes.width  = window.innerWidth;
		this.sizes.height = window.innerHeight;
	}

    /*
	|
	|	CONTROL camera
	|_____________
	|
	*/
	initOrbitControls(){
		this.controls = new OrbitControls(this.camera, this.canvas);
		//this.controls.enableZoom = false;
		this.controls.enableDamping = true;
	}


	/*
	|
	|	renderloop ANimationFrame 
	|_____________
	|
	*/
	renderloop(){

		let elaspedTime = this.clock.getElapsedTime();
		//console.log('tick');
		//console.log(elaspedTime);
		//this.mesh.rotation.y = elaspedTime;	
		//this.mesh.position.y = Math.sin(elaspedTime);
		//this.mesh.position.x = Math.cos(elaspedTime);

		//this.camera.position.y = Math.sin(elaspedTime);
		//this.camera.position.x = Math.cos(elaspedTime);
		//this.positionCamera(this.mesh.position);


		// this.camera.position.x = Math.sin(this.cursor.x * Math.PI * 2 ) * 3 ;
		// this.camera.position.z = Math.cos(this.cursor.x * Math.PI * 2 ) * 3 ;
		// this.camera.position.y = this.cursor.y * 5;

		//this.camera.position.set(this.cursor.x * 10,this.cursor.y * 10);

    	this.controls.update();

		this.camera.lookAt(this.plane.position); // or lesh
    	// Render
		this.renderer.render(this.scene, this.camera);
    	// Call renderloop again on the next frame
		window.requestAnimationFrame(this.renderloop.bind(this));
	}

	/*
	|
	|	Add Helper
	|_____________
	|
	*/
	addHelper(){
		const axesHelper = new THREE.AxesHelper(20);
		this.scene.add( axesHelper );
	}

	
}

export default Sketch;