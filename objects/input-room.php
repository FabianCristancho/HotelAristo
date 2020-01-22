							<div class="card card-room col-12">
								<div class="card-header">
									<i class="fa fa-bed"></i>
									<strong class="card-title">Habitación</strong>
								</div>
								<div class="card-preview">
									<div class="row">
										<div class="form-group col-3">
											<strong>Tipo :</strong>
											<label></label>
										</div>
										<div class="form-group col-3">
											<strong>Número :</strong>
											<label></label>
										</div>								
										<div class="form-group col-3">
											<strong>Cant. huespedes :</strong>
											<label></label>
										</div>
										<div class="form-group col-3">
											<strong>Tarifa :</strong>
											<label></label>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="form-group in-row">
											<label class="form-control-label">Tipo de habitación</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-bed"></i>
												</div>
												<select class="form-control" required>
							                        <option value="J" selected>JOLIOT</option>
							                        <option value="H">HAWKING</option>
							                        <option value="L">LISPECTOR</option>
							                        <option value="M">MAKKAH</option>
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
												 	<?php $consult->getList('roomType','J'); ?>
												</select>
											</div>
										</div>
										<div class="form-group in-row">
											<label class="form-control-label">Numero de huespedes</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-group"></i>
												</div>
												<select class="form-control guests-quantity" required>
							                        <option value="1">1 (Sencilla)</option>
							                        <option value="2">2 (Pareja)</option>
							                        <option value="2">2 (Doble)</option>
							                        <option value="3">3 (Triple)</option>
							                        <option value="4">3 (Triple + Sofacama)</option>
							                    </select>
											</div>
										</div>
										<div class="form-group in-row">
											<label class="form-control-label">Tarifa de habitación</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-dollar"></i>
												</div>
												<input type="number" class="form-control" required>
											</div>
										</div>
									</div>
								</div>
							</div>