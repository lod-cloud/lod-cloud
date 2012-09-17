<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xml:lang="en"
    xmlns="http://www.w3.org/1999/xhtml"
    xmlns:dc="http://purl.org/dc/terms/"
    xmlns:dctype="http://purl.org/dc/dcmitype/"
    xmlns:foaf="http://xmlns.com/foaf/0.1/"
    xmlns:xsd="http://www.w3.org/2001/XMLSchema#">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title property="dc:title">The Linking Open Data cloud diagram</title>
    <link rel="stylesheet" type="text/css" href="resources/style.css" />
    <link rel="foaf:primaryTopic" resource="#cloud" />
  </head>
  <body>
    <div style="float:right">
      <a href="http://www.wiwiss.fu-berlin.de/en/institute/pwo/bizer/"><img src="resources/logo-fub.png" alt="Freie Universität Berlin" style="position:relative;top:3px" /></a>
      <a href="http://www.deri.ie/"><img src="resources/logo-deri.png" alt="DERI" /></a>
    </div>

    <h1>The Linking Open Data cloud diagram</h1>

    <div style="float:right;padding-top:3px">
      <a href="http://latc-project.eu/"><img src="resources/logo-latc.png" alt="LATC Project" /></a>
    </div>

    <p style="clear:right"><span about="#cloud" property="dc:description" datatype="">This web page is the home of the <em>LOD cloud diagram</em>. This image shows datasets that
      have been published in <a href="http://linkeddata.org/">Linked Data</a> format, by contributors to the
      <a href="http://esw.w3.org/topic/SweoIG/TaskForces/CommunityProjects/LinkingOpenData">Linking Open Data</a>
      community project and other individuals and organisations. It is based on metadata collected and curated by contributors to the <a href="http://ckan.net/">CKAN directory</a>.</span> Clicking the image will take you to an image map, where each dataset is a hyperlink to its homepage.</p>

    <p>The diagram is maintained by <span rel="dc:creator"><a typeof="foaf:Person" href="http://richard.cyganiak.de/#me" property="foaf:name">Richard Cyganiak</a></span> (<a href="http://www.deri.ie/">DERI, NUI Galway</a>) and <span rel="dc:contributor"><a typeof="foaf:Person" href="http://www.wiwiss.fu-berlin.de/en/institute/pwo/bizer/team/JentzschAnja.html" resource="#anja" property="foaf:name">Anja Jentzsch</a></span> (<a href="http://www.wiwiss.fu-berlin.de/en/institute/pwo/bizer/">Freie Universität Berlin</a>). For any questions and comments, please
      email <a href="mailto:richard@cyganiak.de">richard@cyganiak.de</a> and <a href="mailto:mail@anjajentzsch.de">mail@anjajentzsch.de</a>.</p>

<?php
$versions = array(
    '2007-05-01' => array('count' => 12),
    '2007-10-08' => array('count' => 25),
    '2007-11-07' => array('count' => 28),
    '2007-11-10' => array('count' => 28),
    '2008-02-28' => array('count' => 32),
    '2008-03-31' => array('count' => 34),
    '2008-09-18' => array('count' => 45),
    '2009-03-05' => array('count' => 89),
    '2009-03-27' => array('count' => 93),
    '2009-07-14' => array('count' => 95),
    '2010-09-22' => array('count' => 203),
    '2011-09-19' => array('count' => 295),
);

$dir = dir('.');
$d = '0000-00-00';
while (false !== ($entry = $dir->read())) {
    if (!preg_match('/lod-datasets_(\d\d\d\d-\d\d-\d\d)(_colored)?\.(pdf|png|svg)/', $entry, $match)) {
        continue;
    }
    if ($match[1] > $d) {
        $d = $match[1];
    }
    $colors = $match[2] ? 'color' : 'white';
    $versions[$match[1]][$colors][$match[3]] = true;
}
$dir->close();
krsort($versions);

?>

    <p>Last updated: <span property="dc:modified" datatype="xsd:date"><?php echo $d; ?></span></p>

    <p><a href="lod-datasets_<?php echo $d; ?>.html"><img src="lod-datasets_<?php echo $d; ?>_1000px.png" alt="Linking Open Data cloud diagram, large version" title="Click to zoom" /></a></p>


    <h2 id="license">Can I use this diagram in my slides, paper, book? <small><a href="#license">#</a></small></h2>

    <div style="float:left;margin: 0.3em 0.7em 0 0"><a rel="license dc:license" href="http://creativecommons.org/licenses/by-sa/3.0/">
      <img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a></div>

    <p>Yes. This work is available under a <a href="http://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a> license.
      This means you can include it in any other work under the condition that you give proper
      attribution. If you create derivative works (such as modified or extended versions of the diagram), then
      you must also license them as CC-BY-SA.</p>

    <div style="float:right;margin-right:2em"><a href="lod-datasets_<?php echo $d; ?>_colored.html"><img src="lod-datasets_<?php echo $d; ?>_colored_300px.png" alt="Linking Open Data cloud diagram, large version, colored by theme" title="Click to zoom" /></a></div>

    <p>Please give attribution along the following lines:</p>

    <blockquote><p>“Linking Open Data cloud diagram, by Richard Cyganiak and Anja Jentzsch. http://lod-cloud.net/”</p></blockquote>

    <p>The diagram is available
      in <a href="lod-datasets_<?php echo $d; ?>.png">PNG</a>,
      in <a href="lod-datasets_<?php echo $d; ?>.pdf">PDF</a> and
      <a href="lod-datasets_<?php echo $d; ?>.svg">SVG</a> versions.</p>

    <p>There is also a colored-by-theme version
      in <a href="lod-datasets_<?php echo $d; ?>_colored.png">PNG</a>,
      in <a href="lod-datasets_<?php echo $d; ?>_colored.pdf">PDF</a> and
      <a href="lod-datasets_<?php echo $d; ?>_colored.svg">SVG</a>.</p>


    <h2 id="how-to-join">How can I get my dataset into the diagram? <small><a href="#how-to-join">#</a></small></h2>

    <p>First, make sure that you publish data according to the
      <a href="http://www.w3.org/DesignIssues/LinkedData.html">Linked Data principles</a>.
      We interpret this as:</p>

    <ul>
      <li>There must be <em>resolvable <tt>http://</tt> (or <tt>https://</tt>) URIs</em>.</li>
      <li>They must resolve, with or without content negotiation, to <em>RDF data</em> in one of the popular RDF formats
        (RDFa, RDF/XML, Turtle, N-Triples).</li>
      <li>The dataset must contain <em>at least 1000 triples</em>. (Hence, your FOAF file most likely does not qualify.)</li>
      <li>The dataset must be connected via <em>RDF links</em> to a dataset that is already
        in the diagram. This means, either your dataset must use URIs from the other dataset,
        or vice versam. We arbitrarily require at least 50 links.</li>
      <li>Access of the <em>entire</em> dataset must be possible via <em>RDF crawling</em>, via an <em>RDF dump</em>, or via a <em>SPARQL endpoint</em>.</li>
    </ul>

    <div style="float:right">
      <a href="http://ckan.net/"><img src="resources/logo-ckan.png" alt="CKAN" /></a>
    </div>

    <p>If your dataset meets these criteria:</p>
 
    <ol>
      <li>Please add it to <a href="http://ckan.net/">CKAN</a>, the open registry of data and content packages.
        See the <a href="http://esw.w3.org/TaskForces/CommunityProjects/LinkingOpenData/DataSets/CKANmetainformation">Guidelines for Collecting Metadata onLinked Datasets in CKAN</a> for more details. (Before creating a new CKAN package, please double-check whether a package already exists for your dataset.)</li>
      <li>We provide a <a href="http://www4.wiwiss.fu-berlin.de/lodcloud/ckan/validator/">handy CKAN record validator</a>; use it to check that at least the minimum required information is present.</li>
      <li>Email <a href="mailto:richard@cyganiak.de">richard@cyganiak.de</a> and <a href="mailto:mail@anjajentzsch.de">mail@anjajentzsch.de</a>.</li>
      <li>We will review the CKAN record, add it to the CKAN <a href="http://ckan.net/group/lodcloud">lodcloud group</a>.</li>
      <li>The dataset will be included in the next update of the diagram.</p>
    </ol>


    <h2 id="excluded">Why is my dataset not included? <small><a href="#excluded">#</a></small></h2>

    <p>See the question above—please make sure that it meets the criteria, is in CKAN, and that we know about it. Other possible reasons why we exclude some datasets are:</p>
    <ul>
      <li>The dataset is published through a <em>SPARQL endpoint</em>, without resolvable entity URIs.</li>
      <li>The dataset is published as an <em>RDF dump</em>, without resolvable entity URIs.</li>
      <li>The dataset is a <em>cache, copy or aggregation</em> of existing RDF datasets without original data.</li>
      <li>The dataset is a <em>service</em> that produces RDF in response to the client submitting some input data (other than an entity URI).</li>
      <li>The dataset is not interlinked with other datasets. (This applies to several large-scale FOAF/SIOC/GoodRelations enabled websites.)</li>
    </ul>

    <p>Datasets of these kinds are important and valuable. They are, however, outside of the scope that we (somewhat arbitrarily) choose to display in this particular diagram.</p>


    <h2 id="open">Are all these datasets really open? <small><a href="#open">#</a></small></h2>

    <p>Probably not. Unfortunately, most publishers do not
      <a href="http://www.w3.org/TR/void/#license">publish their data
      with an explicit license</a>. This leaves re-users in the dark about
      the specific rights that are granted or reserved by the publisher.</p>

    <p>Given this state of affairs, we take a liberal view of what we consider
      “open”. If the data is openly accessible from a network point of view
      – that is, it's not behind an authorization check or paywall – then 
      we will probably add it to the Cloud. Note that we keep track of
      explicit licenses on <a href="http://thedatahub.org/group/lodcloud">the
      Data Hub</a> whenever we know about them. We aspire to provide a
      version color-coded by license in the future.</p>

    <p>Before using any data, you should always check the publisher's
      website for the terms and conditions. If you don't find anyting, then
      the safest course of action is to assume that the publisher reserves
      all rights…</p>

    <p>(Note that the Data Hub takes a stricter view on
      openness and considers a dataset “open” only if it has an explicit
      license that meets the <a href="http://opendefinition.org/">Open
      Definition</a>.)</p>


    <h2 id="perspective">Why don't you also show XYZ in the diagram? <small><a href="#perspective">#</a></small></h2>

    <p>This diagram shows a particular perspective on the Web of Data. There are many
      other possible, perfectly valid, and valuable perspectives as well, that focus on
      other data formats, on other publishing methods, and on highlighting other aspects
      besides size, topic and interlinks. We chose to show this particular view, and
      encourage everyone to explore and visualise other views as well. See the
      <a href="#related">Related Resources section</a> for similar visualisations.</p>


    <h2 id="raw-data">Can I get the raw data? <small><a href="#raw-data">#</a></small></h2>

    <p>Yes. The diagram is based on metadata from the <a href="http://ckan.net/group/lodcloud">lodcloud group</a> on <a href="http://ckan.net/">CKAN</a>.
      This data is fully accessible through the <a href="http://knowledgeforge.net/ckan/doc/ckan/api.html">CKAN API</a>.</p>

    <p>There are some code modules (Python, PHP, Drupal, Perl etc.) that provide convenient wrappers around much of the CKAN API.
      For full details of these, please consult: <a href="http://wiki.okfn.org/ckan/related">http://wiki.okfn.org/ckan/related</a>.</p>

    <p>In the future we plan to make the data available directly as RDF, using the <a href="http://vocab.deri.ie/void/guide">voiD vocabulary</a>.</p>


    <h2 id="workflow">How is the diagram generated? <small><a href="#workflow">#</a></small></h2>

    <p>The diagram is based on metadata from the <a href="http://ckan.net/group/lodcloud">lodcloud group</a> on <a href="http://ckan.net/">CKAN</a>.</p>

    <p>In order to generate the diagram, we access CKAN via the CKAN API to get JSON for each of the data sets in the lodcloud group.
      We then automatically generate a new OmniGraffle file which contains the last version of the LOD cloud and an unsorted bunch of all new datasets.</p>

    <p>Those are manually arranged by their cluster membership to form a beautiful and fluffy cloud. 
      Data set names are either taken from the provided title in CKAN or if given the shortname.
      If the shortname is still too long, we manually tweak it in OmniGraffle.</p>

    <p>PDF and PNG versions are exported from OmniGraffle. The SVG is generated
      from the OmniGraffle using a byzantine collection of home-grown
      Ruby and JS scripts.</p>


    <h2 id="customizing">I want to customize the diagram. Can I get the source file? <small><a href="#customizing">#</a></small></h2>

    <p>The <a href="#license">license</a> allows modifications. We don't
      share the OmniGraffle sources, but the PDF and SVG versions can be
      edited using appropriate software. The SVG is suitable for manipulation
      through scripting. The <a href="#raw-data">raw data</a> is also
      available.</p>


    <h2 id="next-update">When will you update the diagram? <small><a href="#next-update">#</a></small></h2>

    <p>We update the diagram every few months. Ask us if you need a more precise answer.</p>


    <h2 id="history">Can I get the older versions? <small><a href="#history">#</a></small></h2>

    <p>Yes.</p>

    <table class="versions">
      <tr>
        <td></td><th style="text-align: center" colspan="3">White</th><th style="text-align: center" colspan="3">Colored</th><th>Datasets</th>
      </tr>
      <tr typeof="dctype:Image" about="#cloud" property="dc:title" content="LOD cloud diagram">
        <th property="dc:modified" datatype="xsd:date" content="<?php echo $d; ?>">Latest</th>
        <td><?php if ($versions[$d]['white']['png']) { ?><a rel="dc:hasFormat" href="lod-datasets_<?php echo $d; ?>.png">png</a><?php } ?></td>
        <td><?php if ($versions[$d]['white']['pdf']) { ?><a rel="dc:hasFormat" href="lod-datasets_<?php echo $d; ?>.pdf">pdf</a><?php } ?></td>
        <td><?php if ($versions[$d]['white']['svg']) { ?><a rel="dc:hasFormat" href="lod-datasets_<?php echo $d; ?>.svg">svg</a><?php } ?></td>
        <!-- TODO RDFa markup for the colored versions -->
        <td><?php if ($versions[$d]['color']['png']) { ?><a href="lod-datasets_<?php echo $d; ?>_colored.png">png</a><?php } ?></td>
        <td><?php if ($versions[$d]['color']['pdf']) { ?><a href="lod-datasets_<?php echo $d; ?>_colored.pdf">pdf</a><?php } ?></td>
        <td><?php if ($versions[$d]['color']['svg']) { ?><a href="lod-datasets_<?php echo $d; ?>_colored.svg">svg</a><?php } ?></td>
        <td class="dataset-count"><?php if ($versions[$d]['count']) echo $versions[$d]['count']; else echo '?'; ?></td>
      </tr>
<?php foreach ($versions as $date => $version) { ?>
      <tr typeof="dctype:Image" about="#cloud_<?php echo $date; ?>" property="dc:title" content="LOD cloud diagram, version <?php echo $date; ?>">
        <th property="dc:date" datatype="xsd:date"><?php echo $date; ?></th>
        <td><?php if ($version['white']['png']) { ?><a rel="dc:hasFormat" href="lod-datasets_<?php echo $date; ?>.png"><span property="dc:format" content="image/png">png</span></a><?php } ?></td>
        <td><?php if ($version['white']['pdf']) { ?><a rel="dc:hasFormat" href="lod-datasets_<?php echo $date; ?>.pdf"><span property="dc:format" content="application/pdf">pdf</span></a><?php } ?></td>
        <td><?php if ($version['white']['svg']) { ?><a rel="dc:hasFormat" href="lod-datasets_<?php echo $date; ?>.svg"><span property="dc:format" content="image/svg+xml">svg</span></a><?php } ?></td>
        <!-- TODO RDFa markup for the colored versions -->
        <td><?php if ($version['color']['png']) { ?><a href="lod-datasets_<?php echo $date; ?>_colored.png"><span>png</span></a><?php } ?></td>
        <td><?php if ($version['color']['pdf']) { ?><a href="lod-datasets_<?php echo $date; ?>_colored.pdf"><span>pdf</span></a><?php } ?></td>
        <td><?php if ($version['color']['svg']) { ?><a href="lod-datasets_<?php echo $date; ?>_colored.svg"><span>svg</span></a><?php } ?></td>
        <td class="dataset-count"><?php if ($version['count']) echo $version['count']; else echo '?'; ?></td>
      </tr>
<?php } ?>
    </table>
    <div about="#cloud" rel="dc:hasVersion">
<?php $previous = null; foreach ($versions as $date => $version) { ?>
      <span about="#cloud_<?php echo $date; ?>"<?php if ($previous) { ?> rel="dc:replaces" resource="#cloud_<?php echo $previous; ?>"<?php } ?>></span>
<?php $previous = $date; } ?>
    </div>

    <h2 id="details">What <em>exactly</em> does the diagram mean? <small><a href="#details">#</a></small></h2>

    <p>The image shows datasets that are published in
      <a href="http://linkeddata.org/">Linked Data</a> format and are
      interlinked with other dataset in the cloud.</p>

    <p>The size of the circles corresponds to the number of triples in each dataset. The numbers
      are ususally provided by the dataset publishers, and are sometimes rough estimates.</p>

    <table rules="all">
      <tr><th>Circle size</th><th>Triple count</th></tr>
      <tr><td>Very large</td><td>&gt;1B</td></tr>
      <tr><td>Large</td><td>1B-10M</td></tr>
      <tr><td>Medium</td><td>10M-500k</td></tr>
      <tr><td>Small</td><td>500k-10k</td></tr>
      <tr><td>Very small</td><td>&lt;10k</td></tr>
    </table>

    <p>The arrows indicate the existence of at least 50 links between two datasets.
      A link, for our purposes, is an RDF triple where subject and
      object URIs are in the namespaces of different datasets.</p>

    <p>The direction of the arrows indicate the dataset that contains the links, e.g., an arrow from A to B means that dataset A contains RDF triples that use identifiers from B. Bidirectional arrows usually indicate that the links are mirrored in both datasets. The thickness corresponds to the number of links.</p>

    <table rules="all">
      <tr><th>Arrow thickness</th><th>Triple count</th></tr>
      <tr><td>Thick</td><td>&gt;100k</td></tr>
      <tr><td>Medium</td><td>100k-1k</td></tr>
      <tr><td>Thin</td><td>&lt;1k</td></tr>
    </table>


    <h2 id="related">Related resources <small><a href="#related">#</a></small></h2>

    <p>Here are some similar or related efforts that visualise the Web of Data on a high level.</p>

    <ul>
      <li><a href="http://inkdroid.org/lod-graph/">Linking Open Data Graph</a>: A dynamic force graph version of the LOD Cloud, highlighting the ratings of datasets.</li>
      <li><a href="http://inkdroid.org/empirical-cloud/">Empirical Cloud (2010)</a>: Ed Summers generates a dynamic diagram from the Billion Triples dataset.</li>
      <li><a href="http://blog.larkc.eu/?p=1941">LarKC blog: LOD cloud shows surprisingly lumpy structure</a>: Christophe Guéret analyses the network structure of the mid-2009 diagram.</li>
      <li><a href="http://twitpic.com/17qj1h/full">LOD Cloud analysed with Gephi</a>: Another mid-2009 view that clearly shows the clustering.</li>
      <li><a href="http://gromgull.net/blog/2009/09/heat-maps-of-semantic-web-predicate-usage/">Heat maps of Semantic Web predicate usage</a>: Gunnar Grimnes produces a network of Semantic Web sites, clustered by predicate usage, including heat maps for vocabularies.</li>
      <li><a href="http://arxiv.org/abs/0903.0194">A Graph Analysis of the Linked Data Cloud</a>: Marko A. Rodriguez wrote a paper that analyses the
        network structure of an early 2009 version of this diagram.</li>
      <li><a href="http://iswc2009.semanticweb.org/wiki/index.php/ISWC_2009_Tutorials/Legal_and_Social_Frameworks_for_Sharing_Data_on_the_Web#Slides">Rights Statements on the Web of Data</a>: In Leigh Dodds' slides for this ISWC 2009 tutorial, he has a version of the diagram where datasets are colored by their license.</li>
      <li><a href="http://www.milanstankovic.org/blog/?p=154">Evidence of Competence on Linked Data</a>: Milan Stankovic has re-organised the diagram according to the possible use of datasets for determining personal competence.</li>
      <li><a href="http://www.umbel.org/lod_constellation.html">The LOD Constellation</a>, offered by <a href="http://www.umbel.org/">UMBEL</a>, shows class-level relationships between vocabularies, rather than instance-level relationships between datasets.</li>
      <li>The 2005 paper <em><a href="http://genepath.med.harvard.edu/wiki/images/a/a8/2006-JWS-StephensDiLascioLaVignaLuciano.pdf">Aggregation of Bioinformatics Data Using Semantic Web Technology</a></em> by Stevens et al. has a similar diagram showing linkages between several bioinformatics datasets. This diagram was frequently used by Tim Berners-Lee in presentations (see e.g. <a href="http://www.w3.org/2005/Talks/1110-iswc-tbl/Overview.html#(14)">this slide</a>).</li>
      <li>The <a href="http://bio2rdf.org/">Bio2RDF project</a> has a <a href="https://sourceforge.net/apps/mediawiki/bio2rdf/index.php?title=File:Bio2rdfmap_blanc.png">diagram shoing the interlinkages between its datasets</a>.</li>
    </ul>


  </body>
</html>
