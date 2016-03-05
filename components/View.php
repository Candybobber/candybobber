<?php

/**
 * Class View
 * Component for generating templates
 */
class View {


  /**
   * @var array
   */
  protected $content;


  /**
   * @var array
   */
  protected $params;


  /**
   * @var string
   */
  protected $template;


  /**
   * @param $template
   * @param array $params
   */
  public function render($template, $params = array()) {
    echo $this->fetch($template, $params);
  }

  /**
   * @param $template
   * @param array $params
   * @return string
   */
  public function fetch($template, $params = array()){
    $content = $this->fetchPartial($template, $params);
    return $this->fetchPartial('template', array_merge(['content' => $content], $params));
  }


  /**
   * @param $template
   * @param array $params
   * @return string
   */
  public function fetchPartial($template, $params = array()){
    extract($params);
    ob_start();
    include ROOT . '/views/' . $template . '.php';
    return ob_get_clean();
  }
}
