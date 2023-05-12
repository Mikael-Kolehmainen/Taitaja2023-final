<!DOCTYPE html>
<html>
  <head>
    <style>
      tr {
        font-size: 16px;
        color: blacK;
      }
      .special-animation {
        animation-name: pulse;
        animation-duration: 4s;
        animation-iteration-count: infinite;
      }

      @keyframes pulse {
        from {
          font-size: 16px;
          color: black;
        }

        to {
          font-size: 20px;
          color: yellow;
        }
      }
    </style>
  </head>
  <body>
  <?php

    $threeNumbers = [rand(1, 10), rand(1, 10), rand(1, 10)];
    $threeMoreNumbers = [rand(1, 10), rand(1, 10), rand(1, 10)];

    rsort($threeNumbers);
    rsort($threeMoreNumbers);

    echo "<table>";

    $i = 0;
    foreach ($threeNumbers as $number) {
      $specialAnimation = "";

      if ($threeMoreNumbers[$i] == $number) {
        $specialAnimation = "special-animation";
      }

      echo "
        <tr>
          <td class='$specialAnimation'>$number</td>
          <td class='$specialAnimation'>$threeMoreNumbers[$i]</td>
        </tr>
      ";
      $i++;
    }

    echo "</table>";
    ?>
  </body>
</html>


