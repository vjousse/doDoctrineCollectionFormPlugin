doDoctrineCollectionFormPlugin
========================================================

Overview
--------

This "plugin" is a simple form class. It allows you to embed and save doctrine 
(object) forms into a non object form. But why ? Because you can call the save()
or bindAndSave() method on form embedding the object forms.

Installation
------------

Install the plugin into your plugin directory (with a git clone or
by downloding a tgz)

Enabled it in `ProjectConfiguration.class.php`

    [php]
    class ProjectConfiguration extends sfProjectConfiguration
    {
      public function setup()
      {
        $this->enablePlugins(array(
          'doDoctrineCollectionFormPlugin',
          '...'
        ));
      }
    }


Usage
-----

Your form must inherit from doDoctrineCollectionForm

    [php]
    class MealCommandCollectionForm extends DoctrineCollectionForm
    {

      public function configure()
      {

      $this->embedForm('firstObjectForm', new FirstObjectForm($myObject));
      $this->embedForm('secondObjectForm', new SecondObjectForm($my2Object));
      ...

      }
    }

That's all ! Your DoctrineCollectionForm is not bound to any object but you can
call save() and bindAndSave() method on it, it will correctly save the
embedded forms.