<?php

  /**
   * The integration test to show how XGrid works
   *
   * @author suleyman [at] melikoglu.info
   */
  class UsageTest extends BaseTestCase {

      /**
       * This usage example indicates the usage of version 1.0
       */
      public function testUsageOfInitialVersion() {
          $currentPage = 1;

          $grid = new XGrid(
                          array(
                              'pagination' => array(
                                  'currentPage' => $currentPage,
                                  'perPage' => 3,
                                  'baseUrl' => '/xgridAction' // $view->url()
                              )
                          )
          );
          
          // The XGrid needs a datasource. The following is a simple array datasource. 
          // You can use other data sources as well. The example of the Doctrine data source would be following
          // $query = Doctrine_Query::create()->from("User");
          // $dataSource = new XGrid_DataSource_Doctrine($query);
          $array = array(
              array('id' => 3, 'name' => 'Suleyman Melkoglu', 'email' => 'suleyman@melikoglu.info', 'created_at' => strtotime("25 April 2011"), 'status' => '1'),
              array('id' => 4, 'name' => 'Onur Yaman', 'email' => 'onuryaman@gmail.cim', 'created_at' => strtotime("25 April 2011"), 'status' => '2'),
              array('id' => 5, 'name' => 'Can Arbaz', 'email' => 'canarbaz@gmail.com', 'created_at' => strtotime("25 April 2011"), 'status' => '1'),
              array('id' => 6, 'name' => 'Niels Clause', 'email' => 'nielzclause@gmail.com', 'created_at' => strtotime("25 April 2011"), 'status' => null),
          );
          $grid->setDataSource(new XGrid_DataSource_Array($array));

          // custom data fields
          $nameDataField = new XGrid_DataField_Text();
          $nameDataField->addKey("name");

          $replierDataField = new XGrid_DataField_Text();
          $replierDataField->addKey("name")
                  ->setDefaultText("Waiting for reply")
                  ->addFilter(new XGrid_Filter_FirstWord()) // you can even add a filter to the data field
                  ->addFilter(new XGrid_Filter_Concatenator('Mr. ', ' is the king')); // we are appending the is reading status 

          $closuredDataField = new XGrid_DataField_Text();
          $closuredDataField->addKey("status")
                  ->registerOnRender(function(XGrid_DataField_Event $event) {
                              $data = $event->getData();
                              switch ($data->status) {
                                  case '1':
                                      return 'Closed';
                                      break;
                                  case '2':
                                      return 'Replied';
                                      break;
                                  default:
                                      return 'Witing';
                                      break;
                              }
                          });
                          
          $customDateField = new XGrid_Datafield_Date();
          $customDateField->addKey("created_at");
          $customDateField->setFormat('d.m.Y'); 
          

          $grid->addAttribute('class', 'xgrid fullwidth')
                  ->addAttribute('id', 'table-support')
                  ->addField("id", "Selection" /* you can use it with a translator $this->translate->_("Selection") */, XGrid_DataField::CHECKBOX)
                  ->addField("name", "Name", $nameDataField)
                  ->addField("email", "Email", XGrid_DataField::TEXT)
                  ->addField("created_at", "Created at", $customDateField)
                  //->addField("created_at", "Created at", XGrid_DataField::DATE) it chould have instantiated like this also
                  ->addField("replier", "Replier", $replierDataField);

          $grid = $grid->dispatch();


          $expected = "<table class='xgrid fullwidth' id='table-support'>";
          $expected .= "<thead><tr><th>Selection</th><th>Name</th><th>Email</th><th>Created at</th><th>Replier</th></tr></thead>";
          $expected .= '<tbody><tr>';
          $expected .= '<td><input name="id" type="checkbox"  value="3" /></td>';
          $expected .= '<td>Suleyman Melkoglu</td><td>suleyman@melikoglu.info</td>';
          $expected .= '<td>25.04.2011</td><td>Mr. Suleyman is the king</td>';
          $expected .= '</tr><tr>';
          $expected .= '<td><input name="id" type="checkbox"  value="4" />';
          $expected .= '</td><td>Onur Yaman</td><td>onuryaman@gmail.cim</td>';
          $expected .= '<td>25.04.2011</td><td>Mr. Onur is the king</td>';
          $expected .= '</tr><tr><td><input name="id" type="checkbox"  value="5" /></td>';
          $expected .= '<td>Can Arbaz</td><td>canarbaz@gmail.com</td>';
          $expected .= '<td>25.04.2011</td><td>Mr. Can is the king</td>';
          $expected .= '</tr></tbody>';
          $expected .= "<tfoot><tr><td colspan='5' >";
          $expected .= "<div class='paginationControl'><span class='disabled'>&lt; Previous</span> | 1 | <a href='/xgridAction?p=2'>2</a> | <a href='/xgridAction?p=2'>Next &gt;</a></div></td></tr></tfoot>";
          $expected .= '</table>';

          $this->assertEquals($expected, $grid->__toString());
          
          //var_dump($grid->__toString());
      }

      /**
       * This usge test is created BEFORE the actual implementation and might have
       * codes that is not implemented yet. So do not rely on it.
       */
      public function usageOfTheSecondVersionThatIsNotImplementedYet() {

          // the factory creates the grid instance, 
          // The instance may be created via a 3rd party class (like a Zend 
          // framework view helper)
          $grid = XGrid_Factory::create();

          // example data is an array of users
          $exampleData = array(
              array("1", "laplacesdemon", "Suleyman Melikoglu", "email" => "suleyman@melikoglu.info"),
              array("2", "anyusername", "My Real Name", "email" => "realname@gmail.info"),
          );
          $dataSource = new XGrid_DataSource_Array($exampleData);

          // we might have a datasource for a database. 
          // following is an example of the doctrine orm datasource
          //$query = Doctrine_Query::create()->from("User");
          //$dataSource = new XGrid_DataSource_Doctrine($query);
          // all datasource implementations should use the same interface 
          $this->assertTrue($dataSource instanceof XGrid_DataSource_Interface);
          $grid->setDataSource($dataSource);

          // setting the data field
          // 1st parameter is the key field to fetch from the datasource
          // can be an array pointer or string
          // if the integer value is used in the key parameter then 
          // the datasource need to be array
          // string parameter can be used if the datasource is stdClass 
          // or an associative array
          $grid->addField(1, "Username", XGrid_DataField::TEXT);
          $grid->addField(2, "Name Surname", XGrid_DataField::TEXT);
          // associated string identifier
          $grid->addField("email", "E-mail", XGrid_DataField::TEXT);
          $grid->addField("theDate", "Created at", XGrid_DataField::DATE, array('format' => 'dd.MM.yyyy'));
          $grid->addField("updatedAt", "Updated at", new XGrid_DataField('dd.MM.yyyy'));
          // you can even add a filter to it
          $grid->addField('username', "My uppercase field", XGrid_DataField::TEXT, null, new XGrid_Filter_Uppercase());
          $dataField = new XGrid_DataField_Text();
          $dataField->addFilter($dataField);
          $grid->addField('username', "My alternative uppercase field", $dataField);

          // pagination params: recordrs per page, range, pagination strategy
          $grid->setPagination(10, 6, XGrid_Pagination::ELASTIC);

          //$crudStrategy = new MockCrudStrategy();
          //$this->assertTrue($crudStrategy instanceof XGrid_CrudStrategy_Interface);
          // setting the crud strategy turns the CRUD feature on. 
          $grid->setCrudStrategy($crudStrategy);

          // you can disable editable feature using following method
          //$grid->setEditable(false);
          // or you can just disable the create function
          //$grid->setInsertable(false);
          //$grid->setDeletable(false);
          // setting the search strategy enables the "searchable" function
          // note: search should go to a plugin
          /* $searchStrategy = new MockSearchStrategy();
            $this->assertTrue($searchStrategy instanceof XGrid_SearchStrategy_Interface);
            $grid->setSearchStrategy($searchStrategy);
           */

          // you can disable the searchable function via following method
          // if setSearchable method is used with true parameter, then the 
          // default search strategy will be used
          //$grid->setSearchable(false);

          $grid->setSortable(true);

          $grid->setCssClasses(array(
              "table" => "myCssClass",
              "tr" => "myCssClassForTr"
          ));

          // optional plugins can be registered, plugins are hooks that inject some
          // codes on certain events
          /* $plugin = new MockGridPlugin();
            $this->assertTrue($plugin instanceof XGrid_Plugin_Interface);
            $grid->registerPlugin($plugin);
           */

          // dispatch
          $grid->dispatch();

          // echo the table
          echo $grid;
      }

  }

  