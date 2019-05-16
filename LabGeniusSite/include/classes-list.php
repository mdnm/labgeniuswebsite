<div class="classes-list">
	<div class="tables-container">
		
			<?php
				foreach ($modulo->getModulos($id_curso) as $key => $modulo_value) { ?>

					<div class="block-cont position-center width90" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1);" id="<?php echo $modulo_value->id;?>">

						<table class="order-table">

							<thead>
								<tr class="indice">
									<th><?php echo $modulo_value->name;?></th>
								</tr>
							</thead>
							<tbody>
								<?php //verifica se existem aulas
								$aulas = count($aula->buscarAula($id_curso, $modulo_value->id));
								if($aulas > 0){
									foreach ($aula->buscarAula($id_curso, $modulo_value->id) as $key => $aula_value) {
										if($aula_value->type == 1){
                                            // 1 é video
											echo '<tr headers="'.$aula_value->id_aula.'"><td id="info"><i class="fab fa-youtube fa-lg"></i>&emsp;'.$aula_value->titulo.'</td></tr>';
                                        }else{
											// 2 é outros
											echo '<tr headers="'.$aula_value->id_aula.'"><td id="info"><i class="fas fa-clipboard-list fa-lg"></i>&emsp;'.$aula_value->titulo.'</td></tr>';
										}
										
									}
								}else{
								}
								
								?>
								
							</tbody>		  
						</table>
					</div>

				<?php } ?>


			
		</div>
	
</div>