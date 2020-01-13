						<div class="card card-enterprise">
							<div class="card-header">
								<strong class="card-title">Información de la empresa</strong>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="form-group in-row col-4 padd">
										<label class="form-control-label">NIT</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-industry"></i>
											</div>
											<input class="form-control" type="text" id="nit" name="nit" required>
										</div>
										<small class="form-text text-muted">123456789-1</small>
									</div>
									<div class="form-group in-row col-8 padd">
										<label class="form-control-label">Nombre de la empresa</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-tag"></i>
											</div>
											<input class="form-control" type="text" id="name" name="name" required>
										</div>
										<small class="form-text text-muted">ej. Almacén Triple A</small>
									</div>
								</div>
								
								<div class="row">
									<div class="form-group in-row col-4 padd">
										<label class="form-control-label">Telefono</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-phone"></i>
											</div>
											<input id="phone" class="form-control" type="tel" placeholder="Telefono" pattern="[0-9]{1,15}" required>
										</div>
										<small class="form-text text-muted">ej. 3123334466</small>
									</div>
									<div class="form-group in-row col-8 padd">
										<label class="form-control-label">Correo</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-envelope"></i>
											</div>
											 <input id="email" class="form-control" type="email" placeholder="Correo electrónico">
										</div>
										<small class="form-text text-muted">ej. pedro.lopez@mail.com</small>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-3 padd">
                                        <div class="col-4">
                                        	<label class=" form-control-label">Retefuente (3.5%)</label>
                                        </div>
                                        <div class="form-check col-8 padd">
                                        	<div>
                                        		<label>
                                        			<input type="radio" name="retefuente" value="1" class="form-check-input">Si
                                        		</label>
                                        		<label>
                                        			<input type="radio" name="retefuente" value="0" class="form-check-input" checked>No
                                                </label>
                                        	</div>
                                        </div>
                                    </div>
									<div class="form-group in-row col-9 padd">
										<label class="form-control-label">Otro impuesto</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-dollar"></i>
											</div>
											<select id="otro-impuesto" class="combo form-control">
			                                    <option value="NULL">Ninguno</option>
			                                </select>
				                       	 </div>
									</div>
								</div>
							</div>
						</div>