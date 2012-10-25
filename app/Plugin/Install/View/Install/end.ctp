<p>Vous pouvez vous connecter a votre administrateur avec votre adresse mail et le mot de passe que vous avez choisi.</p>
<ul>
    <li><?php echo $this->Html->link("Accéder à l'administrateur", array(
        'manager' => true,
        'plugin' => 'index',
        'controller' => 'index',
        'action' => 'index',
    )) ?></li>
    <li><?php echo $this->Html->link("Visiter le site", array(
        'plugin' => 'index',
        'controller' => 'index',
        'action' => 'index',
    )) ?></li>
</ul>