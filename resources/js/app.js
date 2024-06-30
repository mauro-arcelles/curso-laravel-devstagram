import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
  dictDefaultMessage: 'Sube aquí tu imagen',
  acceptedFiles: '.png,.jpg,.jpeg,.gif',
  addRemoveLinks: true,
  dictRemoveFile: 'Borrar Archivo',
  maxFiles: 1,
  uploadMultiple: false,
  init: function () {
    if (document.querySelector('input[name="imagen"]').value.trim()) {
      const imagenPublicada = {};
      imagenPublicada.size = 1234;
      imagenPublicada.name = document.querySelector('input[name="imagen"]').value;

      this.options.addedfile.call(this, imagenPublicada);
      this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

      imagenPublicada.previewElement.classList.add('dz-success');
      imagenPublicada.previewElement.classList.add('dz-complete');
    }
  }
});

dropzone.on('sending', function (file, xhr, formData) {

});

dropzone.on('success', function (file, response) {
  document.querySelector('input[name="imagen"]').value = response.imagen;
});

dropzone.on('removedfile', function (file) {
  document.querySelector('input[name="imagen"]').value = '';
});
