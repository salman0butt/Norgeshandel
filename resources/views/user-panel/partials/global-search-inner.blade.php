<style>
#suggestions > div > div.col-md-6 > ul {
    margin-bottom: 0px;
}
</style>
<div class = "row m-2 search-result-topic">


    <div class="col-md-4 p-1 offset-1">
    <?php 

   // dd($result);
  
    if(isset($job)) {
         if($i == 0){
           echo 'jobs'; 
         } 
    }
    else {
          if($j == 0){
           echo 'property';
         } 
    }
   
     ?>
    </div>
		<div class = "col-md-6">
			<ul class="list-unstyled">

				<li class = "p-1">
					<a href="">    
                    <?php
                       if(isset($job)) {
                           echo $search." in ".str_replace('_',' ',$job->job_type)." (".$jobs_count.")";//accessing id for testing
                       }else {
                           echo $search." in ".str_replace('_',' ',$property->getTable())." (".$property_count.")";
                       }
                    ?>
                    
                     </a>
				</li>

			</ul>
		</div>
        
	</div>
</div>
