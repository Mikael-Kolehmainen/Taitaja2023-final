<?php

namespace public_site\controller;

/*
  This is the FooterController, its main function is to show the footer of the
  website.
*/
class FooterController
{
  public function showFooter(): void
  {
    echo "
      <footer id='desktop-footer'>
        <div class='col'>
          <div class='row'>
            <a href='/index.php'>
              <img src='/src/public_site/media/logo/oppidoo_logo_white.png' alt='The logo of Oppidoo' />
            </a>
            <p>Oppidoo Oy</p>
            <p>Kutojantie 12</p>
            <p>02630 ESPOO</p>
            <p>(Käyntiosoite, ei postia)</p>
            <p>Y-tunnus: 2486864-8</p>
          </div>
          <div class='row'>
            <h2>Ota yhteyttä!</h2>
            <div class='social-links'>
              <a href='#'>
                <i class='whatsapp'></i>
              </a>
              <a href='#'>
                <i class='facebook'></i>
              </a>
              <a href='#'>
                <i class='linkedin'></i>
              </a>
            </div>
          </div>
        </div>
      </footer>
      <footer id='mobile-footer'>
        <div class='col'>
          <div class='row'>
            <a href='/index.php'>
              <img src='/src/public_site/media/logo/oppidoo_logo_white.png' alt='The logo of Oppidoo' />
            </a>
          </div>
          <div class='row'>
            <h2>Ota yhteyttä!</h2>
            <div class='social-links'>
              <a href='#'>
                <i class='whatsapp'></i>
              </a>
              <a href='#'>
                <i class='facebook'></i>
              </a>
              <a href='#'>
                <i class='linkedin'></i>
              </a>
            </div>
            <p>Oppidoo Oy</p>
            <p>Kutojantie 12</p>
            <p>02630 ESPOO</p>
            <p>(Käyntiosoite, ei postia)</p>
            <p>Y-tunnus: 2486864-8</p>
          </div>
        </div>
      </footer>
    ";
  }
}
