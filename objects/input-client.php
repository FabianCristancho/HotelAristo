						<div class="card card-client col-12">
							<div class="card-header">
								<strong class="card-title">Información personal</strong>
								<button onclick="showAllInputs(0);" class="btn-check-in btn">Check in</button>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="form-group in-row col-6 padd">
										<label class="form-control-label">Nombres*</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-user-o"></i>
											</div>
											<input id="first" class="form-control" type="text" placeholder="Nombres" required>
										</div>
										<small class="form-text text-muted">Pedro Luis</small>
									</div>
									<div class="form-group in-row col-6 padd">
										<label class="form-control-label">Apellidos*</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-user-o"></i>
											</div>
											<input id="last" class="form-control" type="text" placeholder="Apellidos" required>
										</div>
										<small class="form-text text-muted">ej. Perez Perez</small>
									</div>
								</div>
								<div class="hideable row">
									<div class="form-group in-row col-4 padd">
										<label class="form-control-label">Tipo de documento*</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-id-card"></i>
											</div>
											<select class="form-control" id="doc-type">
					                            <option value="CC">Cédula de ciudadania</option>
					                            <option value="RC">Registro civil</option>
					                            <option value="TI">Tarjeta de identidad</option>
					                            <option value="CE">Cedula de extranjeria</option>
					                        </select>
										</div>
									</div>
									<div class="form-group in-row col-5 padd">
										<label class="form-control-label">Número de documento*</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-id-card"></i>
											</div>
											 <input id="doc-num" class="form-control" type="text" placeholder="Número de documento" pattern="[0-9]{1,15}">
										</div>
										<small class="form-text text-muted">ej. 12345678</small>
									</div>
									<div class="form-group in-row col-3 padd">
										<label class="form-control-label">Fecha de expedición*</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-calendar"></i>
											</div>
											<input id="doc-date" class="form-control" type="date">
										</div>
										<small class="form-text text-muted">ej. 10/12/2004</small>
									</div>
								</div>
								<div class="row hideable">
									<div class="form-group in-row col-7 padd">
										<label class="form-control-label">Pais (Expedición)*</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-map-marker"></i>
											</div>
											<select class="form-control" onchange="updateCities(this);">
												<option value="51">Colombia</option>
												<?php $consult->getList('country',''); ?>
	                       					</select>
										</div>
									</div>
									<div class="form-group in-row col-5 padd">
										<label class="form-control-label">Ciudad (Expedición)*</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-map-marker"></i>
											</div>
											<select id="ciudad" class="form-control">
												<?php $consult->getList('city','51'); ?>
	                       					</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group in-row col-4 padd">
										<label class="form-control-label">Telefono*</label>
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
								<div class="row hideable">
									<div class="form-group in-row col-3 padd">
										<label class="form-control-label">Genero*</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-intersex"></i>
											</div>
					                        <select id="gender" class="form-control">
					                            <option value="M">Hombre</option>
					                            <option value="F">Mujer</option>
					                        </select>
					                    </div>
									</div>
									<div class="form-group in-row col-4 padd">
										<label class="form-control-label">Fecha de nacimiento*</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-calendar"></i>
											</div>
					                        <input id="birth" class="form-control" type="date">
					                    </div>
					                    <small class="form-text text-muted">ej. 22/09/1985</small>
									</div>
									<div class="form-group in-row col-5 padd">
										<label class="form-control-label">Tipo de sangre*</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-heartbeat"></i>
											</div>
					                        <select id="blood" class="form-control col-3 padd">
					                            <option value="O">O</option>
					                            <option value="A">A</option>
					                            <option value="B">B</option>
					                            <option value="AB">AB</option>
					                        </select>
					                         <select id="rh" class="form-control col-9 padd">
				                            	<option value="+">+ (Positivo)</option>
				                            	<option value="-">- (Negativo)</option>
				                       	 	</select>
				                       	 </div>
									</div>
								</div>
								<div class="row">
									<div class="hideable form-group in-row col-3 padd">
										<label class="form-control-label">Profesión</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-bank"></i>
											</div>
					                       <select id="profession" class="form-control">
					                            <option value="NULL">Ninguna</option>
					                            <?php $consult->getList('profession',''); ?>
					                        </select>
					                        <button onclick="showModal('add-prof');" class="btn-circle"><i class="fa fa-plus"></i></button>
					                    </div>
									</div>
									<div class="form-group in-row col-3 padd">
										<label class="form-control-label">Empresa</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-bank"></i>
											</div>
					                       <select id="enterprise" class="form-control">
						                        <option value="NULL">NINGUNA</option>
						                        <?php $consult->getList('enterprise',''); ?>
						                    </select>
					                        <button onclick="showModal('add-bizz');" class="btn-circle"><i class="fa fa-plus"></i></button>
					                    </div>
									</div>
									<div class="hideable form-group in-row col-6 padd">
										<label class="form-control-label">Nacionalidad*</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-map-marker"></i>
											</div>
					                        <select id="nac" class="form-control">
					                        	<option value="51">Colombia</option>
					                            <?php $consult->getList('country',''); ?>
					                        </select>
					                    </div>
									</div>
								</div>
							</div>
							<button class="btn btn-done">Listo</button>
						</div>