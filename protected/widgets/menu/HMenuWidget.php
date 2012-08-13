<?php

class HMenuWidget extends BaseMenuWidget
{
    protected function renderMenuRecursive($items)
    {
        $count = 0;
        $n = count($items);
        foreach ($items as $item) {

            if ($item['menu'] == 'horisontal' && (!$this->isTestVisibility || ($this->isTestVisibility && $item['visibility']) == '1' )) {

                $count++;
                $options = isset($item['itemOptions']) ? $item['itemOptions'] : array();
                $class = array();
                if ($item['active'] && $this->activeCssClass != '')
                    $class[] = $this->activeCssClass;
                if ($count === 1 && $this->firstItemCssClass !== null)
                    $class[] = $this->firstItemCssClass;
                if ($count === $n && $this->lastItemCssClass !== null)
                    $class[] = $this->lastItemCssClass;
                if ($this->itemCssClass !== null)
                    $class[] = $this->itemCssClass;
                if ($class !== array()) {
                    if (empty($options['class']))
                        $options['class'] = implode(' ', $class);
                    else
                        $options['class'].=' ' . implode(' ', $class);
                }

                echo CHtml::openTag('li', $options);

                $menu = $this->renderMenuItem($item);
                if (isset($this->itemTemplate) || isset($item['template'])) {
                    $template = isset($item['template']) ? $item['template'] : $this->itemTemplate;
                    echo strtr($template, array('{menu}' => $menu));
                }
                else
                    echo $menu;

                if (isset($item['items']) && count($item['items'])) {
                    echo "\n" . CHtml::openTag('ul', isset($item['submenuOptions']) ? $item['submenuOptions'] : $this->submenuHtmlOptions) . "\n";
                    $this->renderMenuRecursive($item['items']);
                    echo CHtml::closeTag('ul') . "\n";
                }

                echo CHtml::closeTag('li') . "\n";
            }
        }
    }
    
    /* public function init()
      {
      if($this->cssFile===null)
      {
      $file=dirname(__FILE__).DIRECTORY_SEPARATOR.'/views/hmenu/menu.css';
      $this->cssFile=Yii::app()->getAssetManager()->publish($file);
      var_dump($this->cssFile);
      }
      parent::init();
      }

      protected function registerClientScript()
      {
      // …подключаем здесь файлы CSS или JavaScript…
      $file=dirname(__FILE__).DIRECTORY_SEPARATOR.'/views/hmenu';
      $cs=Yii::app()->clientScript;
      $cs->registerCssFile($this->cssFile);
      $cs->registerScriptFile('menu.js');
      } */
    /*
    public $linkLabelWrapper = 'span';

    protected function renderMenuRecursive($items)
    {
        $count = 0;
        $n = count($items);
        foreach ($items as $item) {
            $count++;
            $options = isset($item['itemOptions']) ? $item['itemOptions'] : array();
            $class = array();
            if ($item['active'] && $this->activeCssClass != '')
                $class[] = $this->activeCssClass;
            if ($count === 1 && $this->firstItemCssClass !== null)
                $class[] = $this->firstItemCssClass;
            if ($count === $n && $this->lastItemCssClass !== null)
                $class[] = $this->lastItemCssClass;
            if ($this->itemCssClass !== null)
                $class[] = $this->itemCssClass;
            if ($class !== array()) {
                if (empty($options['class']))
                    $options['class'] = implode(' ', $class);
                else
                    $options['class'].=' ' . implode(' ', $class);
            }

            echo CHtml::openTag('li', $options);
        

            $menu = $this->renderMenuItem($item);
            if (isset($this->itemTemplate) || isset($item['template'])) {
                $template = isset($item['template']) ? $item['template'] : $this->itemTemplate;
                echo strtr($template, array('{menu}' => $menu));
            }
            else
                echo $menu;

            if (isset($item['items']) && count($item['items'])) {
                echo Chtml::openTag('div')."\n";
                echo "\n" . CHtml::openTag('ul', isset($item['submenuOptions']) ? $item['submenuOptions'] : $this->submenuHtmlOptions) . "\n";
                $this->renderMenuRecursive($item['items']);
                echo CHtml::closeTag('ul') . "\n";
                echo Chtml::closeTag('div')."\n";
            }

      
            echo CHtml::closeTag('li') . "\n";
            
        }
    }
    */
}


