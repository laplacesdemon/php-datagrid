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

Autoloading:
------------

XGrid uses PHP's autoloading feature to load/include files. Please refer to the 'Conventions and Coding Standard' section for the naming conventions.

Usage:
------

Make sure that the 'src' folder is in your include path. XGrid uses the __autoload magic function for the file inclusion. Please use the following example to include files.

<pre>
function __autoload($class_name) {
    $tokens = explode("_", $class_name);
    $fileName = implode("/", $tokens);
    include_once  $fileName . '.php';
}
</pre>

A standard way of using XGrid is following

<pre>
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

If you need pagination, you can set pagination parameters like following

<pre>
          $grid = new XGrid(array(
              'pagination' => array(
                  'currentPage' => (isset($_GET['p'])) ? $_GET['p'] : 1 ,
                  'perPage' => 2,
                  'baseUrl' => ''
              )
          ));
          $grid->addField("name", "Name", XGrid_DataField::TEXT);
          $grid->addField("surname", "SurName", XGrid_DataField::TEXT);
          $data = array(
              array("name" => "Value 01", "surname" => "Value 00"),
              array("name" => "Value 02", "surname" => "Value 00"),
              array("name" => "Value 03", "surname" => "Value 00"),
              array("name" => "Value 04", "surname" => "Value 00"),
              array("name" => "Value 11", "surname" => "Value 12"),
              array("name" => "Value 21", "surname" => "Value 22")
          );
          $dataSource = new XGrid_DataSource_Array($data);
          $grid->setDataSource($dataSource);

          echo $grid;
</pre>

Conventions and Coding Standard:
--------------------------------

XGrid uses the coding standard as described in the following url: http://framework.zend.com/manual/en/coding-standard.html