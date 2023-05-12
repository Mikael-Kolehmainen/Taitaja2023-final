<?php

namespace public_site\controller;

/*
  This is the ErrorController, its main function is to show a custom error page
  when an error occurs, for example. 404 Page Not Found.

  When we instantiate this class we can choose the error title, message and
  the destination to the 'Go back' link.
*/
class ErrorController
{
  /** @var string */
  private $title;

  /** @var string */
  private $message;

  /** @var string */
  private $link;

  /**
   * @param string $errorTitle
   * @param string $errorMessage
   * @param string $redirectLink
   */
  public function __construct($errorTitle, $errorMessage, $redirectLink)
  {
    $this->title = $errorTitle;
    $this->message = $errorMessage;
    $this->link = $redirectLink;
  }

  public function showErrorPage(): void
  {
    echo "
        <title>$this->title</title>
      </head>
      <section>
        <article class='box error'>
          <h1>$this->title</h1>
          <p>$this->message</p>
          <a href='$this->link'>Go back</a>
        </article>
      </section>
    ";
  }
}
