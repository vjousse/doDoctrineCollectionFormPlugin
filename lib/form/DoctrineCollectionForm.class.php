<?php
/**
 * Description of DoctrineCollectionForm
 *
 * @package     doDoctrineCollectionFormPlugin
 * @subpackage  form
 * @author      Vincent Jousse <vincent.jousse@devorigin.fr>
 */
class DoctrineCollectionForm extends BaseFormDoctrine
{
  /**
   * Constructor.
   *
   * Notifies the 'form.post_configure' event.
   *
   * @see sfForm
   */
  public function __construct($defaults = array(), $options = array(), $CSRFSecret = null)
  {
    //SKeeping the sfFormDoctrine constructor (no object bound to this form)
    sfFormSymfony::__construct($defaults, $options, $CSRFSecret);

    if (self::$dispatcher)
    {
      self::$dispatcher->notify(new sfEvent($this, 'form.post_configure'));
    }
  }

  /**
   * Updates and saves the embedded forms.
   *
   * @param mixed $con An optional connection object
   */
  protected function doSave($con = null)
  {
    if (null === $con)
    {
      $con = $this->getConnection();
    }


    $this->updateObject();
    
    // embedded forms
    $this->saveEmbeddedForms($con);
  }

  /**
   * Updates the values of the embedded objects with the cleaned up values.
   * There is no more object attached to this form
   *
   * @param  array $values An array of values
   *
   * @return mixed The current updated object
   */
  public function updateObject($values = null)
  {
    if (null === $values)
    {
      $values = $this->values;
    }

    $values = $this->processValues($values);

    // embedded forms
    $this->updateObjectEmbeddedForms($values);

    return true;
  }


  /**
   * There is no current model name.
   *
   * @return string
   */
  public function getModelName()
  {
    return null;
  }

  /**
   * This form has no object bound
   * Just return null
   *
   * @return mixed The current object
   */
  public function getObject()
  {
    return null;
  }

}
?>
