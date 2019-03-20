<div class=" container col-sm-9 page box">
  		<div class="centered-content">
  			<div class="row">
        		<div class="col-md-12">
          			<h1>Résultats de recherche pour: <b><?=  $term; ?></b></h1>
        		</div>
      		</div>
      		<?php if (isset($not_found) OR !empty($errors)): ?>
						<div class="panel panel-warning">
			        	<div class="panel-heading">
			          		<h3 class="panel-title">
			            	<p>Désolé, mais rien ne correspond à vos termes de recherche "<b><?=  $term; ?></b>". Veuillez réessayer avec d'autres mots-clés.</p>
			          		</h3>
			          		<?php if (isset($errors)): ?>
							<p><small class="label label-danger pull-right"><?= $errors; ?></small></p>
							<p><small class="label label-success pull-left">*La liste en bas propose tous les chapitres du blog</small></p><br>
							<?php endif ?>
			        	</div>   

			      	</div>	
			      	<?php else: ?>
			     	<div class="panel panel-success">
			        	<div class="panel-heading">
			          		<h3 class="panel-title">
			            	Votre terme recherché à été <?= $number_finded; ?> fois trouvée dans le blog
			            		<small class="pull-right"></small>
			          		</h3>
			        	</div>                
			      	</div>	

					<?php endif ?>

      		<div class="row">
			<?php $chapter = ' ';?>

          	<!--resukts for search -->
	        	<div class="panel panel-info">
	            	<table class="table table-bordered table-striped table-sm table-condensed">
	              		<div class="panel-heading"> 
	                		<h3 class="panel-title text-center"><span class="fa fa-address-card"></span>  Rechercher dans les <b><?= isset($search_in)? $search_in : '0'; ?></h3>
	              		</div>
	              		<thead>
			              	<tr>
			                  <th class="col-xs-4 text-center">Chapitres</th>
			                  <th class="col-xs-8 text-center">Èpisodes</th>
			              	</tr>
		            	</thead>

		              	<?php foreach ($results AS $result): ?>
				      	<?php if($chapter != $result->chapter): ?>
			      		<tbody>
			              	<tr>
			                  	<th class="col-xs-4">
			                  		<h4 class="list-group-item-heading">
			                    		<i class="fa fa-book "></i>
			                    		<a href="<?= urlHtml('chapter/' . seo($result->chapter) . '/' . $result->chapter_id); ?>"  data-toggle="tooltip" data-placement="bottom" title="Afficher le chapitre"><?=  $result->chapter; ?>
			                    		</a>
			                		</h4>
			                  	</th>
			              		<td class="col-xs-8">
						<?php endif?>	              
			                 		<span class="list-group-item-text">
			                			<a href="<?= urlHtml('/episode/' . seo($result->title) . '/' . $result->id); ?>"  data-toggle="tooltip" data-placement="bottom" title="Afficher l'épisode">
			                    		<span class="label label-info"><?= $result->title;  ?></span>
			                    		</a>
			                		</span>
			                	
			                 	<?php $chapter = $result->chapter ?> 
			                 	<?php if($chapter != $result->chapter): ?>
			                 	</td>
			              	</tr>
		              	<?php endif?>
		               
						<?php endforeach ?>
							</td></tr>
						</tbody>
					</table>
	        	</div>
	        </div>
        </div>
  	</div>
 