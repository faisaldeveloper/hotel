<?php
/**
 * Creates a new widget based on the given class name and initial properties.
 * Priority order:
 * 1. Actual parameter: $properties
 * 2. Specific widget class factory config
 * 3. CJui common factory config
 * 4. If skin is defined (as above), use skin properties from 
 *    widget specific skin file in active Yii theme
 * @param CBaseController $owner the owner of the new widget
 * @param string $className the class name of the widget. This can also be a path alias (e.g. system.web.widgets.COutputCache)
 * @param array $properties the initial property values (name=>value) of the widget.
 * @return CWidget the newly created widget whose properties have been initialized with the given values.
 */
class EWidgetFactory extends CWidgetFactory
{
  public function createWidget($owner,$className,$properties=array())
  {
    $commonProperties='CJuiWidget';
    $applyTo='CJui';

    $widgetName=Yii::import($className);
    if (isset($this->widgets[$commonProperties]) && strpos($widgetName,$applyTo)===0)
    {
      // Merge widget class specific factory config and the $properties parameter
      // into $properties.
      if(isset($this->widgets[$widgetName]))
        $properties=$properties===array() ? $this->widgets[$widgetName] : CMap::mergeArray($this->widgets[$widgetName],$properties);

      // Merge CJui common factory config and the $properties parameter
      // into the $properties parameter of parent call.
      return parent::createWidget($owner,$className,CMap::mergeArray($this->widgets[$commonProperties],$properties));
    }

    return parent::createWidget($owner,$className,$properties);
  }
}