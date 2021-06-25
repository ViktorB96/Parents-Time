function prihvati(idZahteva) {
  $.post("ajax/ajax_prihvati.php", { idZahteva: idZahteva }, function (
    response
  ) {
    location.reload(alert(response));
  });
}
