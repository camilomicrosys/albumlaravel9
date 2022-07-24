import Dropzone from "dropzone";

Dropzone.autoDiscover=false;

const dropzone = new Dropzone('#dropzone',{
dictDefaultMessage:"sube aqui tu imagen",
acceptedFiles:".png,.jpg,.jpeg,.gif",
addRemoveLinks:true,
dictRemoveFiles:"Borrar Archivo",
maxFiles:1,
uploadMultiple:false
}) ;