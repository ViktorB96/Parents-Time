function izbrisiP(idRoditelja) {
  $.post("ajax/ajax_Pdelete.php", { idRoditelja: idRoditelja }, function (
    response
  ) {
    location.reload(alert(response));
  });
}
