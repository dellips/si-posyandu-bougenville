$(document).ready(function() {
    $('#ibu_id').selectize({
        create: true, // memungkinkan menambah item baru yang tidak ada di daftar
        sortField: 'text'
    });
});