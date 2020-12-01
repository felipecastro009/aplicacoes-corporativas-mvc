(function($) {
  'use strict';
  dragula([document.getElementById("dragula-left"), document.getElementById("dragula-right")]);
  dragula([document.getElementById("dragula-event-left"), document.getElementById("dragula-event-right")]);
  dragula([document.getElementById("sortable"), document.getElementById("sortable")])
    .on('drop', function(el) {

      var container = $('#sortable').children();

      var url = $('#sortable').data('url');

      var list = {};
      var index = 0;

      container.each(function (q, k) {
         list[index] = {
            id : $(this).data('id'),
        };
        index++;
      })

      console.log(list)

      $.ajax({
      type: "post",
      data: {'list' : list},
      url: url,
      headers: {
        'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);
        if(data.success) {
          swal(
            'Sucesso!',
            data.message,
            'success'
          )
        } else {
          swal(
            'Erro na solicitação!',
            data.message,
            'warning'
          )
        }
      }
    });
  })
})(jQuery);
