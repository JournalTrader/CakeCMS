<h2>Etapes d'installations</h2>
<ul>
    <li>Configuration de la base de données.</li>
    <li>Configuration de votre compte administrateur.</li>
    <li>Accès au site.</li>
</ul>

<div class="form-actions">
    <?php echo $this->Html->link("Commencer", array(
        'plugin' => 'install',
        'controller' => 'install',
        'action' => 'database'
    ), array(
        'class' => 'btn btn-primary'
    )) ?>
</div>