<?php if(isset($message)): 
    
    $type = (isset($type)) ? $type:null;

    switch($type)
    {
        case AppController::TYPE_ERROR:
            $type = 'error';
            $intro = __('Erreur');
            break;
        case AppController::TYPE_WARNING:
            $type = 'warning';
            $intro = __('Attention');
            break;
        case AppController::TYPE_INFO:
            $type = 'info';
            $intro = __('Info');
            break;
        case AppController::TYPE_SUCCESS:
        default:
            $type = 'success';
            $intro = __('Félicitation');
            break;
    }
?>

<div class="alert alert-<?php echo $type ?>">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong><?php echo $intro ?> !</strong> <?php echo $message ?>
</div>
         
<?php endif ?>