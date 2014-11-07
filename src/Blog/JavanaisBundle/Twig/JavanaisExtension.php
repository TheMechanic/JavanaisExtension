<?php
namespace Blog\JavanaisBundle\Twig;

class JavanaisExtension extends \Twig_Extension 
{
    private $vowels ='aeiouAEIOUéèêëîïôöàâäùüûÉÈÊËÎÏÔÖÀÂÄÙÜÛ';

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('javanais', array($this, 'javanais')),
        );
    }
 
    public function javanais($text)
    {
        // Mettre en minuscule la première lettre du texte
        $text = lcfirst($text);

        // Ajoute AV entre une consonne et une voyelle
        $pattern = '/([a-zA-Z^yY' . $this->vowels . '])([' . $this->vowels . '])/u';
        $replacement = '$1av$2';
        $translated = preg_replace($pattern, $replacement, $text);

        // Ajoute AV devant les mots commençant par des voyelles
        $pattern = '/(\s|^)([' . $this->vowels . '])/u';
        $replacement = '$1av$2';
        $translated = preg_replace($pattern, $replacement, $translated);

        // Mettre en majuscule la première lettre du texte, et retourner le texte
        return ucfirst($translated);
    }

    public function getName()
    {
        return 'javanais_extension';
    }
}
