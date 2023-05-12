<?php

namespace public_site\controller;

/*
  This is the HomeController, its main function is to show the landing page of
  the website.
*/
class HomeController
{
  public function showHomePage(): void
  {
    $headerController = new HeaderController();
    $headerController->showHeader();

    echo "
      <section class='hero'>
        <h1>Matematiikka on helppoa tai hankalaa - olet oikeassa paikassa!</h1>
        <ul>
          <li>Matematiikka on sinulle hankalaa, olet aina kokenut sen vaikeaksi</li>
          <li>Sinulla on diagnosoitu matematiikan oppimisvaikeus</li>
          <li>Olet taitava, mutta haluat syventää, laajentaa ja varmistaa osaamistasi</li>
          <li>Nyt juuri et ymmärrä yksittäistä osa-aluetta</li>
          <li>Haaveenasi on luma-luokka</li>
        </ul>
        <a href='#' class='btn'>Tutustu opetukseen</a>
      </section>
      <section class='main'>
        <article class='two-images'>
          <a href='#' class='clickable-image'>
            <h1>Matematiikka on helppoa</h1>
            <img src='/src/public_site/media/math-is-easy.jpg' alt='A man writing on a board.' />
          </a>
          <a href='#' class='clickable-image'>
            <h1>Matematiikka on hankalaa</h1>
            <img src='/src/public_site/media/math-is-hard.jpg' alt='A frustrated man.' />
          </a>
        </article>
        <article class='description-image' id='desktop-description-image'>
          <img src='/src/public_site/media/mari.jpeg' alt='Mari Laurenius' />
          <div class='description'>
            <h2>MARI LAURENIUS</h2>
            <p>Sydämeni asia on auttaa heitä, jotka luulevat, ettei matematiikkaa voi oppia - kaikki voivat! Olen auttanut alle kouluikäisiä saavuttamaan tason, jolla koulun voi aloittaa taitavana laskijana ja nuoria aikuisia selättämään matematiikan oppimisvaikeudet, jotka ovat seuranneet kaikki kouluvuodet ja kaikkia siltä väliltä.</p>
            <p>Kokemuksesta tiedän, että mitä aikaisemmin näihin asioihin kiinnittää huomiota, sitä varmemmin vaikeudet vältetään. Lue lisää, kuka olen.</p>
            <p>Älä anna matematiikan olla peikko, joka rajoittaa tulevaisuuttasi. Ota yhteyttä rohkeasti, keskustellaan lisää!</p>
            <h3>Koulutukseni:</h3>
            <ul>
              <li>KM, Erityisluokanopettaja</li>
              <li>DI, Tuotantotalous</li>
              <li>Matematiikkaterapeutti</li>
              <li>Matematiikkaterapiani perustuu lukemattomiin koulutuksiin, tieteellisten julkaisujen seuraamiseen ja yli 10 vuoden kokemukseen. Kehitän menetelmiäni koko ajan.</li>
            </ul>
            <a href='#' class='btn'>Tutustu opetukseen</a>
          </div>
        </article>
        <article class='description-image' id='mobile-description-image' style='display: none;'>
          <div class='description'>
            <h2>MARI LAURENIUS</h2>
            <p>Sydämeni asia on auttaa heitä, jotka luulevat, ettei matematiikkaa voi oppia - kaikki voivat! Olen auttanut alle kouluikäisiä saavuttamaan tason, jolla koulun voi aloittaa taitavana laskijana ja nuoria aikuisia selättämään matematiikan oppimisvaikeudet, jotka ovat seuranneet kaikki kouluvuodet ja kaikkia siltä väliltä.</p>
            <p>Kokemuksesta tiedän, että mitä aikaisemmin näihin asioihin kiinnittää huomiota, sitä varmemmin vaikeudet vältetään. Lue lisää, kuka olen.</p>
            <p>Älä anna matematiikan olla peikko, joka rajoittaa tulevaisuuttasi. Ota yhteyttä rohkeasti, keskustellaan lisää!</p>
            <h3>Koulutukseni:</h3>
            <ul>
              <li>KM, Erityisluokanopettaja</li>
              <li>DI, Tuotantotalous</li>
              <li>Matematiikkaterapeutti</li>
              <li>Matematiikkaterapiani perustuu lukemattomiin koulutuksiin, tieteellisten julkaisujen seuraamiseen ja yli 10 vuoden kokemukseen. Kehitän menetelmiäni koko ajan.</li>
            </ul>
          </div>
          <img src='/src/public_site/media/mari.jpeg' alt='Mari Laurenius' />
        </article>
        <a href='#' class='btn' id='description-image-btn-mobile'>Tutustu opetukseen</a>
        <article class='three-images'>
          <div class='review'>
            <img src='/src/public_site/media/reviews/1.jpg' alt='mother using laptop tablet teaching with her son online home his room' />
            <p>\"Matematiikkainho vaihtui innostukseksi parissa viikossa ja osaamiseksi muutamien tuntien jälkeen. Suosittelen kaikille, jotka kamppailevat lapsen huonon matikka-asenteen kanssa!\"</p>
            <p>Äiti 9 vuotiaasta pojastaan</p>
          </div>
          <div class='review'>
            <img src='/src/public_site/media/reviews/2.jpg' alt='son watching father draw' />
            <p>\"Vain viisi tuntia Marin treeneissä ja poikamme pääsi kuin pääsikin luma-luokalle!\"</p>
            <p>Antti Mäki, isä</p>
          </div>
          <div class='review'>
            <img src='/src/public_site/media/reviews/3.jpg' alt='mother helping her daughter study' />
            <p>\"Esikoisen matematiikan opiskelu ei lähtenyt sujumaan ollenkaan. Kaksi vuotta tuskaa ja itkua, kunnes Marilta saimme avun. Nyt matematiikka sujuu hienosti. Kannattaa hakea apua nopeasti. Me odotimme turhan pitkään. Vahva suositus!\"</p>
            <p>Hanna Leppänen, äiti</p>
          </div>
        </article>
        <article class='footer-hero'>
          <h1>Haluatko haastaa itsesi?</h1>
          <p>Tee matematiikan oppimisesta hauskaa ja helppoa kokoelmallamme innostavia pelejä.</p>
          <a href='/index.php/game' class='btn'>Pelamaan</a>
        </article>
      </section>
    ";

    $footerController = new FooterController();
    $footerController->showFooter();
  }
}
