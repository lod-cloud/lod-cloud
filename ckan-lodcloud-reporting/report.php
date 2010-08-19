<?php

$filename = 'index.html';

@ini_set('error_reporting', E_ALL);

include_once('Ckan_client-PHP/Ckan_client.php');

$ckan = new Ckan_client();
echo "Fetching dataset list ... ";
$group_description = $ckan->get_group_entity('lodcloud');
echo "OK (" . count($group_description->packages) . " datasets)\n";
$datasets = array();
foreach ($group_description->packages as $package_id) {
  echo "Fetching dataset $package_id ... ";
  $package = $ckan->get_package_entity($package_id);
  echo $package->name . "\n";
  $datasets[$package->name] = $package;
}

$datasets_with_links = array();
$datasets_without_links = array();
$broken_links = array();
foreach ($datasets as $package => $details) {
  $datasets[$package]->inlinks = array();
}
foreach ($datasets as $package => $details) {
  $datasets[$package]->outlinks = array();
  $extras = get_object_vars($details->extras);
  foreach ($extras as $key => $value) {
    if (!preg_match('/^links:(.*)/', $key, $match)) continue;
    $target = $match[1];
    $datasets[$package]->outlinks[$target] = (int) $value;
    if (!in_array($package, $datasets_with_links)) {
      $datasets_with_links[] = $package;
    }
    if (array_key_exists($target, $datasets)) {
      $datasets[$target]->inlinks[$package] = (int) $value;
      if (!in_array($target, $datasets_with_links)) {
        $datasets_with_links[] = $target;
      }
    } else {
      if (!array_key_exists($target, $broken_links)) {
        $broken_links[$target] = array();
      }
      if (!in_array($package, $broken_links[$target])) {
        $broken_links[$target][] = $package;
      }
    }
  }
  ksort($datasets[$package]->outlinks);
}
foreach (array_keys($datasets) as $package) {
  if (!in_array($package, $datasets_with_links)) {
    $datasets_without_links[] = $package;
  }
  ksort($datasets[$package]->inlinks);
}
foreach (array_keys($broken_links) as $package) {
  sort($broken_links[$package]);
}
sort($datasets_with_links);
sort($datasets_without_links);
ksort($broken_links);

ob_start();

echo '<?xml version="1.0" encoding="utf-8"?>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xml:lang="en"
    xmlns="http://www.w3.org/1999/xhtml"
    xmlns:dc="http://purl.org/dc/terms/">
  <head>
    <title>LOD Cloud data in CKAN</title>
    <style type="text/css">
body { margin: 1 2 3; }
dt { font-weight: bold; }
dd { margin-bottom: 0.7em; }
dt h3 { margin-bottom: 0; }
.missing { color: red; }
a.package { text-decoration: none; }
    </style>
  </head>
  <body>
    <h1>LOD Cloud data in CKAN</h1>
    <p><a href="http://ckan.net/group/lodcloud"><tt>lodcloud</tt> group in CKAN</a></p>

    <h2>Datasets with links</h2>
<?php if ($datasets_with_links) { ?>
    <dl>
<?php foreach ($datasets_with_links as $package) { ?>
      <dt><h3><?php echo package_link($package); ?>: <?php echo $datasets[$package]->title; ?></h3></dt>
      <dd>
        <strong>Outlinks</strong>: <?php
$fragments = array();
foreach ($datasets[$package]->outlinks as $target => $link_count) {
  $fragments[] = package_link($target, array_key_exists($target, $datasets));
}
echo $fragments ? join(', ', $fragments) : 'none';
?><br />
        <strong>Inlinks</strong>: <?php
$fragments = array();
foreach ($datasets[$package]->inlinks as $target => $link_count) {
  $fragments[] = package_link($target, array_key_exists($target, $datasets));
}
echo $fragments ? join(', ', $fragments) : 'none';
?><br />
      </dd>
<?php } ?>
    </dl>
<?php } else { ?>
    <p>None.</p>
<?php } ?>

    <h2>Datasets without links</h2>
<?php if ($datasets_without_links) { ?>
    <dl>
<?php foreach ($datasets_without_links as $package) { ?>
      <dt><h3><?php echo package_link($package); ?>: <?php echo $datasets[$package]->title; ?></h3></dt>
<?php } ?>
    </dl>
<?php } else { ?>
    <p>None.</p>
<?php } ?>

    <h2>Datasets linked from above that are not in the <tt>lodcloud</tt> group</h2>
<?php if ($broken_links) { ?>
    <ul>
<?php foreach ($broken_links as $broken_link => $referrer) { ?>
      <li><strong><?php echo package_link($broken_link, false); ?></strong> (referred from <?php
$fragments = array();
foreach ($referrer as $package) {
  $fragments[] = package_link($package);
}
echo join(", ", $fragments);
?>)
      </li>
<?php } ?>
    </ul>
<?php } else { ?>
    <p>None.</p>
<?php } ?>
  </body>
</html><?php

$html = ob_get_contents();
ob_end_clean();
echo "Writing to file $filename ... ";
$file = fopen($filename, 'w');
fputs($file, $html);
fclose($file);
echo "OK\n";

function package_link($package, $exists = true) {
  return "<a href=\"http://ckan.net/package/$package\" class=\"package" . ($exists ? '' : ' missing') . "\">$package</a>";
}
