<html>
   <body>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <?php
         echo Form::open(array('url' => '/uploadfile','files'=>'true'));
         echo '<h1 class = "text-warning">Select the file to upload.</h1>';
         echo Form::file('image');
         echo Form::text('ruta', '/root');
         echo Form::submit('Upload File', array('class' => 'btn btn-primary'));
         echo Form::close();  
      ?>
      <x-button></x-button>
   </body>
</html>