function odbij(idKorisnika) {
  $.post("ajax/ajax_odbij.php", { idKorisnika: idKorisnika }, function (
    response
  ) {
    location.reload(alert(response));
  });
}
