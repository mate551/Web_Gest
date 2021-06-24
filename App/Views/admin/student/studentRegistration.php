<section id="student-registration">

    <div class="row main-container">

        <h5 class="col-lg-12 mb-4 mt-3 ml-5">Cadastrar aluno</h5>

        <div class="card col-lg-10 mx-auto mb-4" id="student-record-accordion">

            <div class="registration-in-stages mb-2 accordion">

                <div class="registration-header-by-step mt-2">

                    <div class="connection-line"></div>

                    <div class="container-option">

                        <a type="button" class="" data-toggle="collapse" data-target="#student-registration-initial-data"><span>1</span></a>

                        <p>Dados pessoais</p>

                    </div>

                    <div class="container-option">

                        <a type="button" class="collapsed" data-toggle="collapse" data-target="#student-registration-address-and-others"><span>2</span></a>

                        <p>Localidade e outros</p>

                    </div>

                    <div class="container-option">

                        <a type="button" class="collapsed" data-toggle="collapse" data-target="#student-registration-class"><span>3</span></a>

                        <p>Turma de destino</p>

                    </div>

                    <div class="container-option">

                        <a type="button" class="collapsed" data-toggle="collapse" data-target="#student-registration-finishing"><span>4</span></a>

                        <p>Finalizando</p>

                    </div>

                </div>

                <form class="mt-3" id="addStudent" role="form" enctype="multipart/form-data" method="POST" action="/admin/aluno/cadastro/inserir">

                    <div class="row collapse show" id="student-registration-initial-data" data-parent="#student-record-accordion">
                        <div class="col-lg-10 mt-2 mx-auto">
                            <div class="form-row mt-1">

                                <div class="form-group col-md-5">
                                    <label for="name">Nome Completo:</label>
                                    <input type="text" value="" class="form-control" id="name" name="name" placeholder="" maxlength="120" required>
                                </div>

                                <div id="cpfField" class="form-group col-md-4">
                                    <label for="cpf">CPF:</label>
                                    <input type="text" id="cpf" value="" minlength="14" name="cpf" class="form-control" placeholder="000.000.000-00" required>
                                </div>

                                <div class="form-group col-md-3">

                                    <label for="sex">Sexo:</label>

                                    <select id="sex" name="sex" class="form-control custom-select is-valid">

                                        <?php foreach ($this->view->availableSex as $key => $sex) { ?>

                                            <option value="<?= $sex->option_value ?>"><?= $sex->option_text ?></option>

                                        <?php } ?>

                                    </select>

                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label for="birthDate">Data Nascimento:</label>
                                    <input name="birthDate" id="birthDate" type="date" max="2006-01-31" min="1940-01-31" class="form-control" id="birthDate" placeholder="" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="naturalness">Naturalidade:</label>
                                    <input name="naturalness" name="naturalness" type="text" class="form-control" id="naturalness" placeholder="" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="nationality">Nacionalidade:</label>
                                    <input type="text" name="nationality" id="nationality" value="" class="form-control" id="nationality" placeholder="" required>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-5">
                                    <label for="motherName">Nome da Mãe:</label>
                                    <input type="text" class="form-control" value="" name="motherName" id="motherName" maxlength="120" required>
                                </div>

                                <div class="form-group col-md-5">
                                    <label for="fatherName">Nome do Pai:</label>
                                    <input type="text" class="form-control" value="" name="fatherName" id="fatherName" maxlength="120" required>
                                </div>

                                <div class="form-group col-md-2">

                                    <label for="pcd">PcD:</label>

                                    <select id="pcd" name="pcd" class="form-control custom-select is-valid">

                                        <?php foreach ($this->view->pcd as $key => $pcd) { ?>

                                            <option value="<?= $pcd->option_value ?>"><?= $pcd->option_text ?></option>

                                        <?php } ?>

                                    </select>

                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-lg-12 d-flex justify-content-end">
                                    <a type="button" data-toggle="collapse" data-target="#student-registration-address-and-others" class="btn text-white mt-2 collapsed" href="">Proximo <i class="fas fa-angle-right"></i></a>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row collapse" id="student-registration-address-and-others" data-parent="#student-record-accordion">
                        <div class="col-lg-10 mx-auto">

                            <div class="form-row mt-3">

                                <div id="zipCodeField" class="form-group col-md-3">
                                    <label for="zipCode">CEP:</label>
                                    <input type="text" id="zipCode" value="" class="form-control" name="zipCode" minlength="9" placeholder="00000-000" required>
                                </div>

                                <div class="form-group col-md-5">
                                    <label for="county">Munícipio:</label>
                                    <input type="text" id="county" class="form-control" value="" name="county" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="district">Bairro:</label>
                                    <input type="text" id="district" value="" class="form-control" name="district" placeholder="" required>
                                </div>


                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="address">Endereço:</label>
                                    <input type="text" id="address" value="" class="form-control" name="address" placeholder="" required>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="uf">UF:</label>
                                    <input type="text" id="uf" class="form-control" value="" maxlength="2" name="uf" placeholder="" required>
                                </div>

                                <div id="telephoneField" class="form-group col-md-4">
                                    <label for="telephoneNumber">Contato:</label>
                                    <input type="tel" id="telephoneNumber" value="" class="form-control" name="telephoneNumber" placeholder="(00) 00000-0000" required>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-3">

                                    <label for="bloodType">Tipo sanguíneo:</label>

                                    <select id="bloodType" name="bloodType" class="form-control custom-select is-valid">

                                        <?php foreach ($this->view->bloodType as $key => $bloodType) { ?>

                                            <option value="<?= $bloodType->option_value ?>"><?= $bloodType->option_text ?></option>

                                        <?php } ?>

                                    </select>

                                </div>


                                <div id="photoField" class="form-group col-md-8">
                                    <label for="">&nbsp;</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input form-control" name="profilePhoto" id="profilePhoto">
                                        <label class="custom-file-label" for="profilePhoto" data-browse="Arquivo">Selecionar uma foto para o perfil do aluno</label>

                                    </div>
                                </div>


                                <div class="form-group col-md-1">
                                    <label for="">&nbsp;</label>
                                    <a type="button" class="btn btn-success w-100 p-2" data-toggle="modal" data-target="#profilePhotoModal">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>

                            </div>

                            <div class="form-row d-flex justify-content-end">

                                <div class="form-group mr-2">
                                    <a type="button" data-toggle="collapse" data-target="#student-registration-initial-data" class="btn bg-secondary text-white mt-2 collapsed" href=""><i class="fas fa-angle-left mr-3"></i> Voltar</a>
                                </div>

                                <div class="form-group">
                                    <a type="button" class="collapsed btn text-white mt-2 collapsed" data-toggle="collapse" data-target="#student-registration-class" href="">Proximo <i class="fas fa-angle-right ml-3"></i></a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row collapse" id="student-registration-class" data-parent="#student-record-accordion">
                        <div class="col-lg-10 mx-auto">

                            <div class="form-row mt-3 mb-5">

                                <div class="form-group col-md-12">
                                    <label for="class">Turma</label>
                                    <select id="class" name="class" class="form-control custom-select is-valid">

                                        <?php

                                        foreach ($this->view->availableClass as $i => $class) {

                                            $totalVacancies = $class->class_capacity - $class->student_total;


                                            $newName = $class->series_acronym . ' ' . $class->ballot . ' - ' . $class->course . ' - ' . $class->shift . ' - Sala: ' . $class->classroom_number . ' - ' . 'Vagas: ' . $totalVacancies;

                                        ?>
                                            <?php if ($totalVacancies >= 1) { ?>

                                                <option value="<?= $class->class_id ?>"><?= $newName ?></option>

                                            <?php } ?>

                                        <?php } ?>

                                    </select>
                                </div>




                            </div>

                            <div class="form-row d-flex justify-content-end">

                                <div class="form-group mr-2">
                                    <a type="button" data-toggle="collapse" data-target="#student-registration-address-and-others" class="btn bg-secondary text-white mt-2 collapsed" href=""><i class="fas fa-angle-left mr-3"></i> Voltar</a>
                                </div>

                                <div class="form-group">
                                    <a type="button" class="collapsed btn text-white mt-2 collapsed" data-toggle="collapse" data-target="#student-registration-finishing" href="">Proximo <i class="fas fa-angle-right ml-3"></i></a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row collapse" id="student-registration-finishing" data-parent="#student-record-accordion">

                        <div class="col-lg-10 mx-auto">

                            <div class="row">

                                <h5 class="mt-2 col-lg-12 text-left">Finalizando a matricula de <span givenName></span></h5>

                                <div containerStudentRegistrationStatus class="col-lg-12"></div>

                                <div class="col-lg-12">

                                    <div class="row d-flex justify-content-between">

                                        <p class=""><a type="button" data-toggle="collapse" data-target="#student-registration-class" class="btn bg-secondary text-white collapsed ml-3" href=""><i class="fas fa-angle-left mr-3"></i> Voltar</a></p>

                                        <p class=""> <button id="buttonAddStudent" disabled class="btn btn-success">Cadastra aluno (a)</button></p>

                                    </div>


                                </div>

                            </div>

                        </div>
                    </div>
            </div>

            <div class="modal fade" id="profilePhotoModal" tabindex="-1" aria-labelledby="profilePhotoModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="profilePhotoModal">Foto selecionada</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-img col-lg-12 d-flex justify-content-center"><img alt="Selecione uma foto" class="mx-auto rounded-circle" src="" id="visualizarimagem" style="width:300px; height: 300px; object-position:top; object-fit: cover;"></div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar ao cadastro</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>

        </div>

    </div>

</section>