<?php

/* /Users/tesina/Documents/git/ebay-amazon-arbitrage/vendor/cakephp/bake/src/Template/Bake/Template/add.twig */
class __TwigTemplate_a00821f1e563b9fb8862e487ad4a3335cbca09408fc6a35da4648f68b9d47e1f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_042ad5d4481151621f74572886c16faf3a794b80b3670c7a334b05d7c920f636 = $this->env->getExtension("WyriHaximus\\TwigView\\Lib\\Twig\\Extension\\Profiler");
        $__internal_042ad5d4481151621f74572886c16faf3a794b80b3670c7a334b05d7c920f636->enter($__internal_042ad5d4481151621f74572886c16faf3a794b80b3670c7a334b05d7c920f636_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "/Users/tesina/Documents/git/ebay-amazon-arbitrage/vendor/cakephp/bake/src/Template/Bake/Template/add.twig"));

        // line 16
        echo "<?php
/**
 * @var \\";
        // line 18
        echo twig_escape_filter($this->env, ($context["namespace"] ?? null), "html", null, true);
        echo "\\View\\AppView \$this
 * @var \\";
        // line 19
        echo twig_escape_filter($this->env, ($context["entityClass"] ?? null), "html", null, true);
        echo " \$";
        echo twig_escape_filter($this->env, ($context["singularVar"] ?? null), "html", null, true);
        echo "
 */
?>
";
        // line 22
echo $context['_view']->element("form",array(),array());
        
        $__internal_042ad5d4481151621f74572886c16faf3a794b80b3670c7a334b05d7c920f636->leave($__internal_042ad5d4481151621f74572886c16faf3a794b80b3670c7a334b05d7c920f636_prof);

    }

    public function getTemplateName()
    {
        return "/Users/tesina/Documents/git/ebay-amazon-arbitrage/vendor/cakephp/bake/src/Template/Bake/Template/add.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 22,  30 => 19,  26 => 18,  22 => 16,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         2.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
#}
<?php
/**
 * @var \\{{ namespace }}\\View\\AppView \$this
 * @var \\{{ entityClass }} \${{ singularVar }}
 */
?>
{% element 'form' %}
", "/Users/tesina/Documents/git/ebay-amazon-arbitrage/vendor/cakephp/bake/src/Template/Bake/Template/add.twig", "");
    }
}
