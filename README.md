=====================================
[php-datagrid] - A Flexible Data Grid 
=====================================

Formerly known as XGrid.

Php Datagrid provides tabular data grid with a flexible/extensible API. 
The main goal of the XGrid is to keep source code maintainable and reusable.
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

Search Plugin: The plugin / strategy to perform search into the data. Array and Doctrine adapters shall be developed in the initial version.

Sorting Plugin: The plugin to sort data by columns.

CRUD Plugin: The plugin / strategy to handle Create/Update/Delete operations

Preferences class: The encapsulation of the XGrid properties. XGrid should accept this class in the constructor. It shall work as default options of the XGrid.

Autoloading:
------------

XGrid uses PHP's autoloading feature to load/include files. Please refer to the 'Conventions and Coding Standard' section for the naming conventions.

Usage:
------

Make sure that the 'src' folder is in your include path. XGrid uses the __autoload magic function for the file inclusion. Please use the following example to include files. If you use a framework like ZendFramework or CakePHP, the autoloading will be handled by them for you.

<pre>
require 'XGrid/Config.php';
spl_autoload_register(array('XGrid_Config', 'xgridAutoload'));
</pre>

Following is the standard way of using XGrid

<pre>
$grid = new XGrid();
$data = array(
              array("name" => "Value 11", "surname" => "Value 12"),
              array("name" => "Value 21", "surname" => "Value 22")
);
$dataSource = new XGrid_DataSource_Array($data);
$grid->setDataSource($dataSource);
$grid->dispatch(); // the dispatch method is also called by the __toString magic function
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

Setting pagination values in the alternative way. This example also shows the doctrine data source usage.

<pre>
// prepare pagination values. They might depend on your application.
$currentPage = 3;
$perPage = 2;
$range = 6;
$type = XGrid_Plugin_Pagination::SLIDING;

$paginator = new XGrid_Plugin_DefaultPaginator();
$paginator->setCurrentPage($currentPage);
$paginator->setItemCountPerPage($perPage);
$paginator->setType($type);
$paginator->setRange($range);

$xgrid = new XGrid();

// set the data source
$query = Doctrine_Query::create()->from('KuleUser');
$xgrid->setDataSource(new XGrid_DataSource_Doctrine($query));

// set the pagination plugin
$xgrid->registerPlugin($paginator);

echo $xgrid;
</pre>

Conventions and Coding Standard:
--------------------------------

XGrid uses the coding standard as described in the following url: http://framework.zend.com/manual/en/coding-standard.html

Change Log:
-----------

1.0:
===

initial version 

1.1:
---

Minor bugs, Support for nested data structure for the data field

1.2:
---

"Doctrine 2" data source support.

1.3:
----

Renamed from XGrid to php-datagrid due to a name clash with a product developed by the Apple inc.
