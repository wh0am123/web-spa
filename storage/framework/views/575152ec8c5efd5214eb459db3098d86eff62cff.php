<?php $__env->startSection('body'); ?>
<style>
  
  @font-face {

    font-family: 'WSansNew-Bold';
    src: url('../fonts/WSansNew-Bold.otf');

  }

  @font-face {

    font-family: 'light';
    src: url('../fonts/light.ttf');

  }

  * {

    font-family: 'WSansNew-Bold';

  }

  li a {

    color: black;

  }

  li a:hover {

    color: #fff;
    text-decoration: none;

  }

  li a:focus {

    color: #fff;
    text-decoration: none;

  }

  img {

    border-radius: 1%;
  }

  .selected {

    color: #fff;

  }

  .img-btn {

    display: block;

  }

  .img-btn:hover {

    cursor: pointer;

  }

  /* timeline */
  .ball {

    position: absolute;
    width: 3.5%;
    background: #fff;
    height: 3em;
    left: 49.2%;
   	border: 7px solid hsla(0.0, 0.0%, 50.2%, 1.0);
    border-radius: 71%;

}
.tip {

    position: absolute;
    width: 9%;
    background: rgb(128, 128, 128);
    display: flex;
    justify-content: center;
    border-radius: 10%;

}
.container-tl {

    width: 30%;
    position: absolute;
    background: rgb(192, 192, 192);
    display: flex;
    justify-content: center;
    flex-direction: column;
    padding: 4%;
    
}

.container-tl::after {

    content: "";
    position: absolute;
    top: 32%;
    left: 94%;
    width: 0;
    height: 0;
    border-left: 100px solid rgb(192, 192, 192);
    border-top: 50px solid transparent;
    border-bottom: 50px solid transparent;
    
}

.container-tl-right {

    width: 30%;
    position: absolute;
    background: rgb(192, 192, 192);
    display: flex;
    justify-content: center;
    flex-direction: column;
    padding: 4%;
    
}

.container-tl-right::before {

    content: "";
    position: absolute;
    top: 32%;
    left: -16%;
    width: 0;
    height: 0;
    border-right: 100px solid rgb(192, 192, 192);
    border-top: 50px solid transparent;
    border-bottom: 50px solid transparent;

}

.img-sdw {
  
    box-shadow: 0px 0px 10px black;

}

}
</style>
   <section style="margin-top: 5%;">
      <nav class="navbar" style="margin: 0 auto;margin-top: 1%;width: 98%;color: #fff;">
        <ul style="display: flex;list-style-type: none;background:  grey;justify-content:  center;">
      <li style="margin: 1%;"><a href="/">INICIO</a></li>
      <li style="margin: 1%;"><a href="/spa">BIENESTAR &amp; SPA</a></li>
      <li style="margin: 1%;"><a href="/restaurant">RESTAURANTE &amp; BAR</a></li>
      <li style="margin: 1%;"><a href="/deportes">DEPORTES &amp; CURSOS</a></li>
      <li style="margin: 1%;"><a href="/eventos">CENTRO DE EVENTOS</a></li>
      <li style="margin: 1%;"><a href="/blog" class="selected">BLOG</a></li>
      <li style="margin: 1%;"><a href="/contacto">CONTÁCTENOS</a></li>
      </ul>
      </nav>
    </section>
    	<section style="width: 100%;margin-top: 4%;">
    	<div style="display: flex;justify-content: center;">
    <img src="<?php echo e(url('images/flecha-banner.png')); ?>" alt="left-arrow" style="position: absolute;left: 0.9%;top: 12%;">
    	<img src="<?php echo e(url('images/banner-principal-blog.png')); ?>" alt="banner-principal-blog" style="width: 98%;">
    	<img src="<?php echo e(url('images/flecha-banner.png')); ?>" alt="right-arrow" style="transform: rotate(180deg);position: absolute;left: 97.35%;top: 12%;">
    	</div>
    </section>
     <section style="width: 100%;display:  flex;justify-content:  center;">
    	<img src="<?php echo e(url('images/banner-secundario-blog.png')); ?>" alt="banner-secundario-blog" style="margin-top: -2%;width: 98.2%;">
    </section>
    <section class="container" style="margin-bottom: 8%;">
    	<div style="width: 0.8%;background-color: grey;height: 133em;margin-left: 50.7%;margin-top: 10%;"></div>
      <div class="tip" style="left: 46.2%;top: 34%;">
        <h4 style="font-family: 'light';color: #fff;">Mes/Año</h4>
      </div>
      <div class="container-tl" style="top: 35%;left: 11%;display: flex;justify-content: center;">
        <h2 style="font-size: 3em;">DEPORTES</h2>
        <br>
        <p style="font-family: 'light';">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. </p>
        <br>
        <button class="btn" style="background: #C1C1C1FF;">Leer más</button>
      </div>
    	<div class="ball" style="top: 39%;"></div>
      <div class="container-tl" style="top: 58.5%;left: 11%;display: flex;justify-content: center;">
        <img src="<?php echo e(url('images/danza.png')); ?>" style="height: 18em;" class="img-sdw">
        <h2 style="font-size: 3em;">DEPORTES</h2>
        <br>
        <p style="font-family: 'light';">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. </p>
        <br>
        <button class="btn" style="background: #C1C1C1FF;">Leer más</button>
      </div>
    	<div class="ball" style="top: 52%;"></div>
      <div class="tip" style="left: 46.2%;top: 58%;">
        <h4 style="font-family: 'light';color: #fff;">Mes/Año</h4>
      </div>
    	<div class="ball" style="top: 65%;"></div>
      <div class="container-tl-right" style="top: 45.4%;left: 60%;display: flex;justify-content: center;">
        <img src="<?php echo e(url('images/danza.png')); ?>" style="height: 18em;" class="img-sdw">
        <h2 style="font-size: 3em;">DEPORTES</h2>
        <br>
        <p style="font-family: 'light';">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. </p>
        <br>
        <button class="btn" style="background: #C1C1C1FF;">Leer más</button>
      </div>

       <div class="container-tl-right" style="top: 74%;left: 60%;display: flex;justify-content: center;">
        <h2 style="font-size: 3em;">DEPORTES</h2>
        <br>
        <p style="font-family: 'light';">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. </p>
        <br>
        <button class="btn" style="background: #C1C1C1FF;">Leer más</button>
      </div>
    	<div class="ball" style="top: 78%;"></div>
      <div class="tip" style="left: 43.2%;top: 89%;width: 15%;">
        <h4 style="font-family: 'light';color: #fff;">Cargar más</h4>
      </div>
    </section>
    <section class="container" style="width: 100%;padding: 2%;margin-top: 2%;margin-bottom: 2%;">
        <img src="<?php echo e(url('images/banner-promocion-grande.jpg')); ?>" style="width: 100%;height: 14em;">
      </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>