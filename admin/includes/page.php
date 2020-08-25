<div class="row">
   <div class="col-3 mx-auto">
     <ul class="pagination">
      <?php
         if ($paginate->page_total()>1){

             if($paginate->has_previous()){

                 echo '<li class="previous"><a class="page-link" href="main.php?page='.$paginate->previous().'">Previous</a></li>';

             }
             for ($i = 1; $i <= $paginate->page_total(); $i++){
                 if ($i == $paginate->current_page){

                     echo '<li class="active"><a class="page-link" href="main.php?page='. $i .'"> '. $i .' </a></li>';

                 }else{

                     echo '<li><a class="page-link" href="main.php?page='. $i .'"> ' . $i .' </a></li>';
                 }

             }
             if ($paginate->has_next()){

                 echo '<li class="next"><a class="page-link" href="main.php?page='.$paginate->next().'">Next</a></li>';

             }
         }
      ?>
</ul>
</div>
</div>