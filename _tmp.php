<?php

header("Content-type: text/plain");

$scan = scandir('assets\img\class');

foreach($scan as $file)
{
    if (!is_dir("assets\img\class/$file"))
    {
        $name = str_replace('.jpg', '', $file);
        $name = str_replace('icon_', '', $name);
        $encoded = base64_encode(file_get_contents("assets\img\class/$file"));
echo
".icon-class.$name {
    width: 24px;
    height: 24px;
    background-image: url(data:image/jpg;base64,$encoded);
}
";
        
    }
}