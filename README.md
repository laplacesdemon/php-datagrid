[XGrid] - A Flexible Data Grid 
==================================================

The XGrid provides tabular data grid with a flexible/extensible API. 
The main goal of the XGrid is the maintainablility and reuse. So I have focused on the design. 
The development is in phase1 stage. Contributions are welcome. 

Please see the tests/XGrid/UsageTest.php file to find out how it works.

Features of phase1:
-------------------

DataSource / provider support

Doctrine datasource

Array datasource

Pluggable system. Plugins are hook codes injected to certain events of the dispatch.

Filters

Pagination

Features of phase2:
-------------------

Search Plugin

Sorting Plugin


Usage:
------

Make sure that the 'src' folder is in your include path. XGrid uses the __autoload magic function for the file inclusion. Please use the following example to include files.

<pre>
function __autoload($class_name) {
    $tokens = explode("_", $class_name);
    $fileName = implode("/", $tokens);
    include_once  $fileName . '.php';
}

$grid = new XGrid();
$data = array(
              array("name" => "Value 11", "surname" => "Value 12"),
              array("name" => "Value 21", "surname" => "Value 22")
);
$dataSource = new XGrid_DataSource_Array($data);
$grid->setDataSource($dataSource);
$grid->dispatch();
echo $grid;
</pre>