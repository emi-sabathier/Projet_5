<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* template.twig */
class __TwigTemplate_1c542e67e4324f028ddb662e97f72e4644f2bffd629f3f571d817cedf1d2c74c extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!doctype html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>
        ";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        // line 7
        echo "    </title>
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\">
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\"
          integrity=\"sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T\" crossorigin=\"anonymous\">
</head>

<body>
<div class=\"container\">
    <div class=\"navbar navbar-dark bg-dark\">
        <div class=\"row mx-auto\">
            ";
        // line 17
        if (twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "id", [])) {
            // line 18
            echo "                <a href=\"";
            echo twig_escape_filter($this->env, ($context["baseUrl"] ?? null), "html", null, true);
            echo "/disconnect\" class=\"text-white btn btn-danger\">Déconnexion</a>
            ";
        } else {
            // line 20
            echo "                <a href=\"";
            echo twig_escape_filter($this->env, ($context["baseUrl"] ?? null), "html", null, true);
            echo "/authpage\" class=\"text-white btn btn-success\">Connexion</a>
            ";
        }
        // line 22
        echo "        </div>
    </div>
    ";
        // line 24
        $this->displayBlock('body', $context, $blocks);
        // line 26
        echo "</div>
<script src=\"app/public/js/jquery-3.4.1.js\">
</script>
<script src=\"app/public/js/postcomment.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\"
        integrity=\"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1\" crossorigin=\"anonymous\">
</script>
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\"
        integrity=\"sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM\" crossorigin=\"anonymous\">
</script>
</body>

</html>";
    }

    // line 6
    public function block_title($context, array $blocks = [])
    {
        echo "Cuisine rapide";
    }

    // line 24
    public function block_body($context, array $blocks = [])
    {
        // line 25
        echo "    ";
    }

    public function getTemplateName()
    {
        return "template.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  103 => 25,  100 => 24,  94 => 6,  78 => 26,  76 => 24,  72 => 22,  66 => 20,  60 => 18,  58 => 17,  46 => 7,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!doctype html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>
        {% block title %}Cuisine rapide{% endblock %}
    </title>
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\">
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\"
          integrity=\"sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T\" crossorigin=\"anonymous\">
</head>

<body>
<div class=\"container\">
    <div class=\"navbar navbar-dark bg-dark\">
        <div class=\"row mx-auto\">
            {% if session.id %}
                <a href=\"{{ baseUrl }}/disconnect\" class=\"text-white btn btn-danger\">Déconnexion</a>
            {% else %}
                <a href=\"{{ baseUrl }}/authpage\" class=\"text-white btn btn-success\">Connexion</a>
            {% endif %}
        </div>
    </div>
    {% block body %}
    {% endblock %}
</div>
<script src=\"app/public/js/jquery-3.4.1.js\">
</script>
<script src=\"app/public/js/postcomment.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\"
        integrity=\"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1\" crossorigin=\"anonymous\">
</script>
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\"
        integrity=\"sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM\" crossorigin=\"anonymous\">
</script>
</body>

</html>", "template.twig", "C:\\Users\\emilie\\OneDrive\\Projets\\Projet_5\\app\\view\\template.twig");
    }
}
