$(function () {
  //alert("Radi!!!");
  let poruka = $("#poruka");
  $("#btnPrijava").click(function () {
    let email = $("#email").val();
    let lozinka = $("#lozinka").val();
    $.post(
      "ajax/ajax_prijavaD.php?funkcija=prijava",
      { email: email, lozinka: lozinka },
      function (response) {
        let odgovor = JSON.parse(response);
        if (odgovor.greska != "")
          poruka.html("<span style='color:red'>" + odgovor.greska + "</span>");
        else window.location.assign(odgovor.poruka);
      }
    );
  });
  $("#btnPrikaziRegistraciju").click(function () {
    $("#divLozinka").hide();
    $("#divRegistracija").toggle();
  });

  $("#btnPrikaziLozinku").click(function () {
    $("#divRegistracija").hide();
    $("#divLozinka").toggle();
  });

  $("#btnRegister").click(function () {
    let ime = $("#ime").val();
    let prezime = $("#prezime").val();
    let email = $("#email").val();
    let status = $("#status>option:selected").text();
    $.post(
      "ajax/ajax_prijavaD.php?funkcija=registracija",
      { ime: ime, prezime: prezime, email: email, status: status },
      function (response) {
        poruka.html(response);
      }
    );
  });

  $("#btnPosaljiLozinku").click(function () {
    let email = $("#lemail").val();
    $.post(
      "ajax/ajax_prijavaD.php?funkcija=lozinka",
      { email: email },
      function (response) {
        poruka.html(response);
      }
    );
  });
});
