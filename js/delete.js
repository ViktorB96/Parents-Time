function izbrisi(idDadilje) {
  $.post("ajax/ajax_Ddelete.php", { idDadilje: idDadilje }, function (
    response
  ) {
    location.reload(alert(response));
  });
}
