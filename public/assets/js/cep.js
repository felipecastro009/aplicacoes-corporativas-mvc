$.ajaxSetup({
  headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});

$(document).ready(function(){
  $("#cep").on('blur', function()
  {
    value = $(this).val();

    $.get("https://viacep.com.br/ws/"+ value +"/json/", function(data)
    {
      console.log(data);

      $("#rua").val('');
      $("#bairro").val('');
      $("#cidade").val('');
      $("#uf").val('');
      if (data.sucesso != "0")
      {
          $("#bairro").val(data.bairro);
          $("#complemento").val(data.complemento);
          $("#localidade").val(data.localidade);
          $("#rua").val(data.logradouro);
          $("#uf").val(data.uf);
      }
    }, 'json');
  });
});
