<?php

  //*****************//
 // DEVELOPER NOTES //
//*****************//

/*
For this script to work, the URL must include a Query String, detailing:

  i) Ashiva Module Name; and
  ii) Ashiva Module Publisher

Example of Query String: ?module=Ashiva_Test_Module&publisher=Ashiva_Core
*/

  //*****************//
 // ERROR REPORTING //
//*****************//

  error_reporting(E_ALL);
  ini_set('display_errors', 1);


  //**************//
 // INCLUDE CORE //
//**************//

  require_once $_SERVER['DOCUMENT_ROOT'].'/.assets/system/core/core.php';



  //***************************************//
 // FUNCTION :: SHOW ASHIVA MODULE OUTPUT //
//***************************************//

  function Show_Module_Output ($Module_Name, $Module_Publisher) {

    $requiredModNameSet = explode('::', $Module_Name);
    $requiredMod = $requiredModNameSet[0];
    $requiredModParameters = array_slice($requiredModNameSet, 1);

    require_once $_SERVER['DOCUMENT_ROOT'].'/.assets/modules/'.url($Module_Publisher).'/'.url($requiredMod).'/'.url($requiredMod).'.php';

    $Module_Output = $requiredMod(...$requiredModParameters);
    $Module_Output = json_decode($Module_Output, TRUE);
    $Module_Output = json_encode($Module_Output, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    echo '<pre>';
    echo '<h2>Module Output from '.$Module_Name.' by '.$Module_Publisher.' (as JSON)</h2>';
    echo $Module_Output;

    echo '<h2>Module Output from '.$Module_Name.' by '.$Module_Publisher.' (as PHP Array)</h2>';
    print_r(json_decode($Module_Output, TRUE));
    echo '</pre>';
  }



  //******************************//
 // DISPLAY ASHIVA MODULE OUTPUT //
//******************************//

  if ((!isset($_GET['module'])) || (!isset($_GET['publisher']))) {

    echo '<p><strong>URL Query String</strong> must contain both <strong>Ashiva Module Name</strong> <em>and</em> <strong>Ashiva Module Publisher</strong><br />
    <strong>e.g.:</strong> <a href="?module=Ashiva_Test_Module&publisher=Ashiva_Core"><em>?module=Ashiva_Test_Module&publisher=Ashiva_Core</em></a></p>';
  }

  else {
    
    Show_Module_Output($_GET['module'], $_GET['publisher']);
  }

?>
