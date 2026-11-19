(function () {
  // 1. Manejo del formulario principal ('f')
  var form = document.getElementById('f');
  var ok = document.getElementById('ok');
  
  if (form) {
    form.addEventListener('submit', async function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();

      var boton = form.querySelector('button[type="submit"]');
      if (boton) boton.disabled = true;

      try {
        var res = await fetch(form.action, {
          method: 'POST',
          body: new FormData(form)
        });
        var data = await res.json();

        if (data.ok) {
          if (ok) {
            ok.style.display = 'block';
            ok.classList.add('show');
          }
          form.reset();
          setTimeout(function () {
            if (ok) {
              ok.style.display = 'none';
              ok.classList.remove('show');
            }
          }, 5000);
        } else {
          alert(data.error || 'No se pudo enviar el mensaje.');
        }
      } catch (err) {
        alert('No se pudo enviar el mensaje. Intenta de nuevo en unos minutos.');
      } finally {
        if (boton) boton.disabled = false;
      }
    });
  }

  // 2. Manejo del nuevo formulario de sugerencias ('f-sugerencias')
  var formSugerencia = document.getElementById('f-sugerencias');
  var okSugerencia = document.getElementById('ok-sugerencia');

  if (formSugerencia) {
    formSugerencia.addEventListener('submit', async function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();

      var botonSugi = formSugerencia.querySelector('button[type="submit"]');
      if (botonSugi) botonSugi.disabled = true;

      try {
        var res = await fetch('php/guardar_sugerencia.php', {
          method: 'POST',
          body: new FormData(formSugerencia)
        });
        var data = await res.json();

        if (data.ok) {
          if (okSugerencia) {
            okSugerencia.style.display = 'block';
            okSugerencia.classList.add('show');
          }
          formSugerencia.reset();
          setTimeout(function () {
            if (okSugerencia) {
              okSugerencia.style.display = 'none';
              okSugerencia.classList.remove('show');
            }
          }, 5000);
        } else {
          alert(data.error || 'No se pudo enviar la sugerencia.');
        }
      } catch (err) {
        alert('No se pudo enviar la sugerencia. Intenta de nuevo en unos minutos.');
      } finally {
        if (botonSugi) botonSugi.disabled = false;
      }
    });
  }
})();