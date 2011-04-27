<?php

  
  class MockCrudStrategy implements XGrid_CrudStrategy_Interface {
      
      public function onInsert($data) {
          
      }
      
      public function onUpdate($key, $data) {
          
      }
      
      public function onDelete($key) {
          
      }
      
  }
  
  /*class MockSearchStrategy implements XGrid_SearchStrategy_Interface {
      
      public function iDontKnowWhatToPutHereYet() {
          
      }
      
  }*/
  
  
  /**
   * Description of UsageTest
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class UsageTest extends BaseTestCase {
   
      public function testUsageWithSuccessfulScenerio() {
          
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
          $grid->addDataField(1, "Username", XGrid_DataField::TEXT);
          $grid->addDataField(2, "Name Surname", XGrid_DataField::TEXT);
          // associated string identifier
          $grid->addDataField("email", "E-mail", XGrid_DataField::TEXT);
          $grid->addDataField("theDate", "Created at", XGrid_DataField::DATE, array('format' => 'dd.MM.yyyy'));
          $grid->addDataField("updatedAt", "Updated at", new XGrid_DataField('dd.MM.yyyy'));
          // you can even add a filter to it
          $grid->addDataField('username', "My uppercase field", XGrid_DataField::TEXT, null, new XGrid_Filter_Uppercase() );
          $dataField = new XGrid_DataField_Text();
          $dataField->addFilter($dataField);
          $grid->setDataField('username', "My alternative uppercase field", $dataField);
          
          // pagination params: recordrs per page, range, pagination strategy
          $grid->setPagination(10, 6, XGrid_Pagination::ELASTIC);
          
          $crudStrategy = new MockCrudStrategy();
          $this->assertTrue($crudStrategy instanceof XGrid_CrudStrategy_Interface);
          
          // setting the crud strategy turns the CRUD feature on. 
          $grid->setCrudStrategy($crudStrategy);
          
          // you can disable editable feature using following method
          //$grid->setEditable(false);
          
          // or you can just disable the create function
          //$grid->setInsertable(false);
          //$grid->setDeletable(false);
          
          // setting the search strategy enables the "searchable" function
          // note: search should go to a plugin
          /*$searchStrategy = new MockSearchStrategy();
          $this->assertTrue($searchStrategy instanceof XGrid_SearchStrategy_Interface);
          $grid->setSearchStrategy($searchStrategy);
          */
          
          // you can disable the searchable function via following method
          // if setSearchable method is used with true parameter, then the 
          // default search strategy will be used
          //$grid->setSearchable(false);
          
          $grid->setSortable(true);
          
          $grid->setCssClasses(array(
              "table"   => "myCssClass",
              "tr"      => "myCssClassForTr"
          ));
          
          // optional plugins can be registered, plugins are hooks that inject some
          // codes on certain events
          /*$plugin = new MockGridPlugin();
          $this->assertTrue($plugin instanceof XGrid_Plugin_Interface);
          $grid->registerPlugin($plugin);
           */
          
          // dispatch
          $grid->dispatch();
          
          // echo the table
          echo $grid;
      }
      
  }