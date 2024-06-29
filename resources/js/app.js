import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
  dictDefaultMessage: 'Sube aquí tu imagen',
  acceptedFiles: '.png,.jpg,.jpeg,.gif',
  addRemoveLinks: true,
  dictRemoveFile: 'Borrar Archivo',
  maxFiles: 1,
  uploadMultiple: false,
});

dropzone.on('sending', function (file, xhr, formData) {

});

dropzone.on('success', function (file, response) {

});

dropzone.on('removedfile', function (file) {

});