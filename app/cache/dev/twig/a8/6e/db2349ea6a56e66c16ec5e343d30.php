<?php

/* ::layout.html.twig */
class __TwigTemplate_a86edb2349ea6a56e66c16ec5e343d30 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'container' => array($this, 'block_container'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />

    <title>";
        // line 8
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

    ";
        // line 10
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 14
        echo "  </head>

  <body>
    <div class=\"wrapper\">
      <div id=\"header\">
        <h1>Mon Projet Symfony2 (layout général)</h1>       
      </div>
\t
\t<div class=\"container\">
\t";
        // line 23
        $this->displayBlock('container', $context, $blocks);
        // line 25
        echo "\t</div>
      

      <footer>
        <p>The sky's the limit © 2013 and beyond.</p>
      </footer>
    </div>

  ";
        // line 33
        $this->displayBlock('javascripts', $context, $blocks);
        // line 39
        echo "
  </body>
</html>";
    }

    // line 8
    public function block_title($context, array $blocks = array())
    {
        echo "Sdz";
    }

    // line 10
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 11
        echo "      <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/bootstrap.css"), "html", null, true);
        echo "\" type=\"text/css\" />
      <link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/fullcalendar/fullcalendar/fullcalendar.css"), "html", null, true);
        echo "\" type=\"text/css\" />
    ";
    }

    // line 23
    public function block_container($context, array $blocks = array())
    {
        // line 24
        echo "\t";
    }

    // line 33
    public function block_javascripts($context, array $blocks = array())
    {
        // line 34
        echo "    ";
        // line 35
        echo "    <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery.js"), "html", null, true);
        echo "\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/fullcalendar/fullcalendar/fullcalendar.js"), "html", null, true);
        echo "\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/scripts.js"), "html", null, true);
        echo "\"></script>
  ";
    }

    public function getTemplateName()
    {
        return "::layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  110 => 37,  106 => 36,  101 => 35,  99 => 34,  96 => 33,  92 => 24,  89 => 23,  83 => 12,  78 => 11,  75 => 10,  69 => 8,  63 => 39,  61 => 33,  51 => 25,  49 => 23,  38 => 14,  36 => 10,  31 => 8,  23 => 2,);
    }
}
