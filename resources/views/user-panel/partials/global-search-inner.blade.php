<div class = "row m-2 search-result-topic">


    <div class="col-md-4 p-1 offset-1">
    <?php 

    dd($result);
    if($result) {
    echo 'jobs'; 
    }
    else {
    echo 'property';
    }
     ?>
    </div>
		<div class = "col-md-6">
			<ul class="list-unstyled">

				<li class = "p-1">
					<a href="#">    
                    <?php
                       if($result) {
                           echo $search." in ".$result;
                       }else {
                           echo $search." in ".$result['heading'];
                       }
                    ?>
                    
                     </a>
				</li>

			</ul>
		</div>
        
	</div>
</div>
