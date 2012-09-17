<?php

$dir = dir('..');
$latest = null;
while (false !== ($entry = $dir->read())) {
    if (!preg_match('/lod-datasets_\d\d\d\d-\d\d-\d\d\.html/', $entry, $match)) continue;
    if ($match[0] <= $latest) continue;
    $latest = $match[0];
}
$dir->close();
header("Location: http://richard.cyganiak.de/2007/10/lod/$latest", true, 302);

?>
