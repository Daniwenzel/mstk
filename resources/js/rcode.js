$(document).ready(function () {
  $("#compareTowers").click(function (e) {
    e.preventDefault();

    var primeiroArq = $('input[name="primeiroEpe"]')[0].files[0];
    var segundoArq = $('input[name="segundoEpe"]')[0].files[0];

    if(primeiroArq && segundoArq) {
      $('form[name="plotsCorrelacao"]').submit();
    }
    
    else {

      // O primeiro codigo sempre será a torre de referencia, mas a url retornada será com o maior codigo
      // Evitar que duas pastas da mesma correlação sejam criadas.
      // ex: diretórios /../000321-000322/ e /../000322-000321/ para armazenar a mesma correlação
      var torreRef = $('#primeiraTorre').val();
      var torreSec = $('#segundaTorre').val();
      var periodo = $('#dateFilter').val();

      function adicionarZeros(estacao) {
        while(estacao.length < 6) estacao = "0" + estacao;

        return estacao;
      } 
    
      var codigoMaior = adicionarZeros(Math.max(torreRef,torreSec)+"");
      var codigoMenor = adicionarZeros(Math.min(torreRef,torreSec)+"");
      torreRef = adicionarZeros(torreRef);
      torreSec = adicionarZeros(torreSec);

      // Chama função de correlação (através do ajax) apenas se os campos tiverem algum valor e não forem iguais
      if ((torreRef && torreSec) && (torreRef != torreSec)) {
        if (periodo) {
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: "/reports/ajaxCompare",
            data: {
              torreReferencia: torreRef,
              torreSecundaria: torreSec,
              periodo: periodo
            },
            success: function(data) {
              window.location= '/reports/plots/'+codigoMaior+'-'+codigoMenor;
            },
            error: function error(xhr, status, _error) {
              console.log('o erro foi no ajax EXTERNO');
              alert(xhr.responseText);
            },
          });
        }
        else {
          alert('Campo do período vazio.');
        }
      }
      else {
        alert('Estações inválidas ou iguais.');
      }
    }
  })

  $("#generatePlots").click(function (e) {
    e.preventDefault();

    if($('input[name="arquivoEpe"]')[0].files[0]) {
      $('form[name="plotsTorre"]').submit();
    }
    else {
      var primeiraTorre = $('#primeiraTorre').val();
      var periodo = $('#dateFilter').val();

      while (primeiraTorre.length < 6) primeiraTorre = "0" + primeiraTorre;

      // Chama função de correlação (através do ajax) apenas se os campos tiverem algum valor
      if (primeiraTorre) {
        if (periodo) {
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: "/reports/ajaxGenerate",
            data: {
              primeiraTorre: primeiraTorre,
              periodo: periodo
            },
            success: function(data) {
              window.location.href= '/reports/plots/'+primeiraTorre;
            },
            error: function error(xhr, status, _error) {
              console.log('o erro foi no ajax EXTERNO');
              alert(xhr.responseText);
            },
          });
        }
        else {
          alert('Campo do período vazio.');    
        }
      }
      else {
        alert('Campos de torres vazios.');
      }
    }
  });

  // Exibe e esconde o componente de 'loading' no inicio e fim do ajax
  $(document).ajaxStart(function () {
    $("#loading").addClass('show');
  });
  $(document).ajaxStop(function () {
    $("#loading").removeClass('show');
  });
});