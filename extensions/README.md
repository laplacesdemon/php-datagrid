XGrid Extensions
================

The XGrid extensions are library dependent files that is maintained outside of XGrid.
Add this folder to your include path 
Contributions are welcome

Examples
--------

Custom zend data form field

<pre>
// form datafield creates a form html element
$actions = new XGrid_Zend_DataField_Form(
        $this->view, 
        "actions", 
        array(
            "controller" => "user", 
            "action" => "delete"));

$actions->addSubmit("delete", "Delete User"); // adds a submit input form element
$actions->addHidden("id", "{%id}"); // this will give the id property in the dataset if there is any
$grid->addField("actions", "Actions", $actions); // add the custom datafield to your grid
</pre>