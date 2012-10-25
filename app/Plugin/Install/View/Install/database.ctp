<?php if(!isset($pass)): ?>
<form action="<?php echo $this->Html->url(array(
    'plugin' => 'install',
    'controller' => 'install',
    'action' => 'database'
)) ?>" class="form-horizontal" method="POST">
    <div class="control-group">
        <label class="control-label" for="InstallDatasource"> DataSource : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("datasource", array(
                'label' => false,
                'div' => false,
                'default' => 'Database/Mysql',
                'empty' => false,
                'options' => array(
                    'Database/Mysql' => 'mysql',
                    'Database/Sqlite' => 'sqlite',
                    'Database/Postgres' => 'postgres',
                    'Database/Sqlserver' => 'mssql',
                )
            ))
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="InstallHost"> Host: </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("host", array(
                'label' => false,
                'div' => false,
                'value' => "localhost"
            ))
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="InstallLogin"> Login: </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("login", array(
                'label' => false,
                'div' => false,
                'value' => "root"
            ))
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="InstallPassword"> Password: </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("password", array(
                'label' => false,
                'div' => false,
                'value' => "root"
            ))
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="InstallPassword"> Database: </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("database", array(
                'label' => false,
                'div' => false,
                'value' => "altal"
            ))
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="InstallPrefix"> Prefix: </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("prefix", array(
                'label' => false,
                'div' => false
            ))
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="InstallPort"> Port: </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("port", array(
                'label' => false,
                'div' => false
            ))
            ?>
        </div>
    </div>
    <div class="form-actions">
        <?php
        echo $this->Form->input("Créer la base de données", array(
            'type' => 'button',
            'div' => false,
            'label' => false,
            'class' => 'btn btn-primary'
        ))
        ?>
    </div>
</form>
<?php else: ?>
        <div class="form-actions">
        <?php
            echo $this->Html->link('Étape suivante', array(
                'action' => 'step_admin'
            ), array(
                'class' => 'btn btn-primary'
            ))
        ?>
    </div>
<?php endif ?>
