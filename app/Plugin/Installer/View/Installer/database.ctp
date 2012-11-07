<p>Commencez par créer votre base de donner dans votre administrateur MySQL. Puis remplissez le formulaire ci-dessous.</p>
<?php echo $this->Form->create('Installer', array(
    'class' => 'form-horizontal'
)) ?>
<div class="control-group">
    <label class="control-label" for="InstallerDatasource"> Type de la BDD : </label>
    <div class="controls required">
        <?php
            echo $this->Form->input("datasource", array(
                'label' => false,
                'div' => false,
                'empty' => false,
                'options' => array(
                    'Database/Mysql' => 'mysql',
                    'Database/Sqlite' => 'sqlite',
                    'Database/Postgres' => 'postgres',
                    'Database/Sqlserver' => 'mssql',
                ),
                'default' => $default['datasource']
            ));
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="InstallerHost"> Hôte : </label>
    <div class="controls required">
        <?php
            echo $this->Form->input("host", array(
                'label' => false,
                'div' => false,
                'value' => $default['host']
            ));
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="InstallerLogin"> Nom de la BDD : </label>
    <div class="controls required">
        <?php
            echo $this->Form->input("database", array(
                'label' => false,
                'div' => false,
                'default' => $default['database']
            ));
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="InstallerLogin"> Login : </label>
    <div class="controls required">
        <?php
            echo $this->Form->input("login", array(
                'label' => false,
                'div' => false,
                'value' => $default['login']
            ));
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="InstallerPassword"> Mot de passe : </label>
    <div class="controls required">
        <?php
            echo $this->Form->input("password", array(
                'label' => false,
                'div' => false,
                'default' => $default['password']
            ));
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="InstallerPassword"> Préfix : </label>
    <div class="controls required">
        <?php
            echo $this->Form->input("prefix", array(
                'label' => false,
                'div' => false,
                'default' => $default['prefix']
            ));
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="InstallerPassword"> Port : </label>
    <div class="controls required">
        <?php
            echo $this->Form->input("port", array(
                'label' => false,
                'div' => false,
                'default' => $default['port']
            ));
        ?>
    </div>
</div>
<div class="form-actions">
    <?php
    echo $this->Form->input("Créer ma base de données", array(
        'type' => 'button',
        'div' => false,
        'label' => false,
        'class' => 'btn btn-primary'
    ))
    ?>
</div>
<?php echo $this->Form->end() ?>