<?php PUBLICPATH ?><!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Our love story</title>
    <meta charset="utf-8">
    <style type="text/css">

        body {
            background-color: #326696;
            margin: 0px;
            overflow: hidden;
            font-family: Monospace;
            font-size: 13px;
            text-align: center;
            font-weight: bold;
            text-align: center;
        }

        a {
            color: #0078ff;
        }

        @font-face {
            font-family: digit;
            src: url('<?php echo PUBLICPATH  ;?>font/digital-7_mono-webfont.eot');
            src: url('<?php echo PUBLICPATH  ;?>font/digital-7_mono-webfont.eot?#iefix') format('embedded-opentype'), url('<?php echo PUBLICPATH  ;?>font/digital-7_mono-webfont.woff') format('woff'), url('<?php echo PUBLICPATH  ;?>font/digital-7_mono-webfont.ttf') format('truetype'), url('<?php echo PUBLICPATH  ;?>font/digital-7_mono-webfont.svg#digital-7mono') format('svg');

        }

        @font-face {
            font-family: enword;
            src: url('<?php echo PUBLICPATH  ;?>font/Note_this.ttf') format("truetype");
        }

        @font-face {
            font-family: cnword;
            src: url('<?php echo PUBLICPATH  ;?>font/senty.ttf') format("truetype"), url('<?php echo PUBLICPATH  ;?>font/senty.eot?#iefix') format('embedded-opentype');
        }

        @font-face {
            font-family: angelina;
            src: url('<?php echo PUBLICPATH  ;?>font/angelina.ttf') format("truetype"), url('<?php echo PUBLICPATH  ;?>font/angelina.eot') format("opentype");
        }
    </style>
    <link rel="shortcut icon" href="http://xiaopihai.duapp.com/theme/images/favicon2.ico">
    <link href="<?php echo PUBLICPATH; ?>css/default_dev.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo PUBLICPATH; ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo PUBLICPATH; ?>js/garden.js"></script>
    <script type="text/javascript" src="<?php echo PUBLICPATH; ?>js/functions_dev.js"></script>
    <script type="text/javascript" src="<?php echo PUBLICPATH; ?>js/console.js"></script>
    <script type="text/javascript" src="<?php echo PUBLICPATH; ?>js/three.min.js"></script>
    <script type="text/javascript" src="<?php echo PUBLICPATH; ?>js/Detector.js"></script>
</head>
<body>
<div id="mainDiv">
    <div id="content">

        <div id="code">
            <span class="comments left"><span class="heart">❤</span>亚瑟和小丫头的故事<span class="heart">❤</span></span>
            <span class="comments left">--By arthurW</span>
            <span class="comments left">对我 你是老天的恩赐 </span>
            <span class="comments left">感谢缘分 让我们的生命 有了交汇</span>
            <span class="comments left">有如一道光 照进了我平淡的生活</span>
            <span class="comments left">于是开始有了期待 有了惊喜 有了满满的幸福</span>
            <span class="comments left">七百二十二公里 不是心的距离 是被拉长的思念</span>
            <span class="comments left">当我终能在你身旁守护 只想把自己最好的给你</span>
            <span class="comments left">只爱世界上独一的那个你 无关其他</span>
            <span class="comments left">义无反顾 是我爱你的情绪</span>
            <span class="comments left">即使有一天被现实打败 遍体凌伤 也不后悔</span>
            <span class="comments left">不曾铭心刻骨 又怎能算真的爱过</span>
            <span class="comments left">惟愿 当容颜老去 依旧能牵手共赏夕阳</span>
            <span class="comments left">...</span>
            <span class="comments left">谨以此文见证我们的爱情。</span>
            <span class="comments right">Oct 16 2013 </span>
        </div>

        <div id="loveHeart">
            <canvas id="garden"></canvas>
            <div id="words">
                <div id="messages">
                    Baby, I have met you for
                    <div id="elapseClock"></div>
                    <div class="loveupersec">The clock rotation for a second.<br/>I will love one more second.</div>

                </div>

                <div id="loveu">

                    Love u forever and ever.<br/>

                    <div class="signature">- ArthurW</div>
                </div>
            </div>
        </div>
    </div>
    <audio id="myaudio" loop>
        <source src="<?php echo PUBLICPATH; ?>sound/click.mp3" type="audio/mpeg"/>
    </audio>
    <div id="copyright">
        <footer>site by &nbsp;&nbsp; arthurW</footer>
    </div>
</div>

<script type="text/javascript">
    var offsetX = $("#loveHeart").width() / 2;
    var offsetY = $("#loveHeart").height() / 2 - 55;
    var together = new Date();
    together.setFullYear(2012, 2, 14);
    together.setHours(19);
    together.setMinutes(0);
    together.setSeconds(0);
    together.setMilliseconds(0);

    if (!document.createElement('canvas').getContext) {
        var msg = document.createElement("div");
        msg.id = "errorMsg";
        msg.innerHTML = "Your browser doesn't support HTML5!<br/>Recommend use Chrome 14+/IE 9+/Firefox 7+/Safari 4+";
        document.body.appendChild(msg);
        $("#code").css("display", "none")
        $("#copyright").css("position", "absolute");
        $("#copyright").css("bottom", "10px");
        document.execCommand("stop");
    } else {
        setTimeout(function () {
            startHeartAnimation();
        }, 1000);

        timeElapse(together);
        setInterval(function () {
            timeElapse(together);
        }, 500);

        adjustCodePosition();
        $("#code").typewriter();
    }

</script>


<script id="vs" type="x-shader/x-vertex">

    varying vec2 vUv;

    void main() {

    vUv = uv;
    gl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );

    }

</script>

<script id="fs" type="x-shader/x-fragment">

    uniform sampler2D map;

    uniform vec3 fogColor;
    uniform float fogNear;
    uniform float fogFar;

    varying vec2 vUv;

    void main() {

    float depth = gl_FragCoord.z / gl_FragCoord.w;
    float fogFactor = smoothstep( fogNear, fogFar, depth );

    gl_FragColor = texture2D( map, vUv );
    gl_FragColor.w *= pow( gl_FragCoord.z, 20.0 );
    gl_FragColor = mix( gl_FragColor, vec4( fogColor, gl_FragColor.w ), fogFactor );

    }

</script>

<script type="text/javascript">

    if (!Detector.webgl) Detector.addGetWebGLMessage();

    var container;
    var camera, scene, renderer;
    var mesh, geometry, material;

    var mouseX = 0, mouseY = 0;
    var start_time = Date.now();

    var windowHalfX = window.innerWidth / 2;
    var windowHalfY = window.innerHeight / 2;

    init();

    function init() {

        container = document.createElement('div');
        container.style.position = 'absolute';
        container.style.top = '0px';
        container.style.zIndex = '-99';
        $('#mainDiv').append(container);

        // Bg gradient

        var canvas = document.createElement('canvas');
        canvas.width = 32;
        canvas.height = window.innerHeight;

        var context = canvas.getContext('2d');

        var gradient = context.createLinearGradient(0, 0, 0, canvas.height);
        gradient.addColorStop(0, "#1e4877");
        gradient.addColorStop(0.5, "#4584b4");

        context.fillStyle = gradient;
        context.fillRect(0, 0, canvas.width, canvas.height);

        container.style.background = 'url(' + canvas.toDataURL('image/png') + ')';
        container.style.backgroundSize = '32px 100%';

        //

        camera = new THREE.PerspectiveCamera(30, window.innerWidth / window.innerHeight, 1, 3000);
        camera.position.z = 6000;

        scene = new THREE.Scene();

        geometry = new THREE.Geometry();

        var texture = THREE.ImageUtils.loadTexture('<?php echo PUBLICPATH  ;?>images/cloud10.png', null, animate);
        texture.magFilter = THREE.LinearMipMapLinearFilter;
        texture.minFilter = THREE.LinearMipMapLinearFilter;

        var fog = new THREE.Fog(0x4584b4, -100, 3000);

        material = new THREE.ShaderMaterial({

            uniforms: {

                "map": { type: "t", value: texture },
                "fogColor": { type: "c", value: fog.color },
                "fogNear": { type: "f", value: fog.near },
                "fogFar": { type: "f", value: fog.far },

            },
            vertexShader: document.getElementById('vs').textContent,
            fragmentShader: document.getElementById('fs').textContent,
            depthWrite: false,
            depthTest: false,
            transparent: true

        });

        var plane = new THREE.Mesh(new THREE.PlaneGeometry(64, 64));

        for (var i = 0; i < 8000; i++) {

            plane.position.x = Math.random() * 1000 - 500;
            plane.position.y = -Math.random() * Math.random() * 200 - 15;
            plane.position.z = i;
            plane.rotation.z = Math.random() * Math.PI;
            plane.scale.x = plane.scale.y = Math.random() * Math.random() * 1.5 + 0.5;

            THREE.GeometryUtils.merge(geometry, plane);

        }

        mesh = new THREE.Mesh(geometry, material);
        scene.add(mesh);

        mesh = new THREE.Mesh(geometry, material);
        mesh.position.z = -8000;
        scene.add(mesh);

        renderer = new THREE.WebGLRenderer({ antialias: false });
        renderer.setSize(window.innerWidth, window.innerHeight);
        container.appendChild(renderer.domElement);

        document.addEventListener('mousemove', onDocumentMouseMove, false);
        window.addEventListener('resize', onWindowResize, false);

    }

    function onDocumentMouseMove(event) {

        mouseX = ( event.clientX - windowHalfX ) * 0.25;
        mouseY = ( event.clientY - windowHalfY ) * 0.15;

    }

    function onWindowResize(event) {

        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();

        renderer.setSize(window.innerWidth, window.innerHeight);

    }

    function animate() {

        requestAnimationFrame(animate);

        position = ( ( Date.now() - start_time ) * 0.03 ) % 8000;

        camera.position.x += ( mouseX - camera.position.x ) * 0.01;
        camera.position.y += ( -mouseY - camera.position.y ) * 0.01;
        camera.position.z = -position + 8000;

        renderer.render(scene, camera);

    }

</script>
</body>
</html>
