import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';


class CustomCanvas {
	/*
	|
	| Constructor
	|--------------
	*/
	constructor($parent, params) {
		this.parent = 	$parent;
		this.wrapper =  $parent.find('.webgl');
		this.canvas = 	this.wrapper[0];
		this.params = [];
		this.params.color 	 	=  params.color ? params.color : 0xffffff ;
		this.params.position 	=  params.position ? params.position : 'bottom' ;

		this.params.height 		=  this.parent.height() ;
		

		this.clock = new THREE.Clock();

		this.controls = true; 
		this.vectorCenter = new THREE.Vector3();

		this.sizes = {
		    width: this.parent.width(),
		    height: this.params.height
		};

		this.cursor = {
		    x: 0,
		    y: 0
		};
		this.aspectRadio = this.sizes.width / this.sizes.height;

		
	   	this.listenMouse();
	   	this.initPositionBufferGeometry();

	   	if (this.positionIsDefined()) {
			this.init();
		}

	}	


	/**
	|
	| Init
	|-------
	*/
    init() {


		this.setScene();

		this.setCamera();


    	this.addGroup();
    	this.positionGroup();

    	//this.addelt();
    	//this.addBuffer();

    	//this.positionCamera(this.group.position);


    	this.initRendererScene();
    	this.rendererScene();

    	//console.log(this.array)


    	if (this.controls) {
			this.addHelper();
	    	this.initOrbitControls();
    		this.renderloop();
	    }

    	this.resizeWindow();

	}

	// FInalement ca sert a rien !
	initPositionBufferGeometry(){

		const side = {
			'largeur': 100,
			'hauteur': 300 
		};

		const defaut = {
			'largeur': 200,
			'hauteur': 50 
		};

		this.nbSizeBuffer = {
			'rightandleft' : side,
			'right' : side,
			'left' : side,
			'bottom' : defaut
		};

	}



	setScene(){
		this.scene  = new THREE.Scene();
	}

	setCamera(){
		const camera = new THREE.PerspectiveCamera(100, this.sizes.width / this.sizes.height);
		//const camera = new THREE.OrthographicCamera(-1 * this.aspectRadio ,1 * this.aspectRadio ,1,-1);

		//camera.position.y = 17.5;
		camera.position.z = 21;

		this.camera = camera;
		this.scene.add(this.camera);
	}



	/*
	|
	|	centerCamera with elt
	|_____________
	|
	*/
	positionCameraElt(postion){
		this.camera.lookAt(postion);
	}


	/*
	|
	|	One Elememnt
	|_____________
	|
	*/
	addelt(){
		const mesh = new THREE.Mesh(
		    new THREE.BoxGeometry(1, 1, 0, 10,10,10),
		    new THREE.MeshBasicMaterial({ color: this.params.color , wireframe: true})
		);

		//mesh.position.set(0.7,-0.6,1);
		/*mesh.scale.set(2,0.25,0.25);

		///rotation
		mesh.rotation.reorder('YXZ');
		mesh.rotation.y = Math.PI * 0.25;
		mesh.rotation.x = Math.PI * 0.25;
	*/
		this.mesh = mesh;
		this.scene.add(mesh);
	}	



	/*
	|
	|	Buffer elt
	|_____________
	|
	*/
	addBuffer(){

		const geometry = new THREE.BufferGeometry();

		const positionsArray = new Float32Array([
		    0, 0, 0, // First vertex
		    0.5, 1, 0, // Second vertex
		    1, 0, 0  // Third vertex
		]);

		const positionsAttribute = new THREE.BufferAttribute(positionsArray, 3);
		geometry.setAttribute('position', positionsAttribute);

		const material 	= new THREE.MeshBasicMaterial({ 
			color: this.params.color , 
			wireframe: true
		});

		const mesh 		= new THREE.Mesh(geometry, material);

		return mesh;

	}


	/*
	|
	|	Groupe elt
	|_____________
	|
	*/
	addGroup(){
		const _this = this;
		const group = new THREE.Group();

		const count = this.nbSizeBuffer[this.params.position].largeur;
		const ligne = this.nbSizeBuffer[this.params.position].hauteur;

		let positionXLine = count * 0.5 * -1;
		let positionYLine = ligne * 0.5 * -1;

		const groupLine = new THREE.Group();
		for (var i = 0; i < count; i++) {

			const mesh 	= _this.addBuffer();

			const geometry  = new THREE.CircleGeometry( 0.12, 32 );
			const material  = new THREE.MeshBasicMaterial( { color: _this.params.color } );
			const circle 	= new THREE.Mesh( geometry, material );

			circle.position.x = i + 0.5;
			circle.position.y = 1 ;
			mesh.position.x = i ;
			groupLine.add(circle);
			groupLine.add(mesh);
		}

		groupLine.position.x = positionXLine;
		groupLine.position.y = positionYLine;

		group.add(groupLine);


		for (var i = 0; i < ligne; i++) {
			const copy = groupLine.clone();
			copy.position.y = positionYLine + i ;
			copy.position.x = ( i % 2 == 0) ? positionXLine + 0 : positionXLine + 0.5;
			//TweenMax.set(copy.position,{x: 0.5});
			group.add(copy);
		}

		//group.up.x = count * 0.5 * -1;
		//group.up.y = ligne * 0.5 * -1;
		//group.position.x = count * 0.5 * -1;
		//group.position.y = ligne * 0.5 * -1;

		this.scene.add(group);

		this.group 	= group;

	}




	/*
	|
	|	centerCamera with elt
	|_____________
	|
	*/
	positionGroup(){

		const group = this.group;
		const camera = this.camera;

		switch	(this.params.position) {
			case 'bottom':
				camera.position.y = 5;
				break;
			case 'right':
				group.rotation.z = Math.PI * 0.5;
				camera.position.x = -20;

				break;
			default:

		}

	}


	/*
	|
	|	Init Renderer scene
	|_____________
	|
	*/
	initRendererScene(){
		const renderer = new THREE.WebGLRenderer({
			//alpha: true,
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

		//renderer.setClearColor( 0x000000, 0 );
	}
	
	/*
	|
	|	mouseMouse
	|_____________
	|
	*/
	listenMouse(){
		var cursor = this.cursor;
		var sizes = this.sizes;

		window.addEventListener('mousemove',function(event){
			cursor.x = - (event.clientX / sizes.width - 0.5 );
			cursor.y = (event.clientY / sizes.height - 0.5);
		});
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

    	this.controls != false ? this.controls.update() : null ;

		this.camera.lookAt(this.group.position); // or lesh

    	// Render
		this.renderer.render(this.scene, this.camera);
    	// Call renderloop again on the next frame
		window.requestAnimationFrame(this.renderloop.bind(this));
	}

	/*
	|
	|	Update Sizes windows
	|_____________
	|
	*/
	setSize(){
		console.log(this.wrapper.width());
		this.sizes.width  = this.parent.width();
		this.sizes.height = this.params.height;
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
	|	Resize windows
	|_____________
	|
	*/
	resizeWindow(){
		var _this = this;
		window.addEventListener('resize', function(){
			_this.setSize();
		    _this.setCameraAspect();
		   	_this.rendererScene();

		});
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




	 /**
    |
    | PositionDefined
    |-------------------
    */
    positionIsDefined() {
        return this.control(this.isDefined(this.nbSizeBuffer[this.params.position]), this.getMessage('positionNotDefined'));
    }


	 /**
	|
	| Helper: isDefined
	|--------------------
	|
	*/
    isDefined(item) {
        return typeof item !== 'undefined';
    }


    /**
    |
    | Helper: control
    |------------------
    */
    control(condition, message, selector = null) {
        if (!condition) {
            if (selector === null) {
                console.error(message);
            } else {
                console.error(message, selector);
            }
        }

        return condition;
    }




	getMessage(messageKey, var1 = '', var2 = '') {
        var messages = {
            'positionNotDefined': 'Position not Defined',
        };

        return 'Canvas: ' + messages[messageKey];
    }

}

export default CustomCanvas;