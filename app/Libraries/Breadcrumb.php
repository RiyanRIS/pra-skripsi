<?php
namespace App\Libraries;

class Breadcrumb
{
  private $breadcrumbs = array();
  private $tags;

  public function __construct()
  {
    $this->URI = service('uri');

    $this->clickable = true;

    $this->tags['navopen']  = "<nav aria-label=\"breadcrumb\">";
    $this->tags['navclose'] = "</nav>";
    $this->tags['olopen']   = "<ol class=\"breadcrumb\">";
    $this->tags['olclose']  = "</ol>";
    $this->tags['liopen']   = "<li class=\"breadcrumb-item\">";
    $this->tags['liclose']  = "</li>";
    $this->tags['liopenfirst']   = "<li class=\"breadcrumb-item\"><i class=\"fa fa-home\"></i>";
    $this->tags['liclose']  = "</li>";
    
  }

  public function add($crumb, $href)
  {
    if (!$crumb or !$href) return;

    $this->breadcrumbs[] = array(
      'crumb' => $crumb,
      'href' => $href,
    );
  }


  public function render()
  {

    $output  = $this->tags['navopen'];
    $output .= $this->tags['olopen'];

    $count = count($this->breadcrumbs) - 1;
    $no = 0;

    foreach ($this->breadcrumbs as $index => $breadcrumb) {

      if ($index == $count) {
        $output .= $this->tags['liopen'];
        $output .= $breadcrumb['crumb'];
        $output .= $this->tags['liclose'];
      } else {
        $output .= ($no++==0?$this->tags['liopenfirst']:$this->tags['liopen']);
        $output .= '<a href="' . $breadcrumb['href'] . '">';
        $output .= $breadcrumb['crumb'];
        $output .= '</a>';
        $output .= $this->tags['liclose'];
      }
    }

    $output .= $this->tags['olclose'];
    $output .= $this->tags['navclose'];

    return $output;
  }

    public function buildAuto()
    {

        $urisegments = $this->URI->getSegments();

        $output  = $this->tags['navopen'];
        $output .= $this->tags['olopen'];

        $crumbs = array_filter($urisegments);

        $result = array();
        $path = '';

        // SUBTRACT 1 FROM COUNT IF THE LAST LINK IS TO NOT BE A LINK
        $count = count($crumbs) ;

        if ($this->clickable){

            $count = count($crumbs) -1;
        }
        
        $no=0;

        foreach ($crumbs as $k => $crumb) {

            $path .= '/' . $crumb;

            $name = ucwords(str_replace(array(".php", "_"), array("", " "), $crumb));
            $name = ucwords(str_replace('-', ' ', $name));

            if ($k != $count) {
                $result[] = ($no++==0?$this->tags['liopenfirst']:$this->tags['liopen']) . '<a href="' . $path . '"> ' . $name . '</a>' . $this->tags['liclose'];

            } else {

                $result[] = $this->tags['liopen'] . $name . $this->tags['liclose'];

            }
        }

        $output .= implode($result);
        $output .= $this->tags['olclose'];
        $output .= $this->tags['navclose'];

        return $output;
    }
}