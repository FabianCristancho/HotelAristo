				<div class="card card-client col-12">
							<div class="card-header">
								<i class="fa fa-user"></i>
								<strong class="card-title">Información personal</strong>
							</div>

							<div class="hideable id-container"></div>

							<div>
								<div class="card-body">
									<div class="row">
										<div class="form-group in-row col-6 padd">
											<label class="form-control-label">Nombres*</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-user-o"></i>
												</div>
												<input class="form-control" type="text" placeholder="Nombres" onkeyup="this.value=this.value.toUpperCase();" onkeydown="checkInputOnlyLetters(event,this);" maxlength="60" minlength="2" required>
											</div>
											<small class="form-text text-muted">ej. PEDRO LUIS</small>
										</div>

										<div class="form-group in-row col-6 padd">
											<label class="form-control-label">Apellidos*</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-user-o"></i>
												</div>
												<input class="form-control" type="text" placeholder="Apellidos" onkeyup="this.value=this.value.toUpperCase();" onkeydown="checkInputOnlyLetters(event,this);" minlength="2" maxlength="60" required>
											</div>
											<small class="form-text text-muted">ej. PEREZ PEREZ</small>
										</div>
									</div>

									<div class="row">
										<div class="form-group in-row col-3 padd">
											<label class="form-control-label">Tipo de documento*</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-id-card"></i>
												</div>

												<select class="form-control">
						                            <option value="CC">Cédula de ciudadania</option>
						                            <option value="RC">Registro civil</option>
						                            <option value="TI">Tarjeta de identidad</option>
						                            <option value="CE">Cedula de extranjeria</option>
						                        </select>
											</div>
										</div>

										<div class="form-group in-row col-4 padd">
											<label class="form-control-label">Número de documento*</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-id-card"></i>
												</div>
												 <input class="form-control" type="text" placeholder="Número de documento" minlength="6" maxlength="15" onkeydown="$(this).mask('000000000000000');">
											</div>
											<small class="form-text text-muted">ej. 123456789</small>
										</div>
                                        
                                        <div class="form-group in-row col-4 padd">
											<label class="form-control-label">Telefono*</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-phone"></i>
												</div>
												<input class="form-control phone-mask" type="text" placeholder="Telefono" maxlength="15" minlength="7" onkeydown="$(this).mask('000 000 0000');" required>
											</div>
											<small class="form-text text-muted">ej. 3123334466</small>
										</div>
									</div>


									<div class="row">
                                        <div class="form-group in-row col-4 padd">
											<label class="form-control-label">Cargo</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-user-o"></i>
												</div>

												<select class="form-control">
						                            <?php $consult->getList('role');?>
						                        </select>
											</div>
										</div>
										<div class="form-group in-row col-6 padd">
											<label class="form-control-label">Correo</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-envelope"></i>
												</div>
												 <input class="form-control" type="email" placeholder="Correo electrónico">
											</div>
											<small class="form-text text-muted">ej. pedro.lopez@mail.com</small>
										</div>
									</div>
                                    
                                    
                                    <div class="row">
										<div class="form-group in-row col-4 padd">
											<label class="form-control-label">Nombre de Usuario*</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-user-o"></i>
												</div>
												<input class="form-control" type="text" placeholder="Nombre de Usuario" maxlength="50" minlength="2" required>
											</div>
											<small class="form-text text-muted">ej. pedro.perez</small>
										</div>

										<div class="form-group in-row col-4 padd">
											<label class="form-control-label">Contraseña*</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-lock"></i>
												</div>
												<input class="form-control" type="password" placeholder="Contraseña" minlength="2" maxlength="60" required>
											</div>
										</div>
                                        
                                        <div class="form-group in-row col-4 padd">
											<label class="form-control-label">Repetir Contraseña*</label>
											<div class="input-group">
												<div class="input-group-icon">
													<i class="fa fa-lock"></i>
												</div>
												<input class="form-control" type="password" placeholder="Repetir Contraseña" minlength="2" maxlength="60" required>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>