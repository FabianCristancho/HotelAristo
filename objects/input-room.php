							<div class="card card-room col-12">
								<div class="card-header">
									<i class="fa fa-bed"></i>
									<strong class="card-title">Habitación</strong>
								</div>
								
								<div class="card-body">
									<div class="row">
										<div class="form-group in-row">
											<label class="form-control-label">Numero de huespedes</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-group"></i>
												</div>

												<select class="form-control guests-quantity" required>
							                        <option value="S">1 (Sencilla)</option>
							                        <option value="P">2 (Pareja)</option>
							                        <option value="D">2 (Doble)</option>
							                        <option value="T">3 (Triple)</option>
							                        <option value="TS">4 (Triple + Sofacama)</option>
							                    </select>
											</div>
										</div>
										
										<div class="form-group in-row">
											<label class="form-control-label">Tipo de habitación</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-bed"></i>
												</div>

												<select class="form-control" required>
													<?php $consult->getList('roomQuantity','S'); ?>
							                    </select>
											</div>
										</div>

										<div class="form-group in-row">
											<label class="form-control-label">Número de habitación</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-bed"></i>
												</div>

												<select  class="form-control" required>
												 	<?php $consult->getList('roomType','1'); ?>
												</select>
											</div>
										</div>
										
										<div class="form-group in-row">
											<label class="form-control-label">Tarifa de habitación</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-dollar"></i>
												</div>
												<select class="form-control" required>
							                        <?php $consult->getList('tariff','S','1');?>
							                    </select>
							                    <div class="switch-group switch-group-margin-min">
							                    	<label class="switch switch-container">
							                    		<input type="checkbox">
							                    		<span class="slider slider-gray round green"></span>
							                    	</label>
							                    	<label class="switch-label">Descuento</label>
							                    </div>
											</div>
										</div>
										<div class="form-group in-row hideable">
											<label class="form-control-label">Tarifa personalizada</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-dollar"></i>
												</div>
												<input type="number" class="form-control">
											</div>
										</div>
									</div>
								</div>
							</div>