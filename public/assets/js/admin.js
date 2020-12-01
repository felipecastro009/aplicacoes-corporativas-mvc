  $('.js-confirm-delete').on('click', function (e) {
  e.preventDefault();
  let linha = $(e.target).parents('tr');
  swal({
    title: 'Você tem certeza?',
    text: $(this).data('title') + " será excluído.",
    type: 'error',
    confirmButtonText: 'Confirmar',
    cancelButtonText: 'Cancelar',
    showCancelButton: true,
    confirmButtonColor: '#3f51b5',
    cancelButtonColor: '#ff4081',
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "DELETE",
        url: $(this).data('link'),
        headers: {
          'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function(data){
          console.log(data);
          if(data.success) {
            swal(
              'Deletado!',
              data.message,
              'success'
            )
            linha.fadeOut().remove();

            if(data.route) {
              window.location.href = data.route;
            }
          } else {
            swal(
              'Erro na solicitação!',
              data.message,
              'warning'
            )
          }
        }
      });
    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
    } else if (result.dismiss === 'cancel') {
      swal(
        'Ação Cancelada',
        'O seu item está a salvo!',
        'error'
      )
    }
  })
});

$('.js-confirm-delete-release').on('click', function (e) {
  e.preventDefault();
  let linha = $(e.target).offsetParent()
  swal({
    title: 'Você tem certeza?',
    text: $(this).data('title') + " será excluído.",
    type: 'error',
    confirmButtonText: 'Confirmar',
    cancelButtonText: 'Cancelar',
    showCancelButton: true,
    confirmButtonColor: '#3f51b5',
    cancelButtonColor: '#ff4081',
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "DELETE",
        url: $(this).data('link'),
        headers: {
          'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function(data){
          console.log(data);
          if(data.success) {
            swal(
              'Deletado!',
              data.message,
              'success'
            )
            linha.fadeOut().remove();

            if(data.route) {
              window.location.href = data.route;
            }
          } else {
            swal(
              'Erro na solicitação!',
              data.message,
              'warning'
            )
          }
        }
      });
    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
    } else if (result.dismiss === 'cancel') {
      swal(
        'Ação Cancelada',
        'O seu item está a salvo!',
        'error'
      )
    }
  })
});


$(".js-clear").on("click", function(){
   $('.form')[0].reset();
});

$('.js-confirm-sortable-delete ').on('click', function (e) {
  e.preventDefault();
  let linha = $(e.target).parent().parent().parent().parent().parent().parent().parent().parent().parent();
  console.log(linha);
  swal({
    title: 'Você tem certeza?',
    text: $(this).data('title') + " será excluído.",
    type: 'error',
    confirmButtonText: 'Confirmar',
    cancelButtonText: 'Cancelar',
    showCancelButton: true,
    confirmButtonColor: '#3f51b5',
    cancelButtonColor: '#ff4081',
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "DELETE",
        url: $(this).data('link'),
        headers: {
          'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function(data){
          console.log(data);
          if(data.success) {
            swal(
              'Deletado!',
              data.message,
              'success'
            )
          linha.fadeOut().remove();
          } else {
            swal(
              'Erro na solicitação!',
              data.message,
              'warning'
            )
          }
        }
      });
    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
    } else if (result.dismiss === 'cancel') {
      swal(
        'Ação Cancelada',
        'O seu item está a salvo!',
        'error'
      )
    }
  })
});

$('.js-message-delete').on('click', function (e) {
  e.preventDefault();
  swal({
    title: 'Você tem certeza?',
    text: $(this).data('title') + " será excluído.",
    type: 'error',
    confirmButtonText: 'Confirmar',
    cancelButtonText: 'Cancelar',
    showCancelButton: true,
    confirmButtonColor: '#3f51b5',
    cancelButtonColor: '#ff4081',
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "DELETE",
        url: $(this).data('link'),
        headers: {
          'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function(data){
          console.log(data);
          if(data.success) {
            swal(
              'Deletado!',
              data.message,
              'success'
            )
            window.location.href = data.route;
          } else {
            swal(
              'Erro na solicitação!',
              data.message,
              'warning'
            )
          }
        }
      });
    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
    } else if (result.dismiss === 'cancel') {
      swal(
        'Ação Cancelada',
        'O seu item está a salvo!',
        'error'
      )
    }
  })
});

$(".js-box").bootstrapDualListbox({
  filterPlaceHolder: "Filtrar",
  infoText: false
});

$(".js-datepicker").flatpickr({
  enableTime: false,
  time_24hr: false,
  dateFormat: 'd/m/Y',
  locale: 'pt',
});

$(".js-datetimepicker").flatpickr({
  enableTime: true,
  time_24hr: false,
  dateFormat: 'd/m/Y H:i',
  locale: 'pt',
});

$('div.alert').not('.alert-important').delay(3000).fadeOut(350);

 var toolbarOptions = [
  ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
  ['blockquote', 'code-block'],
  [ 'link', 'image', 'video', 'formula' ],          // add's image support
  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  [{ 'font': [] }],
  [{ 'align': [] }],

  ['clean']                                         // remove formatting button
];

if ($(".js-redactor").length) {
  $('.js-redactor').summernote({
    height: 300,
    tabsize: 2
  });
}
