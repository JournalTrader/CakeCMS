<p>Felicitation ! Votre CMS est installé. Vous allez pouvoir utiliser votre site.</p>
<ul>
    <li><?php echo $this->Html->link("Accéder à l'administrateur", array(
        'manager' => true,
        'plugin' => 'index',
        'controller' => 'index',
        'action' => 'index'
    )) ?></li>
    <li><?php echo $this->Html->link("Visiter mon site", array(
        'plugin' => 'index',
        'controller' => 'index',
        'action' => 'index'
    )) ?></li>
</ul>