<p>Plusieurs étapes sont nécéssaires à l'installation de votre CMS.</p>
<p>Laissez-vous guider par les instructions...</p>

<div class="form-actions">
    <?php
    echo $this->Html->link("Commencer l'installation", array(
        'plugin' => 'installer',
        'controller' => 'installer',
        'action' => 'database'
    ), array(
        'class' => 'btn btn-primary'
    ))
    ?>
</div>