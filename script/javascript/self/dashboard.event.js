$(document).ready(function() {

  $(document).click(function(event) {
    if (event.target.className == 'dropdown-icon') {
      $('.header-content-dropdown').slideToggle(100);
    } else {
      $('.header-content-dropdown').slideUp(100);
    }
  });

  $('.dashboard-toogle-bottom').click(function() {
    $('.navigation-wrap').toggle();
    $(this).toggleClass("change");
  });

  $('.sfli').click(function() {
    $(this).next().slideToggle(300);
  });

  $("select[name='Mulai']").change(function(event) {
    if ($(this).val() != '') {
      $("select[name='Sampai']").attr('disabled', false);
      $("select[name='Quartal']").attr('disabled', true);
      for (var i = 0; i < $("select[name='Sampai'] option").length; i++) {
        if ($("select[name='Mulai']").prop('selectedIndex') > i && i!=0) {
          $("select[name='Sampai'] option").eq(i).attr('disabled', true);
        } else {
          $("select[name='Sampai'] option").eq(i).attr('disabled', false);
        }
      }
    }else{
      $("select[name='Sampai']").attr('disabled', true);
      $("select[name='Quartal']").attr('disabled', false);
    }
  });

  $("select[name='Quartal']").change(function(event){
    if ($(this).val() != '') {
      $("select[name='Mulai']").attr('disabled', true);
      $("select[name='Sampai']").attr('disabled', true);
    }
    else {
      $("select[name='Mulai']").attr('disabled', false);
      if ($("select[name='Mulai']").val() != '') $("select[name='Sampai']").attr('disabled', false);
    }
  });

  $("#filtercontent").click(function(event) {
    event.preventDefault();
    var url = window.location.protocol+"//"+window.location.hostname+window.location.pathname;
    if ($("select[name='Mulai']").val() && !$("select[name='Mulai']").prop('disabled')) url += '?Mulai='+$("select[name='Mulai']").val();
    if ($("select[name='Sampai']").val() && !$("select[name='Sampai']").prop('disabled')) url += '&&Sampai='+$("select[name='Sampai']").val();
    if ($("select[name='Quartal']").val() && !$("select[name='Quartal']").prop('disabled')) url += '?Quartal='+$("select[name='Quartal']").val();
    if ($("select[name='Tahun']").val() && !$("select[name='Tahun']").prop('disabled')) url += '&&Tahun='+$("select[name='Tahun']").val();
    if ($("select[name='Regional']").val() && !$("select[name='Regional']").prop('disabled')) url += '&&Regional='+$("select[name='Regional']").val();
    // if ($("select[name='Wilayah']").val()) url += '&&Wilayah='+$("select[name='Wilayah']").val();

    if ($("select[name='Mulai']").val() == '' && $("select[name='Quartal']").val() =='') {
      alert('Bulan Mulai atau Quartal Harus Dipilih');
    } else {
      window.location.href = url;
    }
  });

  $("#seeall").click(function(event) {
    event.preventDefault();
    var url = window.location.protocol+"//"+window.location.hostname+window.location.pathname;
    window.location.href = url;
  });
});
