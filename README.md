# showModuleOutput
This PHP tool shows the initial output of Ashiva Modules before Ashiva Module Components are processed.

```

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

```
