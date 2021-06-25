function izbrisi(idZahteva) {
  $.post("ajax/ajax_izbrisiZahtev.php", { idZahteva: idZahteva }, function (
    response
  ) {
    location.reload(alert(response));
  });
}
