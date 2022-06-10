<?php ob_start() ?>

<section class="h-100 bg-dark">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card card-registration my-4">
          <div class="row g-0">
            <div class="col-xl-6 d-none d-xl-block">
              <img src="https://1.bp.blogspot.com/-1q6JZpTnyK8/XxFm8JX-CFI/AAAAAAAAAPY/rek40UORAgQCL4Er3KJUbasrU-PnB-X_wCLcBGAsYHQ/s1600/tienda%2Bexposici%25C3%25B3n%2B2.jpg" alt="Foto para registro" class="img-fluid"  />
            </div>
            <div class="col-xl-6">
              <div class="card-body p-md-5 text-black">
                <h3 class="mb-5 text-uppercase">Registro</h3>

                <?php if ($alert) : ?>
                  <div class="alert alert-danger" role="alert">
                    <?php MensajesFlash::imprimir_mensajes() ?>
                  </div>
                <?php endif ?>

                <form action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="token" value="<?= $token ?>">
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" name="nombre" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example1m">Nombre</label>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" id="apellidos" name="apellidos" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example1n">Apellidos</label>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="email" name="email" id="email" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example1m1">Email</label>
                        <img src="<?=RUTA?>web/img/1490.gif" alt="alt" id="preloader" />
                        <img src="<?=RUTA?>web/img/tick.png" alt="alt" id="tick" />
                        <img src="<?=RUTA?>web/img/wrong.png" alt="alt" id="cruz" />
                        
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="password" name="password" id="password" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example1n1">Contraseña</label>
                      </div>
                    </div>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="text" name="telefono" id="telefono" class="form-control form-control-lg" />
                    <label class="form-label" for="form3Example8">Teléfono</label>
                  </div>

                
                  <div class="form-outline mb-4">
                    <input type="file" name="foto" accept="image/*" id="form3Example9" class="form-control form-control-lg" />
                    <label class="form-label" for="form3Example9">Foto de perfil</label>
                  </div>

                  <div class="d-flex justify-content-end pt-3">
                    <input type="reset" value="Limpiar" class="btn btn-light btn-lg">
                    <input type="submit" value="registrar" disabled id="registrar" class="btn btn-warning btn-lg ms-2">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
  $('#email').blur(function() {

    if ($('#email').val() != '') {

      

    $.ajax({
      url: "<?= RUTA ?>existe_email",
      method: "POST",
      data: {
        email: $('#email').val()
      },

      success: function(data) {
        if (data.resultado) {

          $('#cruz').css('display', 'inline');
          $('#registrar').prop("disabled", true);
          bootbox.alert("Ya existe un usuario registrado con este email.");


        } else {

          $('#tick').css('display', 'inline');
          $('#registrar').removeAttr("disabled");

        }


      },
      beforeSend: function() {
        $('#tick').css('display', 'none');
        $('#cruz').css('display', 'none');
        $('#preloader').css('display', 'inline');
      },
      complete: function() {
        $('#preloader').css('display', 'none');
      }

      
    });

    }
  });


</script>
<?php
$contenido = ob_get_clean();
require 'template.php';
?>