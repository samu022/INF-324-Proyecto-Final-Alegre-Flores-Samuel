// primer ejercicio con three.js
// crear una geometria teniendo en cuenta el orden de los vértices
var camera, scene, renderer;
var cameraControls;
var clock = new THREE.Clock();
var ambientLight, light;


function init() {
	var canvasWidth = window.innerWidth * 0.9;
	var canvasHeight = window.innerHeight * 0.9;

	// CAMERA

	/*camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 1, 80000 );
	camera.position.set(-1,1,3);
	camera.lookAt(0,0,0);*/
	camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 1, 80000 );
camera.position.set(3, 1, 1); // Ajusta la posición de la cámara
camera.up.set(0, 0, 1); // Cambia la dirección del eje Y

camera.lookAt(0, 0, 0); // Apunta la cámara hacia el origen

	// LIGHTS

	light = new THREE.DirectionalLight( 0xFFFFFF, 0.7 );
	light.position.set( 1, 1, 1 );
	light.target.position.set(0, 0, 0);
	light.target.updateMatrixWorld()

	var ambientLight = new THREE.AmbientLight( 0x111111 );

	// RENDERER
	renderer = new THREE.WebGLRenderer( { antialias: true } );
	renderer.setSize( canvasWidth, canvasHeight );
	renderer.setClearColor( 0xAAAAAA, 1.0 );

	renderer.gammaInput = true;
	renderer.gammaOutput = true;

	// Add to DOM
	var container = document.getElementById('container');
	container.appendChild( renderer.domElement );

	// CONTROLS
	/*cameraControls = new THREE.OrbitControls( camera, renderer.domElement );
	cameraControls.target.set(0, 0, 0);*/

	// CONTROLS
	cameraControls = new THREE.OrbitControls( camera, renderer.domElement );
	cameraControls.target.set(0, 0, 0);
	cameraControls.enableRotate = false; // Desactiva la rotación de la cámara con el mouse
	cameraControls.rotateSpeed = 0.5; // Ajusta la velocidad de rotación de la cámara

	// OBJECT1
	
    
        var migeometria = new THREE.Geometry();
	migeometria.vertices.push(new THREE.Vector3(0, -1, 0));   // Esquina fondo izquierda base 0
	migeometria.vertices.push(new THREE.Vector3(0, 0.81, 0));   // Esquina fondo derecha base 1
	migeometria.vertices.push(new THREE.Vector3(1, -1, 0));   // Esquina delante izquierda base 2
	migeometria.vertices.push(new THREE.Vector3(1, 0.81, 0));   // Esquina delante derecha base 3

	migeometria.vertices.push(new THREE.Vector3(0, -1, 0.05));   // Esquina fondo izquierda superior base 4
	migeometria.vertices.push(new THREE.Vector3(0, 0.81, 0.05));   // Esquina fondo derecha superior base 5
	migeometria.vertices.push(new THREE.Vector3(1, -1, 0.05));   // Esquina delante izquierda superior base 6
	migeometria.vertices.push(new THREE.Vector3(1, 0.81, 0.05));   // Esquina delante derecha superior base 7
	

	/*base al fondo*/
	migeometria.faces.push( new THREE.Face3( 1,2,0) );
	migeometria.faces.push( new THREE.Face3( 1,3,2 ) );
	/*base superior*/
	migeometria.faces.push( new THREE.Face3( 4, 6, 5 ) );
	migeometria.faces.push( new THREE.Face3( 6, 7, 5 ) );
	/*lado izquierdo base*/
	migeometria.faces.push( new THREE.Face3( 2,6,4 ) );
	migeometria.faces.push( new THREE.Face3( 4,0,2 ) );
	/*lado derecho base*/
	migeometria.faces.push( new THREE.Face3( 5,7,3 ) );
	migeometria.faces.push( new THREE.Face3( 5, 3,1 ) );

	/*atras base lado*/
	migeometria.faces.push( new THREE.Face3( 5,0,4 ) );
	migeometria.faces.push( new THREE.Face3( 5,1,0 ) );
	/* delante base lado*/
	migeometria.faces.push( new THREE.Face3(2,7,6 ) );
	migeometria.faces.push( new THREE.Face3( 2,3,7 ) );

	

	
    
    var material = new THREE.MeshBasicMaterial( { color: 0x333333 } ); // Material de color plomo claro
    var miobjeto = new THREE.Mesh (migeometria, material); // Crea el objeto
	
	// SCENE

	scene = new THREE.Scene();
	scene.add( light );
	scene.add( ambientLight );

	scene.add( miobjeto );


	// OBJECT1
	
    
        var migeometria1 = new THREE.Geometry();
	migeometria1.vertices.push(new THREE.Vector3(-0.05, -1, 0));   // Esquina fondo izquierda pantalla 0
	migeometria1.vertices.push(new THREE.Vector3(-0.05, 0.81, 0));   // Esquina fondo derecha pantalla 1
	migeometria1.vertices.push(new THREE.Vector3(0, -1, 0));   // Esquina delante izquierda pantalla 2
	migeometria1.vertices.push(new THREE.Vector3(0, 0.81, 0));   // Esquina delante derecha pantalla 3

	migeometria1.vertices.push(new THREE.Vector3(-0.05, -1, 1));   // Esquina fondo izquierda superior pantalla 4
	migeometria1.vertices.push(new THREE.Vector3(-0.05, 0.81, 1));   // Esquina fondo derecha superior pantalla 5
	migeometria1.vertices.push(new THREE.Vector3(0, -1, 1));   // Esquina delante izquierda superior pantalla 6
	migeometria1.vertices.push(new THREE.Vector3(0, 0.81, 1));   // Esquina delante derecha superior pantalla 7
	
/******************************ERROR************************************/
	/*base al fondo*/
	migeometria1.faces.push( new THREE.Face3( 0,1,2 ) );
	migeometria1.faces.push( new THREE.Face3( 1,3,2 ) );
	/*base superior*/
	migeometria1.faces.push( new THREE.Face3( 4, 6, 5 ) );
	migeometria1.faces.push( new THREE.Face3( 6, 7, 5 ) );
	/*lado izquierdo base*/
	migeometria1.faces.push( new THREE.Face3( 2,6,4 ) );
	migeometria1.faces.push( new THREE.Face3( 4,0,2 ) );
	/*lado derecho base*/
	migeometria1.faces.push( new THREE.Face3( 5,7,3 ) );
	migeometria1.faces.push( new THREE.Face3( 5, 3,1 ) );

	/*atras base lado*/
	migeometria1.faces.push( new THREE.Face3( 5,0,4 ) );
	migeometria1.faces.push( new THREE.Face3( 5,1,0 ) );
	/* delante base lado*/
	migeometria1.faces.push( new THREE.Face3(2,7,6 ) );
	migeometria1.faces.push( new THREE.Face3( 2,3,7 ) );

	

	
    
    var material = new THREE.MeshBasicMaterial( { color: 0x222222 } ); // Material de color plomo oscuro
    var miobjeto2 = new THREE.Mesh (migeometria1, material); // Crea el objeto
	
		// SCENE
	
	scene.add(miobjeto2);

	// OBJECT2 pantalla
	var migeometria2 = new THREE.Geometry();
	migeometria2.vertices.push(new THREE.Vector3(0.001, -0.91, 0.85));   // Esquina izquierda inferior 0
	migeometria2.vertices.push(new THREE.Vector3(0.001, 0.71, 0.85));   // Esquina derecha inferior 1
	migeometria2.vertices.push(new THREE.Vector3(0.001, -0.91, 0.15));   // Esquina izquierda superior 2
	migeometria2.vertices.push(new THREE.Vector3(0.001, 0.71, 0.15));   // Esquina derecha superior 3

	migeometria2.faces.push(new THREE.Face3(2, 1, 0));
	migeometria2.faces.push(new THREE.Face3(3,1,2));

	var material = new THREE.MeshBasicMaterial({ color: 0x000000 }); // Material de color negro
	var miobjeto3 = new THREE.Mesh(migeometria2, material); // Crea el objeto

	// SCENE
	scene.add(miobjeto3);
//puerto usb1
	var migeometriau1 = new THREE.Geometry();
	migeometriau1.vertices.push(new THREE.Vector3(0.1, 0.815, 0.045));   // Esquina izquierda inferior 0
	migeometriau1.vertices.push(new THREE.Vector3(0.175, 0.815, 0.045));   // Esquina derecha inferior 1
	migeometriau1.vertices.push(new THREE.Vector3(0.1, 0.815, 0.01));   // Esquina izquierda superior 2
	migeometriau1.vertices.push(new THREE.Vector3(0.175, 0.815, 0.01));   // Esquina derecha superior 3
	migeometriau1.faces.push(new THREE.Face3(0,1,2));
	migeometriau1.faces.push(new THREE.Face3(2,1,3));

	var material = new THREE.MeshBasicMaterial({ color: 0x000000 }); // Material de color negro
	var miobjetou1 = new THREE.Mesh(migeometriau1, material); // Crea el objeto
// SCENE
	scene.add(miobjetou1);
	

	//puerto usb2
	var migeometriau = new THREE.Geometry();
	migeometriau.vertices.push(new THREE.Vector3(0.2, 0.815, 0.045));   // Esquina izquierda inferior 0
	migeometriau.vertices.push(new THREE.Vector3(0.275, 0.815, 0.045));   // Esquina derecha inferior 1
	migeometriau.vertices.push(new THREE.Vector3(0.2, 0.815, 0.01));   // Esquina izquierda superior 2
	migeometriau.vertices.push(new THREE.Vector3(0.275, 0.815, 0.01));   // Esquina derecha superior 3
	migeometriau.faces.push(new THREE.Face3(0,1,2));
	migeometriau.faces.push(new THREE.Face3(2,1,3));

	var material = new THREE.MeshBasicMaterial({ color: 0x000000 }); // Material de color negro
	var miobjetou = new THREE.Mesh(migeometriau, material); // Crea el objeto
	// SCENE
	scene.add(miobjetou);

	//puerto desc
	var migeometriadesc = new THREE.Geometry();
	migeometriadesc.vertices.push(new THREE.Vector3(0.3, 0.815, 0.035));   // Esquina izquierda inferior 0
	migeometriadesc.vertices.push(new THREE.Vector3(0.335, 0.815, 0.035));   // Esquina derecha inferior 1
	migeometriadesc.vertices.push(new THREE.Vector3(0.3, 0.815, 0.02));   // Esquina izquierda superior 2
	migeometriadesc.vertices.push(new THREE.Vector3(0.335, 0.815, 0.02));   // Esquina derecha superior 3
	migeometriadesc.faces.push(new THREE.Face3(0,1,2));
	migeometriadesc.faces.push(new THREE.Face3(2,1,3));

	var material = new THREE.MeshBasicMaterial({ color: 0x000000 }); // Material de color negro
	var miobjetodesc = new THREE.Mesh(migeometriadesc, material); // Crea el objeto
	// SCENE
	scene.add(miobjetodesc);

	//puerto SD
	var migeometriaSD = new THREE.Geometry();
	migeometriaSD.vertices.push(new THREE.Vector3(0.6, 0.815, 0.032));   // Esquina izquierda inferior 0
	migeometriaSD.vertices.push(new THREE.Vector3(0.75, 0.815, 0.032));   // Esquina derecha inferior 1
	migeometriaSD.vertices.push(new THREE.Vector3(0.6, 0.815, 0.022));   // Esquina izquierda superior 2
	migeometriaSD.vertices.push(new THREE.Vector3(0.75, 0.815, 0.022));   // Esquina derecha superior 3
	migeometriaSD.faces.push(new THREE.Face3(0,1,2));
	migeometriaSD.faces.push(new THREE.Face3(2,1,3));

	var material = new THREE.MeshBasicMaterial({ color: 0x000000 }); // Material de color negro
	var miobjetoSD = new THREE.Mesh(migeometriaSD, material); // Crea el objeto
	// SCENE
	scene.add(miobjetoSD);

	//entrada cargador
	// Crear la geometría del círculo
	var radio = 0.015; // Radio del círculo
	var segmentos = 32; // Número de segmentos del círculo
	var geometriaCirculo = new THREE.CircleGeometry(radio, segmentos);

	// Crear el material del círculo
	var materialCirculo = new THREE.MeshBasicMaterial({ color: 0x000000 }); // Material de color negro

	// Crear el objeto del círculo
	var objetoCirculo = new THREE.Mesh(geometriaCirculo, materialCirculo);
	// Girar el círculo 90 grados en el eje Y
	//objetoCirculo.rotation.y = Math.PI / 2;
	objetoCirculo.rotation.x = -Math.PI / 2;
	

	// Posicionar el círculo en la escena
	objetoCirculo.position.set(0.025, 0.811, 0.025); // Ajusta las coordenadas según tus necesidades

	// Agregar el círculo a la escena
	scene.add(objetoCirculo);


	//entrada audifono
	// Crear la geometría del círculo
	var radio = 0.01; // Radio del círculo
	var segmentos = 32; // Número de segmentos del círculo
	var geometriaCirculo = new THREE.CircleGeometry(radio, segmentos);

	// Crear el material del círculo
	var materialCirculo = new THREE.MeshBasicMaterial({ color: 0x000000 }); // Material de color negro

	// Crear el objeto del círculo
	var objetoCirculo = new THREE.Mesh(geometriaCirculo, materialCirculo);
	// Girar el círculo 90 grados en el eje Y
	//objetoCirculo.rotation.y = Math.PI / 2;
	objetoCirculo.rotation.x = Math.PI / 2;
	

	// Posicionar el círculo en la escena
	objetoCirculo.position.set(0.68, -1.00001, 0.025); // Ajusta las coordenadas según tus necesidades

	// Agregar el círculo a la escena
	scene.add(objetoCirculo);

	
	//puerto HDMI1
	var migeometriaHDMI = new THREE.Geometry();
	migeometriaHDMI.vertices.push(new THREE.Vector3(0.03, -1.005, 0.042));   // Esquina izquierda inferior 0
	migeometriaHDMI.vertices.push(new THREE.Vector3(0.11, -1.005, 0.042));   // Esquina derecha inferior 1
	migeometriaHDMI.vertices.push(new THREE.Vector3(0.03, -1.005, 0.022));   // Esquina izquierda superior 2
	migeometriaHDMI.vertices.push(new THREE.Vector3(0.11, -1.005, 0.022));   // Esquina derecha superior 3
	migeometriaHDMI.faces.push(new THREE.Face3(2,1,0));
	migeometriaHDMI.faces.push(new THREE.Face3(3,1,2));

	var material = new THREE.MeshBasicMaterial({ color: 0x000000 }); // Material de color negro
	var miobjetoHDMI = new THREE.Mesh(migeometriaHDMI, material); // Crea el objeto
	// SCENE
	scene.add(miobjetoHDMI);

	//puerto HDMI2
	var migeometriaHDMI2 = new THREE.Geometry();
	migeometriaHDMI2.vertices.push(new THREE.Vector3(0.05, -1.005, 0.02199));   // Esquina izquierda inferior 0
	migeometriaHDMI2.vertices.push(new THREE.Vector3(0.09, -1.005, 0.02199));   // Esquina derecha inferior 1
	migeometriaHDMI2.vertices.push(new THREE.Vector3(0.05, -1.005, 0.017));   // Esquina izquierda superior 2
	migeometriaHDMI2.vertices.push(new THREE.Vector3(0.09, -1.005, 0.017));   // Esquina derecha superior 3
	migeometriaHDMI2.faces.push(new THREE.Face3(2,1,0));
	migeometriaHDMI2.faces.push(new THREE.Face3(3,1,2));

	var material = new THREE.MeshBasicMaterial({ color: 0x000000 }); // Material de color negro
	var miobjetoHDMI2 = new THREE.Mesh(migeometriaHDMI2, material); // Crea el objeto
	// SCENE
	scene.add(miobjetoHDMI2);


	//puerto LAN
	var migeometriaLAN = new THREE.Geometry();
	migeometriaLAN.vertices.push(new THREE.Vector3(0.14, -1.005, 0.042));   // Esquina izquierda inferior 0
	migeometriaLAN.vertices.push(new THREE.Vector3(0.20, -1.005, 0.042));   // Esquina derecha inferior 1
	migeometriaLAN.vertices.push(new THREE.Vector3(0.14, -1.005, 0.022));   // Esquina izquierda superior 2
	migeometriaLAN.vertices.push(new THREE.Vector3(0.20, -1.005, 0.022));   // Esquina derecha superior 3
	migeometriaLAN.faces.push(new THREE.Face3(2,1,0));
	migeometriaLAN.faces.push(new THREE.Face3(3,1,2));

	var material = new THREE.MeshBasicMaterial({ color: 0x000000 }); // Material de color negro
	var miobjetoLAN = new THREE.Mesh(migeometriaLAN, material); // Crea el objeto
	// SCENE
	scene.add(miobjetoLAN);

	//puerto LAN2
	var migeometriaLAN2 = new THREE.Geometry();
	migeometriaLAN2.vertices.push(new THREE.Vector3(0.15, -1.005, 0.02199));   // Esquina izquierda inferior 0
	migeometriaLAN2.vertices.push(new THREE.Vector3(0.19, -1.005, 0.02199));   // Esquina derecha inferior 1
	migeometriaLAN2.vertices.push(new THREE.Vector3(0.15, -1.005, 0.014));   // Esquina izquierda superior 2
	migeometriaLAN2.vertices.push(new THREE.Vector3(0.19, -1.005, 0.014));   // Esquina derecha superior 3
	migeometriaLAN2.faces.push(new THREE.Face3(2,1,0));
	migeometriaLAN2.faces.push(new THREE.Face3(3,1,2));

	var material = new THREE.MeshBasicMaterial({ color: 0x000000 }); // Material de color negro
	var miobjetoLAN2 = new THREE.Mesh(migeometriaLAN2, material); // Crea el objeto
	// SCENE
	scene.add(miobjetoLAN2);

	//puerto LAN3
	var migeometriaLAN3 = new THREE.Geometry();
	migeometriaLAN3.vertices.push(new THREE.Vector3(0.16, -1.005, 0.01399));   // Esquina izquierda inferior 0
	migeometriaLAN3.vertices.push(new THREE.Vector3(0.18, -1.005, 0.01399));   // Esquina derecha inferior 1
	migeometriaLAN3.vertices.push(new THREE.Vector3(0.16, -1.005, 0.001));   // Esquina izquierda superior 2
	migeometriaLAN3.vertices.push(new THREE.Vector3(0.18, -1.005, 0.001));   // Esquina derecha superior 3
	migeometriaLAN3.faces.push(new THREE.Face3(2,1,0));
	migeometriaLAN3.faces.push(new THREE.Face3(3,1,2));

	var material = new THREE.MeshBasicMaterial({ color: 0x000000 }); // Material de color negro
	var miobjetoLAN3 = new THREE.Mesh(migeometriaLAN3, material); // Crea el objeto
	// SCENE
	scene.add(miobjetoLAN3);


	//puerto share
	var migeometriashare = new THREE.Geometry();
	migeometriashare.vertices.push(new THREE.Vector3(0.23, -1.005, 0.033));   // Esquina izquierda inferior 0
	migeometriashare.vertices.push(new THREE.Vector3(0.26, -1.005, 0.033));   // Esquina derecha inferior 1
	migeometriashare.vertices.push(new THREE.Vector3(0.23, -1.005, 0.022));   // Esquina izquierda superior 2
	migeometriashare.vertices.push(new THREE.Vector3(0.26, -1.005, 0.022));   // Esquina derecha superior 3
	migeometriashare.faces.push(new THREE.Face3(2,1,0));
	migeometriashare.faces.push(new THREE.Face3(3,1,2));

	var material = new THREE.MeshBasicMaterial({ color: 0x000000 }); // Material de color negro
	var miobjetoshare = new THREE.Mesh(migeometriashare, material); // Crea el objeto
	// SCENE
	scene.add(miobjetoshare);
	
	// OBJECT2 camara
	var migeometria3 = new THREE.Geometry();
	migeometria3.vertices.push(new THREE.Vector3(0.001, -0.25, 0.95));   // Esquina izquierda inferior 0
	migeometria3.vertices.push(new THREE.Vector3(0.001, 0.1, 0.95));   // Esquina derecha inferior 1
	migeometria3.vertices.push(new THREE.Vector3(0.001, -0.25, 0.9));   // Esquina izquierda superior 2
	migeometria3.vertices.push(new THREE.Vector3(0.001, 0.1, 0.9));   // Esquina derecha superior 3

	migeometria3.faces.push(new THREE.Face3(2, 1, 0));
	migeometria3.faces.push(new THREE.Face3(3,1,2));

	var material = new THREE.MeshBasicMaterial({ color: 0x000000 }); // Material de color negro
	var miobjeto4 = new THREE.Mesh(migeometria3, material); // Crea el objeto

	// SCENE
	scene.add(miobjeto4);
	
	// OBJECT2 lente camara
	var migeometria4 = new THREE.Geometry();
	migeometria4.vertices.push(new THREE.Vector3(0.001, -0.1, 0.94));   // Esquina izquierda inferior 0
	migeometria4.vertices.push(new THREE.Vector3(0.001, -0.05, 0.94));   // Esquina derecha inferior 1
	migeometria4.vertices.push(new THREE.Vector3(0.001, -0.1, 0.91));   // Esquina izquierda superior 2
	migeometria4.vertices.push(new THREE.Vector3(0.001, -0.05, 0.91));   // Esquina derecha superior 3

	migeometria4.faces.push(new THREE.Face3(2, 1, 0));
	migeometria4.faces.push(new THREE.Face3(3,1,2));

	var material = new THREE.MeshBasicMaterial({ color: 0xFFFFFF }); // Material de color negro
	var miobjeto5 = new THREE.Mesh(migeometria4, material); // Crea el objeto

	// SCENE
	scene.add(miobjeto5);

	
    
    var material = new THREE.MeshBasicMaterial( { color: 0x000000 } ); // Material de color negro
    var miobjeto3 = new THREE.Mesh (migeometria2, material); // Crea el objeto
	
		// SCENE
	
	scene.add(miobjeto3);






// OBJECT mesa
	
    
        var migeometria5 = new THREE.Geometry();
	migeometria5.vertices.push(new THREE.Vector3(-1, -2, -0.25));   // Esquina fondo izquierda mesa 0
	migeometria5.vertices.push(new THREE.Vector3(-1, 2, -0.25));   // Esquina fondo derecha mesa 1
	migeometria5.vertices.push(new THREE.Vector3(1, -2, -0.25));   // Esquina delante izquierda mesa 2
	migeometria5.vertices.push(new THREE.Vector3(1, 2, -0.25));   // Esquina delante derecha mesa 3

	migeometria5.vertices.push(new THREE.Vector3(-1, -2, 0));   // Esquina fondo izquierda superior mesa 4
	migeometria5.vertices.push(new THREE.Vector3(-1, 2, 0));   // Esquina fondo derecha superior mesa 5
	migeometria5.vertices.push(new THREE.Vector3(1, -2, 0));   // Esquina delante izquierda superior mesa 6
	migeometria5.vertices.push(new THREE.Vector3(1, 2, 0));   // Esquina delante derecha superior mesa 7
	
/******************************ERROR************************************/
	/*base al fondo*/
	migeometria5.faces.push( new THREE.Face3( 0,1,2 ) );
	migeometria5.faces.push( new THREE.Face3( 1,3,2 ) );
	/*base superior*/
	migeometria5.faces.push( new THREE.Face3( 4, 6, 5 ) );
	migeometria5.faces.push( new THREE.Face3( 6, 7, 5 ) );
	/*lado izquierdo base*/
	migeometria5.faces.push( new THREE.Face3( 2,6,4 ) );
	migeometria5.faces.push( new THREE.Face3( 4,0,2 ) );
	/*lado derecho base*/
	migeometria5.faces.push( new THREE.Face3( 5,7,3 ) );
	migeometria5.faces.push( new THREE.Face3( 5, 3,1 ) );

	/*atras base lado*/
	migeometria5.faces.push( new THREE.Face3( 5,0,4 ) );
	migeometria5.faces.push( new THREE.Face3( 5,1,0 ) );
	/* delante base lado*/
	migeometria5.faces.push( new THREE.Face3(2,7,6 ) );
	migeometria5.faces.push( new THREE.Face3( 2,3,7 ) );

	

	
    
    var material = new THREE.MeshBasicMaterial( { color: 0x4B2600 } ); // Material de color cafe oscuro
    var miobjeto6 = new THREE.Mesh (migeometria5, material); // Crea el objeto
    scene.add(miobjeto6);

	var aux=0;
	for (var i = 0; i < 14; i++) {
			tecla_fila1(0.20,-0.90+(i*0.09),0.06);  //0.099
			aux=(-0.90+(i*0.09));
	}
	aux=aux+0.19;
	//las otras 4
	for (var i = 0; i < 4; i++) {
			tecla_fila1(0.20,aux+(i*0.09),0.06);
		
		
	}
	//Para fila 2

	tecla_barra(0.29,-0.92,0.06);
	var y=0;
	//tecla normales hasta el borrado
	for (var i = 0; i < 12; i++) {

			tecla_fila2(0.29,-0.85+(i*0.085),0.06);
			y=-0.90+(i*0.09);
	}
	tecla_delete(0.29, y+0.14, 0.06);
	y=y+0.14+0.24;
	//tecla normales hasta el borrado
	for (var i = 0; i < 4; i++) {

			tecla_fila2(0.29, y+(i*0.09),0.06);
			
	}
	tecla_tab(0.38, -0.885, 0.06);
	//tecla normales hasta el ]
	y=0;
	for (var i = 0; i < 12; i++) {

			tecla_fila2(0.38, -0.86+(i*0.09),0.06);
			y=-0.90+(i*0.09);
			
	}
	tecla_corchete(0.38, y+0.15, 0.06 );
	y=y+0.375;
	//continuamos en fila 3
	for (var i = 0; i < 4; i++) {
		if(i!=3){
			tecla_fila2(0.38, y+(i*0.09),0.06);
		}else{

			tecla_mas(0.43,y+(i*0.09),0.06 );
		}
	}
	//fila 4
	y=0;
	tecla_mayus(0.47, -0.88, 0.060);
	//continuamos en fila 4
	for (var i = 0; i < 11; i++) {
		
		tecla_fila2(0.47, -0.86+(i*0.09),0.06);
		y=-0.90+(i*0.09);
		
	}
	tecla_enter(0.47, y+0.205, 0.06 );
	//las otras 3 teclas del numerico
	y=y+0.46;
	for (var i = 0; i < 3; i++) {
		
		tecla_fila2(0.47, y+(i*0.09),0.06);
		
	}
	//teclas 5 linea
	y=0;
	tecla_shift(0.56, -0.865, 0.060);
	//las otras
	//continuamos en fila 5
	for (var i = 0; i < 10; i++) {
		
		tecla_fila2(0.56, -0.75+(i*0.085),0.06);
		y=-0.90+(i*0.09);
		
	}
	y=y+0.29;
	tecla_shift2(0.56, y, 0.060);
	//otras 3 teclas numerico
	//las otras 3 teclas del numerico
	y=y+0.255;
	for (var i = 0; i < 4; i++) {
		if(i!=3){
			tecla_fila2(0.56, y+(i*0.09),0.06);
		}else{
			tecla_mas(0.61, y+(i*0.09),0.06);
		}
		
		
	}
	//ultima linea
	y=0;
	for (var i = 0; i < 4; i++) {
		
		tecla_fila2(0.65, -0.91+(i*0.085),0.06);
		y=-0.90+(i*0.09);
		
	}
	//espace
	tecla_espace(0.65, y+0.22, 0.06);
	//las restantes
	y=y+0.45;
	for (var i = 0; i < 6; i++) {
		if(i!=3){
			tecla_fila2(0.65, y+(i*0.09),0.06);
		}else{
			tecla_arriba(0.635, y+(i*0.09),0.06);
			tecla_abajo(0.665, y+(i*0.09),0.06);
		}
		
		
	}
	//los ultimos 3
	//las otras 3 teclas del numerico

	y=y+0.635;

	tecla_cero(0.65, y+0.055, 0.06)
	for (var i = 0; i < 3; i++) {
			tecla_fila2(0.65, y+(i*0.09),0.06);
		
	}
	//colocamos touchpad
	touchpad(0.82, -0.38, 0.051);
	//colocamos la etiqueta
	etiqueta_grande(0.84, 0.18, 0.051);
	//etiqueta ryzen
	etiqueta_pequena_ryzen(0.83, 0.7, 0.051)
	//etiquetaradeon
	etiqueta_pequena_radeon(0.895, 0.7, 0.051)

	//colocamos pata a la mesa
	pata_mesa(0.8,-1.8,-1)
	pata_mesa(-0.8,-1.8,-1)
	pata_mesa(0.8,1.8,-1)
	pata_mesa(-0.8,1.8,-1)
}

//tecla standar

function tecla_fila1(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.025, 0.065, 0.025);
  var material = new THREE.MeshBasicMaterial({ color: 0x000000 });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}


function tecla_fila2(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.050, 0.050, 0.050);
  var material = new THREE.MeshBasicMaterial({ color: 0x000000 });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}



function tecla_barra(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.050, 0.030, 0.050);
  var material = new THREE.MeshBasicMaterial({ color: 0x000000 });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}

function tecla_delete(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.060, 0.15, 0.050);
  var material = new THREE.MeshBasicMaterial({ color: 0x000000 });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}

function tecla_cero(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.060, 0.16, 0.050);
  var material = new THREE.MeshBasicMaterial({ color: 0x000000 });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}

function tecla_corchete(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.050, 0.12, 0.050);
  var material = new THREE.MeshBasicMaterial({ color: 0x000000 });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}

function tecla_tab(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.060, 0.1, 0.050);
  var material = new THREE.MeshBasicMaterial({ color: 0x000000 });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}

function tecla_mayus(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.060, 0.12, 0.050);
  var material = new THREE.MeshBasicMaterial({ color: 0x000000 });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}

function tecla_mas(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.15, 0.050, 0.050);
  var material = new THREE.MeshBasicMaterial({ color: 0x000000 });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}

function tecla_enter(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.050, 0.18, 0.050);
  var material = new THREE.MeshBasicMaterial({ color: 0x000000 });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}

function tecla_shift(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.050, 0.145, 0.050);
  var material = new THREE.MeshBasicMaterial({ color: 0x000000 });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}

function tecla_shift2(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.050, 0.19, 0.050);
  var material = new THREE.MeshBasicMaterial({ color: 0x000000 });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}

function tecla_espace(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.050, 0.38, 0.050);
  var material = new THREE.MeshBasicMaterial({ color: 0x000000 });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}

function tecla_arriba(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.024, 0.050, 0.050);
  var material = new THREE.MeshBasicMaterial({ color: 0x000000 });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}

function tecla_abajo(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.024, 0.050, 0.050);
  var material = new THREE.MeshBasicMaterial({ color: 0x000000 });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}

function touchpad(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.20, 0.45, 0.025);
  var material = new THREE.MeshBasicMaterial({ color: 0x111111 });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}

function etiqueta_grande(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.13, 0.30, 0.025);
  var material = new THREE.MeshBasicMaterial({ color: 0xFFFFFF });
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}

function etiqueta_pequena_ryzen(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.05, 0.08, 0.025);
  var material = new THREE.MeshBasicMaterial({ color: 0xFFA500 }); //naranja
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}
function etiqueta_pequena_radeon(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.05, 0.08, 0.025);
  var material = new THREE.MeshBasicMaterial({ color: 0xFF0000 }); //naranja
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}


function pata_mesa(x, y, z) {
  var migeometria = new THREE.BoxGeometry(0.2, 0.2, -1.5);
  var material = new THREE.MeshBasicMaterial({ color: 0x4B2600 }); //naranja
  var miobjeto = new THREE.Mesh(migeometria, material);

  miobjeto.position.set(x - 0.01, y, z);

  scene.add(miobjeto);
}

function animate() {
	window.requestAnimationFrame( animate );
	render();
}

function render() {
	var delta = clock.getDelta();
	cameraControls.update(delta);
	renderer.render( scene, camera );
}

try {
	init();
	animate();
} catch(e) {
	var errorReport = "Your program encountered an unrecoverable error, can not draw on canvas. Error was:<br/><br/>";
	$('#container').append(errorReport+e);
}
